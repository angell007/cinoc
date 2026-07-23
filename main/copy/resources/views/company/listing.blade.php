@extends('layouts.app')

@section('content')

    <!-- Header start -->
    @include('includes.header')
    <!-- Header end -->

    <!-- Inner Page Title start -->
    @include('includes.inner_page_title', ['page_title' => __('Reportes')])
    <!-- Inner Page Title end -->

    <div class="pageSearch bg py-5">
        <div class="container">
            <section id="joblisting-header" role="search" class="searchform">
                <form id="top-search" method="GET" action="{{ route('company.listing') }}">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10">
                            <div class="input-group">
                                <input type="text" name="search" value="{{ Request::get('search', '') }}"
                                    class="form-control form-control-lg search" placeholder="{{ __('Buscar Empresa') }}" />
                                <div class="input-group-append">
                                    <button type="submit" id="submit-form-top" class="btn btn-dark btn-lg">
                                        <i class="fa fa-search" aria-hidden="true"></i> {{ __('Buscar') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>

    <div class="listpgWraper py-5">
        <div class="container">
            <div class="row">
                @if ($companies)
                    @foreach ($companies as $company)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 shadow-sm hover-shadow">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <a href="{{ route('company.detail', $company->slug) }}">
                                            {{ $company->printCompanyImage() }}
                                        </a>
                                    </div>
                                    <h5 class="card-title">
                                        <a href="{{ route('company.detail', $company->slug) }}" class="text-dark">{{ $company->name }}</a>
                                    </h5>
                                    <p class="card-text text-muted">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $company->location }}
                                    </p>
                                    <p class="card-text">
                                        <i class="fa fa-black-tie" aria-hidden="true"></i>
                                        {{ __('Empleos actuales') }}: {{ $company->countNumJobs('company_id', $company->id) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="mt-5">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="text-muted">
                            {{ __('Mostrando') }} {{ $companies->firstItem() }} a {{ $companies->lastItem() }}
                            {{ __('de') }} {{ $companies->total() }} {{ __('Registros') }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="Page navigation" class="float-md-right">
                            @if (isset($companies) && count($companies))
                                {{ $companies->appends(request()->query())->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer')

@endsection
