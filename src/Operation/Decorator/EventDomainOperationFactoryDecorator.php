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
use Vainyl\Domain\Event\CreateDomainEvent;
use Vainyl\Domain\Event\DeleteDomainEvent;
use Vainyl\Domain\Event\UpdateDomainEvent;
use Vainyl\Domain\Event\UpsertDomainEvent;
use Vainyl\Domain\Operation\Factory\DomainOperationFactoryInterface;
use Vainyl\Event\EventDispatcherInterface;
use Vainyl\Event\Operation\DispatchEventOperation;
use Vainyl\Operation\Collection\Factory\CollectionFactoryInterface;
use Vainyl\Operation\OperationInterface;

/**
 * Class EventDomainOperationFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class EventDomainOperationFactoryDecorator extends AbstractDomainOperationFactoryDecorator
{
    private $collectionFactory;

    private $eventDispatcher;

    /**
     * EventDomainOperationFactoryDecorator constructor.
     *
     * @param DomainOperationFactoryInterface $operationFactory
     * @param CollectionFactoryInterface      $collectionFactory
     * @param EventDispatcherInterface        $eventDispatcher
     */
    public function __construct(
        DomainOperationFactoryInterface $operationFactory,
        CollectionFactoryInterface $collectionFactory,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->eventDispatcher = $eventDispatcher;
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
                new DispatchEventOperation($this->eventDispatcher, new CreateDomainEvent($domain))
            )
            ->add(parent::create($domain));
    }

    /**
     * @inheritDoc
     */
    public function delete(DomainInterface $domain): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new DispatchEventOperation($this->eventDispatcher, new DeleteDomainEvent($domain))
            )
            ->add(parent::delete($domain));
    }

    /**
     * @inheritDoc
     */
    public function update(DomainInterface $newDomain, DomainInterface $oldDomain): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new DispatchEventOperation($this->eventDispatcher, new UpdateDomainEvent($newDomain, $oldDomain))
            )
            ->add(parent::update($newDomain, $oldDomain));
    }

    /**
     * @inheritDoc
     */
    public function upsert(DomainInterface $domain): OperationInterface
    {
        return $this->collectionFactory
            ->create()
            ->add(
                new DispatchEventOperation($this->eventDispatcher, new UpsertDomainEvent($domain))
            )
            ->add(parent::upsert($domain));
    }
}