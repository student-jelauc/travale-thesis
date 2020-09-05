@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-footer">
                    <select class="form-control"><option>Select Hotel</option></select>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($rooms as $room)

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
