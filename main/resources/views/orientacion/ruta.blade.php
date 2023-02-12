@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title'=>__('My Profile')])
<!-- Inner Page Title end -->
<div class="listpgWraper">
  <div class="container">
    <div class="row">

      @if(Auth::guard('web')->user())
      @include('includes.user_dashboard_menu')

      @endIf

      @if(Auth::guard('company')->user())
      @include('includes.company_dashboard_menu')

      @endIf



      <div class="col-md-9 col-sm-8 ">

        <div class="blog-single gray-bg ">
          <div class="container card ">
            <div class="row align-items-start p-5 ">
              <div class="col-lg-8  m-15px-tb">
                <article class="article">
                  <div class="article-title">
                    <!--<h6><a href="#">Lifestyle</a></h6>-->
                    <p><u><b class="font-weight-bolder">Hoja de ruta de servicios al empleador manual.</b></u></p>
                    <div class="media">
                      <div class="avatar">
                        <!--<img src="https://bootdey.com/img/Content/avatar/avatar1.png" title="" alt="">-->
                      </div>

                    </div>
                  </div>

                  <br>
                  <br>
                  <br>
                  <div class="article-img">
                    <img src="https://bolsaempleo.iescinoc.edu.co/images/hoja.png" title="" alt="">
                  </div>


                  <br>
                  <br>
                  <br>

                  <div class="article-content">
<p style="text-align: justify;">En instructivo adjunto encontrar&aacute; el paso a paso para el ingreso a la bolsa de empleo<span size="3">&nbsp;de la IES-</span>CINOC<span size="3">, el registro como empleador, la publicaci&oacute;n de vacantes, el proceso de preselecci&oacute;n de candidatos y dem&aacute;s. Es de aclarar para las empresas vinculadas a la bolsa de empleo de la IES CINOC que todos los servicios que nosotros pr&eacute;stamos a ustedes no tienen ning&uacute;n costo, igualmente no se realizar&aacute;n visitas a las instalaciones de cada potencial empleador ya que nuestra bolsa de empleo es virtual restringida, por tal motivo se prestaran los servicios por herramientas tecnol&oacute;gicas.&nbsp;</span>Esperamos que este manual sea de gran apoyo para satisfacer las necesidades de los usuarios.</p>
                  
                  
                  <br>
                  <br>
                  <br>
                  
                  <p style="text-align: justify;"><a href="/documents/Manual-de-uso-empresas.pdf" download>Hoja de ruta de servicios al empleador manual</a> </p>
                  
                  
                  </div>
                </article>
              </div>
              <div class="col-lg-4  m-15px-tb blog-aside">
                <div class="widget widget-author ">
                  <div class="widget-title">
                    <!--<h3>Author</h3>-->
                  </div>
                  <div class="widget-body">
                    <div class="media align-items-center">
                      <div class="avatar">
                        <img src="https://bolsaempleo.iescinoc.edu.co/company_logos/institucion-de-educacion-superior-colegio-integrado-nacional-oriente-de-caldas-1634054115-202.jpeg" title="" alt="">
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection