<?php
declare(strict_types=1);

// XAMPP defaults; production hosts can provide these values as environment variables.
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'restaurant_db');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
const APP_NAME = 'Dx_CosSine';
date_default_timezone_set(getenv('APP_TIMEZONE') ?: 'Asia/Yangon');

function db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) return $pdo;
    $pdo = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    return $pdo;
}

final class PdoSessionHandler implements SessionHandlerInterface
{
    public function open(string $path, string $name): bool { return true; }
    public function close(): bool { return true; }
    public function read(string $id): string|false
    {
        $query = db()->prepare('SELECT session_data FROM app_sessions WHERE session_id=? AND expires_at>?');
        $query->execute([$id, time()]);
        $data = $query->fetchColumn();
        return $data === false ? '' : (string)$data;
    }
    public function write(string $id, string $data): bool
    {
        $expires = time() + (int)ini_get('session.gc_maxlifetime');
        $query = db()->prepare('INSERT INTO app_sessions (session_id,session_data,expires_at) VALUES (?,?,?) ON DUPLICATE KEY UPDATE session_data=VALUES(session_data),expires_at=VALUES(expires_at)');
        return $query->execute([$id, $data, $expires]);
    }
    public function destroy(string $id): bool
    {
        $query = db()->prepare('DELETE FROM app_sessions WHERE session_id=?');
        return $query->execute([$id]);
    }
    public function gc(int $maxLifetime): int|false
    {
        $query = db()->prepare('DELETE FROM app_sessions WHERE expires_at<?');
        $query->execute([time()]);
        return $query->rowCount();
    }
}

if (session_status() !== PHP_SESSION_ACTIVE) {
    $onVercel = getenv('VERCEL') === '1';
    if ($onVercel) session_set_save_handler(new PdoSessionHandler(), true);
    session_set_cookie_params(['httponly' => true, 'secure' => $onVercel || (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'), 'samesite' => 'Lax', 'path' => '/']);
    session_start();
}
