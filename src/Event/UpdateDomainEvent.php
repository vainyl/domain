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

namespace Vainyl\Domain\Event;

use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Domain\DomainInterface;
use Vainyl\Event\EventInterface;

/**
 * Class UpdateDomainEvent
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UpdateDomainEvent extends AbstractIdentifiable implements EventInterface
{
    private $newDomain;

    private $oldDomain;

    /**
     * UpdateDomainEvent constructor.
     *
     * @param DomainInterface $newDomain
     * @param DomainInterface $oldDomain
     */
    public function __construct(DomainInterface $newDomain, DomainInterface $oldDomain)
    {
        $this->newDomain = $newDomain;
        $this->oldDomain = $oldDomain;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return sprintf('domain.%s.update', $this->newDomain->getName());
    }

    /**
     * @return DomainInterface
     */
    public function getNewDomain(): DomainInterface
    {
        return $this->newDomain;
    }

    /**
     * @return DomainInterface
     */
    public function getOldDomain(): DomainInterface
    {
        return $this->oldDomain;
    }
}