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
                    <p><u><b class="font-weight-bolder">&iquest;Qu&eacute; es la inclusi&oacute;n laboral en una empresa?</b></u></p>
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
                    <img src="https://bolsaempleo.iescinoc.edu.co/images/include.jpg" title="" alt="">
                  </div>


                  <br>
                  <br>
                  <br>

                  <div class="article-content">

                        <p style="text-align: justify;">La inclusi&oacute;n laboral es una estrategia de la empresa para acceder a nuevos talentos sin discriminaci&oacute;n. Asimismo, constituye una opci&oacute;n para que la PcD pueda mostrar sus habilidades y ejercer su derecho al trabajo y a tener un ingreso digno, a partir del cual se derivan otros derechos y deberes como ciudadano, que le proporcionan a cada persona un desarrollo personal y profesional.</p>
                        <br>
                  <br>
                  <br>
                       <p style="text-align: justify;"><u><strong class="font-weight-bolder">&iquest;Cu&aacute;l es el significado de PCD?</strong></u></p>
                        <p style="text-align: justify;">Una persona con discapacidad (PCD) es aquel individuo que ha sufrido de alguna alteraci&oacute;n de sus funciones f&iacute;sica, sensorial o mental; ya sea en forma temporal o permanente. Que puede ser adquirida o permanente y le impide desarrollar normalmente sus labores diarias</p>
                         <br>
                  <br>
                  <br>
                        <p style="text-align: justify;"><u><strong class="font-weight-bolder">&iquest;Por qu&eacute; hacer inclusi&oacute;n laboral de PcD?</strong></u></p>
                  <br>
                  <br>
                  <br>
                        
                        <ol class="list-group list-group-flush" style="text-align: justify;">
                        <li class="list-group-item">
                        <p>* Cuando hay aceptaci&oacute;n de la diversidad, ocurren cambios positivos en el clima laboral y en la cultura organizacional.</p>
                        </li>
                        <li class="list-group-item">
                        <p>* La discapacidad en la empresa abre posibilidades de innovaci&oacute;n y eficiencia y nos invita a trabajar con diversidad.</p>
                        </li>
                        <li class="list-group-item">
                        <p>* La empresa identifica mejores talentos haciendo un proceso de selecci&oacute;n a partir de las habilidades.</p>
                        </li>
                        <li class="list-group-item">
                        <p>* La capacidad de concentraci&oacute;n y el mayor rendimiento en el trabajo de las PcD est&aacute; comprobado.&nbsp;</p>
                        </li>
                        <li class="list-group-item">
                        <p>* Sentirse &uacute;til, apreciado y con oportunidades convierte a la PcD en un empleado comprometido y leal con la empresa.</p>
                        </li>
                        <li class="list-group-item">
                        <p>* Las PcD tienen m&aacute;s probabilidad de permanecer en un puesto de trabajo, evitando altos costos en rotaci&oacute;n laboral.</p>
                        </li>
                        </ol>
                        <p><br></p>
                 
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