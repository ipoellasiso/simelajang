<?php

use App\Http\Controllers\AkunpajakController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BpjsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboarduserController;
use App\Http\Controllers\JenispajakController;
use App\Http\Controllers\LaporanguController;
use App\Http\Controllers\LaporanguuserController;
use App\Http\Controllers\LaporanlsController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\PajakguadminController;
use App\Http\Controllers\PajakguController;
use App\Http\Controllers\PajaklsController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Registersp2dController;
use App\Http\Controllers\TarikdataController;
use App\Http\Controllers\UseradminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasitbpController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', function () {
//     return view('Template.Layout');
// });

Route::get('/login1', [AuthController::class, 'index'])->name('login');
Route::post('/cek_login', [AuthController::class, 'cek_login']);
Route::get('/logout', [AuthController::class, 'logout']);

// ======= DASHBOARD =======
Route::get('/home', [DashboardController::class, 'index']);
Route::get('/homeuser', [DashboarduserController::class, 'index']);
Route::get('/profil', [ProfilController::class, 'index']);

// ======= DATA OPD =======
Route::get('/tampilopd', [OpdController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/opd/store', [OpdController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/opd/edit/{id}', [OpdController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/opd/destroy/{id}', [OpdController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');

// ======= DATA Jenis Pajak =======
Route::get('/tampiljenispajak', [JenispajakController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/jenispajak/store', [JenispajakController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/jenispajak/edit/{id}', [JenispajakController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/jenispajak/destroy/{id}', [JenispajakController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');

// ======= DATA Akun Pajak =======
Route::get('/tampilakunpajak', [AkunpajakController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/akunpajak/store', [AkunpajakController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/akunpajak/edit/{id}', [AkunpajakController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::delete('/akunpajak/destroy/{id}', [AkunpajakController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');

// ======= DATA USER =======
Route::get('/tampiluseradmin', [UseradminController::class, 'index'])->middleware('auth:web','checkRole:Admin,User');
Route::get('/tampiluser', [UserController::class, 'index'])->middleware('auth:web','checkRole:Admin,User');
Route::post('/user/store', [UserController::class, 'store'])->middleware('auth:web','checkRole:Admin,User');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->middleware('auth:web','checkRole:Admin,User');
Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->middleware('auth:web','checkRole:Admin,User');
Route::post('/user/aktif/{id}', [UserController::class, 'aktif'])->middleware('auth:web','checkRole:Admin,User');
Route::post('/user/nonaktif/{id}', [UserController::class, 'nonaktif'])->middleware('auth:web','checkRole:Admin,User');
Route::get('/user/opd', [UserController::class, 'getDataopd'])->middleware('auth:web','checkRole:Admin,User');

// ======= DATA TARIK PAJAK SIPD RI =======
Route::get('/tarikpajaksipdri', [TarikdataController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::get('/tarikpajaksipdrigu', [TarikdataController::class, 'indexgu'])->middleware('auth:web','checkRole:Admin');

Route::post('/simpanjson', [TarikdataController::class, 'save_json'])->middleware('auth:web','checkRole:Admin');
Route::post('/simpanjsongu', [TarikdataController::class, 'save_jsongu'])->middleware('auth:web','checkRole:Admin');
Route::post('/simpanjsontbp', [TarikdataController::class, 'save_jsontbp'])->middleware('auth:web','checkRole:User');

// ======= DATA VERIFIKASI TBP =======
Route::get('/tampilveriftbp', [VerifikasitbpController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::get('/tampilveriftbpnew', [VerifikasitbpController::class, 'indexnew'])->middleware('auth:web','checkRole:Admin');
Route::get('/verifikasitbp/tolak/{id}', [VerifikasitbpController::class, 'tolaktbp'])->middleware('auth:web','checkRole:Admin');
Route::post('/verifikasitbp/tolakupdate/{id}', [VerifikasitbpController::class, 'tolaktbpupdate'])->middleware('auth:web','checkRole:Admin');
Route::get('/verifikasitbp/terima/{id}', [VerifikasitbpController::class, 'terimatbp'])->middleware('auth:web','checkRole:Admin');
Route::post('/verifikasitbp/terimaupdate/{id}', [VerifikasitbpController::class, 'terimatbpupdate'])->middleware('auth:web','checkRole:Admin');

// ======= DATA PENGAJUAN TBP =======
Route::get('/tariktbp/tolak/{id}', [TarikdataController::class, 'tariktolaktbp'])->middleware('auth:web','checkRole:User');
Route::post('/tariktbp/tolakupdate/{id}', [TarikdataController::class, 'tariktolaktbpupdate'])->middleware('auth:web','checkRole:User');
Route::get('/tariktbp/terima/{id}', [TarikdataController::class, 'tarikterimatbp'])->middleware('auth:web','checkRole:User');
Route::post('/tariktbp/terimaupdate/{id}', [TarikdataController::class, 'tarikterimatbpupdate'])->middleware('auth:web','checkRole:User');
Route::get('/tariktbp/akun_pajak', [TarikdataController::class, 'getDataakunpajak'])->middleware('auth:web','checkRole:User');
Route::get('/tarikpajaksipdritbp', [TarikdataController::class, 'indextbp'])->middleware('auth:web','checkRole:User');
Route::get('/tarikpajaksipdritbptolak', [TarikdataController::class, 'indextbptolak'])->middleware('auth:web','checkRole:User');
Route::get('/tarikpajaksipdritbpbelumverifikasi', [TarikdataController::class, 'indextbpbelumverifikasi'])->middleware('auth:web','checkRole:User');
Route::delete('/tariktbp/destroy/{id}', [TarikdataController::class, 'destroy'])->middleware('auth:web','checkRole:User');
Route::get('/tarikpajaksipdritbplist', [TarikdataController::class, 'indextbplist'])->middleware('auth:web','checkRole:User');
Route::delete('/tariktbp/destroylist/{id}', [TarikdataController::class, 'destroylist'])->middleware('auth:web','checkRole:User');
Route::post('/tariktbp/ubahstatusupdate/{id}', [TarikdataController::class, 'ubahstatustbpupdate'])->middleware('auth:web','checkRole:User');
Route::get('/tariktbp/ubahstatus/{id}', [TarikdataController::class, 'ubahstatustbp'])->middleware('auth:web','checkRole:User');
Route::post('/tariktbp/status4/{id}', [TarikdataController::class, 'indexstatus4'])->middleware('auth:web','checkRole:User');

// ======= DATA PAJAKLS =======
Route::get('/tampilpajakls', [PajaklsController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::post('/pajakls1/store', [PajaklsController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/pajakls1/edit/{id}', [PajaklsController::class, 'edit'])->middleware('auth:web','checkRole:Admin');
Route::post('/pajakls1/update/{id}', [PajaklsController::class, 'update'])->middleware('auth:web','checkRole:Admin');
Route::delete('/pajakls1/destroy/{id}', [PajaklsController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');
Route::post('/pajakls1/terima/{id}', [PajaklsController::class, 'terima'])->middleware('auth:web','checkRole:Admin');
Route::post('/pajakls1/tolak/{id}', [PajaklsController::class, 'tolak'])->middleware('auth:web','checkRole:Admin');
Route::get('/tampilpajaklssipd1', [PajaklsController::class, 'pilihpajaklssipd'])->middleware('auth:web','checkRole:Admin');
Route::get('/pajaklssipd1/edit/{id}', [PajaklsController::class, 'editpajaklssipd'])->middleware('auth:web','checkRole:Admin');
Route::get('/pajakls1/akunpajak', [PajaklsController::class, 'getDataakunpajak'])->middleware('auth:web','checkRole:Admin');
Route::get('/pajakls1/jenispajak', [PajaklsController::class, 'getDatajenispajak'])->middleware('auth:web','checkRole:Admin');
Route::get('/pajakls1/tolakls/{id}', [PajaklsController::class, 'tolakls'])->middleware('auth:web','checkRole:Admin');
Route::post('/pajakls1/tolaklsupdate/{id}', [PajaklsController::class, 'tolaklsupdate'])->middleware('auth:web','checkRole:Admin');
Route::get('/pajakls1/terimals/{id}', [PajaklsController::class, 'terimals'])->middleware('auth:web','checkRole:Admin');
Route::post('/pajakls1/terimalsupdate/{id}', [PajaklsController::class, 'terimalsupdate'])->middleware('auth:web','checkRole:Admin');
Route::get('/pajakls1/lihat/{id}', [PajaklsController::class, 'lihat'])->middleware('auth:web','checkRole:Admin');
Route::get('/pajakls1/totalnilai', [PajaklsController::class, 'totalpajakls'])->middleware('auth:web','checkRole:Admin');

// ======= DATA PAJAKGU =======
Route::get('/tampilpajakgu', [PajakguController::class, 'index'])->middleware('auth:web','checkRole:User,Admin');
Route::post('/pajakgu/store', [PajakguController::class, 'store'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/edit/{id}', [PajakguController::class, 'edit'])->middleware('auth:web','checkRole:User,Admin');
Route::post('/pajakgu/update/{id}', [PajakguController::class, 'update'])->middleware('auth:web','checkRole:User,Admin');
Route::delete('/pajakgu/destroy/{id}', [PajakguController::class, 'destroy'])->middleware('auth:web','checkRole:User,Admin');
Route::post('/pajakgu/terima/{id}', [PajakguController::class, 'terima'])->middleware('auth:web','checkRole:User,Admin');
Route::post('/pajakgu/tolak/{id}', [PajakguController::class, 'tolak'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/tampilspmsp2dgusipd', [PajakguController::class, 'pilihspmsp2dgusipd'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgusipd/edit/{id}', [PajakguController::class, 'editpajakgusipd'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/akunpajak', [PajakguController::class, 'getDataakunpajak'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/jenispajak', [PajakguController::class, 'getDatajenispajak'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/tolakgu/{id}', [PajakguController::class, 'tolakgu'])->middleware('auth:web','checkRole:User,Admin');
Route::post('/pajakgu/tolakguupdate/{id}', [PajakguController::class, 'tolakguupdate'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/terimagu/{id}', [PajakguController::class, 'terimagu'])->middleware('auth:web','checkRole:User,Admin');
Route::post('/pajakgu/terimaguupdate/{id}', [PajakguController::class, 'terimaguupdate'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/lihat/{id}', [PajakguController::class, 'lihat'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/totalnilai', [PajakguController::class, 'totalpajakgu'])->middleware('auth:web','checkRole:User,Admin');

// ======= DATA PAJAKLS =======
Route::get('/tampilbpjs', [BpjsController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::get('/tampilbpjssipd', [BpjsController::class, 'pilihbpjssipd'])->middleware('auth:web','checkRole:Admin');
Route::get('/tampilbpjssipdedit', [BpjsController::class, 'pilihbpjssipdedit'])->middleware('auth:web','checkRole:Admin');
Route::post('/dtbpjs/store', [BpjsController::class, 'store'])->middleware('auth:web','checkRole:Admin');
Route::get('/dtbpjs/detail/{id}', [BpjsController::class, 'detail'])->middleware('auth','checkRole:Admin');
Route::get('/dtbpjs/cetak/{id}', [BpjsController::class, 'cetak'])->middleware('auth','checkRole:Admin');
Route::get('/dtbpjs/edit/{id}', [BpjsController::class, 'edit'])->middleware('auth','checkRole:Admin');
Route::get('/dtbpjs/destroyDetail/{id}', [BpjsController::class, 'destroyDetail'])->middleware('auth:web','checkRole:Admin');
Route::delete('/dtbpjs/destroy/{id}', [BpjsController::class, 'destroy'])->middleware('auth:web','checkRole:Admin');
Route::post('/dtbpjs/update/{id}', [BpjsController::class, 'update'])->middleware('auth:web','checkRole:Admin');

Route::get('/dtbpjs/load_cart', [BpjsController::class, 'load_cart'])->middleware('auth','checkRole:Admin');
// Route::post('/barangmasuk/addToCart/{id}', [BpjsController::class, 'addToCart'])->middleware('auth','checkRole:Admin');
// Route::get('/dtbpjs/load_cart', [BpjsController::class, 'load_cart'])->middleware('auth:web','checkRole:Admin');
Route::post('/dtbpjs/addToCart', [BpjsController::class, 'addToCart'])->middleware('auth:web','checkRole:Admin');
Route::post('/dtbpjs/deleteCart/{id}', [BpjsController::class, 'deleteCart'])->middleware('auth:web','checkRole:Admin');
Route::get('/dtbpjs/editpotcart/{id}', [BpjsController::class, 'editpotcartsipd'])->middleware('auth:web','checkRole:Admin');

Route::get('/dtbpjs/ubah/{id}', [BpjsController::class, 'ubahbpjs'])->middleware('auth:web','checkRole:Admin');
Route::get('/dtbpjs/tolakbpjs/{id}', [BpjsController::class, 'tolakbpjs'])->middleware('auth:web','checkRole:Admin');
Route::post('/dtbpjs/tolakbpjsupdate/{id}', [BpjsController::class, 'tolakbpjsupdate'])->middleware('auth:web','checkRole:Admin');
Route::get('/dtbpjs/terimabpjs/{id}', [BpjsController::class, 'terimabpjs'])->middleware('auth:web','checkRole:Admin');
Route::post('/dtbpjs/terimabpjsupdate/{id}', [BpjsController::class, 'terimabpjsupdate'])->middleware('auth:web','checkRole:Admin');

// ======= REGISTER SP2D =======
Route::get('/tampilregsp2d', [Registersp2dController::class, 'index'])->middleware('auth:web','checkRole:Admin');
Route::get('/tampilregsp2d', [Registersp2dController::class, 'index'])->middleware('auth:web','checkRole:Admin');

// ======= DATA PAJAKGU ADMIN =======
Route::get('/tampilpajakguadmin', [PajakguadminController::class, 'index'])->middleware('auth:web','checkRole:User,Admin');
// Route::get('/pilihspmsp2dgusipd', [PajakguadminController::class, 'pilihspmsp2dgusipd'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/tampilpajakguadminbeluminput', [PajakguadminController::class, 'tampilpajakgusipdbeluminput'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/tampilpajaklsadminbeluminput', [PajaklsController::class, 'tampilpajaklssipdbeluminput'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/tampilpajakgubeluminput', [PajakguController::class, 'pajakgubeluminput'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/tolakguadmin/{id}', [PajakguadminController::class, 'tolakguadmin'])->middleware('auth:web','checkRole:User,Admin');
Route::post('/pajakgu/tolakguupdateadmin/{id}', [PajakguadminController::class, 'tolakguupdateadmin'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/terimaguadmin/{id}', [PajakguadminController::class, 'terimaguadmin'])->middleware('auth:web','checkRole:User,Admin');
Route::post('/pajakgu/terimaguupdateadmin/{id}', [PajakguadminController::class, 'terimaguupdateadmin'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/pajakgu/editadmin/{id}', [PajakguadminController::class, 'editadmin'])->middleware('auth:web','checkRole:User,Admin');
Route::post('/pajakgu/updateadmin/{id}', [PajakguadminController::class, 'updateadmin'])->middleware('auth:web','checkRole:User,Admin');
Route::delete('/pajakgu/destroyadmin/{id}', [PajakguadminController::class, 'destroyadmin'])->middleware('auth:web','checkRole:User,Admin');

// ======= Export Data  Pajakls =======
Route::get('/datapajak/export', [PajaklsController::class, 'export'])->middleware('auth:web','checkRole:User,Admin');
Route::get('/datapajak/exportbeluminput', [PajaklsController::class, 'exportlsbeluminput'])->middleware('auth:web','checkRole:User,Admin');

// ======= Export Data  Pajakgu =======
Route::get('/datapajakgu/export', [PajakguadminController::class, 'export'])->middleware('auth:web','checkRole:User,Admin');

//======== Laporan LS =========
// Route::get('/tampillaporanls', [LaporanlsController::class, 'index'])->middleware('auth:web','checkRole:Admin');
// Route::get('/cetaklaporanls', [LaporanlsController::class, 'laporanls'])->name('cetaklaporanls')->middleware('auth:web','checkRole:Admin');

Route::get('/tampilindekslaporanls', [LaporanlsController::class, 'index'])->name('laporan.pajakls.index')->middleware('auth:web','checkRole:Admin');
Route::get('/tampilindekslaporanls/{id}/tampilawal', [LaporanlsController::class, 'laporanls'])->name('laporan.laporanls.tampil')->middleware('auth:web','checkRole:Admin');
Route::get('/tampilindekslaporanls/{id}/tampil', [LaporanlsController::class, 'laporanls'])->name('laporan.laporanls.tampil')->middleware('auth:web','checkRole:Admin');
Route::get('/laporanpajakls/opd', [LaporanlsController::class, 'getDataopd'])->middleware('auth:web','checkRole:Admin');
Route::get('/laporanpajakls-cetak', [LaporanlsController::class, 'cetak'])->name('laporanpajakls-cetak')->middleware('auth:web','checkRole:Admin');
Route::get('/laporanpajaklsrekap-cetak', [LaporanlsController::class, 'cetakrekapls'])->name('laporanpajaklsrekap-cetak')->middleware('auth:web','checkRole:Admin');

Route::get('/downloadlaporanexcel', [LaporanlsController::class, 'Exportexcells'])->name('laporan.downloadlaporanexcel')->middleware('auth:web','checkRole:Admin');
// Route::get('/downloadlaporanexcel2', [LaporanlsController::class, 'Exportexcellsbeluminput'])->name('laporan.downloadlaporanexcel2')->middleware('auth:web','checkRole:Admin');

// Laporan Ls Rekap 
Route::get('/tampilindekslaporanls/{id}/tampilawalrekap', [LaporanlsController::class, 'laporanlsrekap'])->name('laporan.laporanlsrekap.tampilrekap')->middleware('auth:web','checkRole:Admin');
Route::get('/tampilindekslaporanls/{id}/tampilrekap', [LaporanlsController::class, 'laporanlsrekap'])->name('laporan.laporanlsrekap.tampilrekap')->middleware('auth:web','checkRole:Admin');

//======== Laporan GU =========
Route::get('/tampilindekslaporangu', [LaporanguController::class, 'index'])->name('laporan.pajakgu.index')->middleware('auth:web','checkRole:Admin');
Route::get('/tampilindekslaporangu/{id}/tampilawal', [LaporanguController::class, 'laporangu'])->name('laporan.laporangu.tampil')->middleware('auth:web','checkRole:Admin');
Route::get('/tampilindekslaporangu/{id}/tampil', [LaporanguController::class, 'laporangu'])->name('laporan.laporangu.tampil')->middleware('auth:web','checkRole:Admin');
Route::get('/laporanpajakgu/opd', [LaporanguController::class, 'getDataopd'])->middleware('auth:web','checkRole:Admin');
Route::get('/laporanpajakgu-cetak', [LaporanguController::class, 'cetak'])->name('laporanpajakgu-cetak')->middleware('auth:web','checkRole:Admin');
Route::get('/laporanpajakgurekap-cetak', [LaporanguController::class, 'cetakrekapgu'])->name('laporanpajakgurekap-cetak')->middleware('auth:web','checkRole:Admin');

Route::get('/downloadlaporanexcel', [LaporanguController::class, 'Exportexcelgu'])->name('laporan.downloadlaporanexcel')->middleware('auth:web','checkRole:Admin');

// Laporan GU Rekap 
Route::get('/tampilindekslaporangu/{id}/tampilawalrekap', [LaporanguController::class, 'laporangurekap'])->name('laporan.laporangurekapu.tampilrekap')->middleware('auth:web','checkRole:Admin');
Route::get('/tampilindekslaporangu/{id}/tampilrekap', [LaporanguController::class, 'laporangurekap'])->name('laporan.laporangurekap.tampilrekap')->middleware('auth:web','checkRole:Admin');

Route::get('/tampilindekslaporangu/{id}/tampilawalrekapsemuaopd', [LaporanguController::class, 'laporangurekapsemuaopd'])->name('laporan.laporangurekapsemuaopd.tampilrekap')->middleware('auth:web','checkRole:Admin');
Route::get('/tampilindekslaporangu/{id}/tampilrekapsemuaopd', [LaporanguController::class, 'laporangurekapsemuaopd'])->name('laporan.laporangurekapsemuaopd.tampilrekap')->middleware('auth:web','checkRole:Admin');
Route::get('/laporanpajakgurekapsemuaopd-cetak', [LaporanguController::class, 'cetakrekapgusemuaopd'])->name('laporanpajakgurekapsemuaopd-cetak')->middleware('auth:web','checkRole:Admin');



//======== Laporan GU User =========
Route::get('/tampilindekslaporanguuser', [LaporanguuserController::class, 'index'])->name('laporan.pajakguuser.index')->middleware('auth:web','checkRole:User');
Route::get('/tampilindekslaporanguuser/{id}/tampilawaluser', [LaporanguuserController::class, 'laporangu'])->name('laporan.laporanguuser.tampil')->middleware('auth:web','checkRole:User');
Route::get('/tampilindekslaporanguuser/{id}/tampiluser', [LaporanguuserController::class, 'laporangu'])->name('laporan.laporanguuser.tampil')->middleware('auth:web','checkRole:User');
Route::get('/laporanpajakguuser/opd', [LaporanguuserController::class, 'getDataopd'])->middleware('auth:web','checkRole:User');
Route::get('/laporanpajakguuser-cetak', [LaporanguuserController::class, 'cetak'])->name('laporanpajakguuser-cetak')->middleware('auth:web','checkRole:User');
Route::get('/laporanpajakgurekapuser-cetak', [LaporanguuserController::class, 'cetakrekapgu'])->name('laporanpajakgurekapuser-cetak')->middleware('auth:web','checkRole:User');

Route::get('/downloadlaporanexceluser', [LaporanguuserController::class, 'Exportexcelgu'])->name('laporan.downloadlaporanexceluser')->middleware('auth:web','checkRole:User');

// Laporan GU User Rekap 
Route::get('/tampilindekslaporanguuser/{id}/tampilawalrekapuser', [LaporanguuserController::class, 'laporangurekap'])->name('laporan.laporangurekapuser.tampilrekap')->middleware('auth:web','checkRole:User');
Route::get('/tampilindekslaporanguuser/{id}/tampilrekapuser', [LaporanguuserController::class, 'laporangurekap'])->name('laporan.laporangurekapuser.tampilrekap')->middleware('auth:web','checkRole:User');

Route::get('/tampilindekslaporanguuser/{id}/tampilawalrekapsemuaopduser', [LaporanguuserController::class, 'laporangurekapsemuaopd'])->name('laporan.laporangurekapsemuaopduser.tampilrekap')->middleware('auth:web','checkRole:User');
Route::get('/tampilindekslaporanguuser/{id}/tampilrekapsemuaopduser', [LaporanguuserController::class, 'laporangurekapsemuaopd'])->name('laporan.laporangurekapsemuaopduser.tampilrekap')->middleware('auth:web','checkRole:User');
Route::get('/laporanpajakgurekapsemuaopduser-cetak', [LaporanguuserController::class, 'cetakrekapgusemuaopd'])->name('laporanpajakgurekapsemuaopduser-cetak')->middleware('auth:web','checkRole:User');