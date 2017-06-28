<?php
namespace Deezer\HTTP;

interface Response {
    public function getStatusCode();
    public function sendHeaders();
    public function getBody();
}