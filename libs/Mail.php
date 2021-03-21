<?php
class Mail {
    static $subject = 'smtp.phpdemo.ru';
    static $from = 'keks@phpdemo.ru';
    static $to = 'vohuanrok@mail.ru';
    static $text = 'Shablon';
    static $headers = 'По умолчанию';

    static function send($textMail) {
        self::$text = $textMail;

        self::$subject = '=?utf-8?b?'.base64_encode(self::$subject).'?=';
        self::$headers = "Content-type: text/html; charset\"utf-8\"\r\n";

        self::$headers .= "From: ".self::$from."\r\n";
        self::$headers .= "MIME-Version: 1.0\r\n";
        self::$headers .= "Date: ".date('D, d M Y h:i:s O')."\r\n";
       // self::$headers .= "Precedence: bulk\r\n";    //        если рассылка

        return mail(self::$to, self::$subject, self::$text, self::$headers);
    }

}

//
//Adress	//school-php.com/squirrelmail/
//Login	admin@robinstone2011.school-php.com
//Password	GAZ3ta-vsEGda
//* Осуществляйте отправку писем с ящиков admin@robinstone2011.school-php.com и альтернативного
//robinstone2011@school-php.com . Их обязательно указывать в заголовках From, остальные ящики
//не будут доходить до адресатов.
