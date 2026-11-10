<?php
require_once __DIR__ . '/../includes/functions.php';header('Content-Type: application/json; charset=utf-8');
$user=current_user();$orderId=(int)($_GET['id']??0);if(!$user||$user['role']!=='customer'){http_response_code(401);echo json_encode(['error'=>'Sign in required']);exit;}
$stmt=db()->prepare('SELECT status,updated_at FROM orders WHERE id=? AND user_id=?');$stmt->execute([$orderId,$user['id']]);$order=$stmt->fetch();if(!$order){http_response_code(404);echo json_encode(['error'=>'Order not found']);exit;}echo json_encode(['status'=>$order['status'],'updated_at'=>$order['updated_at']]);
