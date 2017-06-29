<?php
namespace Deezer\Command;

abstract class AbstractCommand implements Command {
    protected $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }
}

