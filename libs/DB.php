<?php
class DB {
    /**
     * @var DB[]
     */

    static public $mysqli = array();
    static public $connect = array();
    static public function _($key = 0) {
        if(!isset(self::$mysqli[$key])) {
            if(!isset(self::$connect['local'])) {
                self::$connect['local'] = Core::$DB_LOCAL;
            }
            if(!isset(self::$connect['login'])) {
                self::$connect['login'] = Core::$DB_LOGIN;
            }
            if(!isset(self::$connect['pass'])) {
                self::$connect['pass'] = Core::$DB_PASS;
            }
            if(!isset(self::$connect['name'])) {
                self::$connect['name'] = Core::$DB_NAME;
            }
            self::$mysqli[$key] = new mysqli(self::$connect['local'], self::$connect['login'], self::$connect['pass'], self::$connect['name']);
            if(mysqli_connect_errno()) {
                echo 'Не удалось подключиться к БД';
                exit();
            }
            if(!self::$mysqli[$key]->set_charset("utf8")) {
                echo 'Ошибка при загрузке набора символов utf8:'.self::$mysqli[$key]->error;
                exit();
            }
        }
        if(!isset(self::$mysqli[$key])) {
            wtf('Что то пошло не так...');
        }
        return(self::$mysqli[$key]);
    }

    static public function close($key = 0) {
        self::$mysqli[$key]->close();
        unset(self::$mysqli[$key]);
    }
}
