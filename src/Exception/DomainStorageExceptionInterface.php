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

namespace Vainyl\Domain\Exception;

use Vainyl\Core\Exception\CoreExceptionInterface;
use Vainyl\Domain\Storage\DomainStorageInterface;

/**
 * Class DomainStorageExceptionInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DomainStorageExceptionInterface extends CoreExceptionInterface
{
    /**
     * @return DomainStorageInterface
     */
    public function getStorage() : DomainStorageInterface;
}