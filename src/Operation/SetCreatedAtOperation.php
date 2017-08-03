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

namespace Vainyl\Domain\Operation;

use Vainyl\Core\ResultInterface;
use Vainyl\Domain\DomainInterface;
use Vainyl\Operation\AbstractOperation;
use Vainyl\Operation\SuccessfulOperationResult;
use Vainyl\Time\TimeInterface;

/**
 * Class SetCreatedAtOperation
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class SetCreatedAtOperation extends AbstractOperation
{
    private $domain;

    private $time;

    /**
     * SetUpdatedAtOperation constructor.
     *
     * @param DomainInterface $domain
     * @param TimeInterface   $time
     */
    public function __construct(DomainInterface $domain, TimeInterface $time)
    {
        $this->domain = $domain;
        $this->time = $time;
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        $this->domain->setCreatedAt($this->time);

        return new SuccessfulOperationResult($this);
    }
}