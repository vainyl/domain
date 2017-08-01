<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Domain
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Domain\Storage;

use Vainyl\Core\Storage\Decorator\AbstractStorageDecorator;
use Vainyl\Domain\DomainInterface;
use Vainyl\Domain\Exception\UnsupportedDomainStorageException;

/**
 * Class CompositeDomainStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method DomainStorageInterface[] getIterator
 */
class CompositeDomainStorage extends AbstractStorageDecorator implements DomainStorageInterface
{
    /**
     * @param string $name
     * @param DomainStorageInterface $storage
     *
     * @return CompositeDomainStorage
     */
    public function addStorage(string $name, DomainStorageInterface $storage): CompositeDomainStorage
    {
        $this->offsetSet($name, $storage);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function findById(string $name, $id): ?DomainInterface
    {
        foreach ($this->getIterator() as $storage) {
            if (false === $storage->supports($name)) {
                continue;
            }
            return $storage->findById($name, $id);
        }

        throw new UnsupportedDomainStorageException($this, $name);
    }

    /**
     * @inheritDoc
     */
    public function findMany(
        string $name,
        array $criteria = [],
        array $orderBy = [],
        int $limit = 0,
        int $offset = 0
    ): array {
        foreach ($this->getIterator() as $storage) {
            if (false === $storage->supports($name)) {
                continue;
            }
            return $storage->findMany($name, $criteria, $orderBy, $limit, $offset);
        }

        throw new UnsupportedDomainStorageException($this, $name);
    }

    /**
     * @inheritDoc
     */
    public function findOne(string $name, array $criteria = [], array $orderBy = []): ?DomainInterface
    {
        foreach ($this->getIterator() as $storage) {
            if (false === $storage->supports($name)) {
                continue;
            }
            return $storage->findOne($name, $criteria, $orderBy);
        }

        throw new UnsupportedDomainStorageException($this, $name);
    }

    /**
     * @param string $name
     *
     * @return DomainStorageInterface
     */
    public function getStorage(string $name): DomainStorageInterface
    {
        return $this->offsetGet($name);
    }

    /**
     * @inheritDoc
     */
    public function supports(string $name): bool
    {
        foreach ($this->getIterator() as $storage) {
            if ($storage->supports($name)) {
                return true;
            }
        }

        return false;
    }
}