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

namespace Vainyl\Domain\Metadata\Decorator;

use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Domain\Metadata\DomainMetadataInterface;

/**
 * Class AbstractDomainMetadataDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDomainMetadataDecorator extends AbstractIdentifiable implements DomainMetadataInterface
{
    private $domainMetadata;

    /**
     * AbstractDomainMetadataDecorator constructor.
     *
     * @param DomainMetadataInterface $domainMetadata
     */
    public function __construct(DomainMetadataInterface $domainMetadata)
    {
        $this->domainMetadata = $domainMetadata;
    }

    /**
     * @inheritDoc
     */
    public function getAlias(): string
    {
        return $this->domainMetadata->getAlias();
    }

    /**
     * @inheritDoc
     */
    public function getScenarios(): array
    {
        return $this->domainMetadata->getScenarios();
    }

    /**
     * @inheritDoc
     */
    public function setAlias(string $alias): DomainMetadataInterface
    {
        $this->domainMetadata->setAlias($alias);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setScenarios(array $scenarios): DomainMetadataInterface
    {
        $this->domainMetadata->setScenarios($scenarios);

        return $this;
    }
}