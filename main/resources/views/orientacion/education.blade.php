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
                    <p><u><b class="font-weight-bolder">&iquest;Qu&eacute; se entiende por formalizaci&oacute;n laboral? </b></u></p>
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
                    <img src="https://bolsaempleo.iescinoc.edu.co/images/education.png" title="" alt="">
                  </div>


                  <br>
                  <br>
                  <br>

                  <div class="article-content">

                    <p style="line-height: 115%; text-align: justify; margin-bottom: 0cm;"><span style="color: rgb(32, 33, 36);">En el lenguaje econ&oacute;mico se conoce como formalizaci&oacute;n (laboral o empresarial) la transici&oacute;n de un trabajador o de una empresa de la econom&iacute;a informal a la formal. &nbsp;Las pol&iacute;ticas que pretenden conseguir o acelerar esta transici&oacute;n se denominan &quot;pol&iacute;ticas de formalizaci&oacute;n&quot;.</span></p>
                    <p style="line-height: 115%; text-align: justify; margin-bottom: 0cm;"><br></p>
                    <p><u><b class="font-weight-bolder">El trabajo formal en Colombia</b></u></p>
                    <p style="line-height: 143%; text-align: justify; margin-bottom: 0.64cm; background: transparent;"><span style="color: rgb(32, 33, 36);">El trabajo formal, seg&uacute;n MinTrabajo, representa un ingreso digno y protecci&oacute;n social para el trabajador y su familia, se desarrolla respetando la legislaci&oacute;n aplicable que conlleva a una mejor calidad de vida, progreso social y econ&oacute;mico, reducci&oacute;n de la pobreza y equidad social.</span></p>
                    <p><u><b class="font-weight-bolder">&iquest;Cu&aacute;les son las ventajas de la formalizaci&oacute;n laboral?</b></u></p>
                    <p style="line-height: 143%; text-align: justify; margin-bottom: 0.64cm; background: transparent;"><span style="color: rgb(32, 33, 36);">La formalizaci&oacute;n laboral se ha propuesto generar escenarios que permitan el alcance de un mercado laboral incluyente, m&aacute;s justo y equitativo, donde los trabajadores tengan acceso a trabajos dignos, decentes y de calidad, potenciando as&iacute; mayores oportunidades laborales para su bienestar y desarrollo.</span></p>
                    <ul>
                      <li>
                        <p><u><b class="font-weight-bolder">Ventajas del empleo formal para trabajadores independientes</b></u></p>
                      </li>
                    </ul>
                    <p style="line-height: 143%; text-align: justify; margin-bottom: 0.64cm; background: transparent;"><span style="color: rgb(32, 33, 36);">Si realizas una actividad econ&oacute;mica como persona natural, es decir que no est&aacute;s vinculado a ninguna empresa a trav&eacute;s de un contrato laboral, puedes pagar de forma independiente tu afiliaci&oacute;n al <a href="https://www.comfama.com/trabajo-con-proposito/seguridad-social/">sistema de seguridad social</a> y disfrutar de sus beneficios:</span></p>
                    <ul>
                      <li>
                        <p style="line-height: 191%; text-align: justify; margin-bottom: 0cm; background: transparent;"><span style="color: rgb(32, 33, 36);">Garant&iacute;a de protecci&oacute;n de los derechos fundamentales.</span></p>
                      </li>
                      <li>
                        <p style="line-height: 191%; text-align: justify; margin-bottom: 0cm; background: transparent;"><span style="color: rgb(32, 33, 36);">Prestaciones asistenciales y econ&oacute;micas para ti y para tu familia.</span></p>
                      </li>
                      <li>
                        <p style="line-height: 191%; text-align: justify; margin-bottom: 0cm; background: transparent;"><span style="color: rgb(32, 33, 36);">Recreaci&oacute;n y cultura para ti y para tu familia.</span></p>
                      </li>
                    </ul>
                    <h3 style="line-height: 167%; text-align: justify; margin-top: 0cm; margin-bottom: 0.42cm; background: transparent; font-size: 19px; font-weight: normal;"><br></h3>
                    <ul>
                      <li>
                       <p><u><b class="font-weight-bold">Ventajas del empleo formal para las microempresas</b></u></p>
                      </li>
                    </ul>
                    <p style="line-height: 143%; text-align: justify; margin-bottom: 0.64cm; background: transparent;"><span style="color: rgb(32, 33, 36);">Los beneficios para las microempresas tambi&eacute;n se evidencian en el progreso de su negocio y la calidad de vida de sus trabajadores, dentro de las ventajas que trae consigo la formalizaci&oacute;n:</span></p>
                    <ul style="text-align: justify;">
                      <li>
                        <p style="line-height: 191%;text-align: left;margin-bottom: 0cm;background: transparent;"><span style="color: rgb(32, 33, 36);">Permitir que los trabajadores y sus familias se beneficien del sistema de seguridad social integral.</span></p>
                      </li>
                      <li>
                        <p style="line-height: 191%;text-align: left;margin-bottom: 0cm;background: transparent;"><span style="color: rgb(32, 33, 36);">Crear y mantener un ambiente laboral seguro para los trabajadores.</span></p>
                      </li>
                      <li>
                        <p style="line-height: 191%;text-align: left;margin-bottom: 0cm;background: transparent;"><span style="color: rgb(32, 33, 36);">Cobertura de los riesgos por parte del sistema</span></p>
                      </li>
                      <li>
                        <p style="line-height: 191%;text-align: left;margin-bottom: 0cm;background: transparent;"><span style="color: rgb(32, 33, 36);">Cumplimiento de las normas.</span></p>
                      </li>
                      <li>
                        <p style="line-height: 191%;text-align: left;margin-bottom: 0cm;background: transparent;"><span style="color: rgb(32, 33, 36);">Aumento de la productividad del negocio.</span></p>
                      </li>
                    </ul>
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