<?php

if (isset($priv)) {
    foreach ($priv as $value) {
        echo $value['from'].'<br>'.$value['to'];
    }
   echo var_dump($priv).'<br>';
   echo $priv['from'];
}

?>

