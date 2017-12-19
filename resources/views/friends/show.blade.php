@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Amigos / Detalhes: {{$friend->nome}}</h1>
        <form action="{{ route('friends.destroy', $friend->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('friends.edit', $friend->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
                    <p class="form-control-static">{{$friend->id}}</p>
                </div>
                <div class="form-group">
                    <label for="nome">NOME</label>
                    <p class="form-control-static">{{$friend->nome}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('friends.index') }}"><i class="glyphicon glyphicon-backward"></i>  Voltar</a>

        </div>
    </div>

@endsection