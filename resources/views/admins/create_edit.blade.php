@extends('layouts.app')
@section('title')
    @if (isset($data) && !empty($data))
        {{ $data->name_surname }} @lang('additional.pages.services.edit')
    @else
        @lang('additional.pages.users.users') @lang('additional.pages.services.add')
    @endif
@endsection

@push('js')
    <script>
        function deletedevice(id) {
            event.preventDefault();
            var posting = $.ajax({
                url: '{{ route('auth.deletedevice') }}',
                dataType: 'json',
                data: {
                    device_id: id,
                },
                type: 'delete',
                success: function(data) {
                    showalertmessage(data.message, data.status);
                },
                error: function(data) {
                    showalertmessage(data.message, data.status);
                }
            });
        }
    </script>
@endpush

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">
                        @if (isset($data) && !empty($data))
                            {{ $data->name_surname }} @lang('additional.pages.services.edit')
                        @else
                            @lang('additional.pages.users.users') @lang('additional.pages.services.add')
                        @endif &nbsp;
                        <a href="{{ route('admins.index') }}" class="btn btn-info"><i class="fa fa-home"></i></a>
                    </h6>
                    <div class="row">
                        <form
                            @if (isset($data) && !empty($data)) action="{{ route('admins.update', $data->id) }}" @else action="{{ route('admins.store') }}" @endif
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
                                            aria-controls="nav-home" aria-selected="true">Şəxsi məlumatlar</button>
                                        @if (isset($data) && !empty($data))
                                            <button class="nav-link" id="nav-devices-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-devices" type="button" role="tab"
                                                aria-controls="nav-devices" aria-selected="false">Cihazlar</button>
                                        @endif
                                    </div>
                                </nav>
                                <div class="tab-content pt-3" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label for="exampleInputAZNAME"
                                                        class="form-label">@lang('additional.forms.username')</label>
                                                    <input type="text" class="form-control" id="exampleInputAZNAME"
                                                        name="name_surname"
                                                        value="{{ isset($data) && !empty($data) && isset($data->name_surname) && !empty(trim($data->name_surname)) ? $data->name_surname : null }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">@lang('additional.forms.fincode')</label>
                                                    <input type="text" class="form-control" name="fin_code"
                                                        value="{{ isset($data) && !empty($data) && isset($data->fin_code) && !empty(trim($data->fin_code)) ? $data->fin_code : null }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">@lang('additional.forms.email')</label>
                                                    <input type="text" class="form-control" name="email"
                                                        value="{{ isset($data) && !empty($data) && isset($data->email) && !empty(trim($data->email)) ? $data->email : null }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">@lang('additional.forms.phone')</label>
                                                    <input type="text" class="form-control" name="phone"
                                                        value="{{ isset($data) && !empty($data) && isset($data->phone) && !empty(trim($data->phone)) ? $data->phone : null }}">
                                                    <span class="w-100 text-center text-muted">0501112233</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">@lang('additional.forms.status')</label>
                                                    <select name="status" class="form-control">
                                                        <option value="1"
                                                            @if (isset($data) && !empty($data) && $data->status == 1) selected @endif>
                                                            @lang('additional.pages.login.status_1')</option>
                                                        <option value="0"
                                                            @if (isset($data) && !empty($data) && $data->status == 0) selected @endif>
                                                            @lang('additional.pages.login.status_0')</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">@lang('additional.forms.profile_picture')</label>
                                                    @if (isset($data) && !empty($data) && isset($data->profile_picture) && !empty($data->profile_picture))
                                                        <img src="{{ App\Helpers\Helper::getImageUrl($data->profile_picture, 'useradditionals') }}"
                                                            alt="{{ $data->name_surname ?? null }}"
                                                            class="img-fluid img-responsive">
                                                    @endif
                                                    <input type="file" class="form-control" name="profile_picture">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    @if (isset($data) && !empty($data))
                                                        <label class="form-label">@lang('additional.forms.newpassword')</label>
                                                        <input type="password" class="form-control" name="new_password">
                                                    @else
                                                        <label class="form-label">@lang('additional.forms.password')</label>
                                                        <input type="password" class="form-control" name="password"
                                                            value="{{ isset($data) && !empty($data) && isset($data->password) && !empty(trim($data->password)) ? $data->password : null }}">
                                                    @endif


                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">Role</label>

                                                    <select name="role" class="form-control">

                                                        @foreach (\Spatie\Permission\Models\Role::all() as $role)
                                                            <option @if(isset($data) && !empty($data) && $data->hasRole($role->name)) selected @endif value="{{ $role->name }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if (isset($data) && !empty($data))
                                        <div class="tab-pane fade" id="nav-devices" role="tabpanel"
                                            aria-labelledby="nav-devices-tab">
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="example">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">IpAddress</th>
                                                            <th scope="col">Device</th>
                                                            <th scope="col">Adres</th>
                                                            <th scope="col">@lang('additional.forms.status')</th>
                                                            <th scope="col">@lang('additional.forms.buttons')</th>
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

                                                                <td>
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-block"
                                                                        onclick="deletedevice('{{ $dat->id }}')"><i
                                                                            class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
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
