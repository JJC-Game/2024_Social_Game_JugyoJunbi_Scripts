<?php
require 'sample_func.php';

// クエリパラメータからidを取得
if (isset($_GET['test_7_input']) && is_numeric($_GET['test_7_input'])) {
    $query_param_input = (int)$_GET['test_7_input'];
} else {
    echo "No Query <br>";
    echo "please input URL http://localhost/PHP/php_test_7_function.php?test_7_input=1<br>";
    $query_param_input = 99999;
}

$bool_result = boolReturnTest($query_param_input);
var_dump($bool_result);
?>