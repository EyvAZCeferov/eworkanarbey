@extends('layouts.app')
@section('title')
    @lang('additional.pages.users.users')
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">@lang('additional.pages.users.users')&nbsp; <a href="{{ route('users.create') }}" class="btn btn-success"><i
                                class="fa fa-plus"></i></a>
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('additional.forms.profile_picture')</th>
                                    <th scope="col">@lang('additional.forms.fincode')</th>
                                    <th scope="col">@lang('additional.forms.username')</th>
                                    <th scope="col">@lang('additional.pages.login.company_information')</th>
                                    <th scope="col">@lang('additional.forms.status')</th>
                                    <th scope="col">@lang('additional.forms.buttons')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (users()->where('is_admin',false) as $dat)
                                    <tr>
                                        <td>
                                            @if (isset($dat->additionalinfo->company_logo) && !empty($dat->additionalinfo->company_logo))
                                                <img src="{{ App\Helpers\Helper::getImageUrl($dat->additionalinfo->company_logo, 'useradditionals') }}"
                                                    alt="{{ $dat->name_surname }}" class="img-fluid img-responsive"
                                                    width="50">
                                            @elseif(isset($dat->profile_picture) && !empty($dat->profile_picture))
                                                <img src="{{ App\Helpers\Helper::getImageUrl($dat->profile_picture, 'useradditionals') }}"
                                                    alt="{{ $dat->name_surname }}" class="img-fluid img-responsive"
                                                    width="50">
                                            @endif
                                        </td>
                                        <td>{{ $dat->fin_code }}</td>
                                        <td>{{ $dat->name_surname }}</td>
                                        <td>{{ !empty($dat->additionalinfo) && isset($dat->additionalinfo->company_name)
                                            ? $dat->additionalinfo->company_name
                                            : trans('additional.pages.login.notacompany') }}
                                        </td>
                                        <td
                                            @if ($dat->status == true) class="text-success" @else class="text-danger" @endif>
                                            @lang('additional.pages.login.status_' . intval($dat->status))
                                        </td>

                                        <td>@include('layouts.partials.table_buttons', [
                                            'edit' => auth()->check() && auth()->user()->hasRole('admin') ? true :false,
                                            'view' => true,
                                            'url' => 'users',
                                            'delete' => auth()->check() && auth()->user()->hasRole('admin') ? true :false,
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
    </div>
@endsection
