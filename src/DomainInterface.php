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

namespace Vainyl\Domain;

use Vainyl\Core\ArrayInterface;
use Vainyl\Core\NameableInterface;

/**
 * Class DomainInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DomainInterface extends ArrayInterface, NameableInterface
{
}