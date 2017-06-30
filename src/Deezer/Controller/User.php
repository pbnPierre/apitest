<?php
namespace Deezer\Controller;

use Deezer\HTTP\JSONResponse;

class User {
    public function index() {
        return new JSONResponse('Never gonna give you up');
    }

    public function get($id) {
        return new JSONResponse($id);
    }
}