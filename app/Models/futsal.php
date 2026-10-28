<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class futsal
{
    // --- AUTH ---
    public function cekLogin($inputLogin)
    {
        return DB::table('users')
            ->where(function($query) use ($inputLogin) {
                $query->where('nama', $inputLogin)
                      ->orWhere('email', $inputLogin);
            })
            ->first();
    }

    public function getAllJabatan() { return DB::table('jabatans')->get(); }
    public function insertJabatan($data) { return DB::table('jabatans')->insert($data); }
    public function deleteJabatan($id) { return DB::table('jabatans')->where('id', $id)->delete(); }

    public function getAllUsers()
    {
        return DB::table('users')
            ->join('jabatans', 'users.id_jabatan', '=', 'jabatans.id')
            ->select('users.*', 'jabatans.nama_jabatan')
            ->get();
    }
    public function insertUser($data) { return DB::table('users')->insert($data); }
    public function deleteUser($id) { return DB::table('users')->where('id', $id)->delete(); }

    public function getAllFields() { return DB::table('fields')->get(); }
    public function insertField($data) { return DB::table('fields')->insert($data); }
    public function deleteField($id) { return DB::table('fields')->where('id', $id)->delete(); }


    public function insertPrice($data)
    {
        return DB::table('field_prices')->insert([
            'id_field'      => $data['field_id'],
            'jenis_hari'    => $data['jenis_hari'],
            'jam_mulai'     => $data['jam_mulai'],
            'jam_selesai'   => $data['jam_selesai'],
            'harga_per_jam' => $data['harga_per_jam']
        ]);
    }
    public function deletePrice($id) { return DB::table('field_prices')->where('id', $id)->delete(); }

    public function getAllBookings()
    {
        return DB::table('bookings')
            ->join('users', 'bookings.id_users', '=', 'users.id')
            ->join('fields', 'bookings.id_field', '=', 'fields.id')
            ->select('bookings.*', 'users.nama', 'fields.nama_lapangan')
            ->get();
    }

    public function getBookingById($id)
    {
        return DB::table('bookings')
            ->join('users', 'bookings.id_users', '=', 'users.id')
            ->join('fields', 'bookings.id_field', '=', 'fields.id')
            ->select('bookings.*', 'users.nama', 'fields.nama_lapangan')
            ->where('bookings.id', $id)
            ->first();
    }    
    public function insertBooking($data) { return DB::table('bookings')->insert($data); }
    public function deleteBooking($id) { return DB::table('bookings')->where('id', $id)->delete(); }
    

    public function getAllPayments()
    {
        return DB::table('payments')
            ->join('bookings', 'payments.id_booking', '=', 'bookings.id')
            ->select('payments.*', 'bookings.kode_booking')
            ->get();
    }

    public function insertPayment($data) 
    { 
        // Dipetakan otomatis dari booking_id (dari form) ke id_booking (di database Navicat)
        return DB::table('payments')->insert([
            'id_booking'       => $data['booking_id'] ?? $data['id_booking'] ?? null,
            'metode_pembayaran'=> $data['metode_pembayaran'] ?? null,
            'jenis_pembayaran' => $data['jenis_pembayaran'] ?? null,
            'jumlah_bayar'     => $data['jumlah_bayar'] ?? null,
            'status'           => $data['status'] ?? null,
            'bukti_transfer'   => $data['bukti_transfer'] ?? null,
        ]); 
    }

    public function deletePayment($id) { return DB::table('payments')->where('id', $id)->delete(); }

    public function getAllEquipments() { return DB::table('equipments')->get(); }
    public function insertEquipment($data) { return DB::table('equipments')->insert($data); }
    public function deleteEquipment($id) { return DB::table('equipments')->where('id', $id)->delete(); }
    
    public function getAllPrices()
    {
        return DB::table('field_prices')
            ->join('fields', 'field_prices.id_field', '=', 'fields.id')
            ->select('field_prices.*', 'fields.nama_lapangan')
            ->get();
    }
}