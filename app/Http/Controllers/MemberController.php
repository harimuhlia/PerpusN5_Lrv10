<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('kelas')
            ->where('role', 'anggota');

        // SEARCH
        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('id_register', 'like', '%' . $request->search . '%')
                  ->orWhere('no_wa', 'like', '%' . $request->search . '%');

            });

        }

        $member = $query->latest()->paginate(10);

        return view('member.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();

        return view('member.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6',
            'kelas_id'  => 'required',
            'no_wa'     => 'required',
            'alamat'    => 'required',
        ]);

        // AUTO GENERATE ID REGISTER
        $lastUser = User::where('role', 'anggota')->count() + 1;

        $idRegister = 'N5-PERPUS-' . str_pad($lastUser, 6, '0', STR_PAD_LEFT);

        User::create([
            'id_register' => $idRegister,
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'role'        => 'anggota',
            'kelas_id'    => $request->kelas_id,
            'no_wa'       => $request->no_wa,
            'alamat'      => $request->alamat,
        ]);

        return redirect()->route('member.index')
            ->with('success', 'Data member berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $member = User::with('kelas')
            ->findOrFail($id);

        return view('member.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $member = User::findOrFail($id);

        $kelas = Kelas::all();

        return view('member.edit', compact('member', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $member = User::findOrFail($id);

        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,' . $member->id,
            'kelas_id'  => 'required',
            'no_wa'     => 'required',
            'alamat'    => 'required',
        ]);

        $data = [
            'name'      => $request->name,
            'email'     => $request->email,
            'kelas_id'  => $request->kelas_id,
            'no_wa'     => $request->no_wa,
            'alamat'    => $request->alamat,
        ];

        // GANTI PASSWORD JIKA DIISI
        if ($request->password) {

            $data['password'] = Hash::make($request->password);

        }

        $member->update($data);

        return redirect()->route('member.index')
            ->with('success', 'Data member berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $member = User::findOrFail($id);

        $member->delete();

        return redirect()->route('member.index')
            ->with('success', 'Data member berhasil dihapus');
    }

    public function trash()
    {
        $member = User::onlyTrashed()
            ->where('role', 'anggota')
            ->paginate(10);

        return view('member.trash', compact('member'));
    }

    public function restore($id)
    {
        User::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('member.trash')
            ->with('success', 'Data berhasil direstore');
    }

    public function forceDelete($id)
    {
        User::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('member.trash')
            ->with('success', 'Data berhasil dihapus permanen');
    }

    // public function kartu($id)
    // {
    //     $member = User::with('kelas')->findOrFail($id);

    //     $pdf = Pdf::loadView('member.kartu', compact('member'))
    //         ->setPaper([0, 0, 242.64, 153.36], 'landscape');

    //     return $pdf->stream('kartu-member.pdf');
    // }

    // public function cetakMasal(Request $request)
    // {
    //     $request->validate([
    //         'member_ids' => 'required'
    //     ]);

    //     $member = User::with('kelas')
    //         ->whereIn('id', $request->member_ids)
    //         ->get();

    //     $pdf = Pdf::loadView('member.kartu-masal', compact('member'))
    //         ->setPaper('A4', 'portrait');

    //     return $pdf->stream('kartu-member-masal.pdf');
    // }

    public function kartu($id)
    {
        $member = User::with('kelas')
                    ->findOrFail($id);

        return view('member.kartu', compact('member'));
    }

    public function cetakMasal()
    {
        $member = User::where('role', 'anggota')
                    ->orderBy('name')
                    ->get();

        return view('member.kartu-masal', compact('member'));
    }

}