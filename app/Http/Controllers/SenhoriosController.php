<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Senhorios;
use App\Models\Utilizadores;
use App\Models\Propriedades;
use App\Models\HistoricoSaldo;
use Carbon\Carbon;

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

    public function updateUtilizador(Request $req, $id)
    {
        $data = Utilizadores::find($id);
        $data->Username=$req->input('nomeUser');
        $data->PrimeiroNome=$req->input('primeiroNome');
        $data->UltimoNome=$req->input('ultimoNome');
        $data->Email=$req->input('mail');
        $data->Morada=$req->input('morada');
        $data->Nascimento=$req->input('dateNascimento');
        $data->save();
        
        return response()->json('Updated successfully.');
    }

    public function showWallet()
    {
        $id = '2';
        $user = Utilizadores::where('IdUser','=',$id)->get();

        $userHist = HistoricoSaldo::where('IdUser','=',$id)->orderBy('IdSaldo', 'desc')->limit(4)->get();

        return view('wallet',['data'=>$user],['data2'=>$userHist]);
    }

    public function senhorioHome(){
        $id = '2';
        $utilizador = Utilizadores::find($id);
        $senhorioId = Senhorios::where('IdUser', $id)->get('IdSenhorio');
        $propriedadesPag = Propriedades::where('IdSenhorio', $senhorioId[0]['IdSenhorio'])->paginate(3);
        $propriedades = Propriedades::where('IdSenhorio', $senhorioId[0]['IdSenhorio'])->get();
        return view('senhorioHome',['user'=>$utilizador,'propriedades'=>$propriedades, 'propriedadesPag'=>$propriedadesPag,"disp"=>0]);
    }

    public function addSaldo(Request $amount){
        $id = 2;
        $user = Utilizadores::find($id);
        $user->Saldo=$amount->input('amountToAdd')+$user->Saldo;
        $user->save();

        $histSaldo = new HistoricoSaldo();
        //$user->IdSaldo=1;
        $histSaldo->IdUser=$id;
        $histSaldo->Username=$amount->input('nameUser');
        $histSaldo->Valor=$amount->input('amountToAdd');
        $histSaldo->Data=Carbon::now();
        $histSaldo->save();

        return response()->json(['res'=>$user->Saldo]);
    }


    public function senhorioHomeDisp(){
        $id = '2';
        $utilizador = Utilizadores::find($id);
        $senhorioId = Senhorios::where('IdUser', $id)->get('IdSenhorio');
        $propriedadesPag = Propriedades::where('IdSenhorio', $senhorioId[0]['IdSenhorio'])->where('Disponibilidade', "Disponivel")->paginate(3);
        $propriedades = Propriedades::where('IdSenhorio', $senhorioId[0]['IdSenhorio'])->get();
        return view('senhorioHome',['user'=>$utilizador,'propriedades'=>$propriedades, 'propriedadesPag'=>$propriedadesPag,"disp"=>1]);
    }

    public function storeProfileImg(Request $req, $id)
    {
        $this->validate($req,[
            'imgProfile' => 'required|mimes:jpg,png,jpeg,|max:5048'
        ]);
        $file = $req->imgProfile->getClientOriginalName();
        $fileName = pathinfo($file,PATHINFO_FILENAME);

        $newImgName = time() . '-' . $fileName . '.' . 
        $req->imgProfile->extension();

        $req->imgProfile->move('img',$newImgName);

        $user = Utilizadores::find($id);
        $user->imagem=$newImgName;
        $user->save();
        return view('senhorioHome',['user'=>$user]);
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
