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

    public function validaNIF($nif, $ignoreFirst=true) {
        
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

        //Limpamos eventuais espaços a mais
        $nif=trim($req->input('NIF'));
        $ignoreFirst=true;
        //Verificamos se é numérico e tem comprimento 9
        if (!is_numeric($nif) || strlen($nif)!=9) {
            return response()->json('NIF Invalido');
        } else {
            $nifSplit=str_split($nif);
            //O primeiro digíto tem de ser 1, 2, 3, 5, 6, 8 ou 9
            //Ou não, se optarmos por ignorar esta "regra"
            if (
                in_array($nifSplit[0], array(1, 2, 3, 5, 6, 8, 9))
                ||
                $ignoreFirst
            ) {
                //Calculamos o dígito de controlo
                $checkDigit=0;
                for($i=0; $i<8; $i++) {
                    $checkDigit+=$nifSplit[$i]*(10-$i-1);
                }
                $checkDigit=11-($checkDigit % 11);
                //Se der 10 então o dígito de controlo tem de ser 0
                if($checkDigit>=10) $checkDigit=0;
                //Comparamos com o último dígito
                if ($checkDigit==$nifSplit[8]) {
                    $data->NIF=$req->input('NIF');
                } else {
                    return response()->json('NIF Invalido');
                }
            } else {
                return response()->json('NIF Invalido');
            }
        }

        
        $data->Nacionalidade=$req->input('Nacionalidade');
        $data->Telefone=$req->input('Telefone');
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
        $dataHoje = Carbon::now();
        return view('senhorioHome',['user'=>$utilizador,'propriedades'=>$propriedades, 'propriedadesPag'=>$propriedadesPag,"disp"=>0,'dataHoje'=>$dataHoje]);
    }

    public function addSaldo(Request $amount){
        dump($amount->getContent());
        dump($amount->input());
        $id = 2;
        $user = Utilizadores::find($id);
        $user->Saldo=$amount->input('amountToAdd')+$user->Saldo;
        $user->save();
        $histSaldo = new HistoricoSaldo();
        //$user->IdSaldo=1;
        $histSaldo->IdUser=$id;
        $histSaldo->Descricao=$amount->input('Descricao');
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

        $id = '2';
        $senhorioId = Senhorios::where('IdUser', $id)->get('IdSenhorio');
        $propriedadesPag = Propriedades::where('IdSenhorio', $senhorioId[0]['IdSenhorio'])->paginate(3);
        $propriedades = Propriedades::where('IdSenhorio', $senhorioId[0]['IdSenhorio'])->get();
        return view('senhorioHome',['user'=>$user,'propriedades'=>$propriedades, 'propriedadesPag'=>$propriedadesPag,"disp"=>0]);
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
