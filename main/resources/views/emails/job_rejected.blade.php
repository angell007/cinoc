@extends('admin.layouts.email_template')
@section('content')
@include('emails.partials.company_notification_shell', [
    'title' => 'Resultado de la revisión',
    'bodyView' => 'emails.partials.job_rejected_body',
])
@endsection
