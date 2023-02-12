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
                    <p><u><b class="font-weight-bolder">&iquest;Qu&eacute; son los beneficios e incentivos tributarios?</b></u></p>
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
                    <img src="https://bolsaempleo.iescinoc.edu.co/images/bene.jpg" title="" alt="">
                  </div>
                  
                  
                  <br>
                  <br>
                  <br>
                  
                  <div class="article-content">

                    <p>Los beneficios tributarios suponen una disminuci&oacute;n total o parcial del impuesto a pagar por las sociedades, estos fueron creados con el fin de incentivar la inversi&oacute;n, por lo que los gobiernos de Latinoam&eacute;rica lo han utilizado de una forma muy marcada.</p>
                    <br>
                    <br>
                    <br>
                   
                    <p><u><strong class="font-weight-bolder">&iquest;Qu&eacute; beneficios tributarios hay en Colombia?</strong></u></p>
                    
                    <br>
                    <br>
                    <br>
                    <ul class="list-group list-group-flush" >
                      <li class="list-group-item">
                        <p>* Renta Personas Naturales AG 2021. Hist&oacute;rico Renta Personas Naturales.</p>
                      </li>
                      <li class="list-group-item">
                        <p>* R&eacute;gimen Simple de Tributaci&oacute;n - RST.</p>
                      </li>
                      <li class="list-group-item">
                        <p>* Registro &Uacute;nico de Beneficiarios Finales - RUB.</p>
                      </li>
                      <li class="list-group-item">
                        <p>* R&eacute;gimen Tributario Especial - RTE.</p>
                      </li>
                      <li class="list-group-item">
                        <p>* Formalizaci&oacute;n Tributaria.</p>
                      </li>
                      <li class="list-group-item">
                        <p>* Convocatoria operadora de pagos devoluci&oacute;n de IVA a turistas extranjeros.</p>
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