<?php
declare(strict_types=1);
require_once __DIR__ . '/../config.php';

function e(?string $value): string { return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8'); }
function money(float|int|string $value): string { return number_format((float)$value, 0) . ' MMK'; }
function redirect(string $url): never { header('Location: ' . $url); exit; }
function csrf_token(): string { return $_SESSION['csrf'] ??= bin2hex(random_bytes(32)); }
function csrf_check(): void {
    if (!hash_equals($_SESSION['csrf'] ?? '', (string)($_POST['csrf'] ?? ''))) {
        http_response_code(419); exit('Your session expired. Refresh the page and try again.');
    }
}
function flash(string $message, string $type = 'success'): void { $_SESSION['flash'] = ['message' => $message, 'type' => $type]; }
function current_user(): ?array { return $_SESSION['user'] ?? null; }
function require_login(): array { if (!current_user()) redirect((str_contains($_SERVER['PHP_SELF'] ?? '', '/admin/') ? '../' : '') . 'login.php'); return current_user(); }
function require_role(array $roles): array {
    $user = require_login();
    if (!in_array($user['role'], $roles, true)) { http_response_code(403); exit('You do not have access to this page.'); }
    return $user;
}
function notify_user(int $userId, string $title, string $message, ?int $orderId = null): void {
    $stmt = db()->prepare('INSERT INTO notifications (user_id, order_id, title, message) VALUES (?, ?, ?, ?)');
    $stmt->execute([$userId, $orderId, $title, $message]);
}
function setting(string $key, string $fallback = ''): string {
    $stmt = db()->prepare('SELECT setting_value FROM settings WHERE setting_key = ?');
    $stmt->execute([$key]); $value = $stmt->fetchColumn();
    if ($value === false) return $fallback;
    if ($key === 'closed_days') $value = implode(',', array_map(fn($day) => $day === '0' ? '00' : $day, explode(',', (string)$value)));
    return (string)$value;
}
function page_title(string $title): string { return $title . ' · ' . APP_NAME; }
