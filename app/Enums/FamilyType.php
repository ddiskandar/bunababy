<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum FamilyType: string implements HasLabel
{
    case ANAK = 'anak';
    case PASANGAN = 'pasangan';
    case ORANG_TUA = 'orang_tua';
    case SAUDARA_KANDUNG = 'saudara_kandung';
    case KERABAT = 'kerabat';
    case TEMAN = 'teman';
    case LAINNYA = 'lainnya';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ANAK => 'Anak',
            self::PASANGAN => 'Pasangan',
            self::ORANG_TUA => 'Orang Tua',
            self::SAUDARA_KANDUNG => 'Saudara Kandung',
            self::KERABAT => 'Kerabat',
            self::TEMAN => 'Teman',
            self::LAINNYA => 'Lainnya',
        };
    }
}
