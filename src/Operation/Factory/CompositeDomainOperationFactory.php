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

use Vainyl\Core\Storage\Decorator\AbstractStorageDecorator;
use Vainyl\Domain\DomainInterface;
use Vainyl\Domain\Exception\UnsupportedDomainFactoryException;
use Vainyl\Operation\OperationInterface;

/**
 * Class CompositeDomainOperationFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CompositeDomainOperationFactory extends AbstractStorageDecorator implements DomainOperationFactoryInterface
{
    /**
     * @param string                          $name
     * @param DomainOperationFactoryInterface $domainOperationFactory
     *
     * @return CompositeDomainOperationFactory
     */
    public function addFactory(
        string $name,
        DomainOperationFactoryInterface $domainOperationFactory
    ): CompositeDomainOperationFactory {
        $this->offsetSet($name, $domainOperationFactory);

        return $this;
    }

    /**
     * @param string $name
     *
     * @return DomainOperationFactoryInterface
     */
    public function getFactory(string $name): DomainOperationFactoryInterface
    {
        return $this->offsetGet($name);
    }

    /**
     * @inheritDoc
     */
    public function supports(DomainInterface $domain): bool
    {
        /**
         * @var DomainOperationFactoryInterface $operationFactory
         */
        foreach ($this->getIterator() as $operationFactory) {
            if (false === $operationFactory->supports($domain)) {
                continue;
            }

            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function create(DomainInterface $domain): OperationInterface
    {
        /**
         * @var DomainOperationFactoryInterface $operationFactory
         */
        foreach ($this->getIterator() as $operationFactory) {
            if (false === $operationFactory->supports($domain)) {
                continue;
            }

            return $operationFactory->create($domain);
        }

        throw new UnsupportedDomainFactoryException($this, $domain);
    }

    /**
     * @inheritDoc
     */
    public function update(DomainInterface $newDomain, DomainInterface $oldDomain): OperationInterface
    {
        /**
         * @var DomainOperationFactoryInterface $operationFactory
         */
        foreach ($this->getIterator() as $operationFactory) {
            if (false === $operationFactory->supports($newDomain)) {
                continue;
            }

            return $operationFactory->update($newDomain, $oldDomain);
        }

        throw new UnsupportedDomainFactoryException($this, $newDomain);
    }

    /**
     * @inheritDoc
     */
    public function delete(DomainInterface $domain): OperationInterface
    {
        /**
         * @var DomainOperationFactoryInterface $operationFactory
         */
        foreach ($this->getIterator() as $operationFactory) {
            if (false === $operationFactory->supports($domain)) {
                continue;
            }

            return $operationFactory->delete($domain);
        }

        throw new UnsupportedDomainFactoryException($this, $domain);
    }

    /**
     * @inheritDoc
     */
    public function upsert(DomainInterface $domain): OperationInterface
    {
        /**
         * @var DomainOperationFactoryInterface $operationFactory
         */
        foreach ($this->getIterator() as $operationFactory) {
            if (false === $operationFactory->supports($domain)) {
                continue;
            }

            return $operationFactory->upsert($domain);
        }

        throw new UnsupportedDomainFactoryException($this, $domain);
    }
}