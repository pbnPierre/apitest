<?php
namespace Deezer\Model;

final class Song {
    use Identifiable;

    //lasy getter and setter
    public $name,
           $length;

    private function __construct(string $name, string $length) {
        $this->name = $name;
        $this->length = $length;
    }

    public static function create(string $name, string $length) {
        $song = new self($name, $length);
        $song->generateId();

        return $song;
    }

    public static function loadFromStorage(array $dbData) {
        $song = new self($dbData['name'], $dbData['length']);
        $song->id = $dbData['id'];

        return $song;
    }
}