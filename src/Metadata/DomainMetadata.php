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

namespace Vainyl\Domain\Metadata;

use Vainyl\Core\AbstractIdentifiable;

/**
 * Class DomainMetadata
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DomainMetadata extends AbstractIdentifiable implements DomainMetadataInterface
{
    public $alias;

    public $scenarios = [];

    /**
     * @inheritDoc
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * @inheritDoc
     */
    public function setAlias(string $alias): DomainMetadataInterface
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getScenarios(): array
    {
        return $this->scenarios;
    }

    /**
     * @inheritDoc
     */
    public function setScenarios(array $scenarios): DomainMetadataInterface
    {
        $this->scenarios = $scenarios;

        return $this;
    }
}