@extends('accommodations.create')

@section('photos')
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>Photos</label>
                    <dropzone url="{{ route('photos.accommodation', $accommodation) }}"/>
                </div>
            </div>
        </div>
    </div>
@endsection
