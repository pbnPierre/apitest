<?php
namespace Deezer\Query;

interface ModelQuery {
    public function findAll(int $offset = 0, int $limit = 0): array;
    public function find($id);
}

