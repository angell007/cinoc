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
                    <p><u><b class="font-weight-bolder">&iquest;Que son las pruebas psicot&eacute;cnicas?</b></u></p>
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
                    <img src="https://bolsaempleo.iescinoc.edu.co/images/test.jpg" title="" alt="">
                  </div>


                  <br>
                  <br>
                  <br>

                  <div class="article-content">

                    <p style="text-align: justify;">Los test psicot&eacute;cnicos son pruebas estandarizadas, que sirven para medir conductas, capacidades y habilidades de un candidato o candidata de cara a una posible contrataci&oacute;n</p>
                    <p style="text-align: justify;"><u><b class="font-weight-bolder">Consejos para superar un test psicot&eacute;cnico:</b></u></p>
                    <p style="text-align: justify;"><br>&nbsp;</p>
                    <p style="text-align: justify;">Estos consejos te ayudar&aacute;n a superarlas con &eacute;xito:&nbsp;</p>
                    <ol>
                      <li>
                        <p style="text-align: justify;"><strong class="font-weight-bolder">Rel&aacute;jate.&nbsp;</strong>Es lo esencial para poder prestar atenci&oacute;n y responder con calma a las preguntas.</p>
                      </li>
                    </ol>
                    <p style="text-align: justify;"><br></p>
                    <ol start="2">
                      <li>
                        <p style="text-align: justify;"><strong class="font-weight-bolder">Lee bien las instrucciones.</strong> No te lances a contestar como loco, sobre todo sin leer y tener muy claro el procedimiento y lo que te piden en el test.&nbsp;</p>
                      </li>
                    </ol>
                    <p style="text-align: justify;"><br></p>
                    <ol start="3">
                      <li>
                        <p style="text-align: justify;"><strong class="font-weight-bolder">Conc&eacute;ntrate.</strong> No te dediques a mirar lo que hacen el resto de candidatos y emplea el tiempo en contestar el m&aacute;ximo n&uacute;mero de preguntas posibles.</p>
                      </li>
                    </ol>
                    <p style="text-align: justify;"><br></p>
                    <ol start="4">
                      <li>
                        <p style="text-align: justify;"><strong class="font-weight-bolder">El tiempo cuenta.</strong> No te lo tomes con demasiada calma, ya que el tiempo empleado en completar los test es limitado y valorado.</p>
                      </li>
                    </ol>
                    <p style="text-align: justify;"><br></p>
                    <ol start="5">
                      <li>
                        <p style="text-align: justify;"><strong class="font-weight-bolder">No te quedes atascado.</strong> Si dudas en una respuesta, no te quedes parado. Contin&uacute;a contestando las que tengas claras y deja para el final las que te hacen dudar.</p>
                      </li>
                    </ol>
                    <p style="text-align: justify;"><br>&nbsp;</p>
                    <ol start="6">
                      <li>
                        <p style="text-align: justify;">&nbsp;<strong class="font-weight-bolder">Sentido com&uacute;n.</strong> Tenlo presente en todo momento y piensa que los test buscan respuestas claras, simples y concretas.</p>
                      </li>
                    </ol>
                    <p style="text-align: justify;"><br>&nbsp;</p>
                    <!--<h2 style="text-align: justify;"><u><strong class="font-weight-bolder"><span style="font-size: 16px;">Te invitamos a realiza un modelo de prueba psicot&eacute;cnicas</span></strong></u></h2>-->
                    <h2 style="text-align: justify;">&nbsp;</h2>
                    <p style="text-align: justify;"><u><b class="font-weight-bolder">Prueba de asertividad</b></u></p>
                    <p style="text-align: justify;"><span>La&nbsp;asertividad&nbsp;es aquella habilidad personal que&nbsp;nos permite expresar de forma adecuada nuestras emociones frente a otra persona, y lo hacemos sin hostilidad ni agresividad. Una persona asertiva sabe expresar directa y adecuadamente sus opiniones y sentimientos (tanto positivos como negativos) en cualquier situaci&oacute;n social.<br>&nbsp;<br> Para saber el grado de asertividad que tienes contesta el siguiente cuestionario.p</span></p>
                   
                   
                    <p style="text-align: justify;"><a href="https://docs.google.com/forms/d/e/1FAIpQLSejMz_D4Njo1FUEe2Bpy86LZwxbj3BwjvsptFuFVY8PcnITFw/viewform">TEST DE ASERTIVIDAD</a> </p>
                   
                   
                   <br>
                   <br>
                   <br>
                   <br>
                    <p style="text-align: justify;"><u><b class="font-weight-bolder">Test Orientativo de Inteligencia Emocional</b></u></p>
                    <p style="text-align: justify;">Una persona puede ser muy inteligente acad&eacute;micamente y ser menos inteligente emocionalmente. Entonces, &iquest;en qu&eacute; consiste la IE o inteligencia emocional?</p>
                    <p style="text-align: justify;">Seg&uacute;n&nbsp;Daniel Goleman, es la&nbsp;&ldquo;la capacidad de reconocer, aceptar y canalizar nuestras emociones para dirigir nuestras conductas a objetivos deseados, lograrlo y compartirlos con los dem&aacute;s&rdquo;.</p>
                    <p style="text-align: justify;">Dentro del concepto, que es&nbsp;dimensional, podemos decir que la IE tiene que ver con la forma de&nbsp;sentir&nbsp;que cada persona tiene.&nbsp;Pero tambi&eacute;n con la forma que tienes de&nbsp;controlar&nbsp;las emociones, con la capacidad de cambiar de estado de &aacute;nimo. Y, sobre todo, con la capacidad de&nbsp;dirigir&nbsp;las emociones hacia estados positivos y equilibrados.</p>
                    <p style="text-align: justify;">Ser capaz de&nbsp;identificar y dirigir&nbsp;las propias emociones, as&iacute; como reconocer las emociones de los dem&aacute;s, es una forma de ser inteligente. Ahora que ya sabes lo que es, te invito a resolver el Test orientativo de inteligencia emocional.</p>
                    <p style="text-align: justify;"><br></p>
                    <p style="text-align: justify;"> <a href="https://docs.google.com/forms/d/e/1FAIpQLSc2V7T2M4Rncdgky7vZIodnT00a_soiwgE5cXmGdVAIT0Ie9w/viewform">
                        
                        TEST ORIENTATIVO DE INTELIGENCIA EMOCIONAL
                        
                    </a> </p>

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