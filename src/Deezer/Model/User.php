<?php
namespace Deezer\Model;

final class User {
    use Identifiable;

    //lasy getter and setter
    public $name,
           $email;

    private function __construct($identifier, $name, $email) {
        $this->generateId();
        $this->name = $name;
        $this->email = $email;
    }

    public static function register($identifier, $name, $email) {
        $user = new self($identifier, $name, $email);
        return $user;
    }
}