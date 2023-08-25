@extends('layouts.app')
@section('title')
    {{ $data->title }}
@endsection
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary rounded mx-0">
            <div class="col-sm-12 col-md-12 col-lg-12 pt-5 text-center">
                <h3>{{ $data->title }}</h3>
                <p>{!! $data->body !!}</p>
                <br />
                <a class="btn btn-info" href="{{ route('notifications.index') }}">@lang('additional.pages.welcome.notifications')</a>
            </div>

        </div>
    </div>
@endsection
