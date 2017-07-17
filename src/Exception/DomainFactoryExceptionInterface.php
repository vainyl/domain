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
use Vainyl\Domain\Operation\Factory\DomainOperationFactoryInterface;

/**
 * Class DomainFactoryExceptionInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DomainFactoryExceptionInterface extends CoreExceptionInterface
{
    /**
     * @return DomainOperationFactoryInterface
     */
    public function getFactory(): DomainOperationFactoryInterface;
}