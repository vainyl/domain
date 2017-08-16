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

use Vainyl\Core\Exception\AbstractCoreException;
use Vainyl\Domain\Operation\Factory\DomainOperationFactoryInterface;

/**
 * Class AbstractDomainFactoryException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDomainFactoryException extends AbstractCoreException implements DomainFactoryExceptionInterface
{
    private $factory;

    /**
     * AbstractDomainFactoryException constructor.
     *
     * @param DomainOperationFactoryInterface $factory
     * @param string                          $message
     * @param int                             $code
     * @param \Throwable|null                 $previous
     */
    public function __construct(
        DomainOperationFactoryInterface $factory,
        string $message,
        int $code = 500,
        \Throwable $previous = null
    ) {
        $this->factory = $factory;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getFactory(): DomainOperationFactoryInterface
    {
        return $this->factory;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['factory' => $this->factory->getId()], parent::toArray());
    }
}