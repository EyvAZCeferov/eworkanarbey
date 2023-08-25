@extends('layouts.app')
@section('title')
    @if (isset($data) && !empty($data))
        Atribut @lang('additional.pages.services.edit')
    @else
        Atribut @lang('additional.pages.services.add')
    @endif
@endsection
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">
                        @if (isset($data) && !empty($data))
                            Atribut @lang('additional.pages.services.edit')
                        @else
                            Atribut @lang('additional.pages.services.add')
                        @endif &nbsp;
                        <a href="{{ route('attributes.index') }}" class="btn btn-info"><i class="fa fa-home"></i></a>
                    </h6>
                    <div class="row">
                        <form
                            @if (isset($data) && !empty($data)) action="{{ route('attributes.update', $data->id) }}" @else action="{{ route('attributes.store') }}" @endif
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

                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">
                                        <div class="mb-3">
                                            <label for="exampleInputAZNAME" class="form-label">@lang('additional.forms.title')</label>
                                            <input type="text" class="form-control" id="exampleInputAZNAME"
                                                name="ru_name"
                                                value="{{ !empty($data) && isset($data->name['ru_name']) && !empty(trim($data->name['ru_name'])) ? $data->name['ru_name'] : null }}">
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

                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">

                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputStatus" class="form-label">@lang('additional.forms.status')</label>
                                        <select name="status" class="form-control" id="exampleInputStatus">
                                            <option value="1" @if (isset($data) && !empty($data) && $data->status == true) selected @endif>
                                                @lang('additional.pages.login.status_1')</option>
                                            <option value="0" @if (isset($data) && !empty($data) && $data->status == false) selected @endif>
                                                @lang('additional.pages.login.status_0')</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputSendInfo" class="form-label">Tip</label>
                                        <select name="type" class="form-control" id="exampleInputSendInfo">
                                            <option value="string" @if (isset($data) && !empty($data) && $data->type == 'string') selected @endif>
                                                Yazı</option>
                                            <option value="integer" @if (isset($data) && !empty($data) && $data->type == 'integer') selected @endif>
                                                Rəqəm</option>
                                            <option value="time" @if (isset($data) && !empty($data) && $data->type == 'time') selected @endif>
                                                Tarix</option>
                                            <option value="text" @if (isset($data) && !empty($data) && $data->type == 'text') selected @endif>
                                                Məlumat (geniş yazı)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="">Aid olduğu qrup</label>
                                        <select name="group_id" class="form-control">
                                            <option value=""></option>
                                            @foreach (attributes()->whereNull('group_id') as $attribute)
                                                <option value="{{ $attribute->id }}"
                                                    @if (isset($data) &&
                                                            !empty($data) &&
                                                            isset($data->group_id) &&
                                                            !empty($data->group_id) &&
                                                            $data->group_id == $attribute->id) selected @endif>
                                                    {{ $attribute->name[app()->getLocale() . '_name'] }}</option>
                                            @endforeach
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
    </div>
    </div>
@endsection
