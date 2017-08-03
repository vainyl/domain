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
    public function create(DomainInterface $entity): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new SetCreatedAtOperation($entity, $this->timeProvider->getCurrentTime())
            )
            ->add(parent::create($entity));
    }

    /**
     * @inheritDoc
     */
    public function update(DomainInterface $newDocument, DomainInterface $oldDocument): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new SetUpdatedAtOperation($newDocument, $this->timeProvider->getCurrentTime())
            )
            ->add(parent::update($newDocument, $oldDocument));
    }

    /**
     * @inheritDoc
     */
    public function upsert(DomainInterface $document): OperationInterface
    {
        $collection = $this->collectionFactory->create();
        if (null === $document->createdAt()) {
            $collection->add(new SetCreatedAtOperation($document, $this->timeProvider->getCurrentTime()));
        }

        if (null === $document->updatedAt()) {
            $collection->add(new SetUpdatedAtOperation($document, $this->timeProvider->getCurrentTime()));
        }

        return $collection->add(parent::upsert($document));
    }
}