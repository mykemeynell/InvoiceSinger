<?php

namespace InvoiceSinger\Storage\Entity\Contract;

use Illuminate\Support\Collection;

/**
 * Interface ClientEntityInterface.
 *
 * @property string|null      $title
 * @property string           $first_name
 * @property string|null      $last_name
 * @property string|null      $business_name
 * @property string|null      $address_1
 * @property string|null      $address_2
 * @property string|null      $town_city
 * @property string|null      $postcode
 * @property string|null      $country
 * @property string|null      $telephone
 * @property string|null      $fax
 * @property string|null      $mobile
 * @property string|null      $email_address
 * @property string|null      $web
 * @property string|null      $vat_number
 * @property integer          $is_active
 * @property \Carbon\Carbon   $created_at
 * @property \Carbon\Carbon   $updated_at
 *
 * @package InvoiceSinger\Storage\Entity\Contract
 */
interface ClientEntityInterface
{
    /**
     * Get the display name.
     *
     * @return string
     */
    public function getDisplayName(): string;

    /**
     * Get the client title.
     *
     * @return string|null
     */
    public function getTitle(): ?string;

    /**
     * Get the first name.
     *
     * @return string
     */
    public function getFirstName(): string;

    /**
     * Get the last name.
     *
     * @return string|null
     */
    public function getLastName(): ?string;

    /**
     * Get the business name.
     *
     * @return string|null
     */
    public function getBusinessName(): ?string;

    /**
     * Get the address as an object.
     *
     * @param bool $include_business_name
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAddressObject($include_business_name = false): Collection;

    /**
     * Get address line 1.
     *
     * @return string|null
     */
    public function getAddress1(): ?string;

    /**
     * Get address line 2.
     *
     * @return string|null
     */
    public function getAddress2(): ?string;

    /**
     * Get the town or city.
     *
     * @return string|null
     */
    public function getTownCity(): ?string;

    /**
     * Get the postcode.
     *
     * @return string|null
     */
    public function getPostcode(): ?string;

    /**
     * Get the country.
     *
     * @return string|null
     */
    public function getCountry(): ?string;

    /**
     * Get the telephone number.
     *
     * @return string|null
     */
    public function getTelephone(): ?string;

    /**
     * Get the fax number.
     *
     * @return string|null
     */
    public function getFax(): ?string;

    /**
     * Get the mobile number.
     *
     * @return string|null
     */
    public function getMobile(): ?string;

    /**
     * Get the email address.
     *
     * @return string|null
     */
    public function getEmailAddress(): ?string;

    /**
     * Get the website address.
     *
     * @return string|null
     */
    public function getWebAddress(): ?string;

    /**
     * Get the VAT number.
     *
     * @return string|null
     */
    public function getVatNumber(): ?string;

    /**
     * Test if client marked as active.
     *
     * @return bool
     */
    public function isActive(): bool;
}
