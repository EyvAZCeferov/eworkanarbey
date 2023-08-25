@extends('layouts.app')
@section('title')
    @lang('additional.pages.login.settings')
@endsection
@section('content')
    @if (isset($role) && $role == 'admin')
        <div class="container-fluid pt-4 px-4">
            <div class="row bg-secondary rounded align-items-center justify-content-center mx-0">
                <div class="col-sm-12 col-xl-12 mx-auto">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">@lang('additional.pages.settings.updateinfo')</h6>
                        <form action="{{ route('settings.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-home" type="button" role="tab"
                                            aria-controls="nav-home" aria-selected="true">AZ</button>
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-profile" type="button" role="tab"
                                            aria-controls="nav-profile" aria-selected="false">RU</button>
                                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-contact" type="button" role="tab"
                                            aria-controls="nav-contact" aria-selected="false">EN</button>
                                    </div>
                                </nav>
                                <div class="tab-content pt-3" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <div class="mb-3">
                                            <label for="exampleInputAZNAME" class="form-label">@lang('additional.forms.title')</label>
                                            <input type="text" class="form-control" id="exampleInputAZNAME"
                                                name="az_title"
                                                value="{{ !empty($setting) && isset($setting->title['az_title']) && !empty(trim($setting->title['az_title'])) ? $setting->title['az_title'] : null }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputAZDESCRIPTION"
                                                class="form-label">@lang('additional.forms.description')</label>
                                            <textarea class="form-control" rows="5" id="exampleInputAZDESCRIPTION" name="az_description">{{ !empty($setting) && isset($setting->description['az_description']) && !empty(trim($setting->description['az_description'])) ? $setting->description['az_description'] : null }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputAZOPENHOURS"
                                                class="form-label">@lang('additional.forms.open_hours')</label>
                                            <input type="text" class="form-control" id="exampleInputAZOPENHOURS"
                                                name="az_open_hours"
                                                value="{{ !empty($setting) && isset($setting->open_hours['az_open_hours']) && !empty(trim($setting->open_hours['az_open_hours'])) ? $setting->open_hours['az_open_hours'] : null }}">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">
                                        <div class="mb-3">
                                            <label for="exampleInputAZNAME" class="form-label">@lang('additional.forms.title')</label>
                                            <input type="text" class="form-control" id="exampleInputAZNAME"
                                                name="ru_title"
                                                value="{{ !empty($setting) && isset($setting->title['ru_title']) && !empty(trim($setting->title['ru_title'])) ? $setting->title['ru_title'] : null }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputAZDESCRIPTION"
                                                class="form-label">@lang('additional.forms.description')</label>
                                            <textarea class="form-control" rows="5" id="exampleInputAZDESCRIPTION" name="ru_description">{{ !empty($setting) && isset($setting->description['ru_description']) && !empty(trim($setting->description['ru_description'])) ? $setting->description['ru_description'] : null }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputAZOPENHOURS"
                                                class="form-label">@lang('additional.forms.open_hours')</label>
                                            <input type="text" class="form-control" id="exampleInputAZOPENHOURS"
                                                name="ru_open_hours"
                                                value="{{ !empty($setting) && isset($setting->open_hours['ru_open_hours']) && !empty(trim($setting->open_hours['ru_open_hours'])) ? $setting->open_hours['ru_open_hours'] : null }}">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                        aria-labelledby="nav-contact-tab">
                                        <div class="mb-3">
                                            <label for="exampleInputAZNAME" class="form-label">@lang('additional.forms.title')</label>
                                            <input type="text" class="form-control" id="exampleInputAZNAME"
                                                name="en_title"
                                                value="{{ !empty($setting) && isset($setting->title['en_title']) && !empty(trim($setting->title['en_title'])) ? $setting->title['en_title'] : null }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputAZDESCRIPTION"
                                                class="form-label">@lang('additional.forms.description')</label>
                                            <textarea class="form-control" rows="5" id="exampleInputAZDESCRIPTION" name="en_description">{{ !empty($setting) && isset($setting->description['en_description']) && !empty(trim($setting->description['en_description'])) ? $setting->description['en_description'] : null }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputAZOPENHOURS"
                                                class="form-label">@lang('additional.forms.open_hours')</label>
                                            <input type="text" class="form-control" id="exampleInputAZOPENHOURS"
                                                name="en_open_hours"
                                                value="{{ !empty($setting) && isset($setting->open_hours['en_open_hours']) && !empty(trim($setting->open_hours['en_open_hours'])) ? $setting->open_hours['en_open_hours'] : null }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label"
                                            id="examleInputFavicon">@lang('additional.forms.favicon')</label>
                                        @if (isset($setting->favicon) && !empty($setting->favicon))
                                            <img src="{{ isset($setting->favicon) && !empty($setting->favicon) ? App\Helpers\Helper::getImageUrl($setting->favicon, 'settings') : null }}"
                                                alt="{{ $setting->title[app()->getLocale() . '_title'] ?? null }}"
                                                class="img-responsive img-fluid">
                                        @endif
                                        <input type="file" class="form-control" id="exampleInputFavicon"
                                            name="favicon">
                                    </div>
                                </div> --}}
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label"
                                            id="examleInputLogo">@lang('additional.forms.logo')</label>
                                        @if (isset($setting->logo_dark_mode) && !empty($setting->logo_dark_mode))
                                            <img src="{{ isset($setting->logo_dark_mode) && !empty($setting->logo_dark_mode) ? App\Helpers\Helper::getImageUrl($setting->logo_dark_mode, 'settings') : null }}"
                                                alt="{{ $setting->title[app()->getLocale() . '_title'] ?? null }}"
                                                class="img-responsive img-fluid">
                                        @endif
                                        <input type="file" class="form-control" id="exampleInputLogo" name="logo">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mx-auto">@lang('additional.buttons.update')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container-fluid pt-4 px-4">
            <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
                <div class="col-sm-12 col-xl-6 mx-auto">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">@lang('additional.pages.login.changepassword')</h6>
                        <form action="{{ route('settings.update') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputCurrentPassword" class="form-label">@lang('additional.forms.currentpassword')</label>
                                <input type="text" class="form-control" id="exampleInputCurrentPassword"
                                    name="current_password">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputNewPassword" class="form-label">@lang('additional.forms.newpassword')</label>
                                <input type="text" class="form-control" id="exampleInputNewPassword"
                                    name="new_password">
                            </div>
                            <button type="submit" class="btn btn-primary">@lang('additional.buttons.update')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
