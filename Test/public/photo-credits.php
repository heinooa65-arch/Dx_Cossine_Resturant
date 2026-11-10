<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/menu_catalog.php';

$pageTitle = 'Menu photo credits';
require __DIR__ . '/includes/header.php';
$catalog = curated_menu_catalog();
$images = menu_image_catalog();
?>
<section class="page-shell">
  <div class="page-heading">
    <span class="eyebrow">PHOTO SOURCES</span>
    <h1>Every dish has<br><em>its own picture.</em></h1>
    <p>The seeded catalog pairs every dish and drink with a distinct Commons image. Open a source page to see the photographer, license, and reuse terms.</p>
  </div>
  <?php foreach ($catalog as $group): ?>
    <section class="content-card photo-credit-section">
      <div class="panel-heading"><div><span class="eyebrow">PHOTO CREDITS</span><h2><?= e($group['name']) ?></h2></div></div>
      <div class="photo-credit-list">
        <?php foreach ($group['items'] as $item): [$name] = $item; $file = $images[$name] ?? ''; ?>
          <article class="photo-credit-row">
            <img src="<?= e(catalog_photo($name)) ?>" alt="" loading="lazy">
            <div><h3><?= e($name) ?></h3><small><?= e($file) ?></small><small>Creator and license details are on the linked Commons file page.</small></div>
            <?php if ($file !== ''): ?><a class="inline-link" href="<?= e(catalog_photo_source($name)) ?>" target="_blank" rel="noopener noreferrer">Source &amp; license ↗</a><?php endif; ?>
          </article>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endforeach; ?>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
