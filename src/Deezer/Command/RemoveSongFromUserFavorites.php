<?php
namespace Deezer\Command;

use Deezer\Model\Song;
use Deezer\Model\User;

class RemoveSongFromUserFavorites extends AbstractCommand {
    protected $song,
              $user;

    public function __construct(\PDO $pdo, User $user, Song $song) {
        parent::__construct($pdo);
        $this->user = $user;
        $this->song = $song;
    }

    public function execute(): bool {
        return $this->pdo->exec(sprintf(
            "DELETE FROM 'user_song' WHERE user_id=%s AND song_id=%s",
            $this->pdo->quote($this->user->getId()),
            $this->pdo->quote($this->song->getId())
        ));
    }
}

