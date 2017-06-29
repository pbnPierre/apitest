<?php
namespace Deezer\Command;

use Deezer\Model\User;

class CreateUser extends AbstractCommand {
    protected $user;

    public function __construct(\PDO $pdo, User $user)
    {
        parent::__construct($pdo);
        $this->user = $user;
    }

    public function execute(): bool {
        return $this->pdo->exec(sprintf(
            "INSERT INTO 'user' ('id', 'name', 'email') VALUES(%s, %s, %s)",
                $this->user->getId(),
                $this->user->name,
                $this->user->email
            ));
    }
}

