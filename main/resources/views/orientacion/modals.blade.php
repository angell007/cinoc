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
                    <p><u><b class="font-weight-bolder">&iquest;Qu&eacute; son las modalidades de contrataci&oacute;n?</b></u></p>
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
                    <img src="https://bolsaempleo.iescinoc.edu.co/images/modals.jpg" title="" alt="">
                  </div>


                  <br>
                  <br>
                  <br>

                  <div class="article-content">

                    <p style="text-align: justify;">Son las diferentes alternativas con que cuenta una empresa para vincular a sus trabajadores, y cada empresa utilizar&aacute; una y otra dependiendo de sus necesidades, y no habr&aacute; problema con ello siempre que la&nbsp;<strong class="font-weight-bolder">contrataci&oacute;n</strong> se ajuste a la ley, y en los casos en que la ley lo permite</p>
                    <br>
                  <br>
                  <br>
                    <p style="text-align: justify;"><u><strong class="font-weight-bolder">&iquest;Cu&aacute;les son las modalidades de contrataci&oacute;n estatal?</strong></u></p>
                    <ol>
                      <li>
                        <p style="text-align: justify;"><strong class="font-weight-bolder">La licitaci&oacute;n p&uacute;blica:&nbsp;</strong>Todo procedimiento administrativo para la adquisici&oacute;n de suministros, contrataci&oacute;n de servicios o la ejecuci&oacute;n de obras (construcciones) que organicen entes, organismos y entidades que formen parte del Sector P&uacute;blico, es considerada una licitaci&oacute;n p&uacute;blica. Llamados tambi&eacute;n concursos p&uacute;blicos, su objetivo es ofrecer y asegurar condiciones de compra o adquisici&oacute;n de bienes y servicios por parte del Estado a un proveedor. El proceso inicia cuando un ente p&uacute;blico interesado en contratar servicios o adquirir suministros, p&uacute;blica de forma electr&oacute;nica los pliegos de condiciones con los requisitos de la licitaci&oacute;n. Con todas las propuestas recolectadas, la parte contratante selecciona y adjudica el contrato al ofertante que considere m&aacute;s relevante.</p>
                      </li>
                      <li>
                        <p style="text-align: justify;">&nbsp;<strong class="font-weight-bolder">La selecci&oacute;n abreviada</strong>: Corresponde a la modalidad de selecci&oacute;n objetiva prevista para la contrataci&oacute;n de bienes o servicios de menor cuant&iacute;a. Bajo esta modalidad, se encuentran:</p>
                        <ul>
                          <li>
                            <p style="text-align: justify;"><strong class="font-weight-bolder">Selecci&oacute;n Abreviada de Menor cuant&iacute;a:</strong> La contrataci&oacute;n de menor cuant&iacute;a, es para la adquisici&oacute;n de bienes o servicios, cuyo valor est&eacute; por encima del diez por ciento (10%) de la m&iacute;nima cuant&iacute;a y hasta el m&aacute;ximo l&iacute;mite de la menor cuant&iacute;a, es decir al monto a partir del cual empieza la contrataci&oacute;n de mayor cuant&iacute;a para licitaci&oacute;n p&uacute;blica.</p>
                          </li>
                        </ul>
                      </li>
                    </ol>
                    <p style="text-align: justify;"><br>&nbsp;</p>
                    <ol>
                      <ul>
                        <li>
                          <p style="text-align: justify;"><strong class="font-weight-bolder">Selecci&oacute;n Abreviada de Subasta Inversa</strong>.La contrataci&oacute;n de menor cuant&iacute;a, es para la adquisici&oacute;n de bienes o servicios, cuyo valor est&eacute; por encima del diez por ciento (10%) de la m&iacute;nima cuant&iacute;a y hasta el m&aacute;ximo l&iacute;mite de la menor cuant&iacute;a, es decir al monto a partir del cual empieza la contrataci&oacute;n de mayor cuant&iacute;a para licitaci&oacute;n p&uacute;blica.</p>
                        </li>
                      </ul>
                    </ol>
                    <p style="text-align: justify;"><br>&nbsp;</p>
                    <ol>
                      <ul>
                        <li>
                          <p style="text-align: justify;"><strong class="font-weight-bolder">Acuerdos Marco de Precio:</strong> El Acuerdo Marco de Precio, es la contrataci&oacute;n que hace la entidad estatal que lidera y coordina el Sistema de Compra P&uacute;blica de Colombia - Colombia Compra Eficiente, con diferentes proponentes que han participado previamente, en la licitaci&oacute;n p&uacute;blica adelantada por la misma, para la adquisici&oacute;n de bienes y servicios; por lo tanto las entidades estatales debemos acogernos a dicho acuerdo, lo que hace m&aacute;s &aacute;gil la contrataci&oacute;n, toda vez que ya no es necesario adelantar el proceso licitatorio, sino que se publica en la Tienda Virtual del Estado Colombiano la solicitud de contrataci&oacute;n, a la cual deben responder con su propuesta, todos los oferentes adjudicatarios del proceso mencionado y la entidad estatal escoge la de menor precio.</p>
                        </li>
                      </ul>
                    </ol>
                    <p style="text-align: justify;"><br>&nbsp;</p>
                    <ol start="3">
                      <li>
                        <p style="text-align: justify;"><strong class="font-weight-bolder">Concurso de m&eacute;ritos:</strong> Esta modalidad contractual est&aacute; prevista para la selecci&oacute;n de consultores o interventores, en asesor&iacute;as t&eacute;cnicas de coordinaci&oacute;n, control y supervisi&oacute;n, gerencia de obra y/o proyectos, as&iacute; como tambi&eacute;n los estudios para la ejecuci&oacute;n de proyectos de inversi&oacute;n, diagn&oacute;stico, prefactibilidad o factibilidad para programas o proyectos espec&iacute;ficos y la ejecuci&oacute;n de dise&ntilde;os, planos, anteproyectos y proyectos.</p>
                      </li>
                    </ol>
                    <p style="text-align: justify;"><br>&nbsp;</p>
                    <ol start="4">
                      <li>
                        <p style="text-align: justify;"><strong class="font-weight-bolder">La contrataci&oacute;n directa:</strong> Es el procedimiento mediante el cual la entidad estatal contrata directamente con una persona natural o jur&iacute;dica, la prestaci&oacute;n de servicios profesionales, la prestaci&oacute;n de servicios de apoyo a la gesti&oacute;n o la adquisici&oacute;n de un bien o servicio, que tenga un proveedor exclusivo o por ser titular de los derechos del mismo. Esta modalidad contractual tambi&eacute;n proceder&aacute; en caso de urgencia manifiesta, contrataci&oacute;n de empr&eacute;stitos, contratos y convenios interadministrativos. Esta modalidad de selecci&oacute;n es independiente de la cuant&iacute;a del contrato a suscribir.</p>
                      </li>
                    </ol>
                    <p style="text-align: justify;"><br>&nbsp;</p>
                    <ol start="5">
                      <li>
                        <p style="text-align: justify;"><strong class="font-weight-bolder">M&iacute;nima cuant&iacute;a</strong>:Bajo esta modalidad, se encuentran:</p>
                      </li>
                    </ol>
                    <p style="text-align: justify;"><br>&nbsp;</p>
                    <ul>
                      <li>
                        <p style="text-align: justify;"><strong class="font-weight-bolder">Proceso de M&iacute;nima Cuant&iacute;a.&nbsp;</strong>La modalidad de selecci&oacute;n de m&iacute;nima cuant&iacute;a es un procedimiento con t&eacute;rminos cortos para escoger al contratista, siempre que el valor de la adquisici&oacute;n de los bienes, obras y/o servicios, no exceda el diez por ciento (10%) de la menor cuant&iacute;a de la Entidad Estatal. Es de anotar que este procedimiento lo regul&oacute; la Ley 1474 de 2011, porque antes de la expedici&oacute;n de esta norma, se solicitaban tres (3) propuestas y se escog&iacute;a la de menor valor, ahora tambi&eacute;n se escoge la oferta de menor valor, pero mediante un proceso de selecci&oacute;n p&uacute;blico y transparente, en el cual pueden participar todos los interesados, quienes deben cumplir con los requisitos de verificaci&oacute;n establecidos en la invitaci&oacute;n p&uacute;blica.</p>
                      </li>
                    </ul>
                    <p style="text-align: justify;"><br>&nbsp;</p>
                    <ul style="text-align: justify;">
                      <li>
                        <p><strong class="font-weight-bolder">Compras en Grandes Superficies, a trav&eacute;s de la Tienda Virtual del Estado Colombiano:&nbsp;</strong>As&iacute; mismo, bajo la modalidad de selecci&oacute;n de m&iacute;nima cuant&iacute;a, se pueden realizar las compras en las Grandes Superficies, que se encuentran en la Tienda Virtual del Estado Colombiano, siempre que su valor est&eacute; dentro de esta modalidad de selecci&oacute;n, es decir que no exceda el diez por ciento (10%) de la menor cuant&iacute;a de la Entidad Estatal.</p>
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