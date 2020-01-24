@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                {!! form_start($form) !!}
                <div class="card-body">
                    {!! form_rest($form) !!}
                </div>
                {!! form_end($form) !!}
            </div>
        </div>
    </div>
@endsection
