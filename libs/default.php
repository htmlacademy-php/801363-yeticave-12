<?php
/**
 * Создаёт настроенный ЧПУ
 *
 * @param array $arr массив из глобальной переменной $_GET
 *
 * @return array возвращает массив-структуру в виде module, page
 */
function transform_route($arr = []) {
    $i = 0;
    foreach($arr as $k=>$v) {
        if(empty($v)) {
            unset($arr[$k]);
        } else {
            if($i === 0) {
                $arr['module'] = $v;
            } elseif($i === 1) {
                $arr['page'] = $v;
            } else {
                $arr['key_'.$i] = $v;
            }
            ++$i;
        }
    }
    return $arr;
}

/**
 * Поиск в массиве
 *
 * @param array $ar сам массив
 * @param string $findValue искомое значение
 * @param string $executeKeys ключи
 *
 * @return array возвращает массив
 */
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

/**
 * Форматирование времени
 *
 * @param string $data_end метка времени
 *
 * @return array возвращает массив ЧЧ:ММ
 */
function format_time_lost($data_end) {
    $datetime1 = strtotime($data_end);
    $datetime2 = strtotime(date('Y-m-d H:i:s'));
    $interval = $datetime1 - $datetime2;
    $hour = floor($interval / 3600);
    $min  = floor(($interval - $hour * 3600) / 60);
    return [$hour, $min];
}

/**
 * Форматирование тела письма
 *
 * @param array $array массив с ключами ('cash' - цена лота, 'login' - имя пользователя, 'lot_id' - id выигрышного лота, 'lot_name' - название лота)
 *
 * @return string возвращает текст письма
 */
function mail_creator($array=[]) {
    return include_template('email.php', ['cash'=>$array['cash'], 'login'=>$array['login'], 'lot_id'=>$array['lot_id'], 'lot_name'=>$array['lot_name']]);
}

/**
 * Форматирование метки времени прошедшего с подачи заявки
 *
 * @param string $datatime метка времени
 *
 * @return string возвращает метку в удобно-читаемом виде
 */
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

/**
 * Форматирование цены (разделение тысяч пробелом и подстановка в конце символа $)
 *
 * @param int $cost стоимость
 *
 * @return string возвращает цену в удобно-читаемом виде
 */
function format_cost($cost=0) {
    $ans = ceil($cost);
    if($ans >= 1000) {
        $ans = number_format($cost, 0, '.', ' ');
    }
    $ans .=' $';  // рубль плохо отображается даже у меня, заменил на $
    return $ans;
}

/**
 * Форматирование цены (разделение тысяч пробелом)
 *
 * @param int $cost стоимость
 *
 * @return string возвращает цену в удобно-читаемом виде
 */
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
        $_SESSION['errors'][] = 'ошибка в запросе';
        return false;
    }
    return $res;
}

/**
 * Отладочная функция служит для вывода вложенных массивов в удобном виде
 *
 * @param array $array данные для вывода
 * @param boolean $stop если установлено в true - продолжает выполнение скрипта, если оставлено по умолчанию - работа скрипта будет прервана
 *
 */
function wtf($array, $stop = false) {
    echo '<pre style="font-size: 13px; line-height: 16px">'.print_r($array,1).'</pre>';
    if(!$stop) {
        exit();
    }
}

/**
 * Защита выводимых переменных от атак
 *
 * @param array|string $var выводимая переменная
 *
 * @return array|string возвращает переданную переменную в обработанном "безопасном виде"
 */
function out_secur($var) {
    if(!is_array($var)) {
        $var = htmlspecialchars($var);
    } else {
        $var = array_map('out_secur', $var);
    }
    return $var;
}

/**
 * Защита переменных от sql атак
 *
 * @param array|string $var переменная
 * @param int $key (не обязательная) работает со списком подключений к  БД
 *
 * @return array|string возвращает переданную переменную в обработанном "безопасном виде"
 */
function db_secur($var, $key = 0) {
    if(!is_array($var)) {
        $var = DB::_($key)->real_escape_string($var);
    } else {
        $var = array_map('db_secur', DB::_($key)->real_escape_string($var));
    }
    return $var;
}

/**
 * Обрезает пробелы в начале и в конце
 *
 * @param array|string $var переменная
 *
 * @return array|string возвращает переданную переменную в обработанном виде
 */
function trimAll($var) {
    if(!is_array($var)) {
        $var = trim($var);
    } else {
        $var = array_map('trimAll', $var);
    }
    return $var;
}

