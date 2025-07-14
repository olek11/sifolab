<?php

namespace App\Http\Controllers;

use \Exception;
use App\Exports\AlatExport;
use App\Exports\BahanExport;
use App\Exports\UsersExport;
use App\Models\Alat;
use App\Models\Bahan;
use App\Models\Jadwal;
use App\Models\PeminjamanAlat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Pastikan hanya pengguna terautentikasi yang bisa akses
    }

    public function dashboardadmin()
    {
        $users = User::all(); // Ambil semua data pengguna
        return view('admin.dashboard', [
            // 'ruangs' => $ruangs,
            // 'peminjamans' => $peminjamans,
            'users' => $users,
            'title' => 'Dashboard Admin', // Tambahkan title di sini
            'menuAdminDashboard' => 'active',
        ]);
    }



    // bagian page user
    public function user()
    {
        $users = User::all(); // Ambil semua data pengguna
        return view('admin.user.user', [
            'title' => 'Kelola Pengguna',
            'menuAdminUser' => 'active',
            'users' => $users, // Kirim data pengguna ke view
        ]);
    }

    /**
     * Menampilkan form untuk menambah pengguna baru
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.user.create', [
            'title' => 'Tambah Data User',
            'menuAdminUser' => 'active',
        ]); // Hanya kirim judul dan menu, data pengguna nggak perlu di form create
    }

    /**
     * Menyimpan data pengguna baru ke database
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'usertype' => 'required|in:admin,user',
        ], [
            'password.required' => 'Password belum diisi.',
            'password.min' => 'Password minimal harus :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'name.required' => 'Nama belum diisi.',
            'email.required' => 'Email belum diisi.',
            'usertype.required' => 'Tipe pengguna belum dipilih.',
        ]);
        // Simpan data pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $request->usertype,
        ]);

        // Redirect ke halaman kelola pengguna dengan pesan sukses
        return redirect()->route('admin.user')->with('success', 'Pengguna berhasil ditambahkan!');
    }
    /**
     * Menampilkan form untuk mengedit data pengguna
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); // Ambil data pengguna berdasarkan ID
        return view('admin.user.edit', [
            'user' => $user,
            'title' => 'Edit Data User',
            'menuAdminUser' => 'active',
        ]);
    }

    /**
     * Memperbarui data pengguna di database
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'usertype' => 'required|in:admin,user',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id); // Ambil data pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->usertype = $request->usertype;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password); // Update password kalau diisi
        }
        $user->save();

        return redirect()->route('admin.user')->with('success', 'Data pengguna berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Ambil data pengguna
        $user->delete(); // Hapus data

        return redirect()->route('admin.user')->with('success', 'Pengguna berhasil dihapus!');
    }
    /**
     * Menampilkan form untuk mengedit data pengguna
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function editUser($id)
    {
        $user = User::findOrFail($id); // Ambil data pengguna
        return view('admin.user.edit', [
            'user' => $user,
            'title' => 'Edit Data User',
            'menuAdminUser' => 'active',
        ]);
    }

    /**
     * Menghapus data pengguna dari database
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id); // Ambil data pengguna
        $user->delete(); // Hapus data

        return redirect()->route('admin.user')->with('success', 'Pengguna dihapus!');
    }
    // Export to Excel

    public function headings(): array
    {
        return ['Nama', 'Email', 'type user'];
    }

    public function exportExcel()
    {
        return Excel::download(new UsersExport(), 'users.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }




    // bagian page daftar alat
    public function alat()
    {
        $alats = Alat::all(); // Ambil semua data dari tabel alats
        return view('admin.alat.alat', [
            'title' => 'Kelola Alat', // Ubah judul menjadi relevan dengan alat
            'menuAdminAlat' => 'active',
            'alats' => $alats, // Kirim data dengan nama variabel yang konsisten
        ]);
    }

    public function createAlat()
    {
        return view('admin.alat.create', [
            'title' => 'Tambah Data Alat',
            'menuAdminAlat' => 'active',
        ]);
    }
    public function storeAlat(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'no_inventaris' => 'required|string|max:255',
            'jumlah_alat' => 'required|integer|min:1',
            'kondisi_alat' => 'required|string|max:50|in:Baik,Rusak Ringan,Rusak Berat',
            'tahun_perolehan' => 'nullable|integer|min:1900|max:2099',
            'merk_type' => 'required|string|max:255', // Wajib karena tidak nullable
            'penguasaan' => 'required|string|max:255', // Wajib karena tidak nullable
            'gambar_alat' => 'nullable|image|mimes:jpg,jpeg,png|max:20048',
            'deskripsi' => 'nullable|string',
            'nup' => 'nullable|string|max:255', // Nullable sesuai migration
        ], [
            'nama_alat.required' => 'Nama alat belum diisi.',
            'no_inventaris.required' => 'No. inventaris belum diisi.',
            'jumlah_alat.required' => 'Jumlah alat belum diisi.',
            'kondisi_alat.required' => 'Kondisi alat belum diisi.',
            'kondisi_alat.in' => 'Kondisi alat harus salah satu dari: Baik, Rusak Ringan, Rusak Berat.',
            'merk_type.required' => 'Merek/Type alat belum diisi.', // Pesan untuk kolom wajib
            'penguasaan.required' => 'Penguasaan alat belum diisi.', // Pesan untuk kolom wajib
            'gambar_alat.max' => 'Ukuran gambar tidak boleh lebih dari 20MB.',
            'gambar_alat.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
        ]);

        // Persiapan data untuk disimpan
        $data = $request->only([
            'nama_alat',
            'no_inventaris',
            'jumlah_alat',
            'kondisi_alat',
            'tahun_perolehan',
            'merk_type',
            'penguasaan',
            'gambar_alat',
            'deskripsi',
            'nup'
        ]);

        // Penanganan unggah gambar jika ada
        if ($request->hasFile('gambar_alat')) {
            $file = $request->file('gambar_alat');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/alat', $fileName);
            $data['gambar_alat'] = 'alat/' . $fileName;
        }

        try {
            // Simpan data alat baru
            Alat::create($data);
            return redirect()->route('admin.alat')->with('success', 'Alat berhasil ditambahkan!');
        } catch (Exception $e) {
            Log::error('Error saat menyimpan alat: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }
    public function editAlat($id)
    {
        $alat = Alat::findOrFail($id); // Ambil data alat berdasarkan ID
        return view('admin.alat.edit', [
            'alat' => $alat,
            'title' => 'Edit Data Alat',
            'menuAdminAlat' => 'active',
        ]);
    }
    public function updateAlat(Request $request, $id)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'no_inventaris' => 'required|string|max:255',
            'jumlah_alat' => 'required|integer|min:1',
            'kondisi_alat' => 'required|string|max:50|in:Baik,Rusak Ringan,Rusak Berat',
            'tahun_perolehan' => 'nullable|integer|min:1900|max:2099',
            'merk_type' => 'required|string|max:255', // Wajib karena tidak nullable
            'penguasaan' => 'required|string|max:255', // Wajib karena tidak nullable
            'gambar_alat' => 'nullable|image|mimes:jpg,jpeg,png|max:20048',
            'deskripsi' => 'nullable|string',
            'nup' => 'nullable|string|max:255', // Nullable sesuai migration
        ], [
            // Pesan validasi yang sama seperti pada storeAlat
        ]);

        $alat = Alat::findOrFail($id); // Ambil data alat berdasarkan ID

        // Update data alat
        $alat->nama_alat = $request->nama_alat;
        $alat->no_inventaris = $request->no_inventaris;
        $alat->jumlah_alat = $request->jumlah_alat;
        $alat->kondisi_alat = $request->kondisi_alat;
        $alat->tahun_perolehan = $request->tahun_perolehan;
        $alat->merk_type = $request->merk_type;
        $alat->penguasaan = $request->penguasaan;
        $alat->deskripsi = $request->deskripsi;
        $alat->nup = $request->nup;

        // Penanganan unggah gambar jika ada
        if ($request->hasFile('gambar_alat')) {
            if ($alat->gambar_alat) {
                Storage::delete('public/' . $alat->gambar_alat); // Hapus gambar lama jika ada
            }
            $file = $request->file('gambar_alat');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/alat', $fileName);
            $alat->gambar_alat = 'alat/' . $fileName; // Simpan path gambar baru
        }
        try {
            $alat->save(); // Simpan perubahan
            return redirect()->route('admin.alat')->with('success', 'Data alat berhasil diperbarui.');
        } catch (Exception $e) {
            Log::error('Error saat memperbarui alat: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }
    public function destroyAlat($id)
    {
        $alat = Alat::findOrFail($id); // Ambil data alat berdasarkan ID
        if ($alat->gambar_alat) {
            Storage::delete('public/' . $alat->gambar_alat); // Hapus gambar jika ada
        }
        $alat->delete(); // Hapus data alat
        return redirect()->route('admin.alat')->with('success', 'Alat berhasil dihapus!');
    }
    public function exportAlatExcel()
    {
        return Excel::download(new AlatExport(), 'alat.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    // bagian daftar bahan
    public function bahan()
    {
        $bahans = Bahan::all(); // Ambil semua data dari tabel
        return view('admin.bahan.bahan', [
            'title' => 'Kelola Bahan', // Ubah judul menjadi relevan dengan bahan
            'menuAdminBahan' => 'active',
            'bahans' => $bahans, // Kirim data dengan nama variabel yang konsisten
        ]);
    }
    public function createBahan()
    {
        return view('admin.bahan.create', [
            'title' => 'Tambah Data Bahan',
            'menuAdminBahan' => 'active',
        ]);
    }
    public function storeBahan(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'jumlah_bahan' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string|max:500',
        ], [
            'name.required' => 'Nama bahan belum diisi.',
            'jumlah_bahan.required' => 'Jumlah bahan belum diisi.',
            'satuan.required' => 'Satuan bahan belum diisi.',
            'deskripsi.max' => 'Deskripsi tidak boleh lebih dari 500 karakter.',
        ]);
        // Simpan data bahan baru
        Bahan::create([
            'name' => $request->name,
            'jumlah_bahan' => $request->jumlah_bahan,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
        ]);
        // Redirect ke halaman kelola bahan dengan pesan sukses
        return redirect()->route('admin.bahan')->with('success', 'Bahan berhasil ditambahkan!');
    }
    public function editBahan($id)
    {
        $bahan = Bahan::findOrFail($id); // Ambil data bahan
        return view('admin.bahan.edit', [
            'bahan' => $bahan,
            'title' => 'Edit Data Bahan',
            'menuAdminBahan' => 'active',
        ]);
    }
    public function updateBahan(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'jumlah_bahan' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $bahan = Bahan::findOrFail($id); // Ambil data bahan
        $bahan->name = $request->name;
        $bahan->jumlah_bahan = $request->jumlah_bahan;
        $bahan->satuan = $request->satuan;
        $bahan->deskripsi = $request->deskripsi;
        $bahan->save(); // Simpan perubahan

        return redirect()->route('admin.bahan')->with('success', 'Data bahan berhasil diperbarui.');
    }
    public function destroyBahan($id)
    {
        $bahan = Bahan::findOrFail($id); // Ambil data bahan
        $bahan->delete(); // Hapus data bahan
        return redirect()->route('admin.bahan')->with('success', 'Bahan berhasil dihapus!');
    }
    public function exportBahanExcel()
    {
        return Excel::download(new BahanExport(), 'bahan.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    // bagian jadwal
    public function jadwal()
    {
        $jadwals = Jadwal::all(); // Ambil semua data dari tabel jadwals
        return view('admin.jadwal.jadwal', [
            'title' => 'Kelola Jadwal', // Ubah judul menjadi relevan
            'menuAdminJadwal' => 'active',
            'jadwals' => $jadwals, // Kirim data dengan nama variabel yang konsisten
        ]);
    }
    public function createJadwal()
    {
        return view('admin.jadwal.create', [
            'title' => 'Tambah Data Jadwal',
            'menuAdminJadwal' => 'active',
        ]);
    }
    public function storeJadwal(Request $request)
    {
        $request->validate([
            'jenis_kegiatan' => 'required|string|max:100',
            'judul_kegiatan' => 'required|string|max:100',
            'hari_tanggal_mulai' => 'required|date',
            'hari_tanggal_selesai' => 'required|date|after_or_equal:hari_tanggal_mulai',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'penanggung_jawab' => 'required|string|max:100',
            'asisten_penanggung_jawab' => 'nullable|string|max:100',
        ], [
            'jenis_kegiatan.required' => 'Jenis kegiatan belum diisi.',
            'judul_kegiatan.required' => 'Judul kegiatan belum diisi.',
            'hari_tanggal_mulai.required' => 'Hari dan tanggal mulai belum diisi.',
            'hari_tanggal_selesai.required' => 'Hari dan tanggal selesai belum diisi.',
            'hari_tanggal_selesai.after_or_equal' => 'Hari dan tanggal selesai harus setelah atau sama dengan hari dan tanggal mulai.',
            'jam_mulai.required' => 'Jam mulai belum diisi.',
            'jam_selesai.required' => 'Jam selesai belum diisi.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
            'penanggung_jawab.required' => 'Penanggung jawab belum diisi.',
        ]);

        // Set zona waktu ke WIB (Asia/Jakarta)
        $startDateTime = Carbon::parse($request->hari_tanggal_mulai . ' ' . $request->jam_mulai, 'Asia/Jakarta');
        $endDateTime = Carbon::parse($request->hari_tanggal_selesai . ' ' . $request->jam_selesai, 'Asia/Jakarta');

        // Periksa konflik jam pada hari yang sama
        $conflictingSchedules = Jadwal::whereDate('hari_tanggal_mulai', $startDateTime->toDateString())
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->whereBetween('jam_mulai', [$startDateTime->format('H:i'), $endDateTime->format('H:i')])
                    ->orWhereBetween('jam_selesai', [$startDateTime->format('H:i'), $endDateTime->format('H:i')])
                    ->orWhere(function ($query) use ($startDateTime, $endDateTime) {
                        $query->where('jam_mulai', '<=', $startDateTime->format('H:i'))
                            ->where('jam_selesai', '>=', $endDateTime->format('H:i'));
                    });
            })->where('status', '!=', 'rejected')->get();

        if ($conflictingSchedules->isNotEmpty()) {
            return redirect()->back()->withErrors(['msg' => 'Jadwal bertabrakan dengan jadwal yang sudah ada.']);
        }
        // Debugging: Cek data yang diterima
        // dd($request->all());

        // Format tanggal dengan nama hari
        $formattedStartDate = $startDateTime->isoFormat('dddd, D MMMM YYYY');
        $formattedEndDate = $endDateTime->isoFormat('dddd, D MMMM YYYY');

        // Simpan data jadwal dengan format WIB
        Jadwal::create([
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'judul_kegiatan' => $request->judul_kegiatan,
            'hari_tanggal_mulai' => $startDateTime->toDateString(),
            'hari_tanggal_selesai' => $endDateTime->toDateString(),
            'jam_mulai' => $startDateTime->format('H:i') . ' WIB',
            'jam_selesai' => $endDateTime->format('H:i') . ' WIB',
            'penanggung_jawab' => $request->penanggung_jawab,
            'asisten_penanggung_jawab' => $request->asisten_penanggung_jawab,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.jadwal')->with('success', 'Jadwal berhasil ditambahkan!');
    }
    public function approve($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update(['status' => 'approved']);
        return redirect()->route('admin.jadwal')->with('success', 'Jadwal berhasil disetujui!');
    }

    public function reject($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update(['status' => 'rejected']);
        return redirect()->route('admin.jadwal')->with('success', 'Jadwal berhasil ditolak!');
    }
    public function editJadwal($id)
    {
        $jadwal = Jadwal::findOrFail($id); // Ambil data jadwal berdasarkan ID
        return view('admin.jadwal.edit', [
            'jadwal' => $jadwal,
            'title' => 'Edit Data Jadwal',
            'menuAdminJadwal' => 'active',
        ]);
    }
    public function updateJadwal(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'jenis_kegiatan' => 'required|string|max:100',
            'judul_kegiatan' => 'required|string|max:100',
            'hari_tanggal_mulai' => 'required',
            'hari_tanggal_selesai' => 'required|after_or_equal:hari_tanggal_mulai',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'penanggung_jawab' => 'required|string|max:100',
            'asisten_penanggung_jawab' => 'nullable|string|max:100',
        ], [
            'jenis_kegiatan.required' => 'Jenis kegiatan belum diisi.',
            'judul_kegiatan.required' => 'Judul kegiatan belum diisi.',
            'hari_tanggal_mulai.required' => 'Hari dan tanggal mulai belum diisi.',
            'hari_tanggal_selesai.required' => 'Hari dan tanggal selesai belum diisi.',
            'hari_tanggal_selesai.after_or_equal' => 'Hari dan tanggal selesai harus setelah atau sama dengan hari dan tanggal mulai.',
            'jam_mulai.required' => 'Jam mulai belum diisi.',
            'jam_selesai.required' => 'Jam selesai belum diisi.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
            'penanggung_jawab.required' => 'Penanggung jawab belum diisi.',
        ]);

        // Parse input dari DateTime Picker
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->hari_tanggal_mulai . ' ' . $request->jam_mulai, 'Asia/Jakarta');
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->hari_tanggal_selesai . ' ' . $request->jam_selesai, 'Asia/Jakarta');



        $jadwal->update([
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'judul_kegiatan' => $request->judul_kegiatan,
            'hari_tanggal_mulai' => $startDateTime,
            'hari_tanggal_selesai' => $endDateTime,
            'jam_mulai' => $startDateTime->format('H:i') . ' WIB',
            'jam_selesai' => $endDateTime->format('H:i') . ' WIB',
            'penanggung_jawab' => $request->penanggung_jawab,
            'asisten_penanggung_jawab' => $request->asisten_penanggung_jawab,
        ]);

        return redirect()->route('admin.jadwal')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroyJadwal($id)
    {
        $jadwal = Jadwal::findOrFail($id); // Ambil data bahan
        $jadwal->delete(); // Hapus data bahan
        return redirect()->route('admin.jadwal')->with('success', 'Bahan berhasil dihapus!');
    }

    public function peminjaman()
    {
        $peminjaman_alats = PeminjamanAlat::with('alat')->paginate(10); // Gunakan paginasi

        return view('admin.peminjaman.peminjamanalat', [
            'title' => 'Kelola Peminjaman Alat', // Lebih relevan dengan fungsi
            'menuAdminPeminjamanAlat' => 'active',
            'peminjaman_alats' => $peminjaman_alats,
        ]);
    }

    public function createPeminjaman()
    {
        $alats = Alat::select('id', 'nama_alat', 'no_inventaris')->get();
        return view('admin.peminjaman.create', [
            'title' => 'Tambah Data Peminjaman',
            'menuAdminPeminjaman' => 'active',
            'alats' => $alats,
        ]);
    }

    // Menyimpan data peminjaman
    public function storePeminjaman(Request $request)
    {
        $validated = $request->validate([
            'nama_peminjam' => 'required|string|max:100',
            'nim_nip_nidn' => 'required|string|max:50',
            'jurusan' => 'required|string|max:50',
            'no_hp' => 'required|string|max:15',
            'nama_alat' => 'required|integer|exists:alats,id', // Ubah ke integer
            'jumlah' => 'required|integer|min:1',
            'peminjaman' => 'required|date',
            'pengembalian' => 'required|date|after_or_equal:peminjaman', // Perbaiki nama field
            'keterangan' => 'nullable|string',
            'paraf_peminjam' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'paraf_petugas' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama_peminjam.required' => 'Nama peminjam belum diisi, silahkan di isi dengan nama lengkap',
            'nim_nip_nidn.required' => 'No identitas belum diisi, silahkan di isi dengan NIM/NIP/NIDN.',
            'nama_alat.required' => 'Nama alat belum dipilih.',
            'nama_alat.exists' => 'Nama alat tidak ditemukan di database.',
            'jumlah.required' => 'Jumlah alat belum diisi.',
            'jumlah.integer' => 'Jumlah alat harus berupa angka.',
            'jumlah.min' => 'Jumlah alat minimal 1.',
            'no_hp.required' => 'No HP belum diisi.',
            'peminjaman.required' => 'Tanggal peminjaman belum diisi.',
            'pengembalian.required' => 'Tanggal pengembalian belum diisi.',
            'pengembalian.after_or_equal' => 'Tanggal pengembalian harus setelah atau sama dengan tanggal peminjaman.',
        ]);

        // Penanganan tanggal
        $startDateTime = Carbon::parse($request->peminjaman);
        $endDateTime = Carbon::parse($request->pengembalian);

        // Penanganan file (opsional)
        if ($request->hasFile('paraf_peminjam')) {
            $paraf_peminjam_path = $request->file('paraf_peminjam')->store('paraf', 'public');
            $validated['paraf_peminjam'] = $paraf_peminjam_path;
        }
        if ($request->hasFile('paraf_petugas')) {
            $paraf_petugas_path = $request->file('paraf_petugas')->store('paraf', 'public');
            $validated['paraf_petugas'] = $paraf_petugas_path;
        }

        try {
            PeminjamanAlat::create([
                'nama_peminjam' => $validated['nama_peminjam'],
                'nim_nip_nidn' => $validated['nim_nip_nidn'],
                'jurusan' => $validated['jurusan'],
                'nama_alat' => $validated['nama_alat'],
                'jumlah' => $validated['jumlah'],
                'no_hp' => $validated['no_hp'],
                'peminjaman' => $startDateTime->toDateString(),
                'pengembalian' => $endDateTime->toDateString(),
                'keterangan' => $validated['keterangan'],
                'status' => 'pending',
                'paraf_peminjam' => $validated['paraf_peminjam'] ?? null,
                'paraf_petugas' => $validated['paraf_petugas'] ?? null,
            ]);
            return redirect()->route('admin.peminjaman')->with('success', 'Data peminjaman berhasil ditambahkan!');
        } catch (Exception $e) {
            Log::error('Error menyimpan peminjaman: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }


    public function approvePeminjaman($id)
    {
        $peminjaman = PeminjamanAlat::findOrFail($id);
        $peminjaman->update(['status' => 'approved']);
        return redirect()->route('admin.peminjaman')->with('success', 'Peminjaman berhasil disetujui!');
    }

    public function rejectPeminjaman($id)
    {
        $peminjaman = PeminjamanAlat::findOrFail($id);
        $peminjaman->update(['status' => 'rejected']);
        return redirect()->route('admin.peminjaman')->with('success', 'Peminjaman berhasil ditolak!');
    }

    // Menampilkan form edit peminjaman
    public function editPeminjaman($id)
    {
        $peminjaman = PeminjamanAlat::with('alat')->findOrFail($id);
        // dd($peminjaman->peminjaman, $peminjaman->pengembalian); // Debug tanggal
        $alats = Alat::select('id', 'nama_alat', 'no_inventaris')->get();
        return view('admin.peminjaman.edit', [
            'peminjaman' => $peminjaman,
            'alats' => $alats,
            'title' => 'Edit Data Peminjaman',
            'menuAdminPeminjaman' => 'active',
        ]);
    }

    // Memperbarui data peminjaman
    public function updatePeminjaman(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_peminjam' => 'required|string|max:100',
            'nim_nip_nidn' => 'required|string|max:50',
            'jurusan' => 'required|string|max:50',
            'no_hp' => 'required|string|max:15',
            'nama_alat' => 'required|integer|exists:alats,id',
            'jumlah' => 'required|integer|min:1',
            'peminjaman' => 'required|date',
            'pengembalian' => 'required|date|after_or_equal:peminjaman',
            'keterangan' => 'nullable|string',
            'paraf_peminjam' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'paraf_petugas' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Penanganan tanggal
        $startDateTime = Carbon::parse($request->peminjaman);
        $endDateTime = Carbon::parse($request->pengembalian);

        $peminjaman = PeminjamanAlat::findOrFail($id);


        if ($request->hasFile('paraf_peminjam')) {
            if ($peminjaman->paraf_peminjam) {
                Storage::disk('public')->delete($peminjaman->paraf_peminjam);
            }
            $paraf_peminjam_path = $request->file('paraf_peminjam')->store('paraf', 'public');
            $validated['paraf_peminjam'] = $paraf_peminjam_path;
        } else {
            $validated['paraf_peminjam'] = $peminjaman->paraf_peminjam;
        }

        if ($request->hasFile('paraf_petugas')) {
            if ($peminjaman->paraf_petugas) {
                Storage::disk('public')->delete($peminjaman->paraf_petugas);
            }
            $paraf_petugas_path = $request->file('paraf_petugas')->store('paraf', 'public');
            $validated['paraf_petugas'] = $paraf_petugas_path;
        } else {
            $validated['paraf_petugas'] = $peminjaman->paraf_petugas;
        }

        try {
            $peminjaman->update([
                'nama_peminjam' => $validated['nama_peminjam'],
                'nim_nip_nidn' => $validated['nim_nip_nidn'],
                'jurusan' => $validated['jurusan'],
                'nama_alat' => $validated['nama_alat'],
                'jumlah' => $validated['jumlah'],
                'no_hp' => $validated['no_hp'],
                'peminjaman' => $startDateTime->toDateString(),
                'pengembalian' => $endDateTime->toDateString(),
                'keterangan' => $validated['keterangan'],
                'paraf_peminjam' => $validated['paraf_peminjam'],
                'paraf_petugas' => $validated['paraf_petugas'],
            ]);
            return redirect()->route('admin.peminjaman')->with('success', 'Data peminjaman berhasil diperbarui!');
        } catch (Exception $e) {
            Log::error('Error memperbarui peminjaman: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Gagal memperbarui data: ' . $e->getMessage()]);
        }
    }

    // Menghapus data peminjaman
    public function destroyPeminjaman($id)
    {
        $peminjaman = PeminjamanAlat::findOrFail($id);
        if ($peminjaman->paraf_peminjam) {
            Storage::delete('public/' . $peminjaman->paraf_peminjam);
        }
        if ($peminjaman->paraf_petugas) {
            Storage::delete('public/' . $peminjaman->paraf_petugas);
        }
        $peminjaman->delete();
        return redirect()->route('admin.peminjaman')->with('success', 'Data peminjaman berhasil dihapus!');
    }
}