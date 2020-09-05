@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                @yield('photos')

                {!! form_start($form) !!}
                <div class="card-body">
                    {!! form_rest($form) !!}
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                    <a href="{{ back()->getTargetUrl() }}" class="btn btn-default">Cancel</a>
                </div>
                {!! form_end($form) !!}
            </div>
        </div>
    </div>
@endsection
