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

// idが1のレコードを検索
$stmt = $pdo->prepare('SELECT random_key FROM users WHERE id = :id');
$stmt->execute(['id' => $query_param_id]);
$record = $stmt->fetch();

// var_dump($record);

echo "<br>";

if ($record) {
    // レコードが存在する場合、random_keyを取得
    $random_key = $record['random_key'];

    if($query_param_random_key == $random_key){
        echo "login success<br>";

        echo "id: " . $query_param_id . " random_key: " . $random_key;
        echo "<br>";
        $sql_str = 'UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE id = ' . $query_param_id;
        $stmt = $pdo->prepare($sql_str);
        $stmt->execute();
        echo "Last Login Updated";
        echo "<br>";
    }else{
        echo "login fail<br>";
    }
} else {
    // レコードが存在しない場合、新しいレコードを作成
    $random_key = rand(1, 999999);
    echo "new random_key " . $random_key;
    $stmt = $pdo->prepare('INSERT INTO users (random_key) VALUES (:random_key)');
    $stmt->execute(['random_key' => $random_key]);
    echo "New record created with Unique Key: " . $random_key;
}

?>