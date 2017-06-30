<?php
namespace Deezer\Query;

abstract class AbstractModelModelQuery implements ModelQuery {
    protected $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    abstract protected function getTableName() : string ;

    public function find($id) {
        $userData = $this->pdo->query(
            sprintf('SELECT * FROM %s WHERE id=%s', $this->getTableName(), $this->pdo->quote($id))
        )->fetchAll();
        return $this->hydrateItem($userData[0]);
    }

    public function findAll(int $offset = 0, int $limit = 20): array {
        $count = $this->countItems();
        $sql = $this->prepareQueryWithOffsetAndLimit("SELECT * FROM ".$this->getTableName(), $offset, $limit);
        $dataBaseResults = $this->pdo->query($sql)->fetchAll();

        return [
            'results' => $this->hydrateItems($dataBaseResults),
            'count' => $count,
            'offset' => $offset,
            'limit' => $limit
        ];
    }

    protected function countItems() {
        return intval($this->pdo->query("SELECT COUNT(1) as count FROM ".$this->getTableName())->fetchAll()[0]['count']);
    }

    protected function hydrateItems(array $databaseResults): array{
        return array_map(function($data) {
            return $this->hydrateItem($data);
        }, $databaseResults);
    }

    abstract protected function hydrateItem(array $databaseResult);

    protected function prepareQueryWithOffsetAndLimit(string $query, int $offset, int $limit) : string {
        if ($offset !== 0) {
            $query.= ' OFFSET '.$offset;
        }

        if ($limit !== 0) {
            $query.= ' LIMIT '.$limit;
        }

        return $query;
    }
}

