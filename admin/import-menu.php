<?php
require_once __DIR__ . '/../includes/functions.php';require_once __DIR__ . '/../includes/menu_catalog.php';
require_role(['admin']);$error='';$count=count(array_merge(...array_map(fn($group)=>$group['items'],curated_menu_catalog())));
if($_SERVER['REQUEST_METHOD']==='POST'){
    csrf_check();$pdo=db();
    try{$pdo->beginTransaction();$count=seed_curated_menu($pdo);$pdo->commit();flash('Added or refreshed '.$count.' curated menu dishes and drinks.');redirect('index.php?tab=menu');}
    catch(Throwable $e){if($pdo->inTransaction())$pdo->rollBack();$error='The menu could not be imported. Details: '.$e->getMessage();}
}
$pageTitle='Import offline menu';require __DIR__ . '/../includes/header.php';?>
<section class="page-shell"><div class="page-heading"><span class="eyebrow">OFFLINE MENU CATALOG</span><h1>Stock the <em>menu.</em></h1><p>Import <?= (int)$count ?> European and Myanmar favourites, sweets, and drinks with sample MMK prices and food photos. Existing order history remains intact.</p></div><div class="content-card profile-card"><?php if($error): ?><div class="notice error"><?= e($error) ?></div><?php endif; ?><p class="muted">Catalog items are updated by their internal catalog key, so you can safely run this more than once. Items you have marked unavailable stay unavailable.</p><form method="post"><input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>"><button class="button button-dark">Import curated menu <span>↗</span></button></form><a class="inline-link" href="index.php?tab=menu">← Back to menu management</a></div></section><?php require __DIR__ . '/../includes/footer.php';?>
