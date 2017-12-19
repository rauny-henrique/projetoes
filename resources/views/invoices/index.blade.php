@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Notas Fiscais {{ '('.$invoices->count().')' }}
            {{--<a class="btn btn-success pull-right" href="{{ route('invoices.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>--}}
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($invoices->count())
                <table class="table table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>VALOR</th>
                        <th>DATA</th>
                        <th>CODIGO</th>
                        <th>DESCRICAO</th>
                        <th class="text-right">OPTIONS</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{$invoice->id}}</td>
                            <td>{{ 'R$ '.number_format($invoice->valor, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($invoice->data)->format('d/m/Y') }}</td>
                            <td>{{$invoice->codigo}}</td>
                            <td>{{$invoice->descricao}}</td>
                            <td class="text-right">
                                <a class="btn btn-xs btn-primary" href="{{ route('invoices.show', $invoice->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                <a class="btn btn-xs btn-warning" href="{{ route('invoices.edit', $invoice->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
      {{--                          <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                </form>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $invoices->render() !!}
            @else
                <h3 class="text-center alert alert-info">Vazio!</h3>
            @endif

        </div>
    </div>

@endsection