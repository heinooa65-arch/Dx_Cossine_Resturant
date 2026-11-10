<?php
require_once __DIR__ . '/functions.php';
$user = current_user();
$active = basename($_SERVER['PHP_SELF'] ?? 'index.html');
$base = str_contains($_SERVER['PHP_SELF'] ?? '', '/admin/') ? '../' : '';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#17251f"><title><?= e(page_title($pageTitle ?? '')) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
  <link rel="stylesheet" href="<?= $base ?>assets/css/extras.css">
</head>
<body>
<header class="site-header"><a class="brand" href="<?= $base ?>index.html"><span class="brand-mark">O</span><span>olive <i>&</i> ember<small>GOOD FOOD, GATHERED</small></span></a>
  <button class="nav-toggle" aria-label="Open navigation" aria-expanded="false">☰</button>
  <nav class="main-nav">
    <a class="<?= $active === 'index.html' ? 'current' : '' ?>" href="<?= $base ?>index.html#menu">Menu</a>
    <a href="<?= $base ?>reserve.php">Reservations</a>
    <?php if ($user && $user['role'] === 'customer'): ?><a href="<?= $base ?>orders.php">My orders</a><?php endif; ?>
    <?php if ($user && in_array($user['role'], ['admin','staff'], true)): ?><a href="<?= $base ?>admin/index.php">Staff desk</a><?php endif; ?>
  </nav>
  <div class="header-actions"><a class="cart-link" href="<?= $base ?>cart.php">Bag <span class="cart-count">0</span></a>
    <?php if ($user): ?><a class="text-link" href="<?= $base ?>profile.php"><?= e(explode(' ', $user['name'])[0]) ?></a><a class="button button-dark button-small" href="<?= $base ?>logout.php">Sign out</a>
    <?php else: ?><a class="text-link" href="<?= $base ?>login.php">Sign in</a><a class="button button-dark button-small" href="<?= $base ?>register.php">Join us</a><?php endif; ?>
  </div>
</header>
<?php if (!empty($_SESSION['flash'])): $f = $_SESSION['flash']; unset($_SESSION['flash']); ?>
<div class="flash <?= e($f['type']) ?>" role="status"><?= e($f['message']) ?><button aria-label="Dismiss" onclick="this.parentElement.remove()">×</button></div>
<?php endif; ?>
<main>
