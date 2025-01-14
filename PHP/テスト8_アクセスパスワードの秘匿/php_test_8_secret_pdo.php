<?php
require 'secret_func.php';

$pdo = getPDO();

// クエリパラメータからidを取得
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $query_param_id = (int)$_GET['id'];
} else {
    $query_param_id = 99999;
}

echo "input id " . $query_param_id ."<br>";

// 入力されたIDのレコードを取得.
$stmt = $pdo->prepare('SELECT id, param FROM test_6_table WHERE id = :id');
$stmt->execute(['id' => $query_param_id]);
$record = $stmt->fetch();

echo "<br>";
echo "record no nakami";
echo "<br>";
var_dump($record);
echo "<br>";
echo "<br>";

if ($record) {
    // レコードが存在する場合、paramを取得
    $param = $record['param'];

    echo "id " . $query_param_id . " param " . $param;
} else {
    // レコードが存在しない場合、新しいレコードを作成
    echo "No Record id " . $query_param_id;
}

?>