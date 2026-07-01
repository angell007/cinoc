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
            @include('includes.user_dashboard_menu')

            <div class="col-md-9 col-sm-8"> 
              
                       
						
						<div class="userccount">
                            <div class="formpanel mt0"
                                
                                <div class="container justify-content-center text-center">
       
                                        <h6>Videos de ineteres.</h6>

                                    <div class="row">
                                        <div class="card-columns bg-transparent m-3 p-1">
                                            @foreach ($videos as $item)
                                            <div class="card bg-transparent">
                                                <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                                    <iframe width="200px" height="200px" class="embed-responsive-item" src="{{$item->video_link}}" frameborder="0"
                                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                                    </iframe>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$item->video_title}}</h5>
                                                    <p class="card-text">{{$item->video_text}}</p>
                                                    <p class="card-text"><small class="text-muted">subido en {{$item->updated_at}}</small></p>
                                
                                                   
                                                    
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    
                                    
                                     <div class="faqs">
                                         
                                         <h6>Preguntas frecuentes.</h6>
                                         
                                            <div class="panel-group" id="accordion">
                                                <h3>&nbsp;</h3>
                                                @if(isset($faqs) && count($faqs))
                                                @foreach($faqs as $faq)
                                                <div class="panel panel-info ">
                                                    <div class="panel-headin ">
                                                        <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" class="collapsed" href="#collapse{{ $faq->id }}">{!! $faq->faq_question !!}</a> </h4>
                                                    </div>
                                                    <div id="collapse{{ $faq->id }}" class="panel-collapse collapse">
                                                        <div class="panel-body">{!! $faq->faq_answer !!}</div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        
                                    
                                    
                                        <div class="faqs">
                                            
                                                 <h6>Enlaces de interes.</h6>
                                               
                                                         <a class="collapsed" href="">Formulario</a> 
                                                    
                                           
                                        </div>

                                                             
                            </div>
                        </div>
                        
  </div>
  </div>
  </div>
  


@include('video.create')

@endsection
