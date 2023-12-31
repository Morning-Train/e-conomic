<?php

namespace Morningtrain\Economic\Resources\Customer;

use Morningtrain\Economic\Abstracts\Resource;
use Morningtrain\Economic\Attributes\Resources\Create;
use Morningtrain\Economic\Attributes\Resources\Delete;
use Morningtrain\Economic\Attributes\Resources\GetCollection;
use Morningtrain\Economic\Attributes\Resources\GetSingle;
use Morningtrain\Economic\Attributes\Resources\Update;
use Morningtrain\Economic\Classes\EconomicRelatedResource;
use Morningtrain\Economic\Resources\Customer;
use Morningtrain\Economic\Traits\Resources\Creatable;
use Morningtrain\Economic\Traits\Resources\EndpointResolvable;

#[GetCollection('customers/:customerNumber/contacts')]
#[GetSingle('customers/:customerNumber/contacts/:contactNumber')]
#[Create('customers/:customerNumber/contacts')]
#[Update('customers/:customerNumber/contacts/:contactNumber')]
#[Delete('customers/:customerNumber/contacts/:contactNumber')]
class Contact extends Resource
{
    use Creatable, EndpointResolvable;

    public Customer $customer;

    public float $customerContactNumber;

    public bool $deleted;

    public string $eInvoiceId;

    public string $email;

    public array $emailNotifications;

    public string $name;

    public string $notes;

    public string $phone;

    public int $sortKey;

    public static function fromCustomer(Customer|int $customer)
    {
        return new EconomicRelatedResource(
            static::getEndpointInstance(GetCollection::class),
            static::getEndpointInstance(GetSingle::class),
            static::class,
            [is_int($customer) ? $customer : $customer->customerNumber]
        );
    }

    public static function create(
        Customer $customer,
        string $name,
        ?string $email = null,
        ?string $phone = null,
        ?string $notes = null,
        ?string $eInvoiceId = null,
        ?array $emailNotifications = null
    ) {
        return static::createRequest(array_filter(compact(
            'customer',
            'name',
            'email',
            'phone',
            'notes',
            'eInvoiceId',
            'emailNotifications'
        )), [$customer->customerNumber]);
    }
}
