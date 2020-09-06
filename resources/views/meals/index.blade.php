@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header">
                    {!! form_start($form) !!}
                    {!! form_rest($form) !!}
                    <button type="submit" class="ml-2 btn btn-success"><i class="fas fa-plus"></i> Add new meal</button>
                    {!! form_end($form) !!}
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($types as $type)
                            <li class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-10">
                                        {{ $type->name }}
                                    </div>
                                    <div class="col-2 text-right">
                                        @can('delete', $type)
                                            <a href="{{ route('meals.delete', $type) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                        @endcan
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="mt-2 ml-3">
                    {{ $types->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
