<?php
require_once __DIR__ . '/../includes/functions.php';
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, max-age=0');
$categories=db()->query('SELECT id,name FROM categories WHERE is_active=1 ORDER BY sort_order,name')->fetchAll();
$items=db()->query('SELECT m.id,m.category_id,m.name,m.description,m.price,m.photo_url,c.name AS category_name FROM menu_items m JOIN categories c ON c.id=m.category_id WHERE m.is_available=1 AND c.is_active=1 ORDER BY c.sort_order,m.name')->fetchAll();
echo json_encode(['categories'=>$categories,'items'=>$items,'opening_hours'=>setting('opening_hours','Daily · 11:00 AM – 10:00 PM')],JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
