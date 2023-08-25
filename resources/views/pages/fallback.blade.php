@extends('layouts.app')
@section('title')
    @lang('additional.pages.fallback.pagenotfound')
@endsection
@section('content')
    <!-- 404 Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
            <div class="col-md-6 text-center p-4">
                <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                <h1 class="display-1 fw-bold">404</h1>
                <h1 class="mb-4">@lang('additional.pages.fallback.pagenotfound')</h1>
                <a class="btn btn-primary rounded-pill py-3 px-5" href="{{ route('welcome') }}">@lang('additional.pages.fallback.gohome')</a>
            </div>
        </div>
    </div>
    <!-- 404 End -->
@endsection