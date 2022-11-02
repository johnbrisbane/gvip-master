<?php

exec("python python/__init__.py 2>&1", $output);
var_dump($output);

foreach($allProj as $orgexp)
{
    $lat        = $orgexp['lat'];
    $lng        = $orgexp['lng'];
    $sector     = $orgexp['sector'];
    $subsector  = $orgexp['subsector'];
    $value      = $orgexp['totalbudget'];


    $output = '';
    $param = 'John';
    exec("python python/equity_functions.py $lat $lng $sector $subsector $value 2>&1", $output);

    var_dump($output);

}

?>