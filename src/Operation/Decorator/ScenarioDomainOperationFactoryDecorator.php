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
use Vainyl\Domain\Scenario\CheckScenarioOperation;
use Vainyl\Domain\Scenario\Storage\DomainScenarioStorageInterface;
use Vainyl\Operation\Collection\Factory\CollectionFactoryInterface;
use Vainyl\Operation\OperationInterface;

/**
 * Class ScenarioDomainOperationFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ScenarioDomainOperationFactoryDecorator extends AbstractDomainOperationFactoryDecorator
{
    private $collectionFactory;

    private $scenarioStorage;

    /**
     * ScenarioDomainOperationFactoryDecorator constructor.
     *
     * @param DomainOperationFactoryInterface $operationFactory
     * @param CollectionFactoryInterface      $collectionFactory
     * @param DomainScenarioStorageInterface  $domainStorage
     */
    public function __construct(
        DomainOperationFactoryInterface $operationFactory,
        CollectionFactoryInterface $collectionFactory,
        DomainScenarioStorageInterface $domainStorage
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->scenarioStorage = $domainStorage;
        parent::__construct($operationFactory);
    }

    /**
     * @inheritDoc
     */
    public function create(DomainInterface $domain): OperationInterface
    {
        $collection = $this->collectionFactory->create();;
        foreach ($this->scenarioStorage->getScenarios(get_class($domain)) as $scenario) {
            $collection->add(new CheckScenarioOperation($domain, $scenario));
        }

        return $collection->add(parent::create($domain));
    }

    /**
     * @inheritDoc
     */
    public function update(DomainInterface $newDomain, DomainInterface $oldDomain): OperationInterface
    {
        $collection = $this->collectionFactory->create();;
        foreach ($this->scenarioStorage->getScenarios(get_class($newDomain)) as $scenario) {
            $collection->add(new CheckScenarioOperation($newDomain, $scenario));
        }

        return $collection->add(parent::update($newDomain, $oldDomain));
    }

    /**
     * @inheritDoc
     */
    public function upsert(DomainInterface $domain): OperationInterface
    {
        $collection = $this->collectionFactory->create();;
        foreach ($this->scenarioStorage->getScenarios(get_class($domain)) as $scenario) {
            $collection->add(new CheckScenarioOperation($domain, $scenario));
        }

        return $collection->add(parent::upsert($domain));
    }
}