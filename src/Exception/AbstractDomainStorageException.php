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
use Vainyl\Domain\Storage\DomainStorageInterface;

/**
 * Class AbstractDomainStorageException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDomainStorageException extends AbstractCoreException implements DomainStorageExceptionInterface
{
    private $storage;

    /**
     * AbstractDomainStorageException constructor.
     *
     * @param DomainStorageInterface $storage
     * @param string                 $message
     * @param int                    $code
     * @param \Exception|null        $previous
     */
    public function __construct(
        DomainStorageInterface $storage,
        string $message,
        int $code = 500,
        \Exception $previous = null
    ) {
        $this->storage = $storage;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getStorage(): DomainStorageInterface
    {
        return $this->storage;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['storage' => $this->storage->getId()], parent::toArray());
    }
}