@extends('layouts.app')
@section('title')
    @lang('additional.pages.login.forgetpassword')
@endsection

@section('content')
    <!-- Sign In Start -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="{{ route('welcome') }}" class="navbar-brand mx-4 mb-3">
                            <h3 class="text-primary">
                                <img class="img-responsive img-fluid"
                                    src="{{ isset(setting()->logo_dark_mode) && !empty(setting()->logo_dark_mode) ? App\Helpers\Helper::getImageUrl(setting()->logo_dark_mode, 'settings') : null }}"
                                    alt="{{ setting()->title[app()->getLocale() . '_title'] ?? null }}">
                            </h3>
                        </a>
                    </div>
                    <form method="post" action="{{ route('forgetpassword.form') }}" id="loginform">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="xxxxxxx"
                                name="fin_code">
                            <label for="floatingInput">@lang('additional.forms.fincode')</label>
                        </div>

                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">@lang('additional.pages.login.forgetpassword')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign In End -->
    </div>
@endsection
