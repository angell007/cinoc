@extends('layouts.app')
@section('content')
<!-- Header start -->
@include('includes.header')
<!-- Header end -->
<!-- Inner Page Title start -->
@include('includes.inner_page_title', ['page_title' => __('My Profile')])
<!-- Inner Page Title end -->
<div class="listpgWraper">
  <div class="container">
    <div class="row">

      @if (Auth::guard('web')->user())
      @include('includes.user_dashboard_menu')
      @endIf

      @if (Auth::guard('company')->user())
      @include('includes.company_dashboard_menu')
      @endIf



      <div class="col-md-9 col-sm-8">



        <div class="userccount">
          <div class="formpanel mt0" <div class="container justify-content-center text-center">

            <!--<h6> Orientación ocupacional .</h6>-->


            <div class="jumbotron jumbotron-fluid">
              <!--<div class="container">-->
              <!--<h1 class="display-4">Fluid jumbotron</h1>-->
              <p class="lead">Orientación ocupacional.</p>

              <!--<div class="">-->



            </div>
          </div>

          @if (Auth::guard('company')->user())
          <div class="card-deck">

            <div class="card border-light mb-3">
              <a href="{{ route('education') }}">
                <img class="card-img-top" style="width: 300px; height:200px !important" src="https://bolsaempleo.iescinoc.edu.co/images/education.png" alt="Card image cap">
                <div class="card-body">
                  <!--<h5>Card title</h5>-->
                  <p class="card-text">&iquest;Qu&eacute; se entiende por formalizaci&oacute;n
                    laboral?.</p>
                  <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
                </div>
              </a>
            </div>
            
            
             <div class="card border-light mb-3">
              <a href="{{ route('benefits') }}">
                <img class="card-img-top" style="width: 300px; height:200px !important" src="https://bolsaempleo.iescinoc.edu.co/images/bene.jpg" alt="Card image cap">
                <div class="card-body">
                  <!--<h5 class="card-title">Card title</h5>-->
                  <p class="card-text">&iquest;Qu&eacute; son los beneficios e incentivos
                    tributarios?.</p>
                  <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
                </div>
              </a>
            </div>

          </div>


          <div class="card-deck">
            <div class="card border-light mb-3">
              <a href="{{ route('include') }}">
                <img class="card-img-top" style="width: 300px; height:200px !important" src="https://bolsaempleo.iescinoc.edu.co/images/include.jpg" alt="Card image cap">
                <div class="card-body">
                  <!--<h5 class="card-title">Card title</h5>-->
                  <p class="card-text">&iquest;Qu&eacute; es la inclusi&oacute;n laboral en una
                    empresa?.</p>
                  <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
                </div>
              </a>
            </div>


            <div class="card border-light mb-3">
              <a href="{{ route('modals') }}">
                <img class="card-img-top" style="width: 300px; height:200px !important" src="https://bolsaempleo.iescinoc.edu.co/images/modals.jpg" alt="Card image cap">
                <div class="card-body">
                  <!--<h5>Card title</h5>-->
                  <p class="card-text">&iquest;Qu&eacute; son las modalidades de
                    contrataci&oacute;n?.
                  </p>
                  <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
                </div>
              </a>
            </div>

          </div>
          
          
          <div class="card-deck">
            <div class="card border-light mb-3">
              <a href="{{ route('ruta') }}">
                <img class="card-img-top" style="width: 300px; height:200px !important" src="https://bolsaempleo.iescinoc.edu.co/images/hoja.png" alt="Card image cap">
                <div class="card-body">
                  <!--<h5 class="card-title">Card title</h5>-->
                  <p class="card-text">Hoja de ruta de servicios al empleador manual.</p>
                  <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
                </div>
              </a>
            </div>
            
            <div class="card border-light mb-3">
              <!--<a href="{{ route('include') }}">-->
              <!--  <img class="card-img-top" style="width: 300px; height:200px !important" src="https://bolsaempleo.iescinoc.edu.co/images/hoja.png" alt="Card image cap">-->
                <!--<div class="card-body">-->
                  <!--<h5 class="card-title">Card title</h5>-->
                  <!--<p class="card-text">Hoja de ruta de servicios al empleador manual.</p>-->
                  <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
                <!--</div>-->
              <!--</a>-->
            </div>
            
          </div>
          
          @endIf
          @if (Auth::guard('web')->user())

          <div class="card-deck">

            <div class="card border-light mb-3">
              <a href="{{ route('cv') }}">
                <img class="card-img-top" style="width: 300px; height:200px !important" src="https://bolsaempleo.iescinoc.edu.co/images/cv.jpg" alt="Card image cap">
                <div class="card-body">
                  <!--<h5>Card title</h5>-->
                  <p class="card-text">&iquest;Qu&eacute; es una hoja de vida?.</p>
                  <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
                </div>
              </a>
            </div>
            
            
             <div class="card border-light mb-3">
              <a href="{{ route('contrats') }}">
                <img class="card-img-top" style="width: 300px; height:200px !important" src="https://bolsaempleo.iescinoc.edu.co/images/contrats.png" alt="Card image cap">
                <div class="card-body">
                  <!--<h5 class="card-title">Card title</h5>-->
                  <p class="card-text">&iquest;Qu&eacute; son los contratos laborales?&nbsp;.
                  </p>
                  <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
                </div>
              </a>
            </div>

          </div>


          <div class="card-deck">
           

            <div class="card border-light mb-3">
              <a href="{{ route('interview') }}">
                <img class="card-img-top" style="width: 300px; height:200px !important" src="https://bolsaempleo.iescinoc.edu.co/images/interview.png" alt="Card image cap">
                <div class="card-body">
                  <!--<h5 class="card-title">Card title</h5>-->
                  <p class="card-text">&iquest;Qu&eacute; es una entrevista de trabajo?.</p>
                  <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
                </div>
              </a>
            </div>

            <div class="card border-light mb-3">
              <a href="{{ route('test') }}">
                <img class="card-img-top" style="width: 300px; height:200px !important" src="https://bolsaempleo.iescinoc.edu.co/images/test.jpg" alt="Card image cap">
                <div class="card-body">
                  <!--<h5>Card title</h5>-->
                  <p class="card-text">&iquest;Que son las pruebas psicot&eacute;cnicas?.</p>
                  <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
                </div>
              </a>
            </div>
          </div>
          @endIf


          <!--<div class="row">-->
          <!--    <div class="card-columns bg-transparent m-3 p-1">-->
          <!--        @foreach ($videos as $item)
    -->
          <!--        <div class="card bg-transparent">-->
          <!--            <div class="embed-responsive embed-responsive-1by1 z-depth-1-half">-->
          <!--                <iframe width="300px" height="200px" class="embed-responsive-item" src="{{ $item->video_link }}" frameborder="0"-->
          <!--                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>-->
          <!--                </iframe>-->
          <!--            </div>-->
          <!--            <div class="card-body">-->
          <!--                <h5 class="card-title">{{ $item->video_title }}</h5>-->
          <!--                <p class="card-text">{{ $item->video_text }}</p>-->
          <!--<p class="card-text"><small class="text-muted">subido en {{ $item->updated_at }}</small></p>-->



          <!--            </div>-->
          <!--        </div>-->
          <!--
    @endforeach-->
          <!--    </div>-->
          <!--</div>-->


          <!--<div class="faqs">-->

          <!--    <h6>Preguntas frecuentes.</h6>-->

          <!--       <div class="panel-group" id="accordion">-->
          <!--           <h3>&nbsp;</h3>-->
          <!--           @if (isset($faqs) && count($faqs))
    -->
          <!--           @foreach ($faqs as $faq)
    -->
          <!--           <div class="panel panel-info ">-->
          <!--               <div class="panel-headin ">-->
          <!--                   <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" class="collapsed" href="#collapse{{ $faq->id }}">{!! $faq->faq_question !!}</a> </h4>-->
          <!--               </div>-->
          <!--               <div id="collapse{{ $faq->id }}" class="panel-collapse collapse">-->
          <!--                   <div class="panel-body">{!! $faq->faq_answer !!}</div>-->
          <!--               </div>-->
          <!--           </div>-->
          <!--
    @endforeach-->
          <!--
    @endif-->
          <!--       </div>-->
          <!--   </div>-->

          {{-- <div class="faqs">

                                <h6>Enlaces de interes.</h6>

                                @if (isset($links) && count($links))
                                    @foreach ($links as $link)
                                        <a class="collapsed" href="{{ $link->link }}">{{ $link->text }}</a>
          @endforeach
          @endif

        </div> --}}




        <!--</div>-->





        <div class="card-deck">
         @if (Auth::guard('web')->user())
          <div class="card border-light mb-3">


            <div class="card-body">

              <h6 class="card-text">Constancias de capacitaciones y otros: </h6>

            </div>

          </div>
          
           @endif

          <div class="card border-light mb-3">


            @if (isset($links) && count($links))
            @foreach ($links as $link)
            <div class="card-body">
                
                 <p class="card-text"><a class="text" href="{{ url('getconst', ['file' => $link->name ]) }}">{{ $link->name }}</a></p>
                 
              
            </div>
            @endforeach
            @endif




          </div>

        </div>


 @if (Auth::guard('web')->user())
        <div class="card-deck">

          <div class="card border-light mb-3">


            <div class="card-body">

              <h6 class="card-text">Fechas importantes: </h6>

            </div>

          </div>

          <div class="card border-light mb-3">


            <div class="card-body">

              <p class="card-text">16  de febrero 2023 - . Actividades grupales sobre competencias básicas (claves y transversales)</p>

            </div>
            <div class="card-body">

              <p class="card-text">22 de marzo del 2023 - Actividades individuales o grupales sobre herramientas para el autoempleo y/o búsqueda de empleo y actividades que ayuden al fortalecimiento del perfil laboral.</p>

            </div>
            <div class="card-body">

              <p class="card-text">05 de abril del 2023 Entrevista grupal de orientación</p>

            </div>

          </div>

        </div>
 @endif

      </div>

    </div>
  </div>
</div>



@include('video.create')

@endsection