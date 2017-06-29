<?php
namespace Deezer\Model;

final class User {
    use Identifiable;

    //lasy getter and setter
    public $name,
           $email;

    private function __construct(string $name, string $email) {
        $this->generateId();
        $this->name = $name;
        $this->email = $email;
    }

    public static function register(string $name, string $email) {
        $user = new self($name, $email);
        return $user;
    }
}