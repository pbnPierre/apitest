<?php
namespace Deezer\Model;

final class User {
    use Identifiable;

    //lasy getter and setter
    public $name,
           $email;

    private function __construct(string $name, string $email) {
        $this->name = $name;
        $this->email = $email;
    }

    public static function register(string $name, string $email) {
        $user = new self($name, $email);
        $user->generateId();

        return $user;
    }

    public static function loadFromStorage(array $dbData) {
        $user = new self($dbData['name'], $dbData['email']);
        $user->id = $dbData['id'];

        return $user;
    }
}