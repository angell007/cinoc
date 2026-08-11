@extends('admin.layouts.email_template')
@section('content')
@include('emails.partials.company_notification_shell', [
    'title' => 'Registro de Usuario',
    'bodyView' => 'emails.partials.user_registered_admin_body',
])
@endsection
