@extends('admin.layouts.email_template')
@section('content')
@php
    $isCompany = method_exists($user, 'getTable') && $user->getTable() === 'companies';
    if ($isCompany) {
        $activationUrl = route('company.email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email);
        $title = 'Activación de cuenta';
    } else {
        $activationUrl = route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email);
        $title = 'Activación de cuenta';
    }
@endphp
@include('emails.partials.company_notification_shell', [
    'title' => $title,
    'bodyView' => 'emails.partials.account_activation_body',
    'isCompany' => $isCompany,
    'activationUrl' => $activationUrl,
    'user' => $user,
])
@endsection
