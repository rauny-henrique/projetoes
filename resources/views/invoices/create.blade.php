@extends('layout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Invoices / Create </h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('invoices.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('valor')) has-error @endif">
                       <label for="valor-field">Valor</label>
                    <input type="number" id="valor-field" name="valor" class="form-control" value="{{ old("valor") }}"/>
                       @if($errors->has("valor"))
                        <span class="help-block">{{ $errors->first("valor") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('data')) has-error @endif">
                       <label for="data-field">Data</label>
                    <input type="text" id="data-field" name="data" class="form-control date-picker" value="{{ old("data") }}"/>
                       @if($errors->has("data"))
                        <span class="help-block">{{ $errors->first("data") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('codigo')) has-error @endif">
                       <label for="codigo-field">Codigo</label>
                    <input type="text" id="codigo-field" name="codigo" class="form-control" value="{{ old("codigo") }}"/>
                       @if($errors->has("codigo"))
                        <span class="help-block">{{ $errors->first("codigo") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('descricao')) has-error @endif">
                       <label for="descricao-field">Descricao</label>
                    <textarea class="form-control" id="descricao-field" rows="3" name="descricao">{{ old("descricao") }}</textarea>
                       @if($errors->has("descricao"))
                        <span class="help-block">{{ $errors->first("descricao") }}</span>
                       @endif
                    </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('invoices.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
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
