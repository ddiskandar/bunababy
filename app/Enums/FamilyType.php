<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum FamilyType: string implements HasLabel
{
    case DIRI_SENDIRI = 'diri_sendiri';
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
            self::DIRI_SENDIRI => 'Diri Sendiri',
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
