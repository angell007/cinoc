@extends('layouts.app')
@section('content')
@include('includes.header')
@include('includes.inner_page_title', ['page_title' => 'Mi hoja de vida'])

<div class="listpgWraper">
    <div class="container">
        @include('flash::message')
        @includeIf('user.inc.profile_completion_notice')

        <div class="cv-toolbar mb-3" style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
            <a href="{{ route('my.profile') }}" class="btn btn-default">
                <i class="fa fa-pencil" aria-hidden="true"></i> Actualizar hoja de vida
            </a>
            <a href="{{ route('download.my.cv') }}" class="btn btn-primary">
                <i class="fa fa-download" aria-hidden="true"></i> Descargar PDF
            </a>
            <button type="button" class="btn btn-warning" onclick="window.print();">
                <i class="fa fa-print" aria-hidden="true"></i> Imprimir
            </button>
            <a href="{{ route('view.public.profile', Auth::user()->id) }}" class="btn btn-default">
                <i class="fa fa-eye" aria-hidden="true"></i> Ver perfil público
            </a>
        </div>

        <div class="cv-print-area">
            @include('user.partials.cv_styles')
            @include('user.partials.cv_body')
        </div>
    </div>
</div>

@include('includes.footer')
@endsection

@push('styles')
<style>
    @media print {
        header, footer, .cv-toolbar, .innerpagetitle, .pageTitle, .breadcrumb, .flash-message {
            display: none !important;
        }
        .listpgWraper, .container, .cv-print-area {
            padding: 0 !important;
            margin: 0 !important;
        }
    }
</style>
@endpush
