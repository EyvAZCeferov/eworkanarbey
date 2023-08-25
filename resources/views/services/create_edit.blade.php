@extends('layouts.app')
@section('title')
    @if (isset($data) && !empty($data))
        @lang('additional.pages.services.service') @lang('additional.pages.services.edit')
    @else
        @lang('additional.pages.services.service') @lang('additional.pages.services.add')
    @endif
@endsection
@push('js')
    {{-- Add Tab --}}
    <script>
        function makeid(length) {
            let result = '';
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            const charactersLength = characters.length;
            let counter = 0;
            while (counter < length) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
                counter += 1;
            }
            return result;
        }

        // <div class="col-sm-6 col-md-6 col-lg-3" id="attributetype_${idofelement}">
        // </div>

        function addareaoftab(type) {
            var idofelement = makeid(11);
            var element =
                `<div class="row my-2 px-3" id="${idofelement}">
                    <input type="hidden" name="area[${idofelement}][type_of_action]" value="2" />
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <label>Qrup</label>
                        <select onchange="changedgroupid('attributetype_${idofelement}','attributegroup_${idofelement}','${idofelement}')" id="attributegroup_${idofelement}" class="form-control" name="area[${idofelement}][group_id]"><option></option>@foreach (attributes()->whereNull('group_id') as $attribute) <option data-type="{{ $attribute->type }}" value="{{ $attribute->id }}" >{{ $attribute->name[app()->getLocale() . '_name'] }}</option> @endforeach</select>
                    </div>
                    
                    <div class="col-sm-6 col-md-6 col-lg-2">
                        <label>Tabloda göstər</label>
                        <input type="checkbox" name="area[${idofelement}][showontable]"/>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-2">
                        <label>Sıra nömrəsi</label>
                        <input class="form-control" name="area[${idofelement}][order_a]" />
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-2 align-center align-items-center justify-content-center justify-center">
                        <button type="button" class='btn btn-danger' onclick="delete_area('${idofelement}')">
                            <i class='fa fa-trash'></i>
                        </button>
                    </div>
                </div>`;

            $(`div#${type}`).append(element);
        }

        // function changedgroupid(id_area, id_select,idofelement) {
        //     var selectvalur = $(`select#${id_select}`).val();
        //     var selectedtype = $('select#' + id_select + ' option:selected').data('type');
        //     $(`div#${id_area}`).empty();
        //     if(selectedtype=="integer"){
        //         $(`div#${id_area}`).append(`<label>Rəqəm</label><input type="integer" class='form-control' name="area[${idofelement}][value]" > `);
        //     }else if(selectedtype=="string"){
        //         $(`div#${id_area}`).append(`<label>Yazı</label><input class='form-control' name="area[${idofelement}][value]" > `);
        //     }else if(selectedtype=="description"){
        //         $(`div#${id_area}`).append(`<label>Açıqlama</label><input class='form-control' name="area[${idofelement}][value]" > `);
        //     }else{
        //         $(`div#${id_area}`).append(`<label>Yazı</label><input class='form-control' name="area[${idofelement}][value]" > `);
        //     }
        // }

        function delete_area(id, type = null) {
            if (type != null && type.length > 0) {
                $.ajax({
                    url: "{{ route('api.deleteserviceattribute') }}",
                    dataType: 'json',
                    data: {
                        element_id: id,
                    },
                    type: 'delete',
                    success: function(data) {
                        if (data.status == "success") {
                            toastr.success(data.message);
                        } else if (data.status == 'error') {
                            toastr.error(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function(data) {
                        if (data.status == "success") {
                            toastr.success(data.message);
                        } else if (data.status == 'error') {
                            toastr.error(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    }
                });
            }
            $(`div#${id}`).remove();
        }
    </script>
    {{-- Add Tab --}}
@endpush
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">
                        @if (isset($data) && !empty($data))
                            @lang('additional.pages.services.service') @lang('additional.pages.services.edit')
                        @else
                            @lang('additional.pages.services.service') @lang('additional.pages.services.add')
                        @endif &nbsp;
                        <a href="{{ route('services.index') }}" class="btn btn-info"><i class="fa fa-home"></i></a>
                    </h6>
                    <div class="row">
                        <form
                            @if (isset($data) && !empty($data)) action="{{ route('services.update', $data->id) }}" @else action="{{ route('services.store') }}" @endif
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
                            <div class="w-100 my-2">
                                <div class="w-100 d">Atributlar &nbsp;<button type="button" class='btn btn-info'
                                        onclick="addareaoftab('attributes_area')"> <i class="fa fa-plus"></i>
                                    </button></div>
                                <div id="attributes_area" class="w-100">
                                    @if (isset($data) && !empty($data) && isset($data->attributes) && !empty($data->attributes))
                                        @foreach ($data->attributes as $tab)
                                            <div class="row my-2 px-3" id="{{ $tab->id }}">
                                                <input type="hidden"
                                                    name="area[{{ $tab->id }}][type_of_action]"
                                                    value="2" />
                                                <div class="col-sm-6 col-md-6 col-lg-4">
                                                    <label>Qrup</label>
                                                    <select
                                                        onchange="changedgroupid('attributetype_{{ $tab->id }}','attributegroup_{{ $tab->id }}','{{ $tab->id }}')"
                                                        id="attributegroup_{{ $tab->id }}" class="form-control"
                                                        name="area[{{ $tab->id }}][group_id]">
                                                        <option></option>
                                                        @foreach (attributes()->whereNull('group_id') as $attribute)
                                                            <option data-type="{{ $attribute->type }}"
                                                                value="{{ $attribute->id }}"
                                                                @if($attribute->id == $tab->attribute_group_id) selected @endif
                                                                >
                                                                {{ $attribute->name[app()->getLocale() . '_name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-sm-6 col-md-6 col-lg-2">
                                                    <label>Tabloda göstər</label>
                                                    <input type="checkbox"

                                                    @if($tab->showontable==true) checked @endif
                                                        name="area[{{ $tab->id }}][showontable]" />
                                                </div>
                                                <div class="col-sm-6 col-md-6 col-lg-2">
                                                    <label>Sıra nömrəsi</label>
                                                    <input class="form-control"
                                                    @if(!empty($tab->order_a)) value="{{ $tab->order_a }}" @endif
                                                        name="area[{{ $tab->id }}][order_a]" />
                                                </div>
                                                <div
                                                    class="col-sm-6 col-md-6 col-lg-2 align-center align-items-center justify-content-center justify-center">
                                                    <button type="button" class='btn btn-danger'
                                                        onclick="delete_area('{{ $tab->id }}','database')">
                                                        <i class='fa fa-trash'></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputIcon" class="form-label">@lang('additional.forms.icon')</label>
                                        @if (isset($data) && !empty($data) && isset($data->icon) && !empty($data->icon))
                                            <img src="{{ App\Helpers\Helper::getImageUrl($data->icon, 'services') }}"
                                                alt="{{ $data->name[app()->getLocale() . '_name'] ?? null }}"
                                                class="img-fluid img-responsive">
                                        @endif
                                        <input type="file" id="exampleInputIcon" class="form-control" name="icon">
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
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">@lang('additional.forms.showondashboard')</label>
                                        <select name="showondashboard" class="form-control">
                                            <option value="1" @if (isset($data) && !empty($data) && $data->showondashboard == true) selected @endif>
                                                @lang('additional.pages.login.status_1')</option>
                                            <option value="0" @if (isset($data) && !empty($data) && $data->showondashboard == false) selected @endif>
                                                @lang('additional.pages.login.status_0')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputTopId" class="form-label">@lang('additional.forms.top_service')</label>
                                        <select name="top_id" class="form-control" id="exampleInputTopId">
                                            <option value=""></option>
                                            @foreach ($services_top as $service)
                                                <option value="{{ $service->id }}"
                                                    @if (isset($data) && !empty($data) && $data->top_id == $service->id) selected @endif>
                                                    {{ $service->name[app()->getLocale() . '_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputOrder" class="form-label">@lang('additional.forms.order')</label>
                                        <input type="number" class="form-control" name="order_a" id="exampleInputOrder"
                                            @if (isset($data) && !empty($data) && !empty($data->order_a)) value="{{ $data->order_a }}" @else value="1" @endif>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 col-lg-3">
                                    <div class="mb-3">
                                        <label for="exampleInputSendInfo" class="form-label">@lang('additional.forms.send_info')</label>
                                        <select name="send_info" class="form-control" id="exampleInputSendInfo">
                                            <option value="1" @if (isset($data) && !empty($data) && $data->send_info == true) selected @endif>
                                                @lang('additional.pages.login.status_1')</option>
                                            <option value="0" @if (isset($data) && !empty($data) && $data->send_info == false) selected @endif>
                                                @lang('additional.pages.login.status_0')</option>
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
