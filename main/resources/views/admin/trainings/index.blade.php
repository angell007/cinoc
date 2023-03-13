@extends('admin.layouts.admin_layout')

@section('content')
    <div class="page-content-wrapper">

        <div class="page-content">


            <div class="page-bar">

                <ul class="page-breadcrumb">

                    <li> <a href="{{ route('admin.home') }}">Inicio</a> <i class="fa fa-circle"></i> </li>

                    <li> <span>Lista de Capacitaciones</span> </li>

                </ul>

            </div>



            <h3 class="page-title"> Gestionar Capacitaciones <small>Admin</small> </h3>



            <div class="flex-row ">

                <div class="col-md-12 ">

                    <div class="d-flex justify-content-between">


                        <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-12 offset-2">
                            <a style="border-radius: 10px !important; border: 1px solid #ccc"
                                class="dashboard-stat dashboard-stat-v2 light"
                                href="{{ route('register_users_training') }}">
                                <div class="visual">
                                    <i class="fa fa-user">
                                    </i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="">
                                        </span>
                                    </div>
                                    <div class="desc">
                                        <small style="font-weight: bold"> Oferentes
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <a style="border-radius: 10px !important; border: 1px solid #ccc"
                                class="dashboard-stat dashboard-stat-v2 light"
                                href="{{ route('register_companies_training') }}">
                                <div class="visual">
                                    <i class="fa fa-building"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="">
                                        </span>
                                    </div>
                                    <div class="desc">
                                        <small style="font-weight: bold"> Compañias
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
