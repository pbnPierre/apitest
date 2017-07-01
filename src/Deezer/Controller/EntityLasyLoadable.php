<?php
namespace Deezer\Controller;

use Deezer\Query\AbstractModelQuery;

Trait EntityLasyLoadable {
    //Lasyloaded base entities
    protected $entities = [];

    protected function getEntity(AbstractModelQuery $query, string  $id) {
        if (!isset($this->entity[$id])) {
            $entity = $query->find($id);

            if (false === $entity) {
                throw new \InvalidArgumentException();
            }
            $this->entity[$id] = $entity;
        }

        return $this->entity[$id];
    }
}