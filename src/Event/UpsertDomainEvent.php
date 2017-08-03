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
 * Class UpsertDomainEvent
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UpsertDomainEvent extends AbstractIdentifiable implements EventInterface
{
    private $domain;

    /**
     * UpsertDomainEvent constructor.
     *
     * @param DomainInterface $domain
     */
    public function __construct(DomainInterface $domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return DomainInterface
     */
    public function getDomain(): DomainInterface
    {
        return $this->domain;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return sprintf('domain.%s.upsert', $this->domain->getName());
    }
}