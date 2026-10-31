<?php

use Illuminate\Support\Facades\Route;

// AUTH & NAVIGASI
Route::get('/', 'App\Http\Controllers\lapfut@index');
Route::get('/login', 'App\Http\Controllers\lapfut@formLogin');                                                                  
Route::post('/login', 'App\Http\Controllers\lapfut@aksilogin');
Route::get('/home', 'App\Http\Controllers\lapfut@home');
Route::get('/logout', 'App\Http\Controllers\lapfut@logout');
Route::get('/register', 'App\Http\Controllers\lapfut@register');
Route::post('/register', 'App\Http\Controllers\lapfut@aksiRegister');

// 1. DATA JABATAN
Route::get('/jabatans', 'App\Http\Controllers\lapfut@jabatans');
Route::post('/jabatans/tambah', 'App\Http\Controllers\lapfut@jabatansTambah');
Route::get('/jabatans/hapus/{id}', 'App\Http\Controllers\lapfut@jabatansHapus');

// 2. DATA USERS
Route::get('/users', 'App\Http\Controllers\lapfut@users');
Route::post('/users/tambah', 'App\Http\Controllers\lapfut@usersTambah');
Route::get('/users/hapus/{id}', 'App\Http\Controllers\lapfut@usersHapus');
Route::get('/users/edit/{id}', 'App\Http\Controllers\lapfut@usersEdit');
Route::match(['get', 'post'], '/users/update/{id}', [lapfut::class, 'usersUpdate'])->name('users.update');
// 3. DATA LAPANGAN
Route::get('/fields', 'App\Http\Controllers\lapfut@fields');
Route::post('/fields/tambah', 'App\Http\Controllers\lapfut@fieldsTambah');
Route::get('/fields/hapus/{id}', 'App\Http\Controllers\lapfut@fieldsHapus');
// Route khusus menu Lapangan
Route::get('/fields', 'App\Http\Controllers\lapfut@fields');
Route::get('/fields/tambah-form', 'App\Http\Controllers\lapfut@fieldsFormTambah'); // Membuka view form
Route::post('/fields/tambah', 'App\Http\Controllers\lapfut@fieldsTambah');         // Proses simpan data
Route::get('/fields/hapus/{id}', 'App\Http\Controllers\lapfut@fieldsHapus');

// 4. DATA HARGA LAPANGAN
Route::get('/field-prices', 'App\Http\Controllers\lapfut@fieldPrices');
Route::post('/field-prices/tambah', 'App\Http\Controllers\lapfut@fieldPricesTambah');
Route::get('/field-prices/hapus/{id}', 'App\Http\Controllers\lapfut@fieldPricesHapus');

// 5. DATA PEMESANAN (BOOKING)
Route::get('/bookings', 'App\Http\Controllers\lapfut@bookings');
Route::post('/bookings/tambah', 'App\Http\Controllers\lapfut@bookingsTambah');
Route::get('/bookings/hapus/{id}', 'App\Http\Controllers\lapfut@bookingsHapus');

// 6. DATA PEMBAYARAN
Route::get('/payments', 'App\Http\Controllers\lapfut@payments');
Route::post('/payments/tambah', 'App\Http\Controllers\lapfut@paymentsTambah');
Route::get('/payments/hapus/{id}', 'App\Http\Controllers\lapfut@paymentsHapus');

// 7. DATA SEWA ALAT
Route::get('/equipments', 'App\Http\Controllers\lapfut@equipments');
Route::post('/equipments/tambah', 'App\Http\Controllers\lapfut@equipmentsTambah');
Route::get('/equipments/hapus/{id}', 'App\Http\Controllers\lapfut@equipmentsHapus');

// JABATAN
Route::get('/jabatans', 'App\Http\Controllers\lapfut@jabatans');
Route::get('/jabatans/tambah-form', 'App\Http\Controllers\lapfut@jabatansFormTambah');
Route::post('/jabatans/tambah', 'App\Http\Controllers\lapfut@jabatansTambah');
Route::get('/jabatans/hapus/{id}', 'App\Http\Controllers\lapfut@jabatansHapus');

// USERS
Route::get('/users', 'App\Http\Controllers\lapfut@users');
Route::get('/users/tambah-form', 'App\Http\Controllers\lapfut@usersFormTambah');
Route::post('/users/tambah', 'App\Http\Controllers\lapfut@usersTambah');
Route::get('/users/hapus/{id}', 'App\Http\Controllers\lapfut@usersHapus');
Route::put('/users/update/{id}', 'App\Http\Controllers\lapfut@usersUpdate'); // Route untuk memproses update data user 

// FIELD PRICES (HARGA)
Route::get('/field-prices', 'App\Http\Controllers\lapfut@fieldPrices');
Route::get('/field-prices/tambah-form', 'App\Http\Controllers\lapfut@fieldPricesFormTambah');
Route::post('/field-prices/tambah', 'App\Http\Controllers\lapfut@fieldPricesTambah');
Route::get('/field-prices/hapus/{id}', 'App\Http\Controllers\lapfut@fieldPricesHapus');

// BOOKINGS (PEMESANAN)
Route::get('/bookings', 'App\Http\Controllers\lapfut@bookings');
Route::get('/bookings/tambah-form', 'App\Http\Controllers\lapfut@bookingsFormTambah');
Route::post('/bookings/tambah', 'App\Http\Controllers\lapfut@bookingsTambah');
Route::get('/bookings/hapus/{id}', 'App\Http\Controllers\lapfut@bookingsHapus');

// PAYMENTS (PEMBAYARAN)
Route::get('/payments', 'App\Http\Controllers\lapfut@payments');
Route::get('/payments/tambah-form', 'App\Http\Controllers\lapfut@paymentsFormTambah');
Route::post('/payments/tambah', 'App\Http\Controllers\lapfut@paymentsTambah');
Route::get('/payments/hapus/{id}', 'App\Http\Controllers\lapfut@paymentsHapus');

// EQUIPMENTS (SEWA ALAT)
Route::get('/equipments', 'App\Http\Controllers\lapfut@equipments');
Route::get('/equipments/tambah-form', 'App\Http\Controllers\lapfut@equipmentsFormTambah');
Route::post('/equipments/tambah', 'App\Http\Controllers\lapfut@equipmentsTambah');
Route::get('/equipments/hapus/{id}', 'App\Http\Controllers\lapfut@equipmentsHapus');