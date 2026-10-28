<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\futsal; 
use Elibyy\TCPDF\Facades\TCPDF;
use Maatwebsite\Excel\Facades\Excel;

class lapfut extends Controller
{
    protected $futsalModel;

    public function __construct()
    {
        $this->futsalModel = new futsal(); 
    }

    public function index()
     { return view("login"); }
     public function formLogin()
    {
    return view('login');
    }

    public function aksilogin(Request $request)
    {
        $user = $this->futsalModel->cekLogin($request->input('username'));

        if ($user && $user->password_hash == $request->input('password')) {
            session([
                'u'          => $user->nama, 
                'id_user'    => $user->id,
                'id_jabatan' => $user->id_jabatan
            ]);
            return redirect('/home');
        }
        return redirect('/')->with('error', 'Username/Email atau Password salah!');
    }

    public function home() { return session('u') ? view('home') : redirect('/'); }
    public function logout() { session()->flush(); return redirect('/'); }
    public function register() { return view('register'); }

    public function aksiRegister(Request $request)
    {
        $this->futsalModel->insertUser([
            'id_jabatan'    => 3,
            'nama'          => $request->input('nama'),
            'email'         => $request->input('email'),
            'no_hp'         => $request->input('no_hp'),
            'password_hash' => $request->input('password'),
        ]);
        return redirect('/')->with('success', 'Registrasi berhasil, silakan login!');
    }

    // --- JABATAN ---
    public function jabatans()
    {
        $data = $this->futsalModel->getAllJabatan();
        return view('jabatans', compact('data'));
    }
    public function jabatansTambah(Request $request)
    {
        $this->futsalModel->insertJabatan(['nama_jabatan' => $request->nama_jabatan, 'deskripsi' => $request->deskripsi]);
        return redirect('/jabatans');
    }
    public function jabatansHapus($id) { $this->futsalModel->deleteJabatan($id); return redirect('/jabatans'); }

    // --- USERS ---
    public function users()
    {
        $data = $this->futsalModel->getAllUsers();
        $jabatans = $this->futsalModel->getAllJabatan();
        return view('users', compact('data', 'jabatans'));
    }
    public function usersTambah(Request $request)
    {
        $this->futsalModel->insertUser([
            'id_jabatan' => $request->id_jabatan, 'nama' => $request->nama,
            'email' => $request->email, 'no_hp' => $request->no_hp, 'password_hash' => $request->password
        ]);
        return redirect('/users');
    }
    public function usersHapus($id) { $this->futsalModel->deleteUser($id); return redirect('/users'); }

    // --- FIELDS ---
    public function fields()
    {
        $data = $this->futsalModel->getAllFields();
        return view('fields', compact('data'));
    }
    public function fieldsTambah(Request $request)
    {
        $this->futsalModel->insertField(['nama_lapangan' => $request->nama_lapangan, 'jenis_lantai' => $request->jenis_lantai, 'deskripsi' => $request->deskripsi]);
        return redirect('/fields');
    }
    public function fieldsHapus($id) { $this->futsalModel->deleteField($id); return redirect('/fields'); }

    // --- FIELD PRICES ---
    public function fieldPrices()
    {
        $data = $this->futsalModel->getAllPrices();
        $fields = $this->futsalModel->getAllFields();
        return view('fields_prices', compact('data', 'fields')); 
    }
    // Menampilkan halaman/view form tambah lapangan
    public function fieldsFormTambah()
    {
        $fields = $this->futsalModel->getAllFields(); // Ambil data lapangan
        return view('tambah_fields', compact('fields')); // Kirim ke view
    }
    public function fieldPricesTambah(Request $request)
    {
        $this->futsalModel->insertPrice([
            'field_id' => $request->field_id, 'jenis_hari' => $request->jenis_hari,
            'jam_mulai' => $request->jam_mulai, 'jam_selesai' => $request->jam_selesai, 'harga_per_jam' => $request->harga_per_jam
        ]);
        return redirect('/field-prices');
    }
    public function fieldPricesHapus($id) { $this->futsalModel->deletePrice($id); return redirect('/field-prices'); }

    // --- BOOKINGS ---
    public function bookings()
    {
        $data = $this->futsalModel->getAllBookings();
        $users = $this->futsalModel->getAllUsers();
        $fields = $this->futsalModel->getAllFields();
        return view('bookings', compact('data', 'users', 'fields'));
    }

    public function bookingsTambah(Request $request)
    {
        // Disesuaikan menjadi id_users dan id_field agar sinkron dengan tabel database
        $this->futsalModel->insertBooking([
            'kode_booking' => 'BOOK-' . time(), 
            'id_users'     => $request->user_id,
            'id_field'     => $request->field_id, 
            'tgl_main'     => $request->tgl_main,
            'jam_mulai'    => $request->jam_mulai, 
            'jam_selesai'  => $request->jam_selesai,
            'durasi_jam'   => $request->durasi_jam, 
            'total_harga'  => $request->total_harga, 
            'status'       => 'pending'
        ]);
        return redirect('/bookings');
    }

    public function bookingsHapus($id) { $this->futsalModel->deleteBooking($id); return redirect('/bookings'); }

    // --- PAYMENTS ---
    public function payments()
    {
        $data = $this->futsalModel->getAllPayments();
        $bookings = $this->futsalModel->getAllBookings();
        return view('payments', compact('data', 'bookings'));
    }
    public function paymentsTambah(Request $request)
    {
        $this->futsalModel->insertPayment([
            'booking_id' => $request->booking_id, 'metode_pembayaran' => $request->metode_pembayaran,
            'jenis_pembayaran' => $request->jenis_pembayaran, 'jumlah_bayar' => $request->jumlah_bayar,
            'status' => 'success', 'bukti_transfer' => $request->bukti_transfer
        ]);
        return redirect('/payments');
    }
    public function paymentsHapus($id) { $this->futsalModel->deletePayment($id); return redirect('/payments'); }

    // --- EQUIPMENTS ---
    public function equipments()
    {
        $data = $this->futsalModel->getAllEquipments();
        return view('equipments', compact('data'));
    }
    public function equipmentsTambah(Request $request)
    {
        $this->futsalModel->insertEquipment([
            'nama_barang' => $request->nama_barang, 'stok' => $request->stok, 'harga_sewa_per_jam' => $request->harga_sewa_per_jam
        ]);
        return redirect('/equipments');
    }
    public function equipmentsHapus($id) { $this->futsalModel->deleteEquipment($id); return redirect('/equipments'); }

    // --- CETAK & EXPORT ---
    public function cetakWindow($id)
    {
        $booking = $this->futsalModel->getBookingById($id);
        return view('cetak_window', compact('booking'));
    }

    public function exportPdf($id)
    {
        $booking = $this->futsalModel->getBookingById($id);
        $html = view('cetak_pdf', compact('booking'))->render();
        TCPDF::SetTitle('Invoice Booking - ' . $booking->kode_booking);
        TCPDF::AddPage();
        TCPDF::writeHTML($html, true, false, true, false, '');
        TCPDF::Output('Invoice_' . $booking->kode_booking . '.pdf', 'I');
    }

    public function exportExcel()
    {
        return Excel::download(new class implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings {
            public function collection() {
                $model = new futsal();
                return collect($model->getAllBookings())->map(function($item) {
                    return [
                        'kode_booking' => $item->kode_booking,
                        'nama' => $item->nama,
                        'nama_lapangan' => $item->nama_lapangan,
                        'tgl_main' => $item->tgl_main,
                        'total_harga' => $item->total_harga,
                        'status' => $item->status,
                    ];
                });
            }
            public function headings(): array {
                return ["Kode Booking", "Nama Pemesan", "Lapangan", "Tanggal Main", "Total Harga", "Status"];
            }
        }, 'Laporan_Pemesanan_Futsal.xlsx');
    }

    public function jabatansFormTambah() { return view('jabatans_tambah'); }
    
    public function usersFormTambah() { 
        $jabatans = $this->futsalModel->getAllJabatan(); 
        return view('users_tambah', compact('jabatans')); 
    }
    
    public function fieldPricesFormTambah() { 
        $fields = $this->futsalModel->getAllFields(); 
        return view('fields_prices_tambah', compact('fields')); 
    }
    
    public function bookingsFormTambah() { 
        $users = $this->futsalModel->getAllUsers(); 
        $fields = $this->futsalModel->getAllFields(); 
        return view('bookings_tambah', compact('users', 'fields')); 
    }
    
    public function paymentsFormTambah() { 
        $bookings = $this->futsalModel->getAllBookings(); 
        return view('payments_tambah', compact('bookings')); 
    }
    
    public function equipmentsFormTambah() { return view('equipments_tambah'); }
}