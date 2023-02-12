@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('Reset Password')])
<!-- Inner Page Title end -->
<!--<div class="listpgWraper">-->
   <div class="container mt-5 p-5">
          <div class="row ">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{__('Reset Password')}}</div>
                    <div class="panel-body">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('company.password.email') }}">
                                                        {{ csrf_field() }}

                             <div class="form-row align-items-center mt-5 mb-2">
                        
                        <div class="col-md-6 offset-2">
                          <label class="sr-only" for="inlineFormInputGroup">Email</label>
                          <div class="input-group mb-2">
                            <div class="input-group-prepend">
                              <div class="input-group-text">@</div>
                            </div>
                            <input type="text" id="email" class="form-control" id="inlineFormInputGroup" name="email" value="{{ old('email') }}" required placeholder="Email">
                            
                             @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                          </div>
                        </div>
                        
                        <div class="col-auto">
                          <button type="submit" class="btn btn-primary mb-2">{{__('Reset')}}!</button>
                        </div>
                      </div>
                      
                            <!--{{ csrf_field() }}-->
                            <!--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">-->
                            <!--    <label for="email" class="col-md-4 control-label">{{__('Email Address')}}</label>-->
                            <!--    <div class="col-md-6">-->
                            <!--        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>-->
                            <!--        @if ($errors->has('email'))-->
                            <!--        <span class="help-block text-danger">-->
                            <!--            <strong>{{ $errors->first('email') }}</strong>-->
                            <!--        </span>-->
                            <!--        @endif-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="form-group">-->
                            <!--    <div class="col-md-6 col-md-offset-4">-->
                            <!--        <button type="submit" class="btn btn-primary">-->
                            <!--            {{__('Send Password Reset Link')}}-->
                            <!--        </button>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--</div>-->
@include('includes.footer')
@endsection