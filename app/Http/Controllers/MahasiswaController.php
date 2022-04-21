<?php

namespace App\Http\Controllers;

use App\Http\Requests\MahasiswaRequest;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function searchMahasiswa(Request $request)
    {
        $search     = $request->search;
        $mahasiswa  = Mahasiswa::where("nim", "LIKE", "%$search%")
            ->orWhere("nama", "LIKE", "%$search%")
            ->orWhere("kelas", "LIKE", "%$search%")
            ->orWhere("jurusan", "LIKE", "%$search%")
            ->orWhere("email", "LIKE", "%$search%")
            ->orWhere("alamat", "LIKE", "%$search%")
            ->orWhere("tanggal_lahir", "LIKE", "%$search%")
            ->paginate(3);
        return view('mahasiswa.index', compact('mahasiswa'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        // $mahasiswa = DB::table('mahasiswa')->get(); // Mengambil semua isi tabel
        // $mahasiswa = Mahasiswa::orderBy('Nim', 'desc')->paginate(3);
        $mahasiswa = Mahasiswa::latest('nim')->paginate(3);
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MahasiswaRequest $request)
    {
        //melakukan validasi data
        // $request->validate([
        //     'nim'           => 'required',
        //     'nama'          => 'required',
        //     'kelas'         => 'required',
        //     'jurusan'       => 'required',
        //     'email'         => 'required|email|max:100',
        //     'alamat'        => 'required',
        //     'tanggal_lahir' => 'required'
        // ]);

        //fungsi eloquent untuk menambah data
        // Mahasiswa::create($request->all());
        Mahasiswa::create($request->validated());

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        // $Mahasiswa = Mahasiswa::find($Nim);
        $Mahasiswa = Mahasiswa::getByNim($Nim);
        return view('mahasiswa.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        //DB::table('mahasiswa')->where('nim', $nim)->first()
        $Mahasiswa = Mahasiswa::getByNim($nim);
        return view('mahasiswa.edit', compact('Mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MahasiswaRequest $request, $nim)
    {
        //melakukan validasi data
        // $request->validate([
        //     'nim'           => 'required',
        //     'nama'          => 'required',
        //     'kelas'         => 'required',
        //     'jurusan'       => 'required',
        //     'email'         => 'required|email|max:100',
        //     'alamat'        => 'required',
        //     'tanggal_lahir' => 'required'
        // ]);
        //fungsi eloquent untuk mengupdate data inputan kita
        // Mahasiswa::find($nim)->update($request->all());
        // Mahasiswa::where('nim', $nim)->first()->update($request->all());
        Mahasiswa::getByNim($nim)->update($request->validated());

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        // Mahasiswa::find($Nim)->delete();
        // Mahasiswa::where('nim', $Nim)->first()->delete();
        Mahasiswa::getByNim($Nim)->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Dihapus');
    }
}