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

use Vainyl\Domain\DomainInterface;
use Vainyl\Domain\Exception\UnsupportedDomainFactoryException;
use Vainyl\Operation\OperationInterface;

/**
 * Class AbstractDomainOperationFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDomainOperationFactory implements DomainOperationFactoryInterface
{
    /**
     * @param DomainInterface $domain
     *
     * @return OperationInterface
     */
    abstract public function doCreate(DomainInterface $domain): OperationInterface;

    /**
     * @param DomainInterface $newDomain
     * @param DomainInterface $oldDomain
     *
     * @return OperationInterface
     */
    abstract public function doUpdate(DomainInterface $newDomain, DomainInterface $oldDomain): OperationInterface;

    /**
     * @param DomainInterface $domain
     *
     * @return OperationInterface
     */
    abstract public function doDelete(DomainInterface $domain): OperationInterface;

    /**
     * @param DomainInterface $domain
     *
     * @return OperationInterface
     */
    abstract public function doUpsert(DomainInterface $domain): OperationInterface;

    /**
     * @inheritDoc
     */
    public function create(DomainInterface $domain): OperationInterface
    {
        if (false === $this->supports($domain)) {
            throw new UnsupportedDomainFactoryException($this, $domain);
        }

        return $this->doCreate($domain);
    }

    /**
     * @inheritDoc
     */
    public function update(DomainInterface $newDomain, DomainInterface $oldDomain): OperationInterface
    {
        if (false === $this->supports($newDomain)) {
            throw new UnsupportedDomainFactoryException($this, $newDomain);
        }

        return $this->doUpdate($newDomain, $oldDomain);
    }

    /**
     * @inheritDoc
     */
    public function delete(DomainInterface $domain): OperationInterface
    {
        if (false === $this->supports($domain)) {
            throw new UnsupportedDomainFactoryException($this, $domain);
        }

        return $this->doDelete($domain);
    }

    /**
     * @inheritDoc
     */
    public function upsert(DomainInterface $domain): OperationInterface
    {
        if (false === $this->supports($domain)) {
            throw new UnsupportedDomainFactoryException($this, $domain);
        }

        return $this->doUpsert($domain);
    }
}