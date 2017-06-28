<?php
namespace Deezer\Model;

final class Song {
    use Identifiable;

    //lasy getter and setter
    public $identifier,
           $name,
           $email;

    private function __construct($name, $duration) {
        $this->generateId();
        $this->name = $name;
        $this->duration = $duration;
    }

    public static function create($identifier, $name, $email) {
        $user = new self($identifier, $name, $email);
        return $user;
    }
}