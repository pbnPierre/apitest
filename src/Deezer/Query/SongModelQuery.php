<?php
namespace Deezer\Query;

use Deezer\Model\Song;

class SongModelQuery extends AbstractModelQuery {
    public function getTableName(): string {
        return 'song';
    }

    protected function hydrateItem(array $databaseResult){
        return Song::loadFromStorage($databaseResult);
    }
}