<?php
$output = '';
$param = 'John';
exec("python python/function.py $param 2>&1", $output);

var_dump($output);
?>