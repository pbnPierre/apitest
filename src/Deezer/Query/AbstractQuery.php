<?php
namespace Deezer\Query;

abstract class AbstractQuery {
    protected $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    protected function prepareQueryWithOffsetAndLimit(string $query, int $offset, int $limit) : string {
        $query.= sprintf(' LIMIT %d OFFSET %d', $limit, $offset);

        return $query;
    }

    abstract protected function getTableName() : string;
}

