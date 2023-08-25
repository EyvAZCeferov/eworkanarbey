@extends('layouts.app')
@section('title')
    @lang('additional.pages.welcome.payments')
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">@lang('additional.pages.welcome.payments')
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr>
                                    @if (auth()->user()->hasRole('admin'))
                                        <th scope="col">@lang('additional.forms.username')</th>
                                    @endif
                                    <th scope="col">@lang('additional.forms.amount')</th>
                                    <th scope="col">@lang('additional.forms.status')</th>
                                    <th scope="col">@lang('additional.forms.payment_time')</th>
                                    <th scope="col">@lang('additional.forms.payment_end_time')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dat)
                                    <tr>
                                        @if (auth()->user()->hasRole('admin'))
                                            <td><a href="{{ route('users.edit',$dat->user_id) }}">#{{ $dat->user->fin_code }} {{ $dat->user->name_surname }}</a></td>
                                        @endif
                                        <td>{{ $dat->amount }}₼</td>
                                        <td
                                            @if ($dat->payment_status == true) class="text-success" @else class="text-danger" @endif>
                                            @lang('additional.pages.payments.status_' . intval($dat->payment_status))
                                        </td>

                                        <td>{{ $dat->created_at }}</td>
                                        <td>{{ $dat->end_time}}</td>
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
