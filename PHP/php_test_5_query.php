<?php

// クエリパラメータからidを取得
if (isset($_GET['test_5_input']) && is_numeric($_GET['test_5_input'])) {
    $query_param_input = (int)$_GET['test_5_input'];
} else {
    echo "No Query <br>";
    echo "please input URL http://localhost/PHP/php_test_5_query.php?test_5_input=1<br>";
    $query_param_input = 99999;
}

echo "input test_5_input " . $query_param_input;

?>