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

use Vainyl\Core\ResultInterface;
use Vainyl\Domain\DomainInterface;
use Vainyl\Operation\AbstractOperation;

/**
 * Class CheckScenarioOperation
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CheckScenarioOperation extends AbstractOperation
{
    private $domain;

    private $scenario;

    /**
     * CheckScenarioOperation constructor.
     *
     * @param DomainInterface   $domain
     * @param ScenarioInterface $scenario
     */
    public function __construct(DomainInterface $domain, ScenarioInterface $scenario)
    {
        $this->domain = $domain;
        $this->scenario = $scenario;
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        return $this->scenario->run($this->domain);
    }
}