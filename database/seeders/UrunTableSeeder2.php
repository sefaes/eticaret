<?php

namespace Database\Seeders;

use App\Models\Urun;
use App\Models\UrunDetay;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;

class UrunTableSeeder2 extends Seeder
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
        Urun::truncate();
        UrunDetay::truncate();

        for ($i = 0; $i < 30; $i++) {
            $urun_adi = $faker->streetName;
            $urun = Urun::create([
                'urun_adi' => $urun_adi,
                'slug'     => Str::slug($urun_adi),
                'aciklama' => $faker->paragraph(20),
                'fiyati'   => $faker->randomFloat(3, 1, 20)
            ]);

            $detay = $urun->detay()->create([
                'goster_slider'=>rand(0,1),
                'goster_gunun_firsati'=>rand(0,1),
                'goster_one_cikan'=>rand(0,1),
                'goster_cok_satan'=>rand(0,1),
                'goster_indirimli'=>rand(0,1)
            ]);
        }

        DB::table('kategori_urun')->truncate();
        $kategoriler = Kategori::all();
        foreach ($kategoriler as $kategori) {
            $urunler = Urun::pluck('id')->random(10)->all();
            $kategori->urunler()->attach($urunler);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
