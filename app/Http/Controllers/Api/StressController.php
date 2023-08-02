<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\StressResource;
use App\Models\Stress;
use Illuminate\Support\Facades\Validator;

class StressController extends Controller
{
    public function index(){
        $stres = Stress::paginate(5);
        return new StressResource(true, 'List Wibu Stress', $stres);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'gelar' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $stress = Stress::create([
            'nama' => $request->nama,
            'gelar' => $request->gelar,
        ]);

        return new StressResource(true, 'List Wibu Stress Berhasil Ditambah', $stress);
    }

    public function show($id){
        $stress = Stress::find($id);

        return new StressResource(true, 'Detail Si Stress!', $stress);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'gelar' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $stress = Stress::find($id);

        $stress->update([
            'nama' => $request->nama,
            'gelar' => $request->gelar,
        ]);

        return new StressResource(true, 'Data Si Wibu Stress Berhasil Di Update!', $stress);
    }

    public function destroy($id){
        $stress = Stress::find($id);

        $stress->delete();

        return new StressResource(true, 'Si Wibu Stress Berhasil DI TIADAKAN!', null);
    }

}
