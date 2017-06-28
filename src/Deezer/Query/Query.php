<?php
namespace Deezer\Query;

interface Query {
    public function upsert($item): bool;
}

