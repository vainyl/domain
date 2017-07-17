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

namespace Vainyl\Domain\Operation\Factory;

use Vainyl\Core\IdentifiableInterface;
use Vainyl\Domain\DomainInterface;
use Vainyl\Operation\OperationInterface;

/**
 * Class DomainOperationFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DomainOperationFactoryInterface extends IdentifiableInterface
{
    /**
     * @param DomainInterface $domain
     *
     * @return bool
     */
    public function supports(DomainInterface $domain): bool;

    /**
     * @param DomainInterface $domain
     *
     * @return OperationInterface
     */
    public function create(DomainInterface $domain): OperationInterface;

    /**
     * @param DomainInterface $newDomain
     * @param DomainInterface $oldDomain
     *
     * @return OperationInterface
     */
    public function update(DomainInterface $newDomain, DomainInterface $oldDomain): OperationInterface;

    /**
     * @param DomainInterface $domain
     *
     * @return OperationInterface
     */
    public function delete(DomainInterface $domain): OperationInterface;

    /**
     * @param DomainInterface $domain
     *
     * @return OperationInterface
     */
    public function upsert(DomainInterface $domain): OperationInterface;
}