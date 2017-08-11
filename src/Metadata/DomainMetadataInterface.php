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

use Vainyl\Core\IdentifiableInterface;

/**
 * Interface DomainMetadataInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DomainMetadataInterface extends IdentifiableInterface
{
    /**
     * @return string
     */
    public function getAlias(): string;

    /**
     * @return array
     */
    public function getScenarios(): array;

    /**
     * @param string $alias
     *
     * @return DomainMetadataInterface
     */
    public function setAlias(string $alias): DomainMetadataInterface;

    /**
     * @param array $scenarios
     *
     * @return DomainMetadataInterface
     */
    public function setScenarios(array $scenarios): DomainMetadataInterface;
}