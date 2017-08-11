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

use Vainyl\Core\IdentifiableInterface;
use Vainyl\Domain\Scenario\ScenarioInterface;

/**
 * Interface ScenarioFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ScenarioFactoryInterface extends IdentifiableInterface
{
    /**
     * @param string $name
     * @param array  $options
     *
     * @return ScenarioInterface
     */
    public function createScenario(string $name, array $options = []) : ScenarioInterface;
}