@extends('layouts.app')
@section('title')
    @lang('additional.urls.standartpages')
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">@lang('additional.urls.standartpages')&nbsp; <a href="{{ route('standartpages.create') }}"
                        class="btn btn-success"><i class="fa fa-plus"></i></a>
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr>

                                    <th scope="col">@lang('additional.forms.title')</th>
                                    <th scope="col">@lang('additional.forms.content')</th>
                                    <th scope="col">@lang('additional.forms.buttons')</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach (standartpages() as $dat)
                                    <tr>
                                        <td>{{ $dat->name[app()->getLocale().'_name'] }}</td>
                                        <td>
                                            {{ mb_substr(App\Helpers\Helper::strip_tags_with_whitespace($dat->description[app()->getLocale().'_description']),0,300) }}
                                        </td>

                                        <td scope="col">@include('layouts.partials.table_buttons', [
                                            'edit' => auth()->check() && auth()->user()->hasRole('admin') ? true : false,
                                            'view' => true,
                                            'url' => 'standartpages',
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
