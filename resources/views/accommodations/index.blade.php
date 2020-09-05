@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-footer">
                    <a class="btn btn-success btn-action" href="{{ route('accommodations.create') }}"><i class="fa fa-plus"></i> Add accommodation</a>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($accommodations as $accommodation)
                            <a href="{{ route('accommodations.show', $accommodation) }}" class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-md-1 align-middle">
                                        <img class="img-thumbnail"
                                             src="{{ $accommodation->photosUrl()->first() ?? asset('images/accommodation-image.svg') }}"
                                             alt="{{ $accommodation->name }}"/>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="row">
                                            <div class="col-md-11"><h5 class="mb-1">{{ $accommodation->name }}</h5></div>
                                            <div class="col-md-1"><small class="float-right">{{ $accommodation->rooms()->count() }} rooms</small></div>
                                            <div class="col-md-12">
                                                <p class="mb-1">
                                                    {{ strlen($accommodation->description) > 200 ? substr($accommodation->description, 0, 200) . '...' : $accommodation->description }}
                                                </p>
                                            </div>
                                            <div class="col-md-12">
                                                <small><star-rating value="{{ $accommodation->stars }}" size="15"/></small>
                                                <small class="align-bottom">{{ $accommodation->city->name }} / {{ $accommodation->city->country->name }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="mt-2 ml-3">
                    {{ $accommodations->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
