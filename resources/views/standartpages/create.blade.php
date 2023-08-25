@extends('layouts.app')
@section('title')
    @if (isset($data) && !empty($data))
        @lang('additional.urls.standartpages') @lang('additional.pages.services.edit')
    @else
        @lang('additional.urls.standartpages') @lang('additional.pages.services.add')
    @endif
@endsection
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">
                        @if (isset($data) && !empty($data))
                            @lang('additional.urls.standartpages') @lang('additional.pages.services.edit')
                        @else
                            @lang('additional.urls.standartpages') @lang('additional.pages.services.add')
                        @endif &nbsp;
                        <a href="{{ route('standartpages.index') }}" class="btn btn-info"><i class="fa fa-home"></i></a>
                    </h6>
                    <div class="row">
                        <form
                            @if (isset($data) && !empty($data)) action="{{ route('standartpages.update', $data->id) }}" @else action="{{ route('standartpages.store') }}" @endif
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($data) && !empty($data))
                                @method('PATCH')
                            @endif
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
                                                name="az_name"
                                                value="{{ isset($data) && !empty($data) && isset($data->name['az_name']) && !empty(trim($data->name['az_name'])) ? $data->name['az_name'] : null }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputAZDESCRIPTION"
                                                class="form-label">@lang('additional.forms.description')</label>
                                            <textarea class="form-control" rows="5" id="exampleInputAZDESCRIPTION" name="az_description">{{ !empty($data) && isset($data->description['az_description']) && !empty(trim($data->description['az_description'])) ? $data->description['az_description'] : null }}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">
                                        <div class="mb-3">
                                            <label for="exampleInputAZNAME" class="form-label">@lang('additional.forms.title')</label>
                                            <input type="text" class="form-control" id="exampleInputAZNAME"
                                                name="ru_name"
                                                value="{{ !empty($data) && isset($data->name['ru_name']) && !empty(trim($data->name['ru_name'])) ? $data->name['ru_name'] : null }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputAZDESCRIPTION"
                                                class="form-label">@lang('additional.forms.description')</label>
                                            <textarea class="form-control" rows="5" id="exampleInputAZDESCRIPTION" name="ru_description">{{ !empty($data) && isset($data->description['ru_description']) && !empty(trim($data->description['ru_description'])) ? $data->description['ru_description'] : null }}</textarea>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                        aria-labelledby="nav-contact-tab">
                                        <div class="mb-3">
                                            <label for="exampleInputAZNAME" class="form-label">@lang('additional.forms.title')</label>
                                            <input type="text" class="form-control" id="exampleInputAZNAME"
                                                name="en_name"
                                                value="{{ !empty($data) && isset($data->name['en_name']) && !empty(trim($data->name['en_name'])) ? $data->name['en_name'] : null }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputAZDESCRIPTION"
                                                class="form-label">@lang('additional.forms.description')</label>
                                            <textarea class="form-control" rows="5" id="exampleInputAZDESCRIPTION" name="en_description">{{ !empty($data) && isset($data->description['en_description']) && !empty(trim($data->description['en_description'])) ? $data->description['en_description'] : null }}</textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">

                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputStatus" class="form-label">@lang('additional.forms.type')</label>
                                        <select name="type" class="form-control" id="exampleInputStatus">
                                            <option value="about" @if (isset($data) && !empty($data) && $data->type == 'about') selected @endif>
                                                Haqqımızda</option>
                                            <option value="termsconditions"
                                                @if (isset($data) && !empty($data) && $data->type == 'termsconditions') selected @endif>
                                                İstifadqə şərtləri</option>
                                            <option value="privarcypolicy"
                                                @if (isset($data) && !empty($data) && $data->type == 'privarcypolicy') selected @endif>
                                                Gizlilik Siyasəti</option>
                                            <option value="muqavilemelumatqqq"
                                                @if (isset($data) && !empty($data) && $data->type == 'muqavilemelumat') selected @endif>
                                                Müqavilə Məlumat</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="row my-2">
                                <button class="btn btn-primary btn-block">@lang('additional.buttons.confirmation')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
