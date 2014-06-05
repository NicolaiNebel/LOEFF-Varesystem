<?php

require_once('initStore.php');

foreach ($_SESSION['catalogue'] as $p) {
    $td = ' <\td> <td> ';
    $str = '<tr> <td> ' . $p->name . $td . $p->price . $td . $delivDate . $td .
        $payDate . $td . $p->description . '<\td> <\tr> ';

    echo $str;
}

?>
