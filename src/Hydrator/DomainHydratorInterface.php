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

namespace Vainyl\Domain\Hydrator;

use Vainyl\Core\Hydrator\HydratorInterface;
use Vainyl\Domain\DomainInterface;

/**
 * Interface DomainHydratorInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @method DomainInterface create(string $className, array $data)
 * @method DomainInterface update($object, array $data)
 */
interface DomainHydratorInterface extends HydratorInterface
{
}