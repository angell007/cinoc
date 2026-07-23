@extends('admin.layouts.email_template')
@section('content')
@include('emails.partials.company_notification_shell', [
    'title' => 'Vacante publicada',
    'bodyView' => 'emails.partials.job_approved_body',
])
@endsection
