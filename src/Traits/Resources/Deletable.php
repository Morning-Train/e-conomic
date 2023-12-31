<?php

namespace Morningtrain\Economic\Traits\Resources;

use Morningtrain\Economic\Attributes\Resources\Delete;
use Morningtrain\Economic\Services\EconomicApiService;

trait Deletable
{
    use EndpointResolvable;

    public function delete(): bool
    {
        $response = EconomicApiService::delete(static::getEndpoint(Delete::class, $this->getPrimaryKey()));

        if ($response->getStatusCode() !== 204) {
            // TODO: Log error and throw exception

            return false;
        }

        return true;
    }
}
