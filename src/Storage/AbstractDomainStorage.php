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
 * Class AbstractDomainStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDomainStorage extends AbstractStorageDecorator implements DomainStorageInterface
{
    /**
     * @param string $name
     * @param        $id
     *
     * @return null|DomainInterface
     */
    abstract public function doFindById(string $name, $id): ?DomainInterface;

    /**
     * @param string $name
     * @param array  $criteria
     * @param array  $orderBy
     * @param int    $limit
     * @param int    $offset
     *
     * @return DomainInterface[]
     */
    abstract public function doFindMany(
        string $name,
        array $criteria = [],
        array $orderBy = [],
        int $limit = 0,
        int $offset = 0
    ): array;

    /**
     * @param string $name
     * @param array  $criteria
     * @param array  $orderBy
     *
     * @return null|DomainInterface
     */
    abstract public function doFindOne(string $name, array $criteria = [], array $orderBy = []): ?DomainInterface;

    /**
     * @inheritDoc
     */
    public function findById(string $name, $id): ?DomainInterface
    {
        if (false === $this->supports($name)) {
            throw new UnsupportedDomainStorageException($this, $name);
        }

        return $this->doFindById($name, $id);
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
        if (false === $this->supports($name)) {
            throw new UnsupportedDomainStorageException($this, $name);
        }

        return $this->doFindMany($name, $limit, $offset);
    }

    /**
     * @inheritDoc
     */
    public function findOne(string $name, array $criteria = [], array $orderBy = []): ?DomainInterface
    {
        if (false === $this->supports($name)) {
            throw new UnsupportedDomainStorageException($this, $name);
        }

        return $this->doFindOne($name, $criteria, $orderBy);
    }
}