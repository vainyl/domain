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

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Vainyl\Core\Exception\MissingRequiredFieldException;
use Vainyl\Core\Exception\MissingRequiredServiceException;

/**
 * Class DomainFactoryCompilerPass
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DomainFactoryCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if (false === ($container->hasDefinition('domain.operation.factory.composite'))) {
            throw new MissingRequiredServiceException($container, 'domain.operation.factory.composite');
        }

        $containerDefinition = $container->getDefinition('domain.operation.factory.composite');

        foreach ($container->findTaggedServiceIds('domain.operation.factory') as $id => $tags) {
            foreach ($tags as $attributes) {
                if (false === array_key_exists('alias', $attributes)) {
                    throw new MissingRequiredFieldException($container, $id, $attributes, 'alias');
                }

                $containerDefinition
                    ->addMethodCall('addFactory', [$attributes['alias'], new Reference($id)]);
            }
        }

        return $this;
    }
}