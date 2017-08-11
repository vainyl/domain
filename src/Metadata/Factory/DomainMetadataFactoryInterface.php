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

use Vainyl\Core\IdentifiableInterface;
use Vainyl\Domain\Metadata\DomainMetadataInterface;

/**
 * Interface DomainMetadataFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DomainMetadataFactoryInterface extends IdentifiableInterface
{
    /**
     * @return DomainMetadataInterface
     */
    public function create(): DomainMetadataInterface;
}