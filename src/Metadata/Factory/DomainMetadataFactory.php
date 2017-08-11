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

namespace Vainyl\Domain\Metadata\Factory;

use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Domain\Metadata\DomainMetadata;
use Vainyl\Domain\Metadata\DomainMetadataInterface;

/**
 * Class DomainMetadataFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DomainMetadataFactory extends AbstractIdentifiable implements DomainMetadataFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(): DomainMetadataInterface
    {
        return new DomainMetadata();
    }
}