@extends('layouts.app')
@section('title')
    @lang('additional.pages.services.services')
@endsection


@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">@lang('additional.pages.services.services')&nbsp; @if(auth()->user()->hasRole('admin')) <a href="{{ route('services.create') }}"
                            class="btn btn-success"><i class="fa fa-plus"></i></a> @endif
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('additional.forms.icon')</th>
                                    <th scope="col">@lang('additional.forms.title')</th>
                                    <th scope="col">@lang('additional.forms.status')</th>
                                    <th scope="col">@lang('additional.forms.buttons')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (services() as $dat)
                                    <tr>
                                        <td>
                                            @if (isset($dat->icon) && !empty($dat->icon))
                                                <img src="{{ App\Helpers\Helper::getImageUrl($dat->icon, 'services') }}"
                                                    alt="{{ $dat->name[app()->getLocale() . '_name'] }}"
                                                    class="img-fluid img-responsive" width="50">
                                            @endif
                                        </td>
                                        <td>{{ $dat->name[app()->getLocale() . '_name'] }}</td>
                                        <td
                                            @if ($dat->status == true) class="text-success" @else class="text-danger" @endif>
                                            @lang('additional.pages.login.status_' . intval($dat->status))
                                        </td>

                                        <td>@include('layouts.partials.table_buttons', [
                                            'edit' => auth()->check() && auth()->user()->hasRole('admin') ? true : false,
                                            'view' => $dat->send_info == true ? true : false,
                                            'url' => 'services',
                                            'delete' => auth()->check() && auth()->user()->hasRole('admin') ? true : false,
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
