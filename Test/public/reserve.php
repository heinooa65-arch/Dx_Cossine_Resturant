<?php
require_once __DIR__ . '/includes/functions.php';
$user=require_login(); $pageTitle='Book a table'; $error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    csrf_check();
    $date=$_POST['date'] ?? ''; $time=$_POST['time'] ?? ''; $guests=(int)($_POST['guests'] ?? 0); $phone=trim($_POST['phone'] ?? ($user['phone'] ?? '')); $note=trim($_POST['note'] ?? '');
    $dateObj=DateTime::createFromFormat('Y-m-d',$date); $timeObj=DateTime::createFromFormat('H:i',$time);
    $closed=array_filter(array_map('intval',explode(',',setting('closed_days'))),fn($v)=>$v>=0&&$v<=6);
    if (!$dateObj || $dateObj->format('Y-m-d')!==$date || $date < date('Y-m-d') || !$timeObj || $guests<1 || $guests>20 || $phone==='') $error='Choose a valid future date, time, party size, and phone number.';
    elseif ($date===date('Y-m-d') && strtotime($date.' '.$time)<time()) $error='Choose a time that has not passed yet.';
    elseif (in_array((int)date('w',strtotime($date)),$closed,true)) $error='The restaurant is closed on that day. Please choose another date.';
    elseif ($time < setting('opening_time','11:00') || $time >= setting('closing_time','22:00')) $error='Please choose a time within our opening hours (' . setting('opening_time','11:00') . '–' . setting('closing_time','22:00') . ').';
    else {
        $start=strtotime($date.' '.$time); $end=$start+5400;
        try {
            $pdo=db(); $pdo->beginTransaction();
            $tables=$pdo->prepare('SELECT id FROM restaurant_tables WHERE is_active=1 AND seats>=? ORDER BY seats,id FOR UPDATE'); $tables->execute([$guests]); $candidate=$tables->fetchAll(); $tableId=null;
            foreach ($candidate as $table) {
                $conflict=$pdo->prepare("SELECT COUNT(*) FROM reservations WHERE table_id=? AND status IN ('Pending','Approved') AND reservation_date=? AND TIMESTAMP(reservation_date,reservation_time) < FROM_UNIXTIME(?) AND TIMESTAMP(reservation_date,reservation_time) > FROM_UNIXTIME(?)");
                $conflict->execute([$table['id'],$date,$end,$start-5400]);
                if (!(int)$conflict->fetchColumn()) { $tableId=(int)$table['id']; break; }
            }
            if (!$tableId) { $pdo->rollBack(); $error='Sorry, no table for that party size is free around this time. Try a different time.'; }
            else {
                $insert=$pdo->prepare("INSERT INTO reservations (user_id,table_id,guest_name,guest_email,guest_phone,reservation_date,reservation_time,guests,status,note) VALUES (?,?,?,?,?,?,?,?,'Pending',?)");
                $insert->execute([$user['id'],$tableId,$user['name'],$user['email'],$phone,$date,$time.':00',$guests,$note]); $pdo->commit(); flash('Your reservation request is in. We’ll confirm it soon.'); redirect('orders.php#reservations');
            }
        } catch(Throwable $e) { if(isset($pdo)&&$pdo->inTransaction())$pdo->rollBack(); $error='Could not save your reservation. Please try again.'; }
    }
}
$pageTitle='Book a table'; require __DIR__ . '/includes/header.php'; ?>
<section class="page-shell reservation-page"><div class="page-heading"><span class="eyebrow">SAVE YOUR SEAT</span><h1>A place at <em>our table.</em></h1><p>Tell us when and how many. Your request is held while our team confirms a table.</p></div><div class="content-card reservation-form-card"><div class="form-intro"><span class="eyebrow">TABLE REQUEST</span><p>We're open <?= e(setting('opening_hours','daily from 11 AM to 10 PM')) ?>.</p></div><?php if($error): ?><div class="notice error"><?= e($error) ?></div><?php endif; ?><form method="post" class="form-stack"><input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>"><div class="form-row"><label>Date<input type="date" name="date" min="<?= date('Y-m-d') ?>" required value="<?= e($_POST['date'] ?? '') ?>"></label><label>Time<input type="time" name="time" min="<?= e(setting('opening_time','11:00')) ?>" max="<?= e(setting('closing_time','22:00')) ?>" required value="<?= e($_POST['time'] ?? '') ?>"></label></div><div class="form-row"><label>Guests<select name="guests" required><?php for($n=1;$n<=12;$n++): ?><option value="<?= $n ?>" <?= (int)($_POST['guests'] ?? 2)===$n?'selected':'' ?>><?= $n ?> <?= $n===1?'guest':'guests' ?></option><?php endfor; ?></select></label><label>Phone number<input type="tel" name="phone" required value="<?= e($_POST['phone'] ?? $user['phone'] ?? '') ?>"></label></div><label>Anything we should know? <small>(optional)</small><textarea name="note" rows="3" placeholder="High chair, birthday, seating preference…"><?= e($_POST['note'] ?? '') ?></textarea></label><button class="button button-dark">Request a table <span>↗</span></button><small class="muted">We'll check opening hours and table availability before saving your request.</small></form></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
