</main>
<?php $base = str_contains($_SERVER['PHP_SELF'] ?? '', '/admin/') ? '../' : ''; ?>
<footer class="site-footer"><div class="footer-main"><a class="brand brand-light" href="<?= $base ?>index.html"><span class="brand-mark">O</span><span>olive <i>&</i> ember<small>GOOD FOOD, GATHERED</small></span></a><p>Good food, good company, a little more time around the table.</p><div><span class="eyebrow">HOURS</span><br><?= e(setting('opening_hours','Daily · 11:00 AM – 10:00 PM')) ?></div></div><div class="footer-bottom"><span>© <?= date('Y') ?> Olive & Ember</span><span>Curated menu · European & Myanmar favourites</span><a href="<?= $base ?>photo-credits.php">Menu photo credits</a><a href="<?= $base ?>admin/index.php">Staff access</a></div></footer>
<script src="<?= $base ?>assets/js/app.js"></script>
<?php if(str_contains($_SERVER['PHP_SELF']??'','/admin/')): ?><script src="<?= $base ?>assets/js/admin.js"></script><link rel="stylesheet" href="<?= $base ?>assets/css/admin.css"><?php endif; ?>
</body></html>
