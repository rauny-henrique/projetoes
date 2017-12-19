@extends('layout')

@section('header')
    @if(!Auth::guest())
        <div class="page-header clearfix">
            <h1>
                Total gasto: {{ ($orcamento) ? 'R$ '.number_format($orcamento->valor, 2) : 'R$ '.number_format(0, 2) }}
            </h1>
            <ul class="nav nav-pills" role="tablist">
                <li role="presentation" class="active"><a href="#">Jogando <span class="badge">{{ $jogando }}</span></a></li>
                <li role="presentation" class="active"><a href="#">Pendente <span class="badge">{{ $pendente }}</span></a></li>
                <li role="presentation" class="active"><a href="#">Zerado <span class="badge">{{ $zerado }}</span></a></li>
            </ul>
            <h1>
                <i class="glyphicon glyphicon-align-justify"></i> Games {{ '('.$total.')' }}
                <a class="btn btn-success pull-right" href="{{ route('games.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
            </h1>

        </div>
    @else
        <div class="page-header clearfix">
            <h1>
                Bem vindo visitante!
            </h1>

        </div>
    @endIf
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if(!Auth::guest())
                @if($games->count())
                <table class="table table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>NOME</th>
                        <th>PLATAFORMA</th>
                        <th>STATUS</th>
                        <th>EMPRESTADO</th>
                        <th>CATEGORIA</th>
                        <th class="text-right">OPTIONS</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($games as $game)
                        <tr>
                            <td>{{$game->id}}</td>
                            <td>{{$game->nome}}</td>
                            <td>{{\App\Platform::find($game->platform_id)->nome}}</td>
                            <td>{{$game->status}}</td>
                            <td>{{ (\App\Lending::where('game_id', $game->id)->first()) ? 'Sim' : 'Não' }}</td>
                            <td>{{\App\Category::find($game->category_id)->nome}}</td>
                            <td class="text-right">
                                <a class="btn btn-xs btn-primary" href="{{ route('games.show', $game->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                <a class="btn btn-xs btn-warning" href="{{ route('games.edit', $game->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                <form action="{{ route('games.destroy', $game->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $games->render() !!}
                @else
                    <h3 class="text-center alert alert-info">Vazio!</h3>
                @endif
            @endif
        </div>
    </div>

@endsection