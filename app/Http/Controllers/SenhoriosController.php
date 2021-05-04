<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Senhorios;

class SenhoriosController extends Controller
{
    private $model;

    public function __construct(Senhorios $senhorios)
    {
        $this->model = $senhorios;
    }

    public function getAllSenhorios(){
        $senhorios = $this->model->all();
        return response()->json($senhorios);
    }

    public function getSenhorio($id){
        $senhorio = $this->model->find($id);
        return response()->json($senhorio);
    }
    
    public function store(Request $request){
        dd($request->all());
    }

    public function update($id, Request $request){
        dd($id, $request->all());
    }

    public function destroy($id){
        return "get " . $id;
    }

    //
}
