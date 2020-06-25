<?php


class Response
{

    public $is_error = true;
    public $message = "";
    public $debug_message = null;
    public $status_code = 200;
    public $payload = null;

    /**
     * Response constructor.
     * @param null $payload
     * @param int $status_code
     * @param string $message
     * @param null $debug_message
     */
    public function __construct($payload, int $status_code = 200, $message = null, $debug_message = null)
    {
        $this->message = $message;
        $this->debug_message = $debug_message;
        $this->status_code = $status_code;
        $this->payload = $payload;
        $this->is_error = !in_array($this->status_code, range(200, 299));
    }

    public function printResponse()
    {
        http_response_code($this->status_code);
        header("Content-Type: application/json; charset=UTF-8");
        if ($this->status_code != 204) print($this->getJson());
    }

    /**
     * @return string in json format
     */
    public function getJson()
    {
        $res = ['is_error' => $this->is_error, 'status_code' => $this->status_code];
        if (!is_null($this->message)) $res['message'] = $this->message;
        if (!is_null($this->debug_message)) $res['debug_message'] = $this->debug_message;
        if (!is_null($this->payload)) $res['payload'] = $this->payload;
        return $this->status_code == 204 ? null : json_encode($res);
    }

}