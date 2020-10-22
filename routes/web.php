<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnasayfaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SepetController;
use App\Http\Controllers\UrunController;
use App\Http\Controllers\OdemeController;
use App\Http\Controllers\SiparisController;
use App\Http\Controllers\KullaniciController;


Route::group(['prefix' => 'yonetim', 'namespace' => 'Yonetim'], function () {
    Route::redirect('/', '/yonetim/oturumac');

    Route::match(['get', 'post'], '/oturumac', 'KullaniciController@oturumac')->name('yonetim.oturumac');
    Route::get('/oturumukapat', [KategoriController::class, 'oturumukapat'])->name('yonetim.oturumukapat');

    Route::group(['middleware' => 'yonetim'], function () {
        Route::get('/anasayfa', [AnasayfaController::class, 'index'])->name('yonetim.anasayfa');




        Route::group(['prefix' => 'kullanici'], function () {
            Route::match(['get', 'post'], '/', 'KullaniciController@index')->name('yonetim.kullanici');
            Route::get('/yeni', [KullaniciController::class, 'form'])->name('yonetim.kullanici.yeni');
            Route::get('/duzenle/{id}', [KullaniciController::class, 'form'])->name('yonetim.kullanici.duzenle');
            Route::post('/kaydet/{id?}', [KullaniciController::class, 'kaydet'])->name('yonetim.kullanici.kaydet');
            Route::get('/sil/{id}', [KullaniciController::class, 'sil'])->name('yonetim.kullanici.sil');




        });

        Route::group(['prefix' => 'kategori'], function () {

            Route::get('/yeni', [KategoriController::class, 'form'])->name('yonetim.kategori.yeni');
            Route::get('/duzenle/{id}', [KategoriController::class, 'form'])->name('yonetim.kategori.duzenle');
            Route::post('/kaydet/{id?}', [KategoriController::class, 'kaydet'])->name('yonetim.kategori.kaydet');
            Route::get('/sil/{id}', [KategoriController::class, 'sil'])->name('yonetim.kategori.sil');
            Route::match(['get', 'post'], '/', 'KategoriController@index')->name('yonetim.kategori');
        });

        Route::group(['prefix' => 'urun'], function () {

            Route::get('/yeni', [UrunController::class, 'form'])->name('yonetim.urun.yeni');
            Route::get('/duzenle/{id}', [UrunController::class, 'form'])->name('yonetim.urun.duzenle');
            Route::post('/kaydet/{id?}', [UrunController::class, 'kaydet'])->name('yonetim.urun.kaydet');
            Route::get('/sil/{id}', [UrunController::class, 'sil'])->name('yonetim.urun.sil');
            Route::match(['get', 'post'], '/', 'UrunController@index')->name('yonetim.urun');
        });

        Route::group(['prefix' => 'siparis'], function () {

            Route::get('/yeni', [SiparisController::class, 'form'])->name('yonetim.siparis.yeni');
            Route::get('/duzenle/{id}', [SiparisController::class, 'form'])->name('yonetim.siparis.duzenle');
            Route::post('/kaydet/{id?}', [SiparisController::class, 'kaydet'])->name('yonetim.siparis.kaydet');
            Route::get('/sil/{id}', [SiparisController::class, 'sil'])->name('yonetim.siparis.sil');
            Route::match(['get', 'post'], '/', 'SiparisController@index')->name('yonetim.siparis');
        });

    });
});

Route::get('/', [AnasayfaController::class, 'index'])->name('anasayfa');
Route::get('/kategori/{slug_kategoriadi}',[KategoriController::class,'index'])->name('kategori');
Route::get('/urun/{slug_urunadi}',[UrunController::class,'index'])->name('urun');
Route::post('/ara',[UrunController::class,'ara'])->name('urun_ara');
Route::get('/ara',[UrunController::class,'ara'])->name('urun_ara');



Route::group(['prefix' => 'sepet'], function () {

    Route::get('/',[SepetController::class, 'index'])->name('sepet');
    Route::post('/ekle',[SepetController::class,'ekle'])->name('sepet.ekle');
    Route::delete('/kaldir/{rowid}',[SepetController::class,'kaldir'])->name('sepet.kaldir');
    Route::delete('/bosalt',[SepetController::class,'bosalt'])->name('sepet.bosalt');
    Route::patch('/guncelle/{rowid}',[SepetController::class,'guncelle'])->name('sepet.guncelle');

});

Route::get('/odeme',[OdemeController::class,'index'])->name('odeme');
Route::post('/odeme',[OdemeController::class,'odemeyap'])->name('odemeyap');
Route::group(['middleware' => 'auth'],function (){

    Route::get('/siparisler',[SiparisController::class,'index'])->name('siparisler');
    Route::get('/siparisler/{id}',[SiparisController::class,'detay'])->name('siparis');

});

Route::group(['prefix'=>'kullanici'],function(){

    Route::get('/oturumac',[KullaniciController::class,'giris_form'])->name('kullanici.oturumac');
    Route::post('/oturumac',[KullaniciController::class,'giris']);
    Route::get('/kaydol',[KullaniciController::class,'kaydol_form'])->name('kullanici.kaydol');
    Route::post('/kaydol',[KullaniciController::class,'kaydol']);
    Route::get('/aktiflestir/{anahtar}',[KullaniciController::class,'aktiflestir'])->name('aktiflestir');
    Route::post('/oturumukapat',[KullaniciController::class,'oturumukapat'])->name('kullanici.oturumukapat');
});

Route::get('/test/mail', function () {
    $kullanici = \App\Models\Kullanici::find(1);

    return new App\Mail\KullaniciKayitMail($kullanici);
});
