<?php
namespace Deezer\Query;

abstract class AbstractModelQuery extends AbstractQuery implements ModelQuery {
    public function find($id) {
        $userData = $this->pdo->query(
            sprintf('SELECT * FROM %s WHERE id=%s', $this->getTableName(), $this->pdo->quote($id))
        )->fetchAll();
        if(!isset($userData[0])) {
            return false;
        }

        return $this->hydrateItem($userData[0]);
    }

    public function findByIds(array $ids) {
        $sql = sprintf("SELECT * FROM %s WHERE id IN ('%s')", $this->getTableName(), implode("','", $ids));
        $dataBaseResults = $this->pdo->query($sql)->fetchAll();
        return $this->hydrateItems($dataBaseResults);
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
}

