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

/**
 * Class AbstractDomain
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDomain implements DomainInterface
{
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
}