@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-footer">
                    <query-filters></query-filters>
                    <overview-filters></overview-filters>
                </div>
                <div class="card-body">
                    @php
                        $accommodation = false;
                        $floor = false;
                    @endphp
                    <div class="row">
                        @foreach($rooms as $room)
                            @if (@$room->accommodation->name !== $accommodation && $accommodation = @$room->accommodation->name)
                                <label class="h3 col-md-12 text-gray-700 mt-3"><span>{{ $accommodation }}</span></label>
                            @endif

                            @if ($room->floor !== $floor && $floor = @$room->floor)
                                <label class="h5 col-md-12 text-gray-500">
                                    <hr/>
                                    Floor {{ $floor }}
                                </label>
                            @endif

                            <div class="btn btn-outline-primary btn-lg m-1">
                                <span class="font-weight-bolder">{{ $room->name }}</span>
                                <div><small class="text-lowercase">{{ @$room->roomType->name }}</small></div>
                            </div>
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
