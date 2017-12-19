@extends('layout')
@section('header')
<div class="page-header">
        <h1>Emprestimos / Detalhes: {{ \App\Game::find($lending->game_id)->nome }}</h1>
        <form action="{{ route('lendings.destroy', $lending->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('lendings.edit', $lending->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <button type="submit" class="btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></button>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{ $lending->id }}</p>
                </div>
                <div class="form-group">
                     <label for="data">Data do emprestimo</label>
                     <p class="form-control-static">{{ \Carbon\Carbon::parse($lending->data)->format('d/m/Y')}}</p>
                </div>
                    <div class="form-group">
                     <label for="friend_id">Amigo</label>
                     <p class="form-control-static">{{ \App\Friend::find($lending->friend_id)->nome }}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('lendings.index') }}"><i class="glyphicon glyphicon-backward"></i> Voltar</a>

        </div>
    </div>

@endsection