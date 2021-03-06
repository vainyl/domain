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

namespace Vainyl\Domain\Operation\Decorator;

use Vainyl\Domain\DomainInterface;
use Vainyl\Domain\Operation\Factory\DomainOperationFactoryInterface;
use Vainyl\Domain\Operation\SetCreatedAtOperation;
use Vainyl\Domain\Operation\SetUpdatedAtOperation;
use Vainyl\Operation\Collection\Factory\CollectionFactoryInterface;
use Vainyl\Operation\OperationInterface;
use Vainyl\Time\Provider\TimeProviderInterface;

/**
 * Class TimestampDomainOperationFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class TimestampDomainOperationFactoryDecorator extends AbstractDomainOperationFactoryDecorator
{
    private $collectionFactory;

    private $timeProvider;

    /**
     * TimestampDomainOperationFactoryDecorator constructor.
     *
     * @param DomainOperationFactoryInterface $operationFactory
     * @param CollectionFactoryInterface      $collectionFactory
     * @param TimeProviderInterface           $timeProvider
     */
    public function __construct(
        DomainOperationFactoryInterface $operationFactory,
        CollectionFactoryInterface $collectionFactory,
        TimeProviderInterface $timeProvider
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->timeProvider = $timeProvider;
        parent::__construct($operationFactory);
    }

    /**
     * @inheritDoc
     */
    public function create(DomainInterface $domain): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new SetCreatedAtOperation($domain, $this->timeProvider->getCurrentTime())
            )
            ->add(parent::create($domain));
    }

    /**
     * @inheritDoc
     */
    public function update(DomainInterface $newDomain, DomainInterface $oldDomain): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new SetUpdatedAtOperation($newDomain, $this->timeProvider->getCurrentTime())
            )
            ->add(parent::update($newDomain, $oldDomain));
    }

    /**
     * @inheritDoc
     */
    public function upsert(DomainInterface $domain): OperationInterface
    {
        $collection = $this->collectionFactory->create();
        if (null === $domain->createdAt()) {
            $collection->add(new SetCreatedAtOperation($domain, $this->timeProvider->getCurrentTime()));
        }

        if (null === $domain->updatedAt()) {
            $collection->add(new SetUpdatedAtOperation($domain, $this->timeProvider->getCurrentTime()));
        }

        return $collection->add(parent::upsert($domain));
    }
}