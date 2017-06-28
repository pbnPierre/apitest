<?php
namespace Deezer\Controller;

use Deezer\HTTP\JSONResponse;

class User {
    public function index() {
        return new JSONResponse(['Coucou mon chat d\'amour']);
    }
}