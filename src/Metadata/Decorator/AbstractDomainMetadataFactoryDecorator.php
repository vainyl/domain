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
use Vainyl\Domain\Metadata\Factory\DomainMetadataFactoryInterface;

/**
 * Class AbstractDomainMetadataFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDomainMetadataFactoryDecorator extends AbstractIdentifiable implements DomainMetadataFactoryInterface
{
    private $metadataFactory;

    /**
     * AbstractDomainMetadataFactoryDecorator constructor.
     *
     * @param DomainMetadataFactoryInterface $metadataFactory
     */
    public function __construct(DomainMetadataFactoryInterface $metadataFactory)
    {
        $this->metadataFactory = $metadataFactory;
    }

    /**
     * @inheritDoc
     */
    public function create(): DomainMetadataInterface
    {
        return $this->metadataFactory->create();
    }
}