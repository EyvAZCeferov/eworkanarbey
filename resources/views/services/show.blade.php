@extends('layouts.app')
@section('title')
    {{ $service->name[app()->getLocale() . '_name'] }}
@endsection
@section('description')
    @if (isset($service->description[app()->getLocale() . '_description']))
        {{ $service->description[app()->getLocale() . '_description'] }}
    @endif
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        @if (auth()->check() && auth()->user()->is_admin == false && count($data) == 0)
            <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
                <div class="col-md-6 text-center">
                    <h3>{{ $service->name[app()->getLocale() . '_name'] }}</h3>
                    <h3>@lang('additional.pages.services.notinformation')</h3>
                </div>
            </div>
        @else
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4">{{ $service->name[app()->getLocale() . '_name'] }} @if (auth()->user()->hasRole('admin') ||
                                auth()->user()->hasRole('moderator'))
                                &nbsp;<a class="btn btn-success"
                                    href="{{ route('servicenotifications.create', ['slug' => $service->slugs[app()->getLocale() . '_slug']]) }}"><i
                                        class="fa fa-plus"></i></a>
                            @endif
                        </h6>
                        @if (isset($service->description) &&
                                !empty($service->description) &&
                                isset($service->description[app()->getLocale() . '_description']) &&
                                !empty($service->description[app()->getLocale() . '_description']))
                            <p>{{ $service->description[app()->getLocale() . '_description'] }}</p>
                            <br>
                        @endif
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0" id="example">
                                <thead>
                                    <tr>
                                        <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                        <th>@lang('additional.forms.time')</th>

                                        @foreach ($tableheaders as $header)
                                            <th>{{ $header['name'] ?? null }}</th>
                                        @endforeach
                                        @if (auth()->check() && auth()->user()->is_admin == true)
                                            <th>@lang('additional.forms.user')</th>
                                        @endif

                                        <th>@lang('additional.forms.buttons')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dat)
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox"></td>
                                            <td>
                                                {{ $formattedDate = \Carbon\Carbon::parse($dat->time)->format('d.m.Y') }}
                                            </td>
                                            @foreach ($tableheaders as $header)
                                                <td>
                                                    @if ($header['variable'] == 'name')
                                                        @if ($header['type'] == 'data')
                                                            {{ $dat->name[app()->getLocale() . '_name'] }}
                                                        @else
                                                            {{ servicenotificationattribute($header['model']->attribute_group_id,$dat->id)->attribute->name[app()->getLocale().'_name'] ?? null }}
                                                        @endif
                                                    @elseif($header['variable'] == 'description')
                                                        @if ($header['type'] == 'data')
                                                            {{ mb_substr($dat->description[app()->getLocale() . '_description'], 0, 200) }}
                                                        @endif
                                                    @endif
                                                </td>
                                            @endforeach


                                            @if (auth()->check() && auth()->user()->is_admin == true)
                                                <td>
                                                    #{{ $dat->user->fin_code }} --
                                                    {{ isset($dat->user->additionalinfo->company_name) && !empty($dat->user->additionalinfo->comapny_name) ? '(' . $dat->user->additional_info->company_name . ')' : $dat->user->name_surname }}
                                                </td>
                                            @endif

                                            <td>@include('layouts.partials.table_buttons', [
                                                'edit' =>
                                                    (auth()->check() &&
                                                        auth()->user()->hasRole('admin')) ||
                                                    (auth()->check() &&
                                                        auth()->user()->hasRole('moderator'))
                                                        ? true
                                                        : false,
                                                'view' => true,
                                                'url' => 'servicenotifications',
                                                'delete' =>
                                                    auth()->check() &&
                                                    auth()->user()->hasRole('admin')
                                                        ? true
                                                        : false,
                                                'id' => $dat->id,
                                            ])</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
