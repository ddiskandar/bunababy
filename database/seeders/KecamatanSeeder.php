<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kecamatans')->insert([
            ['kabupaten_id' => 1, 'name' => 'Cimahi Selatan'],
            ['kabupaten_id' => 1, 'name' => 'Cimahi Tengah'],
            ['kabupaten_id' => 1, 'name' => 'Cimahi Utara'],

            ['kabupaten_id' => 2, 'name' => 'Andir'],
            ['kabupaten_id' => 2, 'name' => 'Astana Anyar'],
            ['kabupaten_id' => 2, 'name' => 'Antapani'],
            ['kabupaten_id' => 2, 'name' => 'Arcamanik'],
            ['kabupaten_id' => 2, 'name' => 'Babakan Ciparay'],
            ['kabupaten_id' => 2, 'name' => 'Bandung Kidul'],
            ['kabupaten_id' => 2, 'name' => 'Bandung Kulon'],
            ['kabupaten_id' => 2, 'name' => 'Batununggal'],
            ['kabupaten_id' => 2, 'name' => 'Bojongloa Kaler'],
            ['kabupaten_id' => 2, 'name' => 'Bojongloa Kidul'],
            ['kabupaten_id' => 2, 'name' => 'Buahbatu'],
            ['kabupaten_id' => 2, 'name' => 'Cibeunying Kaler'],
            ['kabupaten_id' => 2, 'name' => 'Cibeunying Kidul'],
            ['kabupaten_id' => 2, 'name' => 'Cibiru'],
            ['kabupaten_id' => 2, 'name' => 'Cicendo'],
            ['kabupaten_id' => 2, 'name' => 'Cidadap'],
            ['kabupaten_id' => 2, 'name' => 'Cinambo'],
            ['kabupaten_id' => 2, 'name' => 'Coblong'],
            ['kabupaten_id' => 2, 'name' => 'Gedebage'],
            ['kabupaten_id' => 2, 'name' => 'Kiaracondong'],
            ['kabupaten_id' => 2, 'name' => 'Lengkong'],
            ['kabupaten_id' => 2, 'name' => 'Mandalajati'],
            ['kabupaten_id' => 2, 'name' => 'Panyileukan'],
            ['kabupaten_id' => 2, 'name' => 'Rancasari'],
            ['kabupaten_id' => 2, 'name' => 'Regol'],
            ['kabupaten_id' => 2, 'name' => 'Sukajadi'],
            ['kabupaten_id' => 2, 'name' => 'Sukasari'],
            ['kabupaten_id' => 2, 'name' => 'Sumur Bandung'],
            ['kabupaten_id' => 2, 'name' => 'Ujungberung'],

            ['kabupaten_id' => 3, 'name' => 'Arjasari'],
            ['kabupaten_id' => 3, 'name' => 'Baleendah'],
            ['kabupaten_id' => 3, 'name' => 'Banjaran'],
            ['kabupaten_id' => 3, 'name' => 'Bojongsoang'],
            ['kabupaten_id' => 3, 'name' => 'Cangkuang'],
            ['kabupaten_id' => 3, 'name' => 'Cicalengka'],
            ['kabupaten_id' => 3, 'name' => 'Cikancung'],
            ['kabupaten_id' => 3, 'name' => 'Cilengkrang'],
            ['kabupaten_id' => 3, 'name' => 'Cileunyi'],
            ['kabupaten_id' => 3, 'name' => 'Cimaung'],
            ['kabupaten_id' => 3, 'name' => 'Cimenyan'],
            ['kabupaten_id' => 3, 'name' => 'Ciparay'],
            ['kabupaten_id' => 3, 'name' => 'Ciwidey'],
            ['kabupaten_id' => 3, 'name' => 'Dayeuhkolot'],
            ['kabupaten_id' => 3, 'name' => 'Ibun'],
            ['kabupaten_id' => 3, 'name' => 'Katapang'],
            ['kabupaten_id' => 3, 'name' => 'Kertasari'],
            ['kabupaten_id' => 3, 'name' => 'Kutawaringin'],
            ['kabupaten_id' => 3, 'name' => 'Majalaya'],
            ['kabupaten_id' => 3, 'name' => 'Margaasih'],
            ['kabupaten_id' => 3, 'name' => 'Margahayu'],
            ['kabupaten_id' => 3, 'name' => 'Nagreg'],
            ['kabupaten_id' => 3, 'name' => 'Pacet'],
            ['kabupaten_id' => 3, 'name' => 'Pameungpeuk'],
            ['kabupaten_id' => 3, 'name' => 'Pangalengan'],
            ['kabupaten_id' => 3, 'name' => 'Paseh'],
            ['kabupaten_id' => 3, 'name' => 'Pasirjambu'],
            ['kabupaten_id' => 3, 'name' => 'Rancabali'],
            ['kabupaten_id' => 3, 'name' => 'Rancaekek'],
            ['kabupaten_id' => 3, 'name' => 'Solokanjeruk'],
            ['kabupaten_id' => 3, 'name' => 'Soreang'],

            ['kabupaten_id' => 4, 'name' => 'Batujajar'],
            ['kabupaten_id' => 4, 'name' => 'Cihampelar'],
            ['kabupaten_id' => 4, 'name' => 'Cikalong Wetan'],
            ['kabupaten_id' => 4, 'name' => 'Cililin'],
            ['kabupaten_id' => 4, 'name' => 'Cipatat'],
            ['kabupaten_id' => 4, 'name' => 'Cipeundeuy'],
            ['kabupaten_id' => 4, 'name' => 'Cipongkor'],
            ['kabupaten_id' => 4, 'name' => 'Cisarua'],
            ['kabupaten_id' => 4, 'name' => 'Gununghalu'],
            ['kabupaten_id' => 4, 'name' => 'Lembang'],
            ['kabupaten_id' => 4, 'name' => 'Ngamprah'],
            ['kabupaten_id' => 4, 'name' => 'Padalarang'],
            ['kabupaten_id' => 4, 'name' => 'Parongpong'],
            ['kabupaten_id' => 4, 'name' => 'Rongga'],
            ['kabupaten_id' => 4, 'name' => 'Saguling'],
            ['kabupaten_id' => 4, 'name' => 'Sindangkerta'],

            ['kabupaten_id' => 2, 'name' => 'Bandung Wetan'],

        ]);
    }
}
