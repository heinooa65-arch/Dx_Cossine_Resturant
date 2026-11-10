<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/menu_catalog.php';
$message='';$error='';$count=0;
if($_SERVER['REQUEST_METHOD']==='POST'){
    csrf_check();
    try{
        $pdo=db();$pdo->beginTransaction();
        foreach([['admin@olive.local','Restaurant Admin','admin'],['staff@olive.local','Kitchen Staff','staff']] as [$email,$name,$role]){
            $check=$pdo->prepare('SELECT id FROM users WHERE email=?');$check->execute([$email]);
            if(!$check->fetch()){$insert=$pdo->prepare('INSERT INTO users (name,email,password_hash,role) VALUES (?,?,?,?)');$insert->execute([$name,$email,password_hash('Olive123!',PASSWORD_DEFAULT),$role]);}
        }
        $pdo->exec("INSERT IGNORE INTO settings (setting_key,setting_value) VALUES ('opening_time','11:00'),('closing_time','22:00'),('opening_hours','Daily · 11:00 AM – 10:00 PM'),('closed_days',''),('delivery_fee','1500')");
        for($i=1;$i<=10;$i++){$seats=$i<=4?2:($i<=8?4:6);$insert=$pdo->prepare('INSERT IGNORE INTO restaurant_tables (table_number,seats) VALUES (?,?)');$insert->execute(['T'.str_pad((string)$i,2,'0',STR_PAD_LEFT),$seats]);}
        $count=seed_curated_menu($pdo);$pdo->commit();$message='Setup is complete. The offline menu catalog is ready with '.$count.' dishes and drinks.';
    }catch(Throwable $e){if(isset($pdo)&&$pdo->inTransaction())$pdo->rollBack();$error='Setup could not finish. Check the database import and MySQL service. Details: '.$e->getMessage();}
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Restaurant setup</title><link rel="stylesheet" href="assets/css/style.css"><link rel="stylesheet" href="assets/css/extras.css"></head><body class="setup-page"><div class="setup-card"><a class="brand" href="index.html"><span class="brand-mark">O</span><span>olive <i>&</i> ember<small>ONE-TIME XAMPP SETUP</small></span></a><h1>Set the table.</h1><p>This adds the sample staff accounts, ten dining tables, restaurant settings, and a curated offline menu of European favourites, Myanmar traditional dishes, desserts, and drinks.</p><?php if($message): ?><div class="notice success"><?= e($message) ?><p>For security, delete or rename <code>setup.php</code> after setup.</p></div><?php endif; ?><?php if($error): ?><div class="notice error"><?= e($error) ?></div><?php endif; ?><div class="credential-box"><span class="eyebrow">SAMPLE ACCOUNTS</span><p><b>Admin</b> · admin@olive.local · <code>Olive123!</code><br><b>Staff</b> · staff@olive.local · <code>Olive123!</code></p><small>Change these passwords after signing in. Customers can create accounts from the Join us link.</small></div><form method="post"><input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>"><button class="button button-dark" type="submit">Run setup <span>↗</span></button></form><p class="setup-foot">First create the <b>restaurant_db</b> database and import <code>database.sql</code>.</p></div></body></html>
