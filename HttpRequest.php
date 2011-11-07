<?php
class HttpRequest
{
    public static function discover ()
    {
        switch ($_SERVER['HTTP_ACCEPT']) {
            case 'application/json':
                return true;
                break;
            default:
                return false;
                break;
        }
    }
    public static function renderHttpAccept ($text)
    {
        switch (self::discover()) {
            case true:
                return Json::render($text);
                break;
            default:
                return $text
                break;
        }
    }
    public static function decodeHttpAccept ($json)
    {
        switch (self::discover()) {
            case true:
                return Json::decode($json);
                break;
            default:
                return $json;
                break;
        }
    }
}
