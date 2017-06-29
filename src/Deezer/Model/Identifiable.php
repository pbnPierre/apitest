<?php

namespace Deezer\Model;

Trait Identifiable {
    public $id;

    protected function generateId() {
        $this->id = uniqid();
    }

    public function getId() {
        return $this->id;
    }
}