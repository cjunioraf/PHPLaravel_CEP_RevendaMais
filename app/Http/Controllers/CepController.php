<?php

namespace App\Http\Controllers;

use App\Models\Enderecos;
use Illuminate\Http\Request;

class CepController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {

            $enderecos = Enderecos::where('logradouro', 'like', '%' . $search . '%')->get();
            $count = $enderecos->count();

            if ($count === 0) {
                $enderecos = Enderecos::where('bairro', 'like', '%' . $search . '%')->get();
                $count = $enderecos->count();

                if ($count === 0) {
                    $enderecos = Enderecos::where('localidade', 'like', '%' . $search . '%')->get();
                    $count = $enderecos->count();

                    if ($count === 0) {
                        $enderecos = Enderecos::where('complemento', 'like', '%' . $search . '%')->get();
                    }
                }
            }

        } else {
            $enderecos = Enderecos::all();
        }

        return view('welcome', ['enderecos' => $enderecos, 'search' => $search]);
    }
    public function updatedCep(Request $request)
    {
        try {

            $enderecos = Enderecos::where('cep', $request->cep)->first();

            if (!$enderecos) {

                $enderecos = new Enderecos;
                $enderecos->cep = $request->cep;
                $req = curl_init(url: "https://viacep.com.br/ws/{$enderecos->cep}/json/");
                curl_setopt($req, option: CURLOPT_RETURNTRANSFER, value: true);
                $result = json_decode(curl_exec($req));

                if (isset($result->erro) && $result->erro === true) {
                    //echo "Houve um erro na API.";                
                } else {
                    $enderecos->logradouro = $result->logradouro;
                    $enderecos->bairro = $result->bairro;
                    $enderecos->complemento = $result->complemento;
                    $enderecos->localidade = $result->localidade;
                    $enderecos->uf = $result->uf;
                }
            }

            return view('telas.endereco', ['endereco' => $enderecos]);

        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Erro ao buscar endereço VIACEP: ' . $e->getMessage());
        }
    }
    public function store(Request $request)
    {
        try {
            $enderecos = new Enderecos;
            $enderecos->cep = $request->cep;
            $enderecos->logradouro = $request->logradouro;
            $enderecos->uf = $request->uf;
            $enderecos->complemento = $request->complemento;
            $enderecos->numero = $request->numero;
            $enderecos->localidade = $request->localidade;
            $enderecos->bairro = $request->bairro;
            $enderecos->save();

            return redirect('/')->with('msg', 'Endereço gravada com sucesso!');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Erro ao atualizar ao gravar: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $enderecos = Enderecos::findOrFail($id);
        return view('telas.enderecoedit', ['endereco' => $enderecos]);
    }

    public function update(Request $request)
    {
        $record = $request->all();
        Enderecos::findOrFail($request->id)->update($record);
        $enderecos = Enderecos::all();
        return view('welcome', ['enderecos' => $enderecos])->with('msg', 'Endereço alterado com sucesso!');
    }

    public function destroy($id)
    {
        Enderecos::findOrFail($id)->delete();
        $enderecos = Enderecos::all();
        return view('welcome', ['enderecos' => $enderecos])->with('msg', 'Endereço deletado com sucesso!');
    }
}
