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

namespace Vainyl\Domain\Scenario\Factory;

use Vainyl\Core\Storage\Decorator\AbstractStorageDecorator;
use Vainyl\Domain\Scenario\ScenarioInterface;

/**
 * Class CompositeScenarioFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CompositeScenarioFactory extends AbstractStorageDecorator implements ScenarioFactoryInterface
{
    /**
     * @param string                   $name
     * @param ScenarioFactoryInterface $factory
     *
     * @return $this
     */
    public function addFactory(string $name, ScenarioFactoryInterface $factory)
    {
        $this->offsetSet($name, $factory);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function createScenario(string $name, array $options = []): ScenarioInterface
    {
        return $this->getFactory($name)->createScenario($name, $options);
    }

    /**
     * @param string $name
     *
     * @return ScenarioFactoryInterface
     */
    public function getFactory(string $name): ScenarioFactoryInterface
    {
        return $this->offsetGet($name);
    }
}