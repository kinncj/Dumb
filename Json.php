<?php
class Json
{
    public static function render ($text)
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');
        return json_encode($text);
    }
    public static function decode ($json)
    {
        return json_decode($json);
    }
}
