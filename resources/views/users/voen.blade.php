@extends('layouts.app')
@section('title')
    {{ $voeninfo->company_voen }}
@endsection

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">
                        @lang('additional.pages.users.ownervoeninfo')
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('additional.forms.registry_date')</th>
                                    <th scope="col">@lang('additional.forms.company_version')</th>
                                    <th scope="col">VOEN</th>
                                    <th scope="col">@lang('additional.forms.company_owner_name')</th>
                                    <th scope="col">@lang('additional.forms.company_legal_owner')</th>
                                    <th scope="col">@lang('additional.forms.activity_area')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                    {{ $voeninfo->registry_date ?? null }}
                                    </td>
                                    <td>
                                        @if (isset($voeninfo->company_version) && !empty($voeninfo->company_version) && $voeninfo->company_version == 'mmc')
                                            MMC (Məhdud Məsuliyyətli Cəmiyyət)
                                        @elseif (isset($voeninfo->company_version) && !empty($voeninfo->company_version) && $voeninfo->company_version == 'asc')
                                            ASC (Açıq Səhmdar Cəmiyyət)
                                        @elseif (isset($voeninfo->company_version) && !empty($voeninfo->company_version) && $voeninfo->company_version == 'qsc')
                                            QSC (Qapalı Səhmdar Cəmiyyət)
                                        @elseif (isset($voeninfo->company_version) && !empty($voeninfo->company_version) && $voeninfo->company_version == 'fzk')
                                            Fiziki Şəxs (Fərdi Sahibkar)
                                        @endif
                                    </td>
                                    <td>{{ $voeninfo->company_voen ?? null }}</td>
                                    <td>{{ $voeninfo->company_owner_name ?? null }}
                                    </td>
                                    <td>{{ $voeninfo->company_legal_owner ?? null }}</td>
                                    <td>
                                        {{ $voeninfo->activity_area ?? null }}
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
