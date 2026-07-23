@extends('admin.layouts.email_template')
@section('content')
@include('emails.partials.company_notification_shell', [
    'title' => 'Empresa activada',
    'bodyView' => 'emails.partials.company_activated_body',
])
@endsection
