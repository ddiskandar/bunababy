<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.name', 'Bunababy Care');
        $this->migrator->add('general.desc', 'Mom and Baby Care');
        $this->migrator->add('general.address', 'Komplek Nata Endah Blok N No. 170, Cibabat, Cimahi');
        $this->migrator->add('general.ig', '@bunababy_care');
        $this->migrator->add('general.phone', '08997897991');
    }
};
