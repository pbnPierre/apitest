<?php
namespace Deezer\Controller;

use Deezer\DIC\SimpleDIC;
use Deezer\HTTP\JSONResponse;
use Deezer\HTTP\Response;
use Deezer\Query\AbstractModelQuery;

abstract class AbstractPaginatedController {
    const DEFAULT_ITEM_PER_PAGE = 2;

    public function index(SimpleDIC $container, int $offset = 0, int $limit = self::DEFAULT_ITEM_PER_PAGE) {
        $query = $this->getModelQuery($container->pdo);
        $items = $query->findAll($offset, $limit);

        $response = new JSONResponse($items);
        if ($offset  >= $items['count']) {
            throw new \OutOfRangeException('Pagination Limit excedeed max item'.$items['count']);
        }
        $this->setLinksInHeader($response, $items['count'], $offset, $limit);

        return $response;
    }

    protected function setLinksInHeader(Response $response, $count, $offset, $limit) {
        $links = [];

        if ($count > ($offset + $limit)) {
            $links[]= sprintf('//%s/offset/%d/limit/%d; rel="next"',
                $this->getModelBaseUri(), $offset+$limit, $limit);
        }
        if ($offset > 0) {
            $links[]= sprintf('//%s/offset/%d/limit/%d; rel="prev"',
                $this->getModelBaseUri(), min(0, $offset-$limit), $limit);
        }

        if (!empty($links)) {
            $response->addHeader('Link', implode(', ', $links));
        }
    }

    abstract protected function getModelBaseUri(): string;

    public function get(SimpleDIC $container, string $id): Response {
        return new JSONResponse($this->getEntity($this->getModelQuery($container->pdo), $id));
    }

    abstract protected function getModelQuery(\PDO $pdo) :AbstractModelQuery;
}