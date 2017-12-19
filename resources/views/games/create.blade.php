@extends('layout')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Games / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('games.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('nome')) has-error @endif">
                    <label for="nome-field">Nome</label>
                    <input type="text" id="nome-field" name="nome" class="form-control" value="{{ old("nome") }}"/>
                    @if($errors->has("nome"))
                        <span class="help-block">{{ $errors->first("nome") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('platform_id')) has-error @endif">
                    <label for="platform_id-field">Plataforma</label>
                    {{ Form::select('platform_id', $platforms->pluck('nome','id'), null, ['placeholder' => 'Selecione...', 'class' => 'form-control']) }}                    @if($errors->has("platform_id"))
                        <span class="help-block">{{ $errors->first("platform_id") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('status')) has-error @endif">
                    <label for="status-field">Status</label>
                    {{ Form::select('status', ['zerado' => 'Zerado', 'jogando' => 'Jogando', 'pendente' => 'Pendente'], null, ['placeholder' => 'Selecione...', 'class' => 'form-control']) }}                       @if($errors->has("status"))
                        <span class="help-block">{{ $errors->first("status") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('category_id')) has-error @endif">
                    <label for="category_id-field">Categoria</label>
                    {{ Form::select('category_id', $categories->pluck('nome','id'), null, ['placeholder' => 'Selecione...', 'class' => 'form-control']) }}
                    @if($errors->has("category_id"))
                        <span class="help-block">{{ $errors->first("category_id") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('valor')) has-error @endif">
                    <label for="valor-field">Valor</label>
                    <input type="number" id="valor-field" name="valor" class="form-control" value="{{ old("valor") }}"/>
                    @if($errors->has("valor"))
                        <span class="help-block">{{ $errors->first("valor") }}</span>
                    @endif
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('games.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
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
