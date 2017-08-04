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

use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Domain\DomainInterface;
use Vainyl\Domain\Operation\Factory\DomainOperationFactoryInterface;
use Vainyl\Operation\OperationInterface;

/**
 * Class AbstractDomainOperationFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDomainOperationFactoryDecorator extends AbstractIdentifiable implements DomainOperationFactoryInterface
{
    private $operationFactory;

    /**
     * AbstractDomainOperationFactoryDecorator constructor.
     *
     * @param DomainOperationFactoryInterface $operationFactory
     */
    public function __construct(DomainOperationFactoryInterface $operationFactory)
    {
        $this->operationFactory = $operationFactory;
    }

    /**
     * @inheritDoc
     */
    public function create(DomainInterface $domain): OperationInterface
    {
        return $this->operationFactory->create($domain);
    }

    /**
     * @inheritDoc
     */
    public function delete(DomainInterface $domain): OperationInterface
    {
        return $this->operationFactory->delete($domain);
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->operationFactory->getId();
    }

    /**
     * @inheritDoc
     */
    public function supports(DomainInterface $domain): bool
    {
        return $this->operationFactory->supports($domain);
    }

    /**
     * @inheritDoc
     */
    public function update(DomainInterface $newDomain, DomainInterface $oldDomain): OperationInterface
    {
        return $this->operationFactory->update($newDomain, $oldDomain);
    }

    /**
     * @inheritDoc
     */
    public function upsert(DomainInterface $domain): OperationInterface
    {
        return $this->operationFactory->upsert($domain);
    }
}