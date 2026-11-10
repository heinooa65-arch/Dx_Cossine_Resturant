<?php
require_once __DIR__ . '/includes/functions.php';
if (current_user()) redirect('index.html');
$pageTitle='Join us'; $error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    csrf_check(); $name=trim($_POST['name'] ?? ''); $email=strtolower(trim($_POST['email'] ?? '')); $phone=trim($_POST['phone'] ?? ''); $password=(string)($_POST['password'] ?? '');
    if (mb_strlen($name)<2 || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($password)<8) $error='Enter your name and a valid email. Passwords must be at least 8 characters.';
    else {
        try { $stmt=db()->prepare("INSERT INTO users (name,email,password_hash,role,phone) VALUES (?,?,?,'customer',?)"); $stmt->execute([$name,$email,password_hash($password,PASSWORD_DEFAULT),$phone]); $_SESSION['user']=['id'=>(int)db()->lastInsertId(),'name'=>$name,'email'=>$email,'role'=>'customer','phone'=>$phone,'address'=>null]; flash('Welcome in, '.explode(' ',$name)[0].'!'); redirect('index.html'); }
        catch(PDOException $e){$error='That email is already registered. Try signing in.';}
    }
}
require __DIR__ . '/includes/header.php'; ?>
<section class="auth-wrap"><div class="auth-side"><span class="eyebrow">PULL UP A CHAIR</span><h1>There's room<br>for <em>one more.</em></h1><p>Create an account for easy ordering, table bookings, and a little more time around the table.</p><div class="auth-scribble">✳</div></div><div class="auth-card"><span class="eyebrow">JOIN THE TABLE</span><h2>Let's get to know you.</h2><p class="muted">Your email is your sign in. No fuss.</p><?php if($error): ?><div class="notice error"><?= e($error) ?></div><?php endif; ?><form method="post" class="form-stack"><input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>"><label>Your name<input name="name" autocomplete="name" required maxlength="120" value="<?= e($_POST['name'] ?? '') ?>"></label><label>Email address<input type="email" name="email" autocomplete="email" required value="<?= e($_POST['email'] ?? '') ?>"></label><label>Phone number <small>(optional)</small><input type="tel" name="phone" autocomplete="tel" value="<?= e($_POST['phone'] ?? '') ?>"></label><label>Password<input type="password" name="password" autocomplete="new-password" minlength="8" required><small>At least 8 characters.</small></label><button class="button button-dark button-wide">Create account <span>↗</span></button></form><p class="form-foot">Already have an account? <a href="login.php">Sign in</a></p></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
