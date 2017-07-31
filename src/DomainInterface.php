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

namespace Vainyl\Domain;

use Vainyl\Core\ArrayInterface;
use Vainyl\Core\NameableInterface;
use Vainyl\Time\TimeInterface;

/**
 * Class DomainInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DomainInterface extends ArrayInterface, NameableInterface
{
    /**
     * @param TimeInterface $time
     *
     * @return ArrayInterface
     */
    public function setCreatedAt(TimeInterface $time): ArrayInterface;

    /**
     * @param TimeInterface $time
     *
     * @return ArrayInterface
     */
    public function setUpdatedAt(TimeInterface $time): ArrayInterface;

    /**
     * @return TimeInterface
     */
    public function createdAt(): TimeInterface;

    /**
     * @return TimeInterface
     */
    public function updatedAt(): TimeInterface;
}