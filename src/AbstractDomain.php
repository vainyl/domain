<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Doctrine-common-bridge
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Domain;

use Vainyl\Core\ArrayInterface;
use Vainyl\Time\TimeInterface;

/**
 * Class AbstractDomain
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDomain implements DomainInterface
{
    protected $createdAt;

    protected $updatedAt;

    /**
     * @inheritDoc
     */
    public function createdAt(): TimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(TimeInterface $time): ArrayInterface
    {
        $this->createdAt = $time;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt(TimeInterface $time): ArrayInterface
    {
        $this->updatedAt = $time;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        $array = [];
        foreach (get_object_vars($this) as $field => $value) {
            switch (true) {
                case (false === is_object($value)):
                    $array[$field] = $value;
                    break;
                case ($value instanceof ArrayInterface):
                    $array[$field] = $value->toArray();
                    break;
            }
        }

        return $array;
    }

    /**
     * @inheritDoc
     */
    public function updatedAt(): TimeInterface
    {
        return $this->updatedAt;
    }
}