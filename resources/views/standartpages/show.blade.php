@extends('layouts.app')
@section('title')
    {{ $standartpage->name[app()->getLocale() . '_name'] }}
@endsection
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary rounded mx-0">
            <div class="col-sm-12 col-md-12 col-lg-12 pt-5 text-center">
                <h3>{{ $standartpage->name[app()->getLocale() . '_name'] }}</h3>
                <p>{!! $standartpage->description[app()->getLocale().'_description'] !!}</p>
                <br />
            </div>

        </div>
    </div>
@if (auth()->check() && isset(auth()->user()->id))
@else

</div>
@endif

@endsection
