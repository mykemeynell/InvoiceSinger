<?php

namespace InvoiceSinger\Storage\Entity\Contract;

/**
 * Interface PaymentMethodEntityInterface
 *
 * @property string $name
 * @property string $slug
 * @property int    $protected
 * @property int    $enabled
 *
 * @package InvoiceSinger\Storage\Entity\Contract
 */
interface PaymentMethodEntityInterface
{
    /**
     * Get the display name of the payment method.
     *
     * @return string
     */
    public function getDisplayName(): string;

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug(): string;

    /**
     * Test if method is protected.
     *
     * @return bool
     */
    public function isProtected(): bool;

    /**
     * Test if method is enabled.
     *
     * @return bool
     */
    public function isEnabled(): bool;
}
