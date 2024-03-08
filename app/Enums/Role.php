<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Role: string implements HasLabel
{
    case ADMIN = 'admin';
    case AREA = 'area';
    case EVA = 'eva';
    case MANAGER = 'manager';
    case PENDING = 'pending';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
