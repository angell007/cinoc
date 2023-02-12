<!--Footer-->
<div class="largebanner shadow3">
    <div class="adin">

        <div class="row justify-content-center">
            <!--<div class="col-6 ">-->
                <img style="height: 120px;" src="{{asset('images/logo.jpeg')}}" alt="">
            <!--</div>-->
            <!--<div class="col-6 ">-->
                <img style="height: 120px;" src="{{asset('images/logo-egresados.png')}}" alt="">
                
            <!--<div class="col-6 ">-->
                <img class="mt-2" style="height: 95px; border-radius: 25%" src="{{asset('images/Logo-bolsa-de-empleo.png')}}" alt="">
            <!--</div>-->
                
            <!--</div>-->
            <!--<div>-->
            <!--    <img style="height: 150px;" src="{{asset('images/logo-egresados.png')}}" alt="">-->
            <!--</div>-->
        </div>

        <!-- {!! $siteSetting->above_footer_ad !!} -->

    </div>
    <div class="clearfix"></div>
</div>


<div class="footerWrap">
    <div class="container">
        <div class="row">

            <!--Quick Links-->
            <div class="col-md-4 col-sm-12 text-center">
                <!--  <h5>{{__('Quick Links')}}</h5>
                <!--Quick Links menu Start-->
                <!--  <ul class="quicklinks">
                    <li><a href="{{ route('index') }}">{{__('Home')}}</a></li>
                    <li><a href="{{ route('contact.us') }}">{{__('Contact Us')}}</a></li>
                    <li class="postad"><a href="{{ route('post.job') }}">{{__('Post a Job')}}</a></li>
                  

                </ul>-->
                <!--<div style="color: #ccc;text-align: justify;padding: 0.5px;line-height: 1.5;">-->
                <!--   <a style="color:#fff" href="{{asset('documents/RES 0205 AUTORIZACIÓN ETITC.pdf')}}" target="_blank"-->
                <!--   >  {{__('Linked to the network of providers of the Public Employment Service. Authorized by the Special Administrative Unit of the Public Employment Service according to Resolution No. [xxxx] of [day] of [month] 2021. Terms and conditions')}} </a>-->
                <!--</div>-->
                
                 <!--<a style="color:#fff; text-decoration: underline white; cursor:pointer " href="http://iescinoc.edu.co/politica-de-proteccion-de-datos/" target="_blank"> Política de Protección de Datos Personales </a>-->
                  
                   <h6 style="color:#fff">Institución de Educación Superior </h6>
                   <h6 style="color:#fff">Colegio Integrado</h6>
                   <h6 style="color:#fff">Nacional Oriente de Caldas</h6>
                  <a href="https://bolsaempleo.iescinoc.edu.co/files/OFICIO Y ACUERDO POLITICA DE TRATAMIENTO DE DATOS.pdf" target="_blank">{{__('Política de protección de datos')}}</a>
           
           
           
            </div>
            <!--Quick Links menu end-->




            <!--About Us-->
            <div class="col-md-4 col-sm-12">
                <h5>{{__('Contact Us')}}</h5>
                <h6 style='color:white'>Nit : 890.802.678-4 </h6>
                <div class="address">{{ $siteSetting->site_street_address }}</div>
                <div class="email"> <a href="mailto:{{ $siteSetting->mail_to_address }}">{{ $siteSetting->mail_to_address }}</a> </div>
                <div class="email"> <a href="mailto:egresado@iescinoc.edu.co">egresado@iescinoc.edu.co</a> </div>
                <div class="phone"> <a href="tel:{{ $siteSetting->site_phone_primary }}">{{ $siteSetting->site_phone_primary }}</a></div>
                <div class="phone"> <a href="tel: 321 3564207"> 321 3564207</a></div>
                <div class=""> 
                
                    <!--<a style="color:#fff; text-decoration: underline white; cursor:pointer " href="https://youtu.be/02Slo5k58sw" target="_blank"> Guía rapida </a>-->
                
                
                </div>
                <!-- Social Icons end -->

            </div>
            <!--About us End-->
            
            
            <!--About Us-->
            <div class="col-md-4 col-sm-12">
                <h5>Redes Sociales</h5>
                <!-- Social Icons -->
                <div class="social">@include('includes.footer_social')</div>
                <!-- Social Icons end -->
            <div class="my-3">
                    <!--<a style="color:#fff; text-decoration: underline white; cursor:pointer " href="http://iescinoc.edu.co/politica-de-proteccion-de-datos/" target="_blank"> Política de Protección de Datos Personales </a>-->
                 
                  
                 
                 </div>
            <div class="my-3">

                   <!-- <a class="my-2" style="color:#fff" href="{{asset('documents/Resolución Rectoría 183 junio 09 de 2021 Bolsa Empleo.pdf')}}" target="_blank"-->
                   <!-->Reglamento Bolsa de Empleo</a>-->
                
                 
                 </div>
            </div>
            <!--About us End-->


        </div>
    </div>
</div>
<!--Footer end-->
<!--Copyright-->
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="bttxt">{{__('Copyright')}} &copy; {{date('Y')}} {{ $siteSetting->site_name }}. {{__('All Rights Reserved')}}. </div>
            </div>

        </div>

    </div>
</div>