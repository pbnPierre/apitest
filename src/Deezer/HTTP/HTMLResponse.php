<?php
namespace Deezer\HTTP;

class HTMLResponse extends AbstractResponse {

    public function __construct(string $content) {
        $this->body = $content;
    }

    public function getHeaders() {
        return array_merge(
            parent::getHeaders(),
            ['Content-Type' => 'text/html; charset=utf-8']
        );
    }
}