<?php

class TaskResult
{
    private $error = false;
    private $message = "";
    private $debug_message = null;
    private $payload = null;

    public function __construct($is_error, $message, $debug_message = null, $payload = null)
    {
        $this->error = $is_error;
        $this->message = $message;
        $this->debug_message = $debug_message;
        $this->payload = $payload;
    }

    /**
     * @return bool
     */
    public function isError(): bool
    {
        return $this->error;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getDebugMessage()
    {
        return $this->debug_message;
    }

    /**
     * @return null
     */
    public function getPayload()
    {
        return $this->payload;
    }

}