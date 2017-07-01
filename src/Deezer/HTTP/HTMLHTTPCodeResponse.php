<?php
namespace Deezer\HTTP;

class HTMLHTTPCodeResponse extends HTMLResponse {

    public function __construct(int $code) {
        $this->setStatusCode($code);
    }

    public function getBody() {
        return sprintf('<h1>Meow :3 ?</h1><img src="https://http.cat/%d"/ />', $this->getStatusCode());
    }
}