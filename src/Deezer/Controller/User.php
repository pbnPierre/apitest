<?php
namespace Deezer\Controller;

use Deezer\DIC\SimpleDIC;
use Deezer\HTTP\JSONResponse;
use Deezer\Query\UserModelQuery;

class User {
    public function index(SimpleDIC $container) {
        $userQuery = new UserModelQuery($container->pdo);
        $users = $userQuery->findAll();
        return new JSONResponse($users);
    }

    public function get(SimpleDIC $container, $id) {
        $userQuery = new UserModelQuery($container->pdo);
        $user = $userQuery->find($id);
        return new JSONResponse($user);
    }
}