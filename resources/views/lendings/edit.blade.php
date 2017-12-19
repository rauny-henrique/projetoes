@extends('layout')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Emprestimos / Editar: {{ \App\Game::find($lending->game_id)->nome }}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('lendings.update', $lending->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('data')) has-error @endif">
                    <label for="data-field">Data</label>
                    <input type="text" id="data-field" name="data" class="form-control date-picker" value="{{ is_null(old("data")) ? \Carbon\Carbon::parse($lending->data)->format('d/m/Y') : old("data") }}"/>
                    @if($errors->has("data"))
                        <span class="help-block">{{ $errors->first("data") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('friend_id')) has-error @endif">
                    <label for="friend_id-field">Amigo</label>
                    {{ Form::select('friend_id', $friends, $friends, ['placeholder' => 'Selecione...', 'class' => 'form-control']) }}
                    @if($errors->has("friend_id"))
                        <span class="help-block">{{ $errors->first("friend_id") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('game_id')) has-error @endif">
                    <label for="game_id-field">Game</label>
                    {{ Form::select('game_id', $games, $games, ['placeholder' => 'Selecione...', 'class' => 'form-control']) }}
                    @if($errors->has("game_id"))
                        <span class="help-block">{{ $errors->first("game_id") }}</span>
                    @endif
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('lendings.index') }}"><i class="glyphicon glyphicon-backward"></i>  Voltar</a>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('.date-picker').datepicker({
            format: 'dd/mm/yyyy'
        });
    </script>
@endsection
