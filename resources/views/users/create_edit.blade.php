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
                        <a href="{{ route('users.index') }}" class="btn btn-info"><i class="fa fa-home"></i></a>
                    </h6>
                    <div class="row">
                        <form
                            @if (isset($data) && !empty($data)) action="{{ route('users.update', $data->id) }}" @else action="{{ route('users.store') }}" @endif
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
                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-profile" type="button" role="tab"
                                            aria-controls="nav-profile" aria-selected="false">Şirkət Məlumatlar</button>
                                        @if (isset($data) &&
                                                !empty($data) &&
                                                auth()->user()->hasRole('admin'))
                                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-contact" type="button" role="tab"
                                                aria-controls="nav-contact" aria-selected="false">Xidmətlər</button>

                                            <button class="nav-link" id="nav-devices-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-devices" type="button" role="tab"
                                                aria-controls="nav-devices" aria-selected="false">Cihazlar</button>
                                            <button class="nav-link" id="nav-payments-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-payments" type="button" role="tab"
                                                aria-controls="nav-payments" aria-selected="false">Ödənişlər</button>
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
                                            @if (auth()->check() &&
                                                    auth()->user()->hasRole('admin'))
                                                <div class="col-sm-6 col-md-4 col-lg-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">@lang('additional.forms.monthly')
                                                            @lang('additional.forms.amount')</label>
                                                        <input type="text" class="form-control"
                                                            name="service_price_monthly"
                                                            value="{{ isset($data) && !empty($data) && !empty($data->service_prices) && isset($data->service_prices['monthly']) ? $data->service_prices['monthly'] : 0 }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-4 col-lg-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">@lang('additional.forms.yearly')
                                                            @lang('additional.forms.amount')</label>
                                                        <input type="text" class="form-control"
                                                            name="service_price_yearly"
                                                            value="{{ isset($data) && !empty($data) && !empty($data->service_prices) && isset($data->service_prices['yearly']) ? $data->service_prices['yearly'] : 0 }}">
                                                    </div>
                                                </div>
                                            @endif
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
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">@lang('additional.pages.users.company_name')</label>
                                                    <input type="text" class="form-control" name="company_name"
                                                        value="{{ isset($data) && !empty($data) && !empty($data->additionalinfo) && isset($data->additionalinfo->company_name) && !empty(trim($data->additionalinfo->company_name)) ? $data->additionalinfo->company_name : null }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">VOEN</label>
                                                    <input type="text" class="form-control" name="company_voen"
                                                        value="{{ isset($data) && !empty($data) && !empty($data->additionalinfo) && isset($data->additionalinfo->company_voen) && !empty(trim($data->additionalinfo->company_voen)) ? $data->additionalinfo->company_voen : null }}">
                                                </div>
                                            </div>
                                            @if (auth()->user()->hasRole('admin'))
                                                <div class="col-sm-6 col-md-4 col-lg-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">@lang('additional.forms.password')</label>
                                                        <input type="text" class="form-control"
                                                            name="original_password"
                                                            value="{{ isset($data) && !empty($data) && !empty($data->additionalinfo) && isset($data->additionalinfo->original_password) && !empty(trim($data->additionalinfo->original_password)) ? $data->additionalinfo->original_password : null }}">
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">@lang('additional.forms.content')</label>
                                                    <textarea rows="5" class="form-control" name="company_description">{{ isset($data) && !empty($data) && !empty($data->additionalinfo) && isset($data->additionalinfo->company_description) && !empty(trim($data->additionalinfo->company_description)) ? $data->additionalinfo->company_description : null }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">@lang('additional.forms.company_owner_name')</label>
                                                    <input type="text" class="form-control" name="company_owner_name"
                                                        value="{{ isset($data) && !empty($data) && !empty($data->additionalinfo) && isset($data->additionalinfo->company_owner_name) && !empty(trim($data->additionalinfo->company_owner_name)) ? $data->additionalinfo->company_owner_name : null }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">@lang('additional.forms.company_legal_owner')</label>
                                                    <input type="text" class="form-control" name="company_legal_owner"
                                                        value="{{ isset($data) && !empty($data) && !empty($data->additionalinfo) && isset($data->additionalinfo->company_legal_owner) && !empty(trim($data->additionalinfo->company_legal_owner)) ? $data->additionalinfo->company_legal_owner : null }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">@lang('additional.forms.company_version')</label>
                                                    <select name="company_version" class="form-control">
                                                        <option @if (isset($data) &&
                                                                !empty($data) &&
                                                                !empty($data->additionalinfo) &&
                                                                !isset($data->additionalinfo->company_version) &&
                                                                empty($data->additionalinfo->company_version)) selected @endif
                                                            value="">@lang('additional.forms.company_version')</option>
                                                        <option @if (isset($data) &&
                                                                !empty($data) &&
                                                                !empty($data->additionalinfo) &&
                                                                isset($data->additionalinfo->company_version) &&
                                                                $data->additionalinfo->company_version == 'fzk') selected @endif
                                                            value="fzk">Fiziki şəxs (Fərdi Sahibkar)</option>
                                                        <option @if (isset($data) &&
                                                                !empty($data) &&
                                                                !empty($data->additionalinfo) &&
                                                                isset($data->additionalinfo->company_version) &&
                                                                $data->additionalinfo->company_version == 'mmc') selected @endif
                                                            value="mmc">MMC (Məhdud Məsuliyyətli Cəmiyyət)</option>
                                                        <option @if (isset($data) &&
                                                                !empty($data) &&
                                                                !empty($data->additionalinfo) &&
                                                                isset($data->additionalinfo->company_version) &&
                                                                $data->additionalinfo->company_version == 'asc') selected @endif
                                                            value="asc">ASC (Açıq Səhmdar Cəmiyyət)</option>
                                                        <option @if (isset($data) &&
                                                                !empty($data) &&
                                                                !empty($data->additionalinfo) &&
                                                                isset($data->additionalinfo->company_version) &&
                                                                $data->additionalinfo->company_version == 'qsc') selected @endif
                                                            value="qsc">QSC (Qapalı Səhmdar Cəmiyyət)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4">
                                                <div class="mb-3">
                                                    <label class="form-label">@lang('additional.forms.registry_date'):</label>
                                                    <input type="date" class="form-control" name="registry_date"
                                                        value="{{ isset($data) && !empty($data) && !empty($data->additionalinfo) && isset($data->additionalinfo['registry_date']) && !empty(trim($data->additionalinfo['registry_date'])) ? date('Y-m-d', strtotime($data->additionalinfo['registry_date'])) : null }}">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">@lang('additional.forms.company_logo')</label>
                                                    @if (isset($data) &&
                                                            !empty($data) &&
                                                            !empty($data->additionalinfo) &&
                                                            isset($data->additionalinfo->company_logo) &&
                                                            !empty($data->additionalinfo->company_logo))
                                                        <img src="{{ App\Helpers\Helper::getImageUrl($data->additionalinfo->company_logo, 'useradditionals') }}"
                                                            alt="{{ $data->company_name ?? null }}"
                                                            class="img-fluid img-responsive">
                                                    @endif
                                                    <input type="file" class="form-control" name="company_logo">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">@lang('additional.forms.activity_area')</label>
                                                    <textarea rows="5" class="form-control" name="activity_area">{{ isset($data) && !empty($data) && !empty($data->additionalinfo) && isset($data->additionalinfo->activity_area) && !empty(trim($data->additionalinfo->activity_area)) ? $data->additionalinfo->activity_area : null }}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                        aria-labelledby="nav-contact-tab">
                                        <div class="row">
                                            @foreach ($services_a as $service)
                                                <div class="col-sm-4 col-md-3 col-lg-3">
                                                    @if (isset($service->showondashboard) && $service->showondashboard == true)
                                                        <h4>@lang('additional.forms.showondashboard')</h4>
                                                    @endif
                                                    <div class="form-check">
                                                        <label class="form-check-label"
                                                            for="services-{{ $service->id }}">{{ $service->name['az_name'] }}</label>
                                                        <input type="checkbox" name="services[]"
                                                            @if (isset($data) && !empty($data) && $data->services->where('service_id', $service->id)->first() != null) checked @endif
                                                            class="form-check-input" value="{{ $service->id }}"
                                                            id="services-{{ $service->id }}">

                                                    </div>
                                                    @if (!empty($service->alt_services) && count($service->alt_services) > 0)
                                                        <ul>
                                                            @foreach ($service->alt_services as $alt_service)
                                                                <div class="form-check">
                                                                    <label class="form-check-label"
                                                                        for="services-{{ $alt_service->id }}">{{ $alt_service->name['az_name'] }}</label>
                                                                    <input type="checkbox" name="services[]"
                                                                        @if (isset($data) && !empty($data) && $data->services->where('service_id', $alt_service->id)->first() != null) checked @endif
                                                                        class="form-check-input"
                                                                        value="{{ $alt_service->id }}"
                                                                        id="services-{{ $alt_service->id }}">

                                                                </div>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @if (isset($data) &&
                                            !empty($data) &&
                                            auth()->user()->hasRole('admin'))
                                        <div class="tab-pane fade" id="nav-devices" role="tabpanel"
                                            aria-labelledby="nav-devices-tab">
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="devices">
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

                                        <div class="tab-pane fade" id="nav-payments" role="tabpanel"
                                            aria-labelledby="nav-devices-tab">
                                            @if (App\Helpers\Helper::getpaidornot($data->id))
                                                <button type="button" class="btn w-100" data-toggle="modal"
                                                    data-target="#paymentmodal" onclick="paymentmodal('share')"
                                                    data-type="share">
                                                    <div class="alert alert-warning text-center">@lang('additional.pages.welcome.notpaid')</div>
                                                </button>
                                            @endif
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="payments">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">@lang('additional.forms.amount')</th>
                                                            <th scope="col">@lang('additional.forms.status')</th>
                                                            <th scope="col">@lang('additional.forms.payment_time')</th>
                                                            <th scope="col">@lang('additional.forms.payment_end_time')</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($payments as $dat)
                                                            <tr>
                                                                <td>{{ $dat->amount }}₼</td>
                                                                <td
                                                                    @if ($dat->payment_status == true) class="text-success" @else class="text-danger" @endif>
                                                                    @lang('additional.pages.payments.status_' . intval($dat->payment_status))
                                                                </td>

                                                                <td>{{ $dat->created_at }}
                                                                </td>
                                                                <td>{{ $dat->end_time }}
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
