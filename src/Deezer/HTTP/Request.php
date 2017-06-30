<?php
namespace Deezer\HTTP;

class Request{
    public function get(string $parameterName){
        if (isset($_POST[$parameterName])) {
            return $_POST[$parameterName];
        }

        if (isset($_GET[$parameterName])) {
            return $_GET[$parameterName];
        }

        return false;
    }

    public function getBody() {
        return json_encode($this->body);
    }
}