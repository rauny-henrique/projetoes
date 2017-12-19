@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Emprestimos {{ '('.$lendings->count().')' }}
            <a class="btn btn-success pull-right" href="{{ route('lendings.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($lendings->count())
                <table class="table table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>DATA DO EMPRESTIMO</th>
                        <th>GAME</th>
                        <th>AMIGO</th>
                        <th class="text-right">OPÇÕES</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($lendings as $lending)
                        <tr>
                            <td>{{$lending->id}}</td>
                            <td>{{ \Carbon\Carbon::parse($lending->data)->format('d/m/Y') }}</td>
                            <td>{{\App\Game::find($lending->game_id)->nome.' ('.\App\Platform::find(\App\Game::find($lending->game_id)->platform_id)->nome.')' }}</td>
                            <td>{{\App\Friend::find($lending->friend_id)->nome}}</td>
                            <td class="text-right">
                                <a class="btn btn-xs btn-primary" href="{{ route('lendings.show', $lending->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                <a class="btn btn-xs btn-warning" href="{{ route('lendings.edit', $lending->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                <form action="{{ route('lendings.destroy', $lending->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $lendings->render() !!}
            @else
                <h3 class="text-center alert alert-info">Vazio!</h3>
            @endif

        </div>
    </div>

@endsection