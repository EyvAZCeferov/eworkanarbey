@extends('layouts.app')
@section('title')
    @lang('additional.pages.welcome.notifications')
@endsection
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">@lang('additional.pages.welcome.notifications')</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
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
                                @if (isset(auth()->user()->notifications) && !empty(auth()->user()->notifications))
                                    @foreach (auth()->user()->notifications as $notification)
                                        <tr>
                                            <td>{{ $notification->title }}</td>
                                            <td>{!! mb_substr($notification->body,0,200) !!}</td>
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
                                                'id'=>$notification->id,
                                            ])</td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
