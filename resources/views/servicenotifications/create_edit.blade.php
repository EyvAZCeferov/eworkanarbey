@extends('layouts.app')
@section('title')
    @if (isset($data) && !empty($data))
        @lang('additional.pages.services.edit') {{ $data->name[app()->getLocale() . '_name'] }}
    @else
        @lang('additional.pages.services.add') {{ $service->name[app()->getLocale() . '_name'] }}
    @endif
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        /* Optional: Style the select box to match your design */
        .select2-container {
            width: 100%;
            margin-bottom: 10px;
        }

        .select2-container .select2-selection--single {
            height: 40px;
            border: 2px solid #ccc;
            border-radius: 4px;
            padding: 8px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.2s ease-in-out;
        }

        .select2-container .select2-selection--single:focus {
            border-color: #2196f3;
        }

        .select2-container .select2-selection--single .select2-selection__arrow {
            height: 40px;
            border-left: 2px solid #ccc;
            transition: border-color 0.2s ease-in-out;
        }

        .select2-container .select2-selection--single .select2-selection__arrow b {
            border-color: #666 transparent transparent transparent;
        }

        .select2-container .select2-selection--single .select2-selection__arrow:hover {
            border-color: #2196f3;
        }

        .select2-container .select2-results__option {
            padding: 8px;
            font-size: 16px;
            transition: background-color 0.2s ease-in-out;
        }

        .select2-container .select2-results__option:hover {
            background-color: #eee;
        }
    </style>
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $("select[name=user_id]").select2({
            width: 'resolve',
        });
    </script>
@endpush
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">
                        @if (isset($data) && !empty($data))
                            @lang('additional.pages.services.edit') {{ $data->name[app()->getLocale() . '_name'] }}
                        @else
                            @lang('additional.pages.services.add') {{ $service->name[app()->getLocale() . '_name'] }}
                        @endif
                        <a href="{{ route('services.show', isset($service) && !empty($service) ? $service->id : $data->service_id) }}"
                            class="btn btn-info"><i class="fa fa-home"></i></a>
                    </h6>
                    <div class="row">
                        <form
                            @if (isset($data) && !empty($data)) action="{{ route('servicenotifications.update', $data->id) }}" @else action="{{ route('servicenotifications.store') }}" @endif
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($data) && !empty($data))
                                @method('PATCH')
                            @endif
                            @if (!isset($data) && empty($data))
                                <input type="hidden" name='service_id' value="{{ $service->id }}">
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
                                @foreach ($service->attributes as $attribute)
                                    @if (!empty($attribute))
                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <div class="mb-3">
                                                <label
                                                    class="form-label">{{ $attribute->attributegroup->name[app()->getLocale() . '_name'] }}</label>
                                                @if ($attribute->attributegroup->type == 'string')
                                                    <input type="text" class="form-control"
                                                        name="area[{{ $attribute->attribute_group_id }}][value]"
                                                        @if(isset($data) && !empty($data) && !empty(servicenotificationattribute($attribute->attribute_group_id,$data->id))) value="{{ servicenotificationattribute($attribute->attribute_group_id,$data->id)->attribute->name[app()->getLocale().'_name'] ?? null }}" @endif
                                                        >
                                                @elseif($attribute->attributegroup->type == 'integer')
                                                    <input type="number" class="form-control"
                                                        name="area[{{ $attribute->attribute_group_id }}][value]"
                                                        @if(isset($data) && !empty($data) && !empty(servicenotificationattribute($attribute->attribute_group_id,$data->id))) value="{{ servicenotificationattribute($attribute->attribute_group_id,$data->id)->attribute->name[app()->getLocale().'_name'] ?? null }}" @endif
                                                        >
                                                @elseif($attribute->attributegroup->type == 'time')
                                                    <input type="date" class="form-control"
                                                        name="area[{{ $attribute->attribute_group_id }}][value]"
                                                        @if(isset($data) && !empty($data) && !empty(servicenotificationattribute($attribute->attribute_group_id,$data->id))) value="{{ servicenotificationattribute($attribute->attribute_group_id,$data->id)->attribute->name[app()->getLocale().'_name'] ?? null }}" @endif
                                                        >
                                                @elseif($attribute->attributegroup->type == 'text')
                                                    <textarea rows="5" class="form-control" name="area[{{ $attribute->attribute_group_id }}][value]">@if(isset($data) && !empty($data) && !empty(servicenotificationattribute($attribute->attribute_group_id,$data->id))) {{ servicenotificationattribute($attribute->attribute_group_id,$data->id)->attribute->name[app()->getLocale().'_name'] ?? null }} @endif</textarea>
                                                @else
                                                    <input type="text" class="form-control"
                                                        name="area[{{ $attribute->attribute_group_id }}][value]"
                                                        @if(isset($data) && !empty($data) && !empty(servicenotificationattribute($attribute->attribute_group_id,$data->id))) value="{{ servicenotificationattribute($attribute->attribute_group_id,$data->id)->attribute->name[app()->getLocale().'_name'] ?? null }}" @endif
                                                        >
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="row my-2">
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputIcon" class="form-label">@lang('additional.forms.pdf')</label>
                                        @if (isset($data) && !empty($data) && isset($data->pdf) && !empty($data->pdf))
                                            <iframe
                                                src="{{ App\Helpers\Helper::getImageUrl($data->pdf, 'servicenotifications') }}"
                                                height="200" width="300"></iframe>
                                        @endif
                                        <input type="file" accept="pdf" id="exampleInputIcon" class="form-control"
                                            name="pdf">
                                    </div>
                                </div>
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
                                @if (!isset($data) && empty($data))
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="mb-3">
                                            <label for="exampleInputTopId" class="form-label">@lang('additional.forms.user')</label>
                                            <select name="user_id"
                                                class="js-example-basic-single js-states js-select2 form-control"
                                                id="exampleInputTopId">
                                                <option value=""></option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if (isset($data) && !empty($data) && $data->user_id == $user->id) selected @endif>
                                                        #{{ $user->fin_code }} {{ $user->name_surname }}
                                                        {{ isset($user->additionalinfo->company_name) && !empty($user->additionalinfo->comapny_name) ? '(' . $user->additional_info->company_name . ')' : null }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="mb-3">
                                            <label for="exampleInputTopId" class="form-label">@lang('additional.forms.user')</label>
                                            <p>#{{ $data->user->fin_code }} --
                                                {{ isset($data->user->additionalinfo->company_name) && !empty($data->user->additionalinfo->comapny_name) ? '(' . $data->user->additional_info->company_name . ')' : $data->user->name_surname }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputOrder" class="form-label">@lang('additional.forms.time')</label>
                                        @if (isset($data) && !empty($data) && !empty($data->time) && isset($data->time) && !empty(trim($data->time)))

                                            <input type="date" class="form-control" name="time"
                                                id="exampleInputOrder" value="{{ \Carbon\Carbon::parse($data->time)->format('Y-m-d') }}">
                                        @else
                                            <input type="date" class="form-control" name="time"
                                                id="exampleInputOrder">
                                        @endif
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
