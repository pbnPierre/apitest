<?php
namespace Deezer\Controller;

use Deezer\Query\AbstractModelQuery;
use Deezer\Query\SongModelQuery;

class Song extends AbstractPaginatedController {
    use EntityLasyLoadable;

    protected function getModelQuery(\PDO $pdo) : AbstractModelQuery {
        return new SongModelQuery($pdo);
    }

    protected function getModelBaseUri(): string {
        return 'songs';
    }
}