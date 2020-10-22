<?php

namespace Database\Seeders;

use App\Models\Kullanici;
use App\Models\KullaniciDetay;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KullaniciTableSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $faker= Factory::create();
        Kullanici::truncate();
        KullaniciDetay::truncate();

        $kullanici_yonetici = Kullanici::create([
            'adsoyad'     => 'Cem Gündüzoğlu',
            'email'       => 'cem@eticaret.test',
            'sifre'       => bcrypt('123456'),
            'aktif_mi'    => 1,
            'yonetici_mi' => 1
        ]);
        $kullanici_yonetici->detay()->create([
            'adres'       => 'Ankara',
            'telefon'     => '(312) 444 55 66',
            'ceptelefonu' => '(555) 444 55 66'
        ]);

        for ($i = 0; $i < 50; $i++) {
            $kullanici_musteri = Kullanici::create([
                'adsoyad'     => $faker->name,
                'email'       => $faker->unique()->safeEmail,
                'sifre'       => bcrypt('123456'),
                'aktif_mi'    => 1,
                'yonetici_mi' => 0
            ]);

            $kullanici_musteri->detay()->create([
                'adres'       => $faker->address,
                'telefon'     => $faker->e164PhoneNumber,
                'ceptelefonu' => $faker->e164PhoneNumber
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
