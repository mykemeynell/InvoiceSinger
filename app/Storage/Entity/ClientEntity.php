<?php

namespace InvoiceSinger\Storage\Entity;

use ArchLayer\Entity\Concern\EntityHasTimestamps;
use Illuminate\Database\Eloquent\Model;
use UuidColumn\Concern\HasUuidObserver;

/**
 * Class ClientEntity.
 *
 * @package InvoiceSinger\Storage\Entity
 */
class ClientEntity extends Model implements Contract\ClientEntityInterface
{
    use HasUuidObserver, EntityHasTimestamps;

    /**
     * The table name.
     *
     * @var string
     */
    public $table = 'clients';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'business_name',
        'address_1',
        'address_2',
        'town_city',
        'postcode',
        'country',
        'telephone',
        'fax',
        'mobile',
        'email_address',
        'web',
        'vat_number',
        'is_active',
    ];

    /**
     * Get the display name.
     *
     * @return string
     */
    public function getDisplayName(): string
    {
        if(! $this->business_name !== "" && $this->business_name !== null) {
            return $this->business_name;
        }

        return ucwords(implode(" ", [
            $this->first_name,
            $this->first_name,
        ]));
    }

    /**
     * Get the client title.
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return ucwords($this->title);
    }

    /**
     * Get the first name.
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * Get the last name.
     *
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * Get the business name.
     *
     * @return string|null
     */
    public function getBusinessName(): ?string
    {
        return $this->business_name;
    }

    /**
     * Get address line 1.
     *
     * @return string|null
     */
    public function getAddress1(): ?string
    {
        return $this->address_1;
    }

    /**
     * Get address line 2.
     *
     * @return string|null
     */
    public function getAddress2(): ?string
    {
        return $this->address_2;
    }

    /**
     * Get the town or city.
     *
     * @return string|null
     */
    public function getTownCity(): ?string
    {
        return $this->town_city;
    }

    /**
     * Get the postcode.
     *
     * @return string|null
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * Get the country.
     *
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * Get the telephone number.
     *
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * Get the fax number.
     *
     * @return string|null
     */
    public function getFax(): ?string
    {
        return $this->fax;
    }

    /**
     * Get the mobile number.
     *
     * @return string|null
     */
    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    /**
     * Get the email address.
     *
     * @return string|null
     */
    public function getEmailAddress(): ?string
    {
        return $this->email_address;
    }

    /**
     * Get the website address.
     *
     * @return string|null
     */
    public function getWebAddress(): ?string
    {
        return $this->web;
    }

    /**
     * Get the VAT number.
     *
     * @return string|null
     */
    public function getVatNumber(): ?string
    {
        return $this->vat_number;
    }

    /**
     * Test if client marked as active.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Set the is_active field.
     *
     * @param $value
     *
     * @return int
     */
    public function setIsActiveAttribute($value): int
    {
        return $this->attributes['is_active'] = $value === 'on' ? 1 : 0;
    }
}
