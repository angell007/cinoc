@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('PQR')])
<!-- Inner Page Title end -->
<div class="inner-page">
    <!-- About -->
    <div class="container">
        <div class="contact-wrap">
            <div class="title"> <span>{{__('We Are Here For Your Help')}}</span>
                <h2>Formulario PQR</h2>

            </div>
            <!-- Contact Info -->
            <div class="contact-now">
                <div class="row">
                    <div class="col-lg-4 column">
                        <div class="contact"> <span><i class="fa fa-home"></i></span>
                            <div class="information"> <strong>{{__('Address')}}:</strong>
                                <p>{{ $siteSetting->site_street_address }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Contact Info -->
                    <div class="col-lg-4 column">
                        <div class="contact"> <span><i class="fa fa-envelope"></i></span>
                            <div class="information"> <strong>{{__('Email Address')}}:</strong>
                                <p><a href="mailto:{{ $siteSetting->mail_to_address }}">{{ $siteSetting->mail_to_address }}</a></p>
                            </div>

                            <div style="margin-top:10px;text-align:center"> <strong style="text-transform:uppercase;font-weight:900">{{__('Technical Support')}}:</strong>
                                <a href="mailto:{{ $siteSetting->mail_to_address }}">oficinaegresados@iescinoc.edu.co</a>
                            </div>

                        </div>

                    </div>
                    <!-- Contact Info -->
                    <!--<div class="col-lg-4 column">-->
                    <!--    <div class="contact"> <span><i class="fa fa-phone"></i></span>-->
                    <!--        <div class="information"> <strong>{{__('Phone')}}:</strong>-->
                    <!--            <p><img width="20px" height="20px" style="margin-right: 10px" src="https://assets.stickpng.com/images/580b57fcd9996e24bc43c543.png"> <a href="tel:{{ $siteSetting->site_phone_primary }}">{{ $siteSetting->site_phone_primary }}</a></p>-->
                    <!--            <p><a href="tel:{{ $siteSetting->site_phone_secondary }}">{{ $siteSetting->site_phone_secondary }}</a></p>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!-- Contact Info -->
                </div>
                <div class="row">
                    <div class="col-lg-4 column">
                        <img src="{{asset('images/logo.jpeg')}}">
                        <!-- Google Map -->
                        <!-- <div class="googlemap">
                         <iframe src="https://maps.google.it/maps?q={{urlencode(strip_tags($siteSetting->site_google_map))}}&output=embed" allowfullscreen></iframe>
                    </div>-->
                    </div>
                    <!-- Contact form -->
                    <div class="col-lg-8 column">
                        <div class="contact-form">
                            <div id="message"></div>
                            <form method="post" action="{{ route('contact.us')}}" name="contactform" id="contactform">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6{{ $errors->has('full_name') ? ' has-error' : '' }}">
                                        {!! Form::text('full_name', null, array('id'=>'full_name', 'placeholder'=>__('Full Name'), 'required'=>'required', 'autofocus'=>'autofocus')) !!}
                                        @if ($errors->has('full_name')) <span class="help-block text-danger text-danger"> <strong>{{ $errors->first('full_name') }}</strong> </span> @endif
                                    </div>
                                    <div class="col-md-6{{ $errors->has('email') ? ' has-error' : '' }}">
                                        {!! Form::text('email', null, array('id'=>'email', 'placeholder'=>__('Email'), 'required'=>'required')) !!}
                                        @if ($errors->has('email')) <span class="help-block text-danger text-danger"> <strong>{{ $errors->first('email') }}</strong> </span> @endif
                                    </div>
                                    <div class="col-md-6{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        {!! Form::text('phone', null, array('id'=>'phone', 'placeholder'=>__('Phone'))) !!}
                                        @if ($errors->has('phone')) <span class="help-block text-danger text-danger"> <strong>{{ $errors->first('phone') }}</strong> </span> @endif
                                    </div>
                                    <div class="col-md-6{{ $errors->has('subject') ? ' has-error' : '' }}">
                                        {!! Form::text('subject', null, array('id'=>'subject', 'placeholder'=>__('Subject'), 'required'=>'required')) !!}
                                        @if ($errors->has('subject')) <span class="help-block text-danger text-danger"> <strong>{{ $errors->first('subject') }}</strong> </span> @endif
                                    </div>


                                    <!--<div class="col-md-6{{ $errors->has('file') ? ' has-error' : '' }}">-->
                                    <!--    {!! Form::file('subject', null, array('id'=>'file', 'placeholder'=>'file', 'required'=>'required')) !!}-->
                                    <!--    @if ($errors->has('subject')) <span class="help-block text-danger text-danger"> <strong>{{ $errors->first('subject') }}</strong> </span> @endif-->
                                    <!--</div>-->


                                    <div class="col-md-12{{ $errors->has('message_txt') ? ' has-error' : '' }}">
                                        {!! Form::textarea('message_txt', null, array('id'=>'message_txt', 'placeholder'=>__('Message'), 'required'=>'required')) !!}
                                        @if ($errors->has('message_txt')) <span class="help-block text-danger text-danger"> <strong>{{ $errors->first('message_txt') }}</strong> </span> @endif
                                    </div>
                                    <div class="col-md-12{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                        {!! app('captcha')->display() !!}
                                        @if ($errors->has('g-recaptcha-response')) <span class="help-block text-danger text-danger"> <strong>{{ $errors->first('g-recaptcha-response') }}</strong> </span> @endif
                                    </div>
                                    <div class="col-md-12">
                                        <button title="" class="button" type="submit" id="submit">Enviar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')
@endsection