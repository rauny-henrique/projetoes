@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Reviews {{ '('.$reviews->count().')' }}
            <a class="btn btn-success pull-right" href="{{ route('reviews.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($reviews->count())
                <table class="table table-condensed table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>AUTOR</th>
                        <th>GAME</th>
                        <th>DESCRICAO</th>
                        <th>NOTA</th>
                        <th class="text-right">OPTIONS</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($reviews as $review)
                        <tr>
                            <td>{{$review->id}}</td>
                            <td>{{Auth::user()->name}}</td>
                            <td>{{ \App\Game::find($review->game_id)->nome }}</td>
                            <td>{{$review->descricao}}</td>
                            <td>{{$review->nota}}</td>
                            <td class="text-right">
                                <a class="btn btn-xs btn-primary" href="{{ route('reviews.show', $review->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                <a class="btn btn-xs btn-warning" href="{{ route('reviews.edit', $review->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $reviews->render() !!}
            @else
                <h3 class="text-center alert alert-info">Vazio!</h3>
            @endif

        </div>
    </div>

@endsection