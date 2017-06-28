<?php
namespace Deezer\HTTP;

class JSONResponse extends AbstractResponse {

    public function __construct($content) {
        $this->body = $content;
    }

    public function getHeaders() {
        return array_merge(
            parent::getHeaders(),
            ['Content-Type' => 'application/json']
        );
    }

    public function getBody() {
        return json_encode($this->body);
    }
}