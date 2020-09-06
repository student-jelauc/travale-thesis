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
                            <v-select name="room_type_id" route-name="room.types.select" placeholder="Select Room Types" multiple></v-select>
                        </div>
                        <div class="col">
                            <v-select name="facility_id" route-name="facilities.select" placeholder="Select Facility" multiple></v-select>
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
