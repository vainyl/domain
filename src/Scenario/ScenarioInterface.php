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

namespace Vainyl\Domain\Scenario;

use Vainyl\Core\NameableInterface;
use Vainyl\Core\ResultInterface;
use Vainyl\Domain\DomainInterface;

/**
 * Interface ScenarioInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface ScenarioInterface extends NameableInterface
{
    /**
     * @param DomainInterface $domain
     *
     * @return ResultInterface
     */
    public function run(DomainInterface $domain): ResultInterface;
}