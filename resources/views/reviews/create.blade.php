@extends('layout')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Reviews / Criar </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('reviews.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('autor')) has-error @endif">
                    <label for="autor-field">Autor</label>
                    <input type="text" id="autor-field" name="autor" class="form-control" value="{{ Auth::user()->name }}"/>
                    @if($errors->has("autor"))
                        <span class="help-block">{{ $errors->first("autor") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('descricao')) has-error @endif">
                    <label for="descricao-field">Descricao</label>
                    <textarea class="form-control" id="descricao-field" rows="3" name="descricao">{{ old("descricao") }}</textarea>
                    @if($errors->has("descricao"))
                        <span class="help-block">{{ $errors->first("descricao") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('nota')) has-error @endif">
                    <label for="nota-field">Nota</label>
                    {{ Form::selectRange('nota', 0, 10, null, ['placeholder' => 'Selecione...', 'class' => 'form-control']) }}
                    @if($errors->has("nota"))
                        <span class="help-block">{{ $errors->first("nota") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('game_id')) has-error @endif">
                    <label for="game_id-field">Game</label>
                    {{ Form::select('game_id', $games, null, ['placeholder' => 'Selecione...', 'class' => 'form-control']) }}
                    @if($errors->has("game_id"))
                        <span class="help-block">{{ $errors->first("game_id") }}</span>
                    @endif
                </div>
                <div style="display: none;" class="form-group @if($errors->has('user_id')) has-error @endif">
                    <label for="user_id-field">User</label>
                    <input type="hidden" id="user_id-field" name="user_id" class="form-control" value="{{ Auth::id() }}"/>
                    @if($errors->has("user_id"))
                        <span class="help-block">{{ $errors->first("user_id") }}</span>
                    @endif
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('reviews.index') }}"><i class="glyphicon glyphicon-backward"></i> Voltar</a>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('.date-picker').datepicker({
        });
    </script>
@endsection
