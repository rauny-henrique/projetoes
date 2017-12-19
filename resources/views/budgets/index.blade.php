@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Orçamento
            <a class="btn btn-success pull-right" href="{{ route('budgets.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($budgets->count())
                <table class="table table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>VALOR</th>
                        <th>USER_ID</th>
                        <th class="text-right">OPTIONS</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($budgets as $budget)
                        <tr>
                            <td>{{$budget->id}}</td>
                            <td>{{$budget->valor}}</td>
                            <td>{{$budget->user_id}}</td>
                            <td class="text-right">
                                <a class="btn btn-xs btn-primary" href="{{ route('budgets.show', $budget->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                <a class="btn btn-xs btn-warning" href="{{ route('budgets.edit', $budget->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $budgets->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection