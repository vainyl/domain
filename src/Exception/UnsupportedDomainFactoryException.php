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

namespace Vainyl\Domain\Exception;

use Vainyl\Domain\DomainInterface;
use Vainyl\Domain\Operation\Factory\DomainOperationFactoryInterface;

/**
 * Class UnsupportedDomainException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedDomainFactoryException extends AbstractDomainFactoryException
{
    private $domain;

    /**
     * UnsupportedDomainException constructor.
     *
     * @param DomainOperationFactoryInterface $factory
     * @param DomainInterface                 $domain
     */
    public function __construct(DomainOperationFactoryInterface $factory, DomainInterface $domain)
    {
        $this->domain = $domain;
        parent::__construct($factory, sprintf('Unsupported domain %s', $domain->getName()));
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['domain' => $this->domain], parent::toArray());
    }
}