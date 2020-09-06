@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <v-select name="accommodation_id" route-name="accommodations.select" placeholder="Select Accommodation"></v-select>
                        </div>
                        <div class="col">
                            <select class="form-control" name="room_type_id">
                                <option>Select Type</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control" name="facilitiy_id[]">
                                <option>Select Facilities</option>
                            </select>
                        </div>
                        <div class="col">
                            <select class="form-control">
                                <option>Select Floor</option>
                            </select>
                        </div>
                    </div>
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
