@extends('layout')
@section('header')
    <div class="page-header">
        <h1>Game / Detalhes: {{$game->nome}}</h1>
        <form action="{{ route('games.destroy', $game->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('games.edit', $game->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
                    <p class="form-control-static">{{$game->id}}</p>
                </div>
                <div class="form-group">
                    <label for="nome">NOME</label>
                    <p class="form-control-static">{{$game->nome}}</p>
                </div>
                <div class="form-group">
                    <label for="platform_id">PLATAFORMA</label>
                    <p class="form-control-static">{{\App\Platform::find($game->platform_id)->nome}}</p>
                </div>
                <div class="form-group">
                    <label for="status">STATUS</label>
                    <p class="form-control-static">{{$game->status}}</p>
                </div>
                <div class="form-group">
                    <label for="lending_id">EMPRESTADO</label>
                    <p class="form-control-static">{{ (\App\Lending::where('game_id', $game->id)->first()) ? 'Sim' : 'Não' }}</p>
                </div>
                <div class="form-group">
                    <label for="category_id">CATEGORIA</label>
                    <p class="form-control-static">{{\App\Category::find($game->category_id)->nome}}</p>
                </div>
                <div class="form-group">
                    <label for="valor">VALOR</label>
                    <p class="form-control-static">{{$game->valor}}</p>
                </div>
                <div class="form-group">
                    <label for="review_id">REVIEW</label>
                    @if($reviews->count())
                        @foreach($reviews as $review)
                            <p class="form-control-static">{{ $review->descricao }}</p>
                        @endforeach
                    @else
                        <p class="form-control-static">{{ 'Sem reviews' }}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="invoice_id">NOTA FISCAL</label>
                    <p class="form-control-static">Código: {{\App\Invoice::find($game->id)->codigo}}</p>
                    <p class="form-control-static">Valor: {{ 'R$ '.number_format(\App\Invoice::find($game->id)->valor, 2) }}</p>
                    <p class="form-control-static">Data: {{\App\Invoice::find($game->id)->data}}</p>
                    <p class="form-control-static">Descrição: {{\App\Invoice::find($game->id)->descricao}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('games.index') }}"><i class="glyphicon glyphicon-backward"></i>  Voltar</a>

        </div>
    </div>

@endsection