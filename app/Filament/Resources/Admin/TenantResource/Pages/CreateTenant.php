<?php

namespace App\Filament\Resources\Admin\TenantResource\Pages;

use App\Filament\Resources\Admin\TenantResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTenant extends CreateRecord
{
    protected static string $resource = TenantResource::class;
}
