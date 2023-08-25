@extends('layouts.app')
@section('title')
    @lang('additional.pages.users.admins')
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">@lang('additional.pages.users.admins')&nbsp; <a href="{{ route('admins.create') }}"
                            class="btn btn-success"><i class="fa fa-plus"></i></a>
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('additional.forms.profile_picture')</th>
                                    <th scope="col">@lang('additional.forms.fincode')</th>
                                    <th scope="col">@lang('additional.forms.username')</th>
                                    <th scope="col">@lang('additional.forms.status')</th>
                                    <th scope="col">@lang('additional.forms.buttons')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (users()->where('is_admin',true) as $dat)
                                    <tr>
                                        <td>
                                            @if (isset($dat->image) && !empty($dat->image))
                                                <img src="{{ App\Helpers\Helper::getImageUrl($dat->profile_picture, 'useradditionals') }}"
                                                    alt="{{ $dat->name_surname }}" class="img-fluid img-responsive"
                                                    width="50">
                                            @endif
                                        </td>
                                        <td>{{ $dat->fin_code }}</td>
                                        <td>{{ $dat->name_surname }}</td>
                                        <td
                                            @if ($dat->status == true) class="text-success" @else class="text-danger" @endif>
                                            @lang('additional.pages.login.status_' . intval($dat->status))
                                        </td>

                                        <td>@include('layouts.partials.table_buttons', [
                                            'edit' => true,
                                            'view' => false,
                                            'url' => 'admins',
                                            'delete' => true,
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
