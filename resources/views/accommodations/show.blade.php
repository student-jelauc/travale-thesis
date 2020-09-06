@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header border-top">
                    <a class="btn btn-success btn-action" href="{{ route('accommodations.edit', $accommodation) }}"><i
                            class="fas fa-edit"></i> Edit</a>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <gallery
                            :images="{{ $accommodation->photosUrl()->count() ? $accommodation->photosUrl() : collect(asset('images/accommodation-image.svg')) }}"/>
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

        <div class="col-md-12">
            <h1 class="h4 mt-5 mb-4 text-gray-800">Rooms</h1>
            <div class="card border-0 shadow-sm">
                <div class="card-header border-top">
                    <a class="btn btn-success" href="{{ route('rooms.create', $accommodation) }}">
                        <i class="fas fa-plus"></i> Add room</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($roomsTypes as $type)
                            <div class="col-xl-2 col-md-4 mb-4">
                                <a href="{{ route('rooms', [$accommodation, $type]) }}">
                                    <div class="card h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="font-weight-bold text-primary text-uppercase mb-1">
                                                        {{ $type->name }}
                                                    </div>
                                                    <div
                                                        class="h5 mb-0 font-weight-bold text-gray-800">{{ $type->rooms_count }}
                                                        rooms
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-key fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
