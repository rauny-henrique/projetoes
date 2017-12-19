@extends('layout')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Game / Editar: {{$game->nome}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('games.update', $game->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('nome')) has-error @endif">
                    <label for="nome-field">Nome</label>
                    <input type="text" id="nome-field" name="nome" class="form-control" value="{{ is_null(old("nome")) ? $game->nome : old("nome") }}"/>
                    @if($errors->has("nome"))
                        <span class="help-block">{{ $errors->first("nome") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('platform_id')) has-error @endif">
                    <label for="platform_id-field">Plataforma</label>
                    {{ Form::select('platform_id', $platforms, $platforms, ['placeholder' => 'Selecione...', 'class' => 'form-control']) }}                    @if($errors->has("platform_id"))
                        <span class="help-block">{{ $errors->first("platform_id") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('status')) has-error @endif">
                    <label for="status-field">Status</label>
                    <input type="text" id="status-field" name="status" class="form-control" value="{{ is_null(old("status")) ? $game->status : old("status") }}"/>
                    @if($errors->has("status"))
                        <span class="help-block">{{ $errors->first("status") }}</span>
                    @endif
                </div>
                <div style="display: none;" class="form-group @if($errors->has('lending_id')) has-error @endif">
                    <label for="lending_id-field">Lending_id</label>
                    <input type="hidden" id="lending_id-field" name="lending_id" class="form-control" value="{{ is_null(old("lending_id")) ? $game->lending_id : old("lending_id") }}"/>
                    @if($errors->has("lending_id"))
                        <span class="help-block">{{ $errors->first("lending_id") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('category_id')) has-error @endif">
                    <label for="category_id-field">Categoria</label>
                    {{ Form::select('category_id', $categories, $categories, ['placeholder' => 'Selecione...', 'class' => 'form-control']) }}
                    @if($errors->has("category_id"))
                        <span class="help-block">{{ $errors->first("category_id") }}</span>
                    @endif
                </div>
                <div style="display: none;" class="form-group @if($errors->has('valor')) has-error @endif">
                    <label for="valor-field">Valor</label>
                    <input type="hidden" id="valor-field" name="valor" class="form-control" value="{{ is_null(old("valor")) ? $game->valor : old("valor") }}"/>
                    @if($errors->has("valor"))
                        <span class="help-block">{{ $errors->first("valor") }}</span>
                    @endif
                </div>
                <div style="display: none;" class="form-group @if($errors->has('review_id')) has-error @endif">
                    <label for="review_id-field">Review_id</label>
                    <input type="hidden" id="review_id-field" name="review_id" class="form-control" value="{{ is_null(old("review_id")) ? $game->review_id : old("review_id") }}"/>
                    @if($errors->has("review_id"))
                        <span class="help-block">{{ $errors->first("review_id") }}</span>
                    @endif
                </div>
                <div style="display: none;" class="form-group @if($errors->has('user_id')) has-error @endif">
                    <label for="user_id-field">User_id</label>
                    <input type="hidden" id="user_id-field" name="user_id" class="form-control" value="{{ is_null(old("user_id")) ? $game->user_id : old("user_id") }}"/>
                    @if($errors->has("user_id"))
                        <span class="help-block">{{ $errors->first("user_id") }}</span>
                    @endif
                </div>
                <div style="display: none;" class="form-group @if($errors->has('invoice_id')) has-error @endif">
                    <label for="invoice_id-field">Invoice_id</label>
                    <input type="hidden" id="invoice_id-field" name="invoice_id" class="form-control" value="{{ is_null(old("invoice_id")) ? $game->invoice_id : old("invoice_id") }}"/>
                    @if($errors->has("invoice_id"))
                        <span class="help-block">{{ $errors->first("invoice_id") }}</span>
                    @endif
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('games.index') }}"><i class="glyphicon glyphicon-backward"></i>  Voltar</a>
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
