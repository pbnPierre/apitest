<?php
namespace Deezer\Controller;

use Deezer\DIC\SimpleDIC;
use Deezer\HTTP\JSONResponse;
use Deezer\Query\SongModelQuery;

class Song {
    public function index(SimpleDIC $container) {
        $songQuery = new SongModelQuery($container->pdo);
        $songs = $songQuery->findAll();
        return new JSONResponse($songs);
    }

    public function get(SimpleDIC $container, $id) {
        $songQuery = new SongModelQuery($container->pdo);
        $song = $songQuery->find($id);
        return new JSONResponse($song);
    }
}