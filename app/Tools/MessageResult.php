<?php


namespace App\Tools;

class MessageResult{

    public $statusCode;
    public $statusMsg;
    public $extra;

    public function toJson(){

        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }
}