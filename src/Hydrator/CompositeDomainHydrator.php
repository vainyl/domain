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

namespace Vainyl\Domain\Hydrator;

use Vainyl\Core\Exception\UnsupportedClassHydratorException;
use Vainyl\Core\Hydrator\HydratorInterface;
use Vainyl\Core\IdentifiableInterface;
use Vainyl\Core\Storage\Decorator\AbstractStorageDecorator;

/**
 * Class CompositeDomainHydrator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CompositeDomainHydrator extends AbstractStorageDecorator implements DomainHydratorInterface
{
    /**
     * @param string                  $alias
     * @param DomainHydratorInterface $hydrator
     *
     * @return CompositeDomainHydrator
     */
    public function addHydrator(string $alias, DomainHydratorInterface $hydrator): CompositeDomainHydrator
    {
        $this->offsetSet($alias, $hydrator);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function create(string $className, array $data): IdentifiableInterface
    {
        /**
         * @var HydratorInterface $hydrator
         */
        foreach ($this->getIterator() as $hydrator) {
            if (false === $hydrator->supports($className)) {
                continue;
            }

            return $hydrator->create($className, $data);
        }

        throw new UnsupportedClassHydratorException($this, $className);
    }

    /**
     * @inheritDoc
     */
    public function supports(string $className): bool
    {
        /**
         * @var HydratorInterface $hydrator
         */
        foreach ($this->getIterator() as $hydrator) {
            if (false === $hydrator->supports($className)) {
                continue;
            }

            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function update($object, array $data): IdentifiableInterface
    {
        /**
         * @var HydratorInterface $hydrator
         */
        foreach ($this->getIterator() as $hydrator) {
            if (false === $hydrator->supports(get_class($object))) {
                continue;
            }

            return $hydrator->update($object, $data);
        }

        throw new UnsupportedClassHydratorException($this, get_class($object));
    }
}