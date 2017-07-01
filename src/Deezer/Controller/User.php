<?php
namespace Deezer\Controller;

use Deezer\Command\AddSongToUserFavorites;
use Deezer\Command\RemoveSongFromUserFavorites;
use Deezer\Command\RemoveSongToUserFavorites;
use Deezer\DIC\SimpleDIC;
use Deezer\HTTP\JSONResponse;
use Deezer\Query\AbstractModelQuery;
use Deezer\Query\SongModelQuery;
use Deezer\Query\UserFavouriteQuery;
use Deezer\Query\UserModelQuery;

class User extends AbstractPaginatedController {
    use EntityLasyLoadable;

    protected function getModelQuery(\PDO $pdo): AbstractModelQuery {
        return new UserModelQuery($pdo);
    }

    protected function getModelBaseUri(): string {
        return 'users';
    }

    public function getFavoriteSongs(SimpleDIC $container, string $userId) {
        $user = $this->getEntity($this->getModelQuery($container->pdo), $userId);
        $favouriteSongQuery = new UserFavouriteQuery($container->pdo, $user);
        return new JSONResponse($favouriteSongQuery->findAll());
    }

    public function addSongToFavorite(SimpleDIC $container, string $userId, string $songId) {
        $user = $this->getEntity($this->getModelQuery($container->pdo), $userId);
        $song = $this->getSong($container->pdo, $songId);

        $command = new AddSongToUserFavorites($container->pdo, $user, $song);
        $command->execute();

        return $this->getFavoriteSongs($container, $userId);
    }

    public function removeFavoriteSong(SimpleDIC $container, string $userId, string $songId) {
        $user = $this->getEntity($this->getModelQuery($container->pdo), $userId);
        $song = $this->getSong($container->pdo, $songId);

        $command = new RemoveSongFromUserFavorites($container->pdo, $user, $song);
        $command->execute();

        return $this->getFavoriteSongs($container, $userId);
    }

    protected function getSong(\PDO $pdo, $songId): \Deezer\Model\Song {
        $songQuery = new SongModelQuery($pdo);
        $song = $songQuery->find($songId);
        if (false === $song) {
            throw new \InvalidArgumentException();
        }
        return $song;
    }
}