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

use Vainyl\Domain\Storage\DomainStorageInterface;

/**
 * Class UnsupportedDomainException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnsupportedDomainException extends AbstractDomainStorageException
{
    private $domain;

    /**
     * UnsupportedDomainException constructor.
     *
     * @param DomainStorageInterface $storage
     * @param string                 $domain
     */
    public function __construct(DomainStorageInterface $storage, string $domain)
    {
        $this->domain = $domain;
        parent::__construct($storage, sprintf('Unsupported domain %s', $domain));
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['domain' => $this->domain], parent::toArray());
    }
}