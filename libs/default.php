<?php
function format_time_lost($data_end) {
    $datetime1 = new DateTime($data_end);
    $datetime2 = new DateTime();
    $interval = $datetime1->diff($datetime2);
    return [$interval->format('%H%'), $interval->format('%i%')];
//    return $interval->format('%H%').':'.$interval->format('%i%');
}

function format_cost($cost=0) {
    $ans = ceil($cost);
    if($ans >= 1000) {
        $ans = number_format($cost, 0, '.', ' ');
    }
    $ans .=' $';  // рубль плохо отображается даже у меня, заменил на $
    return $ans;
}

spl_autoload_register(function ($class) {
    include './libs/class_'.$class.'.php';
});

function wtf($array, $stop = false) {
    echo '<pre style="font-size: 13px; line-height: 16px">'.print_r($array,1).'</pre>';
    if(!$stop) {
        exit();
    }
}

function out_secur($var) {
    if(!is_array($var)) {
        $var = htmlspecialchars($var);
    } else {
        $var = array_map('out_secur', $var);
    }
    return $var;
}

function db_secur($var, $key = 0) {
    if(!is_array($var)) {
        $var = DB::_($key)->real_escape_string($var);
    } else {
        $var = array_map('db_secur', DB::_($key)->real_escape_string($var));
    }
    return $var;
}

function trimAll($var) {
    if(!is_array($var)) {
        $var = trim($var);
    } else {
        $var = array_map('trimAll', $var);
    }
    return $var;
}

function crypter($var) {
    $salt1 = 'v5kmmge423tttrmgpo5g7h40';
    $salt2 = 'fn21kfkr95legdf32ls657v';
    return crypt(md5($salt2.$var.$salt1), $salt2);
}
