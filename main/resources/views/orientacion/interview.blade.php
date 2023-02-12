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
                    <p><u><b class="font-weight-bolder">&iquest;Qu&eacute; es una entrevista de trabajo?</b></u></p>
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
                    <img src="https://bolsaempleo.iescinoc.edu.co/images/interview.png" title="" alt="">
                  </div>


                  <br>
                  <br>
                  <br>

                  <div class="article-content">
                      
                            <p style="text-align: justify;"><u><strong class="font-weight-bolder"></strong></u></p>
                            <p style="text-align: justify;">B&aacute;sicamente una entrevista es una t&eacute;cnica empleada durante los procesos de selecci&oacute;n para cubrir una vacante o de nueva creaci&oacute;n y elegir al candidato que mejor encaje con el puesto de trabajo. La entrevista puede estar estructurada en diferentes partes, pero siempre consiste en un intercambio de ideas mediante una conversaci&oacute;n entre dos o m&aacute;s personas. Generalmente se diferencian dos roles: el entrevistador que dirige la entrevista y va planteando diferentes cuestiones relevantes para conocer m&aacute;s acerca del entrevistado, que es el segundo rol y que expone de manera voluntaria sus opiniones e ideas con el objetivo de persuadir al entrevistador de que es el candidato perfecto para cubrir el puesto de empleo.</p>
                            <p style="text-align: justify;"><br>&nbsp;</p>
                            <p style="text-align: justify;"><u><strong class="font-weight-bolder">5 tips para una entrevista de trabajo exitosa</strong></u></p>
                            <p style="text-align: justify;">Apreciado egresado y estudiante Conoce los 5 tips claves para una entrevista de trabajo exitosa. Debes tener en cuenta que no es cuesti&oacute;n de &apos;suerte&apos; asistir a una entrevista laboral sino de preparaci&oacute;n, as&iacute; que estas recomendaciones te ayudar&aacute;n.</p>
                            <p style="text-align: justify;"><strong class="font-weight-bolder">1. Conoce tu propio curr&iacute;culum vitae</strong></p>
                            <p style="text-align: justify;">De inicio tu curr&iacute;culum vitae (CV) les impresion&oacute;, por esta raz&oacute;n debes repasar punto por punto, con el documento enfrente, pensando en c&oacute;mo podr&iacute;as extender la informaci&oacute;n que ofreces, qu&eacute; m&aacute;s datos pueden resultar interesantes o qu&eacute; puede despertar la curiosidad del entrevistador.</p>
                            <p style="text-align: justify;"><strong class="font-weight-bolder">2. Busca informaci&oacute;n de la empresa a la que quieres ingresar</strong></p>
                            <p style="text-align: justify;">Realiza una lectura cuidadosa del anuncio de la oferta de empleo, generalmente te dir&aacute; algo sobre los intereses del empleador. El conocimiento, dimensi&oacute;n, productos, servicios, o alg&uacute;n evento noticioso reciente que tengas sobre la empresa que ofert&oacute; la vacante a la cual est&aacute;s aplicando, siempre impresionan al entrevistador y te brindar&aacute;n confianza. Revisa art&iacute;culos sobre la empresa en internet y diarios.</p>
                            <p style="text-align: justify;"><strong class="font-weight-bolder">3. Recuerda, te dir&aacute;n que hables de ti</strong></p>
                            <p style="text-align: justify;">Conc&eacute;ntrate en hablar de tu vida laboral profesional. C&oacute;mo trabajas en el d&iacute;a a d&iacute;a, en qu&eacute; &aacute;reas tienes experiencia y por qu&eacute; puedes ser un elemento valioso para una organizaci&oacute;n. Algunas preguntas son: &quot;&iquest;cu&aacute;les son tus habilidades y defectos?&quot;, &quot;&iquest;prefieres trabajar con personas o prefieres trabajar solo?&quot;.</p>
                            <p style="text-align: justify;"><strong class="font-weight-bolder">4. Cuida el lenguaje corporal</strong></p>
                            <p style="text-align: justify;">Tu lenguaje corporal puede expresar m&aacute;s sobre tu personalidad. Siempre adopta una postura erguida, nada peor que andar encorvado, ya que refleja flojera, indecisi&oacute;n, y falta de profesionalismo. Evita todo tipo de movimientos nerviosos con tus manos o pies, sonr&iacute;e. Ten precauci&oacute;n tambi&eacute;n con el movimiento de pies y piernas, a veces es inconsciente y te puede traicionar.</p>
                            <p style="text-align: justify;"><strong class="font-weight-bolder">5.As&iacute; es como debes terminar la entrevista</strong></p>
                            <p style="text-align: justify;">Si puedes y hay tiempo realiza algunas de las preguntas que preparaste previamente con respecto a tu inter&eacute;s por el empleo. La &uacute;ltima pregunta podr&iacute;a ser aquella sobre la fecha probable en la que tomar&aacute;n una decisi&oacute;n. Mu&eacute;strate agradecido, vuelve a expresar tu inter&eacute;s por trabajar con la empresa, y sal del lugar.</p>
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