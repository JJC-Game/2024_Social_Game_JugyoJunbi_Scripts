<?php
require 'secret_func.php';

// クエリパラメータからidを取得
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $query_param_id = (int)$_GET['id'];
} else {
    $query_param_id = 99999;
}

$pdo = getPDO();
$login_result = loginCheck($pdo);

if ($login_result) {
    echo "login success<br>";

    // ガチャの実行.
    // 剰余を得て、入手したガチャIDを決定.
    $rand_num = mt_rand(1, 10016);
    $get_chara_id = $rand_num % 32;
    $gacha_result_chara_flag = 1 << $get_chara_id;
    echo "<br>";
    echo "get chara id " . $get_chara_id . "<br>";
    echo "get chara flag 2^" . $get_chara_id . " = " . $gacha_result_chara_flag . "<br>";
    echo "<br>";

    // 入力に基づいて、一致したユーザーデータが存在するか確認.
    $stmt = $pdo->prepare('SELECT user_has_chara_flag FROM user_gacha WHERE user_id = :user_id');
    $stmt->execute(['user_id' => $query_param_id]);
    $record = $stmt->fetch();
    if ($record) {
        echo "exist gacha data<br>";
        $has_chara_flag = $record['user_has_chara_flag'];

        echo "before gacha chara flag " . $has_chara_flag . "<br>";
        $has_chara_flag = $has_chara_flag | $gacha_result_chara_flag;
        echo "after gacha chara flag " . $has_chara_flag . "<br>";

        $stmt = $pdo->prepare('UPDATE user_gacha SET user_has_chara_flag = :user_has_chara_flag WHERE user_id = :user_id');
        $stmt->execute(['user_id' => $query_param_id, 'user_has_chara_flag' => $has_chara_flag]);

        $has_chara_id_string = "";
        $not_has_chara_id_string = "";
        for ($i = 0; $i <= 31; $i++) {
            $check_chara_flag = 1 << $i;
            $and_operation_result = $has_chara_flag & $check_chara_flag;
            if( $and_operation_result != 0 ){
                $has_chara_id_string = $has_chara_id_string.$i.",";
            }else{
                $not_has_chara_id_string = $not_has_chara_id_string.$i.",";
            }
        }
        echo "<br>";
        echo "has chara id " . $has_chara_id_string;
        echo "<br>";
        echo "not has chara id " . $not_has_chara_id_string;

    }else{
        echo "not exist gacha data<br>";
        // レコードが存在しない場合、新しいレコードを作成
        echo "get chara " . $gacha_result_chara_flag . "<br>";
        $stmt = $pdo->prepare('INSERT INTO user_gacha (user_id, user_has_chara_flag) VALUES (:user_id, :user_has_chara_flag)');
        $stmt->execute(['user_id' => $query_param_id, 'user_has_chara_flag' => $gacha_result_chara_flag]);
        $insert_record = $stmt->fetch();

        $newId = $pdo->lastInsertId();
        echo "New record id " . $newId . " user_has_chara_flag " . $gacha_result_chara_flag;
    }
} else {
    echo "login fail<br>";
}


?>