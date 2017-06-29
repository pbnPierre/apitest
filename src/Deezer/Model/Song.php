<?php
namespace Deezer\Model;

final class Song {
    use Identifiable;

    //lasy getter and setter
    public $name,
           $duration;

    private function __construct($name, $duration) {
        $this->generateId();
        $this->name = $name;
        $this->duration = $duration;
    }

    public static function create($name, $duration) {
        $song = new self($name, $duration);
        return $song;
    }
}