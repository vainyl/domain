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

namespace Vainyl\Domain\Scenario\Storage;

use Vainyl\Core\ArrayInterface;
use Vainyl\Domain\Scenario\ScenarioInterface;

/**
 * Interface DomainScenarioStorageInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DomainScenarioStorageInterface extends ArrayInterface
{
    /**
     * @param string $name
     *
     * @return ScenarioInterface[]
     */
    public function getScenarios(string $name) : array;
}