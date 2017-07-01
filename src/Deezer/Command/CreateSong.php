<?php
namespace Deezer\Command;

use Deezer\Model\Song;

class CreateSong extends AbstractCommand {
    protected $song;

    public function __construct(\PDO $pdo, Song $song) {
        parent::__construct($pdo);
        $this->song = $song;
    }

    public function execute(): bool {
        return $this->pdo->exec(sprintf(
            "INSERT INTO 'song' ('id', 'name', 'length') VALUES(%s, %s, %d)",
            $this->pdo->quote($this->song->getId()),
            $this->pdo->quote($this->song->name),
            $this->pdo->quote($this->song->length)
        ));
    }
}

