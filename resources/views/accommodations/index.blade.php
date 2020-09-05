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
                                        <img class="img-thumbnail" src="{{ asset('images/accommodation-image.svg') }}">
                                    </div>
                                    <div class="col-md-11">
                                        <div class="flex-column align-items-start">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">{{ $accommodation->name }}</h5>
                                                <small>{{ $accommodation->rooms()->count() }} rooms</small>
                                            </div>
                                            <p class="mb-1">
                                                {{ strlen($accommodation->description) > 200 ? substr($accommodation->description, 0, 200) . '...' : $accommodation->description }}
                                            </p>
                                            <small>Donec id elit non mi porta.</small>
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
