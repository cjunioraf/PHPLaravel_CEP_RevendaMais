@extends('layouts.main')

@section('title', 'Busca CEP')

@section('Content')

<div id="cadastro-create-container" class="col-md-5 offset-md-12">

    @csrf

    <form action="/endereco">

        <!-- <div class="col-md-9"> -->

        <h1>Buscar CEP:</h1>

        <div class="row">

            <div class="col-md-9">
                <input type="Numero" class="form-control" id="cep" name="cep"
                    placeholder="Digite o CEP pressione ENTER... " wire:model.lazy="cep" maxlength="8">
            </div>

        </div>

        <!-- </div> -->

    </form>

</div>

<div id="dashboard-title-container" class="col-md-12 offset-md-12">
    <h1>Endereço(s) cadastrado(s)</h1>
</div>

<div id="cadastro-create-container" class="col-md-12 offset-md-12">

    @if(isset($enderecos) && count($enderecos) > 0)

    <table class="table">

        <thead>

            <tr>
                <th scope="col">CEP</th>
                <th scope="col">Logradouro/Numero/Bairro</th>
                <th scope="col">Localidade</th>
                <th scope="col">Ação</th>
            </tr>

        </thead>

        <tbody>

            @foreach($enderecos as $endereco)
            <tr>
                <!-- <td scropt="row">{{ $loop->index + 1 }}</td> -->
                <td>{{ $endereco->cep }}</td>
                <td>{{ $endereco->logradouro }}/{{ $endereco->numero }}/{{ $endereco->bairro }}</td>
                <td>{{ $endereco->localidade }}</td>
                <td>
                    <a href="/telas/enderecoedit/{{ $endereco->id }}" class="btn btn-info edit-btn"><ion-icon
                            name="create-outline"></ion-icon>Editar</a>
                    <form action="/telas/{{ $endereco->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn"><ion-icon
                                name="trash-outline"></ion-icon>Deletar</button>
                    </form>

                </td>
            </tr>
            @endforeach

        </tbody>

    </table>

    @else
    <h4>Não possui endereço cadastrado!</h4>
    @endif

</div>

@endsection