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

use Vainyl\Core\NameableInterface;
use Vainyl\Time\TimeInterface;

/**
 * Class DomainInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DomainInterface extends NameableInterface
{
    /**
     * @param TimeInterface $time
     *
     * @return DomainInterface
     */
    public function setCreatedAt(TimeInterface $time): DomainInterface;

    /**
     * @param TimeInterface $time
     *
     * @return DomainInterface
     */
    public function setUpdatedAt(TimeInterface $time): DomainInterface;

    /**
     * @return null|TimeInterface
     */
    public function createdAt(): ?TimeInterface;

    /**
     * @return null|TimeInterface
     */
    public function updatedAt(): ?TimeInterface;
}