@extends('admin.layouts.email_template')
@section('content')
@include('emails.partials.company_notification_shell', [
    'title' => 'Resultado de su solicitud',
    'bodyView' => 'emails.partials.company_registration_rejected_body',
])
@endsection
