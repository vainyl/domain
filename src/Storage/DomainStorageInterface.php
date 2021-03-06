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

use Vainyl\Core\IdentifiableInterface;
use Vainyl\Domain\DomainInterface;

/**
 * Class DomainStorageInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DomainStorageInterface extends IdentifiableInterface
{
    /**
     * @param string $name
     * @param        $id
     *
     * @return null|DomainInterface
     */
    public function findById(string $name, $id): ?DomainInterface;

    /**
     * @param string $name
     * @param array  $criteria
     * @param array  $orderBy
     * @param int    $limit
     * @param int    $offset
     *
     * @return DomainInterface[]
     */
    public function findMany(
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
    public function findOne(string $name, array $criteria = [], array $orderBy = []): ?DomainInterface;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function supports(string $name): bool;
}