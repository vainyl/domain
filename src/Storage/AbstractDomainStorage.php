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
use Vainyl\Domain\Exception\UnsupportedDomainException;

/**
 * Class AbstractDomainStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDomainStorage extends AbstractStorageDecorator implements DomainStorageInterface
{
    /**
     * @param string $name
     * @param int    $limit
     * @param int    $offset
     *
     * @return array
     */
    abstract public function doFind(string $name, int $limit = 0, int $offset = 0): array;

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
    public function find(string $name, int $limit = 0, int $offset = 0): array
    {
        if (false === $this->supports($name)) {
            throw new UnsupportedDomainException($this, $name);
        }

        return $this->doFind($name, $limit, $offset);
    }

    /**
     * @inheritDoc
     */
    public function findOne(string $name, array $criteria = [], array $orderBy = []): ?DomainInterface
    {
        if (false === $this->supports($name)) {
            throw new UnsupportedDomainException($this, $name);
        }

        return $this->doFindOne($name, $criteria, $orderBy);
    }
}