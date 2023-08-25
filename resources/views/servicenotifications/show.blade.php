@extends('layouts.app')
@section('title')
    {{ $data->name[app()->getLocale() . '_name'] }}
@endsection
@section('description')
    {{ $data->description[app()->getLocale() . '_description'] }}
@endsection
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary rounded mx-0">
            <div class="col-sm-12 col-md-12 col-lg-12 pt-5 text-center">
                <h3>{{ $data->name[app()->getLocale() . '_name'] }}</h3>
                <p>{!! $data->description[app()->getLocale() . '_description'] !!}</p>
                @if (isset($data->pdf) && !empty($data->pdf))
                    <iframe src="{{ App\Helpers\Helper::getImageUrl($data->pdf, 'servicenotifications') }}"
                        style="width: 100%;height:500px" frameborder="0"></iframe>
                @endif
                <a href="{{ route('services.show', $data->service_id) }}" class="btn btn-info"><i class="fa fa-home"></i>@lang('additional.pages.services.services')</a>
            </div>
        </div>
    </div>
@endsection
