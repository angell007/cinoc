@extends('admin.layouts.email_template')
@section('content')
@include('emails.partials.company_notification_shell', [
    'title' => 'Solicitud de registro recibida',
    'bodyView' => 'emails.partials.company_registration_received_body',
])
@endsection
