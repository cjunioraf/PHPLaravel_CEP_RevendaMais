@extends('layouts.main')

@section('title', 'Endereço')

@section('Content')

<div id="cadastro-create-container" class="col-md-6 offset-md-3">

    <h1>Cadastro de Endereço:</h1>

    <form action="/telas" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="row" id="row-bloco">

            <div class="col-md-6">
                <div>
                    <label for="cep">CEP:</label>
                    <input type="Numero" class="form-control" id="cep" name="cep" value="{{ $endereco->cep }}"
                        maxlength="8">
                </div>
            </div>

            <div class="col-md-6">

                <div>
                    <label for="logradouro">Logradouro:</label>
                    <input type="text" class="form-control" id="logradouro" name="logradouro"
                        value="{{ $endereco->logradouro }}">
                </div>

            </div>

            <div class="col-md-6">

                <div>
                    <label class="margin-top" for="localidade">Cidade:</label>
                    <input type="text" class="form-control" id="localidade" name="localidade"
                        value="{{ $endereco->localidade }}">
                </div>

            </div>

            <div class="col-md-6">

                <div>
                    <label class="margin-top" for="bairro">Bairro:</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" value="{{ $endereco->bairro }}">
                </div>

            </div>

            <div class="col-md-4">
                <div>
                    <label class="margin-top" for="uf">UF:</label>
                    <input type="text" class="form-control" id="uf" name="uf" value="{{ $endereco->uf }}">
                </div>
            </div>

            <div class="col-md-4">

                <div>
                    <label class="margin-top" for="numero">Número:</label>
                    <input type="Numero" class="form-control" id="numero" name="numero">
                </div>

            </div>

            <div class="col-md-4">

                <div>
                    <label class="margin-top" for="complemento">Complemento:</label>
                    <input type="text" class="form-control" id="complemento" name="complemento"
                        value="{{ $endereco->complemento }}">
                </div>

            </div>

        </div>

        <div class="margin-top">
            <input type="submit" class="btn-salvar" value="Salvar">
        </div>

    </form>

</div>

@endsection