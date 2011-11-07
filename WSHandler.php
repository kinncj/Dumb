<?php
/**
 * Class that provide cool functions to WebServices
 * @example $WSH = new WSHandler('url/to/json?'); $WSH->setParams(array())->getResults();
 * @author kinncj
 *
 */
class WSHandler
{
    private $params;
    private $service;
    public function __construct ($service)
    {
        $this->service = $service;
    }
    public function setParams ($params)
    {
        $param = null;
        foreach ($params as $key => $value) {
            $param .= "{$key}={$value}&";
        }
        $param = substr($param, 0, - 1);
        $this->params = $param;
        return $this;
    }
    public function getQueryString(){
        return $this->service . $this->params;
    }
    public function getResults ()
    {
        return file_get_contents($this->service . $this->params, false, 
        $this->headers());
    }
    public function headers ()
    {
        return stream_context_create(
        array(
        'http' => array('method' => "GET", 
        'header' => "User-Agent: DumbWS\r\n")));
    }
}
