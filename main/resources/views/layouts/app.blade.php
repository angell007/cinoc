<?php
//
if (!isset($seo)) {
    $seo = (object) ['seo_title' => $siteSetting->site_name, 'seo_description' => $siteSetting->site_name, 'seo_keywords' => $siteSetting->site_name, 'seo_other' => '']; //
} ?>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="{{ session('localeDir', 'ltr') }}" dir="{{ session('localeDir', 'ltr') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __($seo->seo_title) }} </title>
    <meta name="Description" content="{!! $seo->seo_description !!}">
    <meta name="Keywords" content="{!! $seo->seo_keywords !!}">
    <meta name="csrf-token" id="csrf_token" content="{{ csrf_token() }}"> {!! $seo->seo_other !!}
    <!--Fav Icon -->
    <link rel="shortcut icon" href="https://bolsaempleo.iescinoc.edu.co/images/logo.jpeg">
    <!--Slider -->
    <link href="{{ asset('/') }}js/revolution-slider/css/settings.css" rel="stylesheet">
    <!--Owl carousel -->
    <link href="{{ asset('/') }}css/owl.carousel.css" rel="stylesheet">
    <!--Bootstrap -->
    <link href="{{ asset('/') }}css/bootstrap.min.css" rel="stylesheet">
    <!--Font Awesome -->
    <link href="{{ asset('/') }}css/font-awesome.css" rel="stylesheet">
    <!--Custom Style -->
    <link href="{{ asset('/') }}css/main.css?r=6" rel="stylesheet">
    @if (session('localeDir', 'ltr') == 'rtl')
        <!--Rtl Style -->
        <link href="{{ asset('/') }}css/rtl-style.css" rel="stylesheet">
    @endif
    <link href="{{ asset('/') }}admin_assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/') }}admin_assets/global/plugins/select2/css/select2.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/') }}admin_assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <!--HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
<script src="{{ asset('/') }}js/html5shiv.min.js"></script>
<script src="{{ asset('/') }}js/respond.min.js"></script> <![endif]--> @stack('styles')
    <style>
        .custom-select {
            style="width: 150px;"
            /*width: 100%;*/
            /*text-overflow: ellipsis;*/
            /*overflow: hidden;*/
            /*max-width: 100%;*/
            /*white-space:nowrap;*/
        }

        option {
            width: 200px !important;
            /*text-overflow: ellipsis;*/
            overflow: hidden;
            /*max-width: 100%;*/
            /*white-space:nowrap;*/
            /*overflow: hidden;*/
            white-space: normal;
        }

        @media only screen and (max-width: 600px) {
            .logo {
                max-width: 100% !important;
            }
        }

        @media only screen and (min-width: 600px) {
            .logo {
                max-width: 300% !important;
            }
        }
    </style>
    <!--Global site tag (gtag.js) - Google Analytics -->
    <script async src="https:// www.googletagmanager.com/gtag/js?id=UA-159331368-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-159331368-1');
    </script>
</head>

<body> @yield('content')
    <!--Bootstrap's JavaScript -->
    <script src="{{ asset('/') }}js/jquery.min.js"></script>
    <script src="{{ asset('/') }}js/bootstrap.min.js"></script>
    <script src="{{ asset('/') }}js/popper.js"></script>
    <!--Owl carousel -->
    <script src="{{ asset('/') }}js/owl.carousel.js"></script>
    <script src="{{ asset('/') }}admin_assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
        type="text/javascript"></script>
    <script src="{{ asset('/') }}admin_assets/global/plugins/Bootstrap-3-Typeahead/bootstrap3-typeahead.min.js"
        type="text/javascript"></script>
    <!--END PAGE LEVEL PLUGINS -->
    <script src="{{ asset('/') }}admin_assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript">
    </script>
    <script src="{{ asset('/') }}admin_assets/global/plugins/jquery.scrollTo.min.js" type="text/javascript"></script>
    <!--Revolution Slider -->
    <script type="text/javascript" src="{{ asset('/') }}js/revolution-slider/js/jquery.themepunch.tools.min.js">
    </script>
    <script type="text/javascript" src="{{ asset('/') }}js/revolution-slider/js/jquery.themepunch.revolution.min.js">
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> {!! NoCaptcha::renderJs() !!} @stack('scripts')
    <!--Custom js -->
    <script src="{{ asset('/') }}js/script.js"></script>
    <script type="text/JavaScript">
        $(document).ready(function(){ $('.textC').on('input',function(e){ var words= $(this).val().split(" ").length+$(this).val().split("\n").length-1 
                                          
                                            if(words>=250){ $(this).val(text) }else{ text=$(this).val() } }) 

                                            $("#description").on('keyup',function(){ })

                                             $(".number-1").each(function() {$(this).val(currency($(this).val())); });

                                              $(".number-1").on({ "focus": function (event) { $(event.target).select(); },

                                              "input":function (event) { $(event.target).val(currency($(event.target).val())) } }); 

                                              $('select').select2(); 

                                              $('.selected-remote').select2({ width:'resolve', theme:'classic', ajax: { url: '/api/proffesions', dataType: 'json' } }); 

                                              $(document).scrollTo('.has-error', 2000); }); 

                                              function currency(textCurrency){
                                                
                                                var salary_from = textCurrency

                                                salary_from = salary_from.replace('$','').replace(/,/g,'') 
                                               
                                               if(salary_from.includes('.00'))
                                               { salary_from = salary_from.replace(".00","") } 

                                               if(salary_from.includes('.0') && !salary_from.includes('.00'))
                                               { 
                                                salary_from = salary_from.replace(".0","")
                                                salary_from = salary_from.substring(0, salary_from.length - 1); 
                                            } 

                                               if(salary_from != '' && !parseFloat(salary_from).toString().includes(NaN))
                                                { salary_from = '$' + parseFloat(parseInt(salary_from), 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString(); }

                                               else{ salary_from =''; } 
                                            
                                            return salary_from; } 

                                            function  showProcessingForm(btn_id){ 
                                                $("#"+btn_id).val( 'Processing .....' );
                                                $("#"+btn_id).attr('disabled','disabled'); 
                                            } 

                                        </script>
</body>

</html>
