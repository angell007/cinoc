@extends('admin.layouts.admin_layout')

@section('content')

<div class="page-content-wrapper">

    <!-- BEGIN CONTENT BODY -->

    <div class="page-content" style="background-color:#eef1f5;">

        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->

        <div class="page-bar">

            <ul class="page-breadcrumb">

                <li> <a href="index.html">Home</a> <i class="fa fa-circle"></i> </li>

                <li> <span>{{ $siteSetting->site_name }} Admin Panel</span> </li>

            </ul>

        </div>

        <!-- END PAGE BAR -->

        <!-- BEGIN PAGE TITLE-->

        <h3 class="page-title"> {{ $siteSetting->site_name }} Admin Panel <small>{{ $siteSetting->site_name }} Admin Panel</small> </h3>

        <!-- END PAGE TITLE-->

        <!-- END PAGE HEADER-->

        <div class="row">







            <div class="col-md-6 col-sm-6">



                <!--<form method="post" action="{{route('download')}}">-->

                <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">



                    <a class="dashboard-stat dashboard-stat-v2 green" href="{{route('download', ['type' => 1])}}">

                        <div class="visual"> <i class="fa fa-user"></i> </div>

                        <div class="details">

                            <div class="number"> <span data-counter="counterup" data-value="1349">{{ $totalTodaysUsers }}</span> </div>

                            <div class="desc"> 

                            <small>


                                Usuarios de hoy

                                </small>


                            </div>

                        </div>

                    </a>

                </div>

                <!--</form>-->




                <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 red" href="{{route('download', ['type' => 2])}}">

                        <div class="visual"> <i class="fa fa-user"></i> </div>

                        <div class="details">

                            <div class="number"> <span data-counter="counterup" data-value="1349">{{ $totalActiveUsers }}</span> </div>

                           
                            <div class="desc"> <small> Usuarios Activos </small></div>


                        </div>

                    </a> </div>

               






                <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 blue" href="{{route('download', ['type' => 4])}}">

                        <div class="visual"> <i class="fa fa-user"></i> </div>

                        <div class="details">

                            <div class="number"> <span data-counter="counterup" data-value="1349">{{ $totalCompany }}</span> </div>

                            <div class="desc"> <small> Empresas </small></div>


                        </div>

                    </a> </div>









                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">



                    <h4>General</h4>



                    <form method="get" action="{{route('datos-export')}}">

                        <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

                        <label>Desde</label><input type="date" name="a">

                        <label>Hasta</label><Input type="date" name="b">

                        <input type="submit" value="Descargar">



                    </form>







                    </a>

                </div>









            </div>









            <div class="col-md-6 col-sm-6">

                <!--<form method="post" action="{{route('download')}}">-->

                <input name="_token" type="hidden" value="{!! csrf_token() !!}" />



                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 red" href="{{route('download', ['type' => 5])}}">

                        <div class="visual"> <i class="fa fa-list"></i> </div>

                        <div class="details">

                            <div class="number"> <span data-counter="counterup" data-value="1349">{{ $totalTodaysJobs }}</span> </div>

                            <!--<input type="hidden"  name="type" value ='5'/>-->

                            <!--<button class=" btn btn-danger transparent " type="submit">-->

                            <div class="desc"> <small> Vacantes de hoy </small></div>

                            <!--</button>-->

                        </div>

                    </a> </div>

                <!--</form>-->



                <!--<form method="post" action="{{route('download')}}">-->

                <input name="_token" type="hidden" value="{!! csrf_token() !!}" />



                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 blue" href="{{route('download', ['type' => 6])}}">

                        <div class="visual"> <i class="fa fa-list"></i> </div>

                        <div class="details">

                            <div class="number"> <span data-counter="counterup" data-value="1349">{{ $totalActiveJobs }}</span> </div>

                            <!--<input type="hidden"  name="type" value ='6'/>-->

                            <!--<button class=" btn btn-info transparent " type="submit">-->

                            <div class="desc"> <small> Vacantes activas </small></div>

                            <!--</button>-->

                        </div>

                    </a> </div>





                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 blue" href="{{route('download', ['type' => 7])}}">

                        <div class="visual"> <i class="fa fa-list"></i> </div>

                        <div class="details">

                            <div class="number"> <span data-counter="counterup" data-value="1349">{{ $totalFeaturedJobs }}</span> </div>

                            <!--<input type="hidden"  name="type" value ='6'/>-->

                            <!--<button class=" btn btn-info transparent " type="submit">-->

                            <div class="desc"> <small> Vacantes Inactivas </small></div>

                            <!--</button>-->

                        </div>

                    </a> </div>







                <!-- <form method="post" action="{{route('download')}}"> -->

                    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 purple" href="{{route('download', ['type' => 8])}}">

                            <div class="visual"> <i class="fa fa-list"></i> </div>

                            <div class="details">

                                <div class="number"> <span data-counter="counterup" data-value="1349">{{ $OfertaLaboral }}</span> </div>

                                <div class="desc"> <small>

                                    <!-- <input type="hidden" name="type" value='8' /> -->

                                    <!-- <button class=" btn btn-danger transparent " type="submit"> -->

                                        Vacantes aplicadas

                                        </small>

                                </div>

                                <!-- </button> -->

                            </div>

                        </a> </div>

                <!-- </form> -->







                <!-- <form method="post" action="{{route('download')}}"> -->

                    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 purple" href="{{route('download', ['type' => 9])}}">

                            <div class="visual"> <i class="fa fa-list"></i> </div>

                            <div class="details">

                                <div class="number"> <span data-counter="counterup" data-value="1349">{{ $contratado }}</span> </div>

                                <!-- <input type="hidden" name="type" value='9' /> -->

                                <!-- <button class=" btn btn-danger transparent " type="submit"> -->

                                    <div class="desc"> <small> Contratados </small></div>

                                <!-- </button> -->

                            </div>

                        </a> </div>

                <!-- </form> -->

                

                

                <!-- <form method="post" action="{{route('download')}}"> -->

                    <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> <a class="dashboard-stat dashboard-stat-v2 purple" href="#">

                            <div class="visual"> <i class="fa fa-list"></i> </div>

                            <div class="details">

                                <div class="number"> <span data-counter="counterup" data-value="1349">{{ $totalcvs }}</span> </div>

                                <!-- <input type="hidden" name="type" value='9' /> -->

                                <!-- <button class=" btn btn-danger transparent " type="submit"> -->

                                    <div class="desc"> <small> Hojas de vida </small></div>

                                <!-- </button> -->

                            </div>

                        </a> </div>

                <!-- </form> -->

                

                

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 p-1">



                    <a class="dashboard-stat dashboard-stat-v2 green">

                        <div class="visual"> <i class="fa fa-user"></i> </div>

                        <div class="details">

                            <div class="number"> <span data-counter="counterup" data-value="1349">{{ $asistieron }}</span> </div>

                             <small style="color:white; font-size: .9em">Capacitación - Personas </small>

                            <div class="desc"> 

                            <small>

                                <!--<input type="submit" value =" Usuarios de hoy" />-->

                                <!--<input type="hidden" name="type" value ='1'/>-->

                                <!--<button class=" btn btn-info transparent " type="submit">-->

                                 Asistieron en el mes

                                </small>

                                <!--</button> -->

                            </div>

                        </div>

                    </a>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">



                    <a class="dashboard-stat dashboard-stat-v2 green">

                        <div class="visual"> <i class="fa fa-user"></i> </div>

                        <div class="details">

                            <div class="number"> <span data-counter="counterup" data-value="1349">{{ $direccionados }}</span> </div>

                             <small style="color:white; font-size: .9em">Capacitación - Personas </small>

                            <div class="desc"> 

                            <small>

                                <!--<input type="submit" value =" Usuarios de hoy" />-->

                                <!--<input type="hidden" name="type" value ='1'/>-->

                                <!--<button class=" btn btn-info transparent " type="submit">-->

                                 Direccionados del mes

                                </small>

                                <!--</button> -->

                            </div>

                        </div>

                    </a>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                    

                    <a class="dashboard-stat dashboard-stat-v2 green">

                        <div class="visual"> <i class="fa fa-user"></i> </div>

                        <div class="details">

                            <div class="number"> <span data-counter="counterup" data-value="1349">{{ $culminados }}</span> </div>

                             <small style="color:white; font-size: .9em">Capacitación - Personas </small>

                            <div class="desc"> 

                            <small>

                                <!--<input type="submit" value =" Usuarios de hoy" />-->

                                <!--<input type="hidden" name="type" value ='1'/>-->

                                <!--<button class=" btn btn-info transparent " type="submit">-->

                                  Culminaron en el mes

                                </small>

                                <!--</button> -->

                            </div>

                        </div>

                    </a>

                </div>









            </div>

        </div>

        <div class="row">

            <div class="col-md-6 col-sm-6">

                <div class="portlet light bordered">

                    <div class="portlet-title">

                        <div class="caption"> <i class="icon-share font-dark hide"></i> <span class="caption-subject font-dark bold uppercase">Recent Registered Users</span> </div>

                    </div>

                    <div class="portlet-body">

                        <div class="slimScrol">

                            <ul class="feeds">

                                @foreach($recentUsers as $recentUser)

                                <li>

                                    <div class="col1">

                                        <div class="cont">

                                            <div class="cont-col1">

                                                <div class="label label-sm label-info"> <i class="fa fa-check"></i> </div>

                                            </div>

                                            <div class="cont-col2">

                                                <div class="desc"> <small><a href="{{ route('edit.user', $recentUser->id) }}"> {{ $recentUser->name }} ({{ $recentUser->email }}) </a> - <i class="fa fa-home" aria-hidden="true"></i> {{ $recentUser->getLocation()}}</small></div>

                                            </div>

                                        </div>

                                    </div>

                                </li>

                                @endforeach

                            </ul>

                        </div>

                        <div class="scroller-footer">

                            <div class="btn-arrow-link pull-right"> <a href="{{ route('list.users') }}">See All Users</a> <i class="icon-arrow-right"></i> </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-6 col-sm-6">

                <div class="portlet light bordered">

                    <div class="portlet-title">

                        <div class="caption"> <i class="icon-share font-dark hide"></i> <span class="caption-subject font-dark bold uppercase">Recent Jobs</span> </div>

                    </div>

                    <div class="portlet-body">

                        <div class="slimScrol">

                            <ul class="feeds">

                                @foreach($recentJobs as $recentJob)

                                <li>

                                    <div class="col1">

                                        <div class="cont">

                                            <div class="cont-col1">

                                                <div class="label label-sm label-info"> <i class="fa fa-check"></i> </div>

                                            </div>

                                            <div class="cont-col2">

                                                <div class="desc"> <small><a href="{{ route('edit.job', $recentJob->id) }}"> {{ \Illuminate\Support\Str::limit($recentJob->title, 50) }} </a> - <i class="fa fa-list" aria-hidden="true"></i> {{ $recentJob->getCompany('name') }} - <i class="fa fa-home" aria-hidden="true"></i> {{ $recentJob->getLocation() }}</small></div>

                                            </div>

                                        </div>

                                    </div>

                                </li>

                                @endforeach

                            </ul>

                        </div>

                        <div class="scroller-footer">

                            <div class="btn-arrow-link pull-right"> <a href="{{ route('list.jobs') }}">See All Jobs</a> <i class="icon-arrow-right"></i> </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- END CONTENT BODY -->

</div>

@endsection

@push('scripts')

<script type="text/javascript">

    $(function() {

        $('.slimScrol').slimScroll({

            height: '250px',

            railVisible: true,

            alwaysVisible: true

        });

    });

</script>

@endpush