@extends('layouts.app')
@section('title')
    @lang('additional.pages.login.myprofile')
@endsection

@push('js')
    <script>
        function uploadnewphoto(input) {
            event.preventDefault();
            var formData = new FormData();
            formData.append('profile_photo', input.files[0]);

            $.ajax({
                url: '{{ route('auth.updateprofile') }}',
                data: formData,
                processData: false,
                contentType: false,
                type: 'post',
                success: function(data) {
                    showalertmessage(data.message, data.status);
                    window.location.href = "{{ url()->current() }}"

                },
                error: function(data) {
                    showalertmessage(data.message, data.status);
                }
            });
        }
    </script>
@endpush
@section('content')
    <div class="container pt-4 px-4">
        <div class="row bg-secondary rounded mx-0">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-sm-12 col-xl-12 mx-auto">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">@lang('additional.pages.login.myprofile')</h6>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <img class="rounded-circle" id="profile_photo"
                                    src="{{ isset($data->profile_picture) && !empty($data->profile_picture) ? App\Helpers\Helper::getImageUrl($data->profile_picture, 'useradditionals') : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png' }}"
                                    alt="{{ $data->name_surname ?? null }}" style="width: 200px; height: 200px;">
                                {{-- <div class="my-2"
                                    style="position:relative;width:100%;
                                height:30px">
                                    <label style="z-index: 11" class="btn btn-warning text-center" for="selectnewimage"><i
                                            class="fa fa-edit"></i> @lang('additional.pages.login.chagephoto')</label>
                                    <input type="file"
                                        style="position: absolute;z-index:2;
                                    top:0;left:0;
                                    right:0;
                                    bottom:0;
                                    width:100%;
                                    height:100%;opacity:0"
                                        id="selectnewimage" name="profile_picture" onchange="uploadnewphoto(this)">
                                </div> --}}
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-">
                                <h3>{{ $data->name_surname }}</h3>
                                <p>@lang('additional.forms.fincode'): {{ $data->fin_code }}</p>
                                <p>@lang('additional.forms.phone'): {{ $data->phone }}</p>
                                <p>@lang('additional.forms.email'): {{ $data->email }}</p>
                                <p>@lang('additional.forms.status'): <span
                                        class="@if ($data->status == 1) text-success @else text-danger @endif ">@lang('additional.pages.login.status_' . intval($data->status))</span>
                                </p>
                            </div>
                        </div>
                        <br>
                        <div class="row my-3 mt-4">
                            <h6 class="mb-4">@lang('additional.pages.login.company_information')</h6>
                        </div>

                        {{-- Coll --}}
                        @if (isset($data->additionalinfo) && !empty($data->additionalinfo))
                            <div class="row my-3">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <img class="rounded-circle" id="profile_photo"
                                        src="{{ isset($data->additionalinfo->company_logo) && !empty($data->additionalinfo->company_logo) ? App\Helpers\Helper::getImageUrl($data->additionalinfo->company_logo, 'useradditionals') : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png' }}"
                                        alt="{{ $data->additionalinfo->company_name ?? null }}"
                                        style="width: 200px; height: 200px;">

                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-">
                                    <h3>{{ $data->additionalinfo->company_name ?? null }}</h3>
                                    <p><b>@lang('additional.forms.description')</b>: {{ $data->additionalinfo->company_description ?? null }}
                                    </p>
                                    <p>VOEN: {{ $data->additionalinfo->company_voen ?? null }}</p>
                                </div>
                            </div>
                        @endif
                        <div class="row my-3 mt-4">
                            <h6 class="mb-4">@lang('additional.pages.welcome.notifications')</h6>
                            <div class="table-responsive">
                                <table class="table table-hover" id="notifications">
                                    <thead>
                                        <tr>
                                            <th scope="col">@lang('additional.forms.title')</th>
                                            <th scope="col">@lang('additional.forms.content')</th>
                                            <th scope="col">@lang('additional.forms.status')</th>
                                            <th scope="col">@lang('additional.forms.via')</th>
                                            <th scope="col">@lang('additional.forms.buttons')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($data->notifications) && !empty($data->notifications))
                                            @foreach ($data->notifications as $notification)
                                                <tr>
                                                    <td>{{ $notification->title }}</td>
                                                    <td>{!! $notification->body !!}</td>
                                                    <td
                                                        @if ($notification->status == true) class="text-success" @else class="text-danger" @endif>
                                                        @lang('additional.pages.notifications.readed_' . intval($notification->status))
                                                    </td>
                                                    <td>
                                                        @if ($notification->via == 1)
                                                            E-mail
                                                        @else
                                                            Sms
                                                        @endif
                                                    </td>
                                                    <td>@include('layouts.partials.table_buttons', [
                                                        'edit' => false,
                                                        'view' => true,
                                                        'url' => 'notifications',
                                                        'delete' => false,
                                                        'id' => $notification->id,
                                                    ])</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row my-3 mt-4">
                            <h6 class="mb-4">@lang('additional.pages.services.services')</h6>
                            <div class="table-responsive">
                                <table class="table table-hover" id="services">
                                    <thead>
                                        <tr>
                                            <th>@lang('additional.forms.title')</th>
                                            <th>@lang('additional.forms.content')</th>
                                            <th>@lang('additional.forms.time')</th>
                                            <th>@lang('additional.forms.buttons')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->servicenotifications as $dat)
                                            <tr>
                                                <td>{{ $dat->name[app()->getLocale() . '_name'] }}</td>
                                                <td>{{ mb_substr($dat->description[app()->getLocale() . '_description'], 0, 200) }}
                                                </td>
                                                <td>
                                                    {{ App\Helpers\Helper::getDateTimeViaTimeStamp($dat->time, false, 'a') }}
                                                </td>

                                                <td>@include('layouts.partials.table_buttons', [
                                                    'edit' => false,
                                                    'view' => true,
                                                    'url' => 'servicenotifications',
                                                    'delete' => false,
                                                    'id' => $dat->id,
                                                ])</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row my-3 mt-4">
                            <h6 class="mb-4">Cihazlar</h6>
                            <div class="table-responsive">
                                <table class="table table-hover" id="devices">
                                    <thead>
                                        <tr>
                                            <th scope="col">IpAddress</th>
                                            <th scope="col">Device</th>
                                            <th scope="col">Adres</th>
                                            <th scope="col">@lang('additional.forms.status')</th>
                                            {{-- <th scope="col">@lang('additional.forms.buttons')</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->devices as $dat)
                                            <tr>
                                                <td>
                                                    {{ $dat->ipaddress }}
                                                </td>
                                                <td>
                                                    @if (!empty($dat->device_data))
                                                        Device: {{ $dat->device_data['device'] }} --OS:
                                                        {{ $dat->device_data['platform'] }} --Browser
                                                        {{ $dat->device_data['browser'] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!empty($dat->address_data))
                                                        City:{{ $dat->address_data['geoplugin_city'] }}
                                                    @endif
                                                </td>
                                                <td
                                                    @if ($dat->status == true) class="text-success" @else class="text-danger" @endif>
                                                    @lang('additional.pages.login.status_' . intval($dat->status))
                                                </td>

                                                {{-- <td>
                                                    <button type="button" class="btn btn-danger btn-block"
                                                        onclick="deletedevice('{{ $dat->id }}')"><i
                                                            class="fa fa-trash"></i></button>
                                                </td> --}}
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
