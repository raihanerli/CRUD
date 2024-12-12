<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class pegawaiAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan semua data yang ada di dalam model kita
        $data = pegawai::orderBy('nama', 'asc');
        return DataTables::of($data)
            ->addIndexColumn() //menambahkan index baru untuk pengurutan, lalu tambahkan juga di index.blade di column trs data
            ->addColumn('aksi', function ($data) { //kolom ini akan mengambil tampilan tombol dr file tombol yg ada di folder views/pegawai/tombol
                return view('pegawai.tombol')->with('data', $data);
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //berfungsi untuk menangani pengiriman data pengguna dan menyimpannya ke database setelah divalidasi.
    {
        $validasi = Validator::make(request->all(), [
            'nama' => 'required',
            'email' => 'required|email'
        ], [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email wajib benar',
        ]);//proses untuk melakukan validasi
        // bisa di cek metodenya menggunakan php artisan route:list

        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {
            $data = [
                'nama' => $request->nama,
                'email' => $request->email
            ];
            pegawai::create($data); //ini akan menyimpan data dari request data, pastikan app/modelsnya sudah dipanggil diatasnya
            return response()->json(['success' => "Berhasil menyimpan data"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
