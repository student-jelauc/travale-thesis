@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-top">
                    <a class="btn btn-success" href="{{ route('rooms.edit', $room) }}"><i
                            class="fas fa-edit"></i> Edit</a>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <gallery :images="{{ $room->photosUrl()->count() ? $room->photosUrl() : collect(asset('images/room-image.svg')) }}"/>
                    </div>
                    <div class="col-md-10">
                        {!! form_start($form) !!}
                        <div class="card-body">
                            {!! form_rest($form) !!}
                        </div>
                        {!! form_end($form) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
