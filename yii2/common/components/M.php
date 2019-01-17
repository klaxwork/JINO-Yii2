<?php
namespace common\components;

/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 16.07.2015
 * Time: 10:52
 */
class M
{
    public static $month = array(
        '',
        'Январь',
        'Февраль',
        'Март',
        'Апрель',
        'Май',
        'Июнь',
        'Июль',
        'Август',
        'Сентябрь',
        'Октябрь',
        'Ноябрь',
        'Декабрь'
    );

    public static $monthShort = array(
        '',
        'Янв.',
        'Февр.',
        'Мaрта',
        'Апр.',
        'Мая',
        'Июня',
        'Июля',
        'Авг.',
        'Сент.',
        'Окт.',
        'Нояб.',
        'Дек.'
    );

    public static $ofmonth = array(
        '',
        'Января',
        'Февраля',
        'Марта',
        'Апреля',
        'Мая',
        'Июня',
        'Июля',
        'Августа',
        'Сентября',
        'Октября',
        'Ноября',
        'Декабря'
    );

    public static $DayWeek = array(
        'Воскресенье',
        'Понедельник',
        'Вторник',
        'Среда',
        'Четверг',
        'Пятница',
        'Суббота',
        'Воскресенье'
    );

    public static $DayWeekShort = array(
        'Вс',
        'Пн',
        'Вт',
        'Ср',
        'Чт',
        'Пт',
        'Сб',
        'Вс'
    );

    public static function declOfNum($number, $titles, $show = true)
    {
        $cases = array(2, 0, 1, 1, 1, 2);
        $res = ($show ? $number . " " : '') . $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min(abs($number) % 10, 5)]];
        return $res;
    }

    public static function printr($var, $name = false, $toVar = false)
    {
        $mem = '';
        $display = 'block';
        //if (Yii::app()->user->isGuest) {
        //$display = 'none';
        //}

        //ob_start();
        /*if (!YII_DEBUG) {
            return false;
        }*/

        if (0) {
            ob_start();
            print "<pre style='position: relative; z-index: 999; display: {$display}; font-size: 13px; background-color: #ddd; padding: 5px; border: solid 1px #000; line-height: 1.2em;'>\n";
            if ($name) {
                print "<span style='color: #080; font-weight: bold; font-size: 20px; line-height: 1.2em;'>{$name}</span> => ";
            }
            //$mem .= print_r($var, true);
            CVarDumper::dump($var);
            print "</pre>\n";
            //var_dump($someVar);
            $mem = ob_get_clean();

        }

        if (1) {
            if (!empty($_GET['debug']) && $_GET['debug'] == 'console') {
                if ($name) {
                    $mem .= "{$name} = ";
                }
                $mem .= print_r($var, true);
                $mem .= "\n";
            } else {
                $mem .= "<pre style='position: relative; z-index: 999; display: {$display}; font-size: 13px; background-color: #ddd; padding: 5px; border: solid 1px #000; line-height: 1.2em;'>";
                if ($name) {
                    $mem .= "<span style='color: #080; font-weight: bold; font-size: 20px; line-height: 1.2em;'>{$name}</span> => ";
                }
                $mem .= print_r($var, true);
                $mem .= "</pre>\n";
            }
        }

        if ($toVar !== false) {
            return $mem;
        } else {
            print $mem;
        }
    }

    public static function debug($var, $name, $is_return)
    {
        if ($_GET['debug'] == 'console') {
            print '$name => ';
            print_r($var);
            print "\n";
        } elseif (DEBUG) {
            M::printr($var, $name, $is_return);
        }
    }

    public static function toArray($objects, $field = false)
    {
        $arrays = array();
        foreach ($objects as $element) {
            if ($field) {
                $k = $element->$field;
                $arrays[$k] = $element->attributes;
            } else {
                $arrays[] = $element->attributes;
            }
        }
        return $arrays;
    }

    public static function json_encode($data)
    {
        if (is_object($data)) {
            $data = array($data);
        }
        foreach ($data as $k => $object) {
            M::printr($object, '$object');
            $relations = $object->relations();

            foreach ($relations as $key_relations => $relation) {
                M::printr($key_relations, '$key_relations');
                $new_object = $object->$key_relations;
                M::printr($new_object, '$new_object');
            }
        }


    }

    public static function DayOfWeek($date = false)
    {
        if ($date === false) {
            $date = time();
        }

        if ($date === (int)$date) {
            //число
            $day = (int)strftime("%w", $date);
        } else {
            //строка
            $day = (int)strftime("%w", strtotime($date));
        }

        return self::$DayWeek[$day];
    }

    public static function DayOfWeekShort($date = false, $short = false)
    {
        if ($date === false) {
            $date = time();
        }

        if ($date === (int)$date) {
            //число
            $day = (int)strftime("%w", $date);
        } else {
            //строка
            $day = (int)strftime("%w", strtotime($date));
        }

        return self::$DayWeekShort[$day];
    }

    public static function Month($date = 0)
    {
        if ($date === 0) {
            $date = time();
        }
        //переводим в число
        if ($date !== (int)$date) {
            $date = strtotime($date);
        }
        //получаем номер месяца
        $mon = (int)strftime("%m", $date);
        //возвращаем месяц
        return self::$month[$mon];
    }

    public static function OfMonth($date = 0, $short = false)
    {
        if ($date === 0) {
            $date = time();
        }
        //переводим в число
        if ($date !== (int)$date) {
            $date = strtotime($date);
        }
        //получаем номер месяца
        $mon = (int)strftime("%m", $date);
        //возвращаем дату вида число месяца год ("20 декабря" если коротко, или "20 декабря 2015")
        if ($short !== false) {
            return trim(strftime("%e " . self::$ofmonth[$mon], $date));
        } else {
            return trim(strftime("%e " . self::$ofmonth[$mon] . " %Y", $date));
        }
    }


    public static function sendEmail($email, $text, $subject = false, $attachment = false)
    {

        //тестовый email
        //$email = 'k.olshevskiy@ak-gro.com';

        //Yii::app()->mailer->exceptions = true;
        Yii::app()->mailer->ClearAddresses();
        //Yii::app()->mailer->Host = '10.10.0.8';
        //Yii::app()->mailer->Username = 'postmaster@userdev.ru';
        //Yii::app()->mailer->Password = 'ZdE32Df341';
        //Yii::app()->mailer->IsSMTP(true);
        //Yii::app()->mailer->SMTPAuth = true;
        Yii::app()->mailer->From = Yii::app()->params['from']['email']; //'info@desperadosport.ru'; //Yii::app()->params['adminEmail'];
        Yii::app()->mailer->FromName = Yii::app()->params['from']['name']; //"Desperado";
        Yii::app()->mailer->IsHTML(true);
        //Yii::app()->mailer->CharSet = 'UTF-8';
        Yii::app()->mailer->ContentType = 'text/html';
        Yii::app()->mailer->Subject = $subject ? $subject : Yii::app()->params['from']['name']; //'desperadosport.ru';
        Yii::app()->mailer->Body = $text;
        //Yii::app()->mailer->AddAttachment(array(Yii::app()->params['files'] . '/_coupon_mail.php', Yii::app()->params['files'] . '/_certificate_mail.php'));
        $Errors = array();
        if ($attachment !== false) {
            // Если передан массив строк - цепляем каждую.

            if (!is_array($attachment)) {
                $attachments = array($attachment);
            } else {
                $attachments = $attachment;
            }
            foreach ($attachments as $attachment) {
                try {
                    Yii::app()->mailer->AddAttachment($attachment);
                } catch (Exception $e) {
                    //M::printr($e, '> $e');
                    $Errors[] = $e->getMessage();
                }
            }
        }

        if (!is_array($email)) {
            $emails = array($email);
        } else {
            $emails = $email;
        }
        foreach ($emails as $email) {
            try {
                Yii::app()->mailer->AddAddress($email);
            } catch (Exception $e) {
                //self::xlog($e, 'mails');
                $Errors[] = $e->getMessage();
            }
        }

        try {
            Yii::app()->mailer->Send();
        } catch (Exception $e) {
            //self::xlog($e, 'mails');
            return false;
        }
        return true;
    }

    public static function sendSms($phone, $textSms, $mess_id = null, $time = 0, $Exception = false)
    {
        ini_set('default_socket_timeout', 10);
        $_SESSION['SOAP_EXCEPTION'] = null;
        try {
            $result = Yii::app()->sms->send($phone, $textSms, $mess_id, $time);
            //M::printr($result, '$result');
            M::xlog($result);
            //return $result;
        } catch (Exception $e) {
            if (isset($_SESSION['SOAP_EXCEPTION']) && !empty($_SESSION['SOAP_EXCEPTION'])) {
                //M::printr($_SESSION['SOAP_EXCEPTION']->getMessage());
            }
        }
    }

    public static function xlog($message, $suffix = 'system', $attr = 'a')
    {
        if (empty($suffix)) {
            $suffix = 'system';
        }
        $filename = '/runtime/error_' . $suffix . '.log';
        $path = Yii::getPathOfAlias('application') . $filename;
        //M::printr($path, '$path');

        $x = explode(' ', microtime());
        $sec = (int)strftime("%S", $x[1]) + $x[0];
        $date = strftime("%Y-%m-%d %H:%M:") . $sec;

        $f = fopen($path, $attr);
        if (!is_array($message)) {
            //$message = array($message);
        }
        fputs($f, "\t" . $date . "\n");
        //ob_start();
        $res = print_r($message, true);
        //M::printr($res, '$res');
        //$res = ob_get_clean();
        fputs($f, $res . "\n");
        /*foreach ($message as $mess) {
            //fputs($f, $mess . "\n");
        }*/
        fputs($f, "\n");
        fclose($f);
    }

    /**
     * Функция меняет значения элементов массива $key и $key2 местами
     * @param array $array исходный массив
     * @param $key ключ элемента массива
     * @param $key2 ключ элемента массива
     * @return bool true замена произошла, false замена не произошла
     */
    public static function array_swap(array &$array, $key, $key2)
    {
        if (isset($array[$key]) && isset($array[$key2])) {
            list($array[$key], $array[$key2]) = array($array[$key2], $array[$key]);
            return true;
        }

        return false;
    }

    public static function getWords($text, $num = 10)
    {

    }

    public static function getChars($text, $num = 1000)
    {

    }

    public static function file_post_contents($url, $data, $method = 'POST', $username = null, $password = null)
    {
        //$url = 'https://yafni.bitrix24.ru/rest/214/v5sow827al0rm66z/crm.deal.add.json/';
        $postdata = http_build_query($data);

        $opts = [
            'http' => [
                'method' => $method,
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'content' => $postdata,
            ]
        ];

        if ($username && $password) {
            $opts['http']['header'] .= ("Authorization: Basic " . base64_encode("{$username}:{$password}")); // .= to append to the header array element
        }

        $context = stream_context_create($opts);
        return file_get_contents($url, false, $context);
    }

}