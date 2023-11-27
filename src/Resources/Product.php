<?php

namespace MorningTrain\Economic\Resources;

use MorningTrain\Economic\Abstracts\Resource;
use MorningTrain\Economic\Attributes\Resources\Create;
use MorningTrain\Economic\Attributes\Resources\GetCollection;
use MorningTrain\Economic\Attributes\Resources\GetSingle;
use MorningTrain\Economic\Attributes\Resources\Properties\Filterable;
use MorningTrain\Economic\Attributes\Resources\Properties\ResourceType;
use MorningTrain\Economic\Attributes\Resources\Properties\Sortable;
use MorningTrain\Economic\Classes\EconomicCollection;
use MorningTrain\Economic\Resources\AccountingYear\Entry;
use MorningTrain\Economic\Resources\AccountingYear\Period;
use MorningTrain\Economic\Resources\AccountingYear\Total;
use MorningTrain\Economic\Resources\AccountingYear\Voucher;
use MorningTrain\Economic\Traits\Resources\Creatable;
use MorningTrain\Economic\Traits\Resources\GetCollectionable;
use MorningTrain\Economic\Traits\Resources\GetSingleable;

#[GetCollection('products')]
#[GetSingle('products/:product', ':product')]
#[Create('products')]
class Product extends Resource
{
    use GetCollectionable, GetSingleable, Creatable;

    #[Filterable]
    #[Sortable]
    public string $barCode;

    #[Filterable]
    #[Sortable]
    public bool $barred;

    #[Filterable]
    #[Sortable]
    public float $costPrice;

    

    /**
     * @var EconomicCollection<Entry>
     */
    #[ResourceType(Entry::class)]
    public EconomicCollection $entries;

    #[Filterable]
    #[Sortable]
    public DateTime $fromDate;

    /**
     * @var EconomicCollection<Period>
     */
    #[ResourceType(Period::class)]
    public EconomicCollection $periods;

    #[Filterable]
    #[Sortable]
    public DateTime $toDate;

    /**
     * @var EconomicCollection<Total>
     */
    #[ResourceType(Total::class)]
    public EconomicCollection $totals;

    /**
     * @var EconomicCollection<Voucher>
     */
    #[ResourceType(Voucher::class)]
    public EconomicCollection $vouchers;

    #[Filterable]
    #[Sortable]
    public string $year;

    public static function create(DateTime $fromDate, DateTime $toDate): static
    {
        return static::createRequest(compact('fromDate', 'toDate'));
    }
}