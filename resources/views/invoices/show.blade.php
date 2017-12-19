@extends('layout')
@section('header')
<div class="page-header">
        <h1>Notas Fiscais / Detalhes: {{$invoice->id}}</h1>
        <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('invoices.edit', $invoice->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                {{--<button type="submit" class="btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></button>--}}
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
                    <p class="form-control-static">{{$invoice->id}}</p>
                </div>
                <div class="form-group">
                     <label for="valor">VALOR</label>
                     <p class="form-control-static">{{ 'R$ '.number_format($invoice->valor, 2) }}</p>
                </div>
                    <div class="form-group">
                     <label for="data">DATA</label>
                     <p class="form-control-static">{{ \Carbon\Carbon::parse($invoice->data)->format('d/m/Y') }}</p>
                </div>
                    <div class="form-group">
                     <label for="codigo">CODIGO</label>
                     <p class="form-control-static">{{$invoice->codigo}}</p>
                </div>
                    <div class="form-group">
                     <label for="descricao">DESCRICAO</label>
                     <p class="form-control-static">{{$invoice->descricao}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('invoices.index') }}"><i class="glyphicon glyphicon-backward"></i>  Voltar</a>

        </div>
    </div>

@endsection