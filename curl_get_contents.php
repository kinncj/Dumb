<?php
/**
 * 
 * This function provide access to urls like file_get_contents, but ignores the SSL certificate
 * @param string $url
 * @example echo curl_get_contents("https://www.github.com");
 * @author Kinn Coelho Julião <kinncj@gmail.com>
 * @copyright Kinn Coelho Julião - 2012 - kinncj.github.com
 * @package Dumb
 */
function curl_get_contents($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}