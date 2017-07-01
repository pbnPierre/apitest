<?php
namespace Deezer\Command;

use Deezer\Model\Song;
use Deezer\Model\User;
use Deezer\Query\UserFavouriteQuery;

class AddSongToUserFavorites extends AbstractCommand {
    protected $song,
              $user;

    public function __construct(\PDO $pdo, User $user, Song $song) {
        parent::__construct($pdo);
        $this->user = $user;
        $this->song = $song;
    }

    public function execute(): bool {
        $query = new UserFavouriteQuery($this->pdo, $this->user);
        $favouriteSongs = $query ->findAll();

        if (in_array($this->song, $favouriteSongs)) {
            return false;
        }

        return $this->pdo->exec(sprintf(
            "INSERT INTO 'user_song' ('user_id', 'song_id') VALUES(%s, %s)",
            $this->pdo->quote($this->user->getId()),
            $this->pdo->quote($this->song->getId())
        ));
    }
}