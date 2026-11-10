<?php
require_once __DIR__ . '/includes/functions.php';
if (current_user()) redirect('index.html');
$pageTitle='Sign in'; $error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    csrf_check(); $email=strtolower(trim($_POST['email'] ?? '')); $password=(string)($_POST['password'] ?? '');
    $stmt=db()->prepare('SELECT id,name,email,password_hash,role,phone,address FROM users WHERE email=?'); $stmt->execute([$email]); $row=$stmt->fetch();
    if ($row && password_verify($password,$row['password_hash'])) { unset($row['password_hash']); session_regenerate_id(true); $_SESSION['user']=$row; redirect($row['role']==='customer'?'index.html':'admin/index.php'); }
    $error='That email and password do not match.';
}
require __DIR__ . '/includes/header.php'; ?>
<section class="auth-wrap"><div class="auth-side"><span class="eyebrow">WELCOME BACK</span><h1>Your table<br>is <em>waiting.</em></h1><p>Sign in to follow your order, save your address, and make a reservation.</p><div class="auth-scribble">✳</div></div><div class="auth-card"><span class="eyebrow">SIGN IN</span><h2>Good to see you.</h2><p class="muted">Use your email and password to continue.</p><?php if($error): ?><div class="notice error"><?= e($error) ?></div><?php endif; ?><form method="post" class="form-stack"><input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>"><label>Email address<input type="email" name="email" autocomplete="email" required value="<?= e($_POST['email'] ?? '') ?>"></label><label>Password<input type="password" name="password" autocomplete="current-password" required></label><button class="button button-dark button-wide">Sign in <span>↗</span></button></form><p class="form-foot">New to the table? <a href="register.php">Create an account</a></p></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
