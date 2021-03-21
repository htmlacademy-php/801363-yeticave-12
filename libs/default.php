<?php
//spl_autoload_register(function ($class) {
//    include './libs/class_'.$class.'.php';
//});
function findArray ($ar, $findValue, $executeKeys){
    $result = array();

    foreach ($ar as $k => $v) {
        if (is_array($ar[$k])) {
            $second_result = findArray ($ar[$k], $findValue, $executeKeys);
            $result = array_merge($result, $second_result);
            continue;
        }
        if ($v === $findValue) {
            foreach ($executeKeys as $val){
                $result[] = $ar[$val];
            }

        }
    }
    return $result;
}

function format_time_lost($data_end) {
    $datetime1 = strtotime($data_end);
    $datetime2 = strtotime(date('Y-m-d H:i:s'));
    $interval = $datetime1 - $datetime2;
    $hour = floor($interval / 3600);
    $min  = floor(($interval - $hour * 3600) / 60);
    return [$hour, $min];
}

function mail_creator($array=[]) {
    ob_start();
    echo include_template('email.php', ['cash'=>$array['cash'], 'login'=>$array['login'], 'lot_id'=>$array['lot_id'], 'lot_name'=>$array['lot_name']]);
    $mailBody = ob_get_contents();
    ob_clean();
    return $mailBody;
}

function format_old_time($datatime) {
    $tim = strtotime(date('Y-m-d H:i:s')) - strtotime($datatime);
    if($tim < 60*60) {
        $res = floor($tim/60).' минут назад';
    } else {
        $hour = floor($tim / 3600);
        $min  = floor(($tim - $hour * 3600) / 60);

        if($hour > 24) {
            $res = 'Более суток назад';
        } else {
            $res = $hour.'ч. '.$min.'мин. назад';
        }
    }
    if($tim < 5*60) { $res = 'Только что'; }

    return $res;
}

function format_cost($cost=0) {
    $ans = ceil($cost);
    if($ans >= 1000) {
        $ans = number_format($cost, 0, '.', ' ');
    }
    $ans .=' $';  // рубль плохо отображается даже у меня, заменил на $
    return $ans;
}
function format_cost_count($cost=0) {
    $ans = ceil($cost);
    if($ans >= 1000) {
        $ans = number_format($cost, 0, '.', ' ');
    }
    return $ans;
}

/**
 * @param $query
 * @param int $key
 * @return mysqli_result
 */
function q($query, $key = 0) {
    $res = DB::_($key)->query($query);
    if($res === false) {
        $info = debug_backtrace();    // откуда вызывалась функция полная информация
        echo '<div style="margin-top: 300px">';
        echo 'ЗАПРОС: '.$query.'<br>'.DB::_($key)->error.'<br><hr>';
        wtf($info, 1);
        echo 'ФАЙЛ - '.$info[0]['file'].'<br>СТРОКА - '.$info[0]['line'];
        echo '</div>';
        $error = 'Ошибка в запросе: '.date('Y-m-d h:i:s')."\n".$query."\n\n".'ФАЙЛ - '.$info[0]['file']."\n".'СТРОКА - '.$info[0]['line']."\n".'=======================================================';
        file_put_contents('./logs/query_errors.txt', $error."\n\n", FILE_APPEND);
        $_SESSION['errors'][] = 'ошибка в запросе';
        return false;
    } else {
        return $res;
    }
}

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
    $salt1 = 'v5kmj4d9K&k3;dee7h40';
    $salt2 = 'k4pPN^lP(h3f32ls657v';
    return crypt(md5($salt2.$var.$salt1), $salt2);
}
