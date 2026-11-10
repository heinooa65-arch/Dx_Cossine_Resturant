<?php
declare(strict_types=1);
define('DB_HOST',getenv('DB_HOST')?:'127.0.0.1');
define('DB_PORT',getenv('DB_PORT')?:'3306');
define('DB_NAME',getenv('DB_NAME')?:'restaurant_db');
define('DB_USER',getenv('DB_USER')?:'root');
define('DB_PASS',getenv('DB_PASS')!==false?getenv('DB_PASS'):'');
define('APP_NAME',getenv('APP_NAME')?:'Olive & Ember');
date_default_timezone_set(getenv('APP_TIMEZONE')?:'Asia/Yangon');

function db(): PDO
{
    static $pdo=null;
    if($pdo instanceof PDO)return $pdo;
    $pdo=new PDO('mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME.';charset=utf8mb4',DB_USER,DB_PASS,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES=>false,PDO::ATTR_PERSISTENT=>false]);
    return $pdo;
}

final class PdoSessionHandler implements SessionHandlerInterface
{
    public function open(string $path,string $name):bool{return true;}
    public function close():bool{return true;}
    public function read(string $id):string|false{$q=db()->prepare('SELECT session_data FROM app_sessions WHERE session_id=? AND expires_at>?');$q->execute([$id,time()]);$data=$q->fetchColumn();return $data===false?'':(string)$data;}
    public function write(string $id,string $data):bool{$expiry=time()+(int)ini_get('session.gc_maxlifetime');$q=db()->prepare('INSERT INTO app_sessions (session_id,session_data,expires_at) VALUES (?,?,?) ON DUPLICATE KEY UPDATE session_data=VALUES(session_data),expires_at=VALUES(expires_at)');return $q->execute([$id,$data,$expiry]);}
    public function destroy(string $id):bool{$q=db()->prepare('DELETE FROM app_sessions WHERE session_id=?');return $q->execute([$id]);}
    public function gc(int $max_lifetime):int|false{$q=db()->prepare('DELETE FROM app_sessions WHERE expires_at<?');$q->execute([time()]);return $q->rowCount();}
}

if(session_status()!==PHP_SESSION_ACTIVE){
    session_set_save_handler(new PdoSessionHandler(),true);
    session_set_cookie_params(['httponly'=>true,'secure'=>(!empty($_SERVER['HTTPS'])&&$_SERVER['HTTPS']!=='off')||getenv('VERCEL')==='1','samesite'=>'Lax','path'=>'/']);
    session_start();
}
