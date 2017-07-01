<?php
namespace Deezer\Query;

use Deezer\Model\User;

class UserFavouriteQuery extends AbstractQuery {
    protected $user;

    public function __construct(\PDO $pdo, User $user){
        parent::__construct($pdo);
        $this->user = $user;
    }

    protected function getTableName(): string {
        return 'user_song';
    }

    public function findAll() {
        $sql = sprintf('SELECT song_id FROM %s WHERE user_id=%s;',
                        $this->getTableName(),
                        $this->pdo->quote($this->user->getId()));
        $songModelQuery = new SongModelQuery($this->pdo);
        $ids = $this->pdo->query($sql)->fetchAll();
        $ids = array_map(function($item) {
            return $item['song_id'];
        }, $ids);

        return $songModelQuery->findByIds($ids);
    }
}
