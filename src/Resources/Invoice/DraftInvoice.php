<?php

namespace MorningTrain\Economic\Resources\Invoice;

use MorningTrain\Economic\Attributes\Resources\Create;
use MorningTrain\Economic\Attributes\Resources\GetCollection;
use MorningTrain\Economic\Attributes\Resources\GetSingle;

#[GetCollection('invoices/drafts')]
#[GetSingle('invoices/drafts/:draftInvoiceNumber', ':draftInvoiceNumber')]
#[Create('invoices/drafts')]
class DraftInvoice extends Invoice
{
    public ?int $draftInvoiceNumber = null;

    public function create()
    {
        return static::createRequest([
            'customer' => $this->customer,
            'layout' => $this->layout,
            'currency' => $this->currency->isoNumber,
            'paymentTerms' => $this->paymentTerms,
            'date' => $this->date->format('Y-m-d'),
            'recipient' => $this->recipient,
            'lines' => $this->lines ?? null,
        ]);
    }

    public function book(): ?BookedInvoice
    {
        return BookedInvoice::createFromDraft($this);
    }
}
