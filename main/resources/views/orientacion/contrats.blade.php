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
                    <p><u><b class="font-weight-bolder"> &iquest;Qu&eacute; son los contratos laborales?&nbsp;</b></u></p>
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
                    <img src="https://bolsaempleo.iescinoc.edu.co/images/contrats.png" title="" alt="">
                  </div>
                  
                  
                  <br>
                  <br>
                  <br>
                  
                  <div class="article-content">

                    <p style="text-align: justify;"><span size="3"><u><strong class="font-weight-bolder">&iquest;Qu&eacute; son los contratos laborales?&nbsp;</strong></u></span></p>
                    <p style="text-align: justify;">Los&nbsp;contratos laborales&nbsp;hacen referencia a los acuerdos&nbsp;de trabajo&nbsp;entre una o varias personas, en este caso son conocidas como empleador y empleado. Dentro de estos documentos deben incluirse el salario, los horarios, las responsabilidades, el cargo por desempe&ntilde;ar entre otras cosas</p>
                    <p style="text-align: justify;"><br>&nbsp;</p>
                    <p style="text-align: justify;"><u><strong class="font-weight-bolder">Tipos de contratos</strong></u></p>
                    <p style="text-align: justify;">Existen cinco tipos de contratos regulados por la normativa, cada uno de ellos con sus caracter&iacute;sticas y particularidades propias: obra o labor, t&eacute;rmino fijo, t&eacute;rmino indefinido, aprendizaje, temporal, ocasional o accidental. Es competencia del Estado la regulaci&oacute;n de los mismos.</p>
                    <p style="text-align: justify;"><span size="3"><strong class="font-weight-bolder">Contrato por obra o labor:</strong></span>Es un contrato que se realiza para una labor espec&iacute;fica y termina en el momento que la obra llegue a su fin. Este tipo de vinculaci&oacute;n es caracter&iacute;stica de trabajos de construcci&oacute;n, de universidades y colegios. Este contrato es igual en t&eacute;rminos de beneficios y descuentos a los contratos indefinidos y definidos, por ser un contrato laboral</p>
                    <p style="text-align: justify;"><strong class="font-weight-bolder">Contrato de trabajo a t&eacute;rmino fijo:</strong></p>
                    <p style="text-align: justify;">Se caracteriza por tener una fecha de inicio y de terminaci&oacute;n que no puede superar 3 a&ntilde;os, es fundamental que sea por escrito. Puede ser prorrogado indefinidamente cuando su vigencia sea superior a un (1) a&ntilde;o, o cuando siendo inferior, se haya prorrogado hasta por tres (3) veces.</p>
                    <p style="text-align: justify;"><strong class="font-weight-bolder">Contrato de trabajo a t&eacute;rmino indefinido:</strong></p>
                    <p style="text-align: justify;">El contrato a t&eacute;rmino indefinido no tiene estipulada una fecha de culminaci&oacute;n de la obligaci&oacute;n contractual, cuya duraci&oacute;n no haya sido expresamente estipulada o no resulte de la naturaleza de la obra o servicio que debe ejecutarse. Puede hacerse por escrito o de forma verbal.</p>
                    <p style="text-align: justify;"><br>&nbsp;</p>
                    <p style="text-align: justify;"><strong class="font-weight-bolder">Contrato de aprendizaje:</strong></p>
                    <p style="text-align: justify;">Es aquel mediante el cual una persona natural realiza formaci&oacute;n te&oacute;rica pr&aacute;ctica en una entidad autorizada, a cambio de que la empresa proporcione los medios para adquirir formaci&oacute;n profesional requerida en el oficio, actividad u ocupaci&oacute;n, por cualquier tiempo determinado no superior a dos (2) a&ntilde;os, y por esto recibe un apoyo de sostenimiento mensual, que sea como m&iacute;nimo en la fase lectiva el equivalente al 50% de un (1) salario m&iacute;nimo mensual vigente y durante la fase pr&aacute;ctica ser&aacute; equivalente al setenta y cinco por ciento (75%) de un salario m&iacute;nimo mensual legal vigente.</p>
                    <p style="text-align: justify;">*No aplica para solicitudes de PEPFF y/o migrantes provenientes de Venezuela en condici&oacute;n irregular.</p>
                    <p style="text-align: justify;"><strong class="font-weight-bolder">Contrato temporal, ocasional o accidental</strong></p>
                    <p style="text-align: justify;">El C&oacute;digo Sustantivo del Trabajo, define el trabajo ocasional, accidental o transitorio, como aquel no mayor de 30 d&iacute;as, y cuyas labores sean distintas de las actividades normales del empleador. Esta forma de contrataci&oacute;n puede hacerse por escrito o verbalmente; recomendamos hacerlo por escrito, estableciendo la tarea espec&iacute;fica del trabajador.</p>
                    <p style="text-align: justify;">*No aplica para solicitudes de PEPFF</p>
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