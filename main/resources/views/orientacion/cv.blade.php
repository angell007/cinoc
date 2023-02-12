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
                    <p><u><b class="font-weight-bolder">&iquest;Qu&eacute; es una hoja de vida?</b></u></p>
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
                    <img src="https://bolsaempleo.iescinoc.edu.co/images/cv.jpg" title="" alt="">
                  </div>
                  
                   <br>
                  <br>
                  <br>
                  
                  <div class="article-content">
                    <p>Documento o herramienta a trav&eacute;s de la cual se presenta de forma resumida la trayectoria acad&eacute;mica, experiencia laboral y profesional de una persona; as&iacute; como logros obtenidos y competencias desarrolladas frente al cargo al cual se aspira.</p>
                    <p><br>&nbsp;</p>
                    <p><span size="3"><u><b class="font-weight-bolder">Factores importantes a tener en cuenta en la elaboraci&oacute;n de una hoja de vida</b></u></span><b class="font-weight-bolder">:</b></p>
                    <ol>
                      <li>
                        <p><b class="font-weight-bolder">Datos personales:</b> Aqu&iacute; deber&aacute;s escribir tu informaci&oacute;n personal y datos de ubicaci&oacute;n. Puedes incluir una fotograf&iacute;a para identificarte.</p>
                      </li>
                    </ol>
                    <p><br></p>
                    <ol start="2">
                      <li>
                        <p><b class="font-weight-bolder">Perfil profesional:&nbsp;</b>En este espacio va una breve descripci&oacute;n de las habilidades, destrezas, especialidades, fortalezas y logros que se tienen sobre una ocupaci&oacute;n. Incluye tambi&eacute;n los campos de inter&eacute;s y los enfoques que se tienen de la profesi&oacute;n.</p>
                      </li>
                    </ol>
                    <p><br></p>
                    <ol start="3">
                      <li>
                        <p><b class="font-weight-bolder">Educaci&oacute;n:</b> En este espacio debe ir la formaci&oacute;n acad&eacute;mica realizada por ti que valida si eres apto para un empleo. Esta secci&oacute;n puede ir dividida en dos partes:</p>
                      </li>
                    </ol>
                    <ul>
                      <li>
                        <p><b class="font-weight-bolder">Formaci&oacute;n acad&eacute;mica:&nbsp;</b>t&iacute;tulos de colegio, t&eacute;cnicos, pregrado, posgrado, entre otros.</p>
                      </li>
                      <li>
                        <p><b class="font-weight-bolder">Formaci&oacute;n complementaria:</b> seminarios, talleres, dominio de otros idiomas, entre otros.</p>
                      </li>
                      <li>
                        <p><b class="font-weight-bolder">Habilidades tecnol&oacute;gicas:&nbsp;</b>Aptitudes y conocimientos, principalmente t&eacute;cnicos, que te permiten realizar tareas espec&iacute;ficas relacionadas con la tecnolog&iacute;a y el entorno digital.</p>
                      </li>
                    </ul>
                    <ol start="4">
                      <li>
                        <p>Experiencia laboral:&nbsp;Aqu&iacute; se debe explicar en qu&eacute; lugares se ha trabajado, el cargo que se desempe&ntilde;aba (es opcional poner las responsabilidades de cargo), jefe inmediato y el tiempo de duraci&oacute;n de dicho empleo.</p>
                      </li>
                      <li>
                        <p>Referencias:&nbsp;En este espacio debes incluir los datos de personas que puedan verificar la informaci&oacute;n que aparece en tu hoja de vida y dar conceptos sobre ti. Es recomendable tener al menos tres (3) referencias, indicando nombres y apellidos completos, ocupaci&oacute;n y tel&eacute;fono de contacto.</p>
                      </li>
                    </ol>

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

                    <p><span size="3"><u><b class="font-weight-bolder">&iquest;Te gustar&iacute;a un asesoramiento de tu hoja de vida?&nbsp;</b></u></span></p>
                    <ol>
                      <li>
                        <p>Seleciona tu hoja de vida y da click en enviar</p>
                        
                       
                                <form class="form-inline">

                                    <select class="form-control mb-2" placeholder="HV">
                                        
                                        @foreach($cvs as $cv )
                                        
                                        <option value="{{$cv->id}}">
                                            {{$cv->title_cv}}
                                        </option>
                                        
                                        @endforeach
                    
                                    </select>

                                <button type="button" id="btnEnviar" class="btn btn-primary mb-3 mt-3" onclick="sendRevision()">Enviar</button>
                                </form>
                        
                      </li>
                      
                      
                      
                      
                      <li>
                        <p>Se realiza una revisi&oacute;n del documento para evidenciar los aspectos a mejorar en cuanto al dise&ntilde;o, redacci&oacute;n y organizaci&oacute;n de los datos, dichas mejoras ser&aacute;n mencionadas dentro del documento en forma de comentarios para que el egresado/estudiantes realice las respectivas correcciones&nbsp;</p>
                      </li>
                      <li>
                        <p>Es un servicio que no tiene costo&nbsp;</p>
                      </li>
                      <li>
                        <p>El tiempo de respuesta es de 1 a 4 d&iacute;as h&aacute;biles&nbsp;</p>
                      </li>
                    </ol>

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

@push('scripts')


<script type="text/javascript">

 function sendRevision(){
     
    let btn = document.getElementById('btnEnviar')
    btn.innerHTML = "Enviando..."

    $.ajax({

        type: "POST",
    
                url: "{{ route('send-revision') }}",
    
                data: {"_token": "{{ csrf_token() }}"},
    
                datatype: 'json',
    
                success: function (json) {
    
                    btn.innerHTML = "Enviar"
                    alert('Email enviado.')
                },
                
                error: function (json) {
    
                    btn.innerHTML = "Enviar"
                    alert('No hemos pordido enviar tu mensaje intenta mas tarde.')
                },
    
        });

    }

</script>

@endpush