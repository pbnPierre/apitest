<?php
namespace Deezer\HTTP;

abstract class AbstractResponse implements Response {
    protected $code = 200,
              $headers = [],
              $body;

    function getStatusCode() {
        return $this->code;
    }

    function setStatusCode(int $code) : self {
        $this->code = $code;
        return $this;
    }

    protected function getHeaders() {
        return $this->headers;
    }

    public function addHeader($name, $value) : self{
        $this->headers[$name] = $value;
        return $this;
    }

    public function getBody() {
        return $this->body;
    }

    public function sendHeaders() {
        foreach ($this->getHeaders() as $name => $value) {
            header(sprintf('%s: %s', $name, $value));
        }
    }
}