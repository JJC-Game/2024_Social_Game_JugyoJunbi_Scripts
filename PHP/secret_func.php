<?php
function getPDO() {
    $dsn = 'mysql:host=localhost;dbname=2024_social_game_db;charset=utf8';
    $username = 'root';
    $password = '';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    try {
        $pdo = new PDO($dsn, $username, $password, $options);
        return $pdo;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit;
    }
}

function boolReturnTest($param1){
    $param2 = 100;

    if ($param1 == $param2) {
        return true;
    } else {
        return false;
    }
}


function loginCheck($pdo){
    // クエリパラメータからidを取得
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $query_param_id = (int)$_GET['id'];
    } else {
        $query_param_id = 99999;
    }

    if (isset($_GET['random_key']) && is_numeric($_GET['random_key'])) {
        $query_param_random_key = (int)$_GET['random_key'];
    } else {
        $query_param_random_key = 1000000;
    }

    // 入力に基づいて、一致したユーザーデータが存在するか確認.
    $stmt = $pdo->prepare('SELECT id, random_key FROM users WHERE id = :id AND random_key = :random_key');
    $stmt->execute(['id' => $query_param_id, 'random_key' => $query_param_random_key]);
    $record = $stmt->fetch();

    if ($record) {
        return true;    // ログイン成功
    } else {
        return false;   // ログイン失敗
    }
}
?>