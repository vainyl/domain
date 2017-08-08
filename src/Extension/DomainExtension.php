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

namespace Vainyl\Domain\Extension;

use Vainyl\Core\Extension\AbstractFrameworkExtension;

/**
 * Class DomainExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DomainExtension extends AbstractFrameworkExtension
{
    /**
     * @inheritDoc
     */
    public function getCompilerPasses(): array
    {
        return [
            [new DomainFactoryCompilerPass()],
            [new DomainStorageCompilerPass()],
            [new DomainHydratorCompilerPass()],
        ];
    }
}