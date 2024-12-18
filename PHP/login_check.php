<?php
require 'secret_func.php';

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

echo "input id " . $query_param_id;
echo " random_key " . $query_param_random_key."<br>";

$pdo = getPDO();

// 入力に基づいて、一致したユーザーデータが存在するか確認.
$stmt = $pdo->prepare('SELECT id, random_key FROM users WHERE id = :id AND random_key = :random_key');
$stmt->execute(['id' => $query_param_id, 'random_key' => $query_param_random_key]);
$record = $stmt->fetch();

echo "<br>";

if ($record) {
    echo "login success<br>";

} else {
    echo "login fail<br>";
}

?>