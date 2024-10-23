<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SiswaController extends Controller
{
    public function index(){
        $siswas = Siswa::all();
        return view('siswa.index', compact('siswas'));
    }

    public function create(){
        return view('siswa.create');
    }

    public function store(Request $request): RedirectResponse{
        $validatedData = $request->validate([
            'pelapor'  => 'required|string|max:255', 
            'terlapor' => 'required|string|max:255', 
            'kelas'    => 'required|string|max:255', 
            'laporan'  => 'required|string|max:255', 
            'bukti'    => 'required|image|mimes:png,jpg,jpeg|max:2048', 
        ]);

        $bukti = $request->file('bukti');
        $bukti->storeAs('public/storage', $bukti->hashName(), 'public'); 

            Siswa::create([
                'pelapor'  => $validatedData['pelapor'],
                'terlapor' => $validatedData['terlapor'],
                'kelas'    => $validatedData['kelas'],
                'laporan'  => $validatedData['laporan'],
                'bukti'    => $bukti->hashName(),
                'status'   => 'Under Review',
                ]
            );

        return redirect('siswa')->with(['success' => 'Data Has Been Sent to Your Teacher, Waiting to be Processed!']);

    }

    public function update($id){

    }



    // public function  show(string $id){
    //     $siswa = Siswa::findOrFail($id);

    //     return view('siswa.show', compact('siswa'));
    // }


}
