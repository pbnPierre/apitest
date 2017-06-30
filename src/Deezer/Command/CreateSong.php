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
            "INSERT INTO 'song' ('id', 'name', 'length') VALUES('%s', '%s', '%s')",
            $this->song->getId(),
            $this->song->name,
            $this->song->length
        ));
    }
}

