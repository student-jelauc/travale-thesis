@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-footer">
                    <a class="btn btn-success" href="{{ route('rooms.create', [$accommodation, $type]) }}"><i class="fa fa-plus"></i> Add room</a>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($rooms as $room)
                            <a href="{{ route('rooms.show', $room) }}" class="list-group-item list-group-item-action">
                                <div class="row">
                                    <div class="col-md-1 align-middle">
                                        <img class="img-thumbnail"
                                             src="{{ $room->photosUrl()->first() ?? asset('images/room-image.svg') }}"
                                             alt="{{ $room->name }}"/>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="row">
                                            <div class="col-9">
                                                <div class="col-12"><h5 class="mb-1">{{ $room->name }}</h5></div>
                                                <div class="col-12">
                                                    {{ strlen($room->description) > 200 ? substr($room->description, 0, 200) . '...' : $room->description }}
                                                </div>
                                                <div class="col-12">
                                                    <small>{{ $room->adults_capacity }} adults, {{ $room->children_capacity }} children, {{ $room->infants_capacity }} infants </small>
                                                </div>
                                            </div>
                                            <div class="col-3 text-right">
                                                <div class="col-12">
                                                    <small>{{ $room->roomType->name }}</small>
                                                </div>
                                                <div class="col-12">
                                                    <small>Floor {{ $room->floor }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="mt-2 ml-3">
                    {{ $rooms->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
