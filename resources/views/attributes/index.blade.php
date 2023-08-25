@extends('layouts.app')
@section("title")
Atributlar
@endsection


@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Atributlar&nbsp; @if(auth()->user()->hasRole('admin')) <a href="{{ route('attributes.create') }}"
                            class="btn btn-success"><i class="fa fa-plus"></i></a> @endif
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('additional.forms.title')</th>
                                    <th scope="col">Tipi</th>
                                    <th scope="col">@lang('additional.forms.status')</th>
                                    <th scope="col">@lang('additional.forms.buttons')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (attributes() as $dat)
                                @if(empty($dat->group_id) && !isset($dat->group_id))
                                    <tr>

                                        <td>{{ $dat->name[app()->getLocale() . '_name'] }}</td>
                                        <td>{{ $dat->type }}</td>
                                        {{-- <td>@if(isset($dat->group_id) && !empty($dat->group_id)) <span class="text-success">{{ $dat->group->name[app()->getLocale().'_name'] }}</span> @else <span class="text-danger">Yoxdur</span> @endif</td> --}}
                                        <td
                                            @if ($dat->status == true) class="text-success" @else class="text-danger" @endif>
                                            @lang('additional.pages.login.status_' . intval($dat->status))
                                        </td>

                                        <td>@include('layouts.partials.table_buttons', [
                                            'edit' => auth()->check() && auth()->user()->hasRole('admin') ? true : false,
                                            'view' => false,
                                            'url' => 'attributes',
                                            'delete' => auth()->check() && auth()->user()->hasRole('admin') ? true : false,
                                            'id' => $dat->id,
                                        ])</td>
                                    </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
