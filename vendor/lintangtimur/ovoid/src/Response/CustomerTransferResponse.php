<?php

namespace Stelin\Response;

class CustomerTransferResponse
{
    private $code;
    private $message;
    private $isOvo;

    public function __construct($data)
    {
        $this->code = $data->code ? $data->code : false;
        $this->message = $data->message ? $data->message : false;
        $this->isOvo = $data->isOvo ? $data->isOvo : false;
    }

    /**
     * code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get transaction message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * is ovo
     *
     * @return int
     */
    public function isOvo()
    {
        return $this->isOvo;
    }
}
