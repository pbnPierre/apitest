<?php
namespace Deezer\Query;

use Deezer\Model\User;

class UserModelQuery extends AbstractModelModelQuery {
    public function getTableName(): string {
        return 'user';
    }

    protected function hydrateItem(array $databaseResult){
        return User::loadFromStorage($databaseResult);
    }
}
