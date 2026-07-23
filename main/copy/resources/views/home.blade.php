@extends('layouts.app')

@section('content')

<!-- Encabezado -->
@include('includes.header')

<!-- Título de la página interna -->
@include('includes.inner_page_title', ['page_title'=>__('Panel de Control')])

<div class="dashboard-wrapper py-5">
    <div class="container">
        @include('flash::message')
        <div class="row">
            @include('includes.user_dashboard_menu')
            <div class="col-lg-9">
                <div class="profile-banner bg-light rounded p-4 mb-4 shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-md-3 mb-3 mb-md-0">
                            <div class="avatar-wrapper">
                                {{auth()->user()->printUserImage()}}
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-9">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h2 class="mb-1">{{auth()->user()->name}}</h2>
                                    <p class="text-muted mb-0"><i class="fa fa-map-marker-alt mr-2"></i>{{Auth::user()->getLocation()}}</p>
                                </div>
                                <a href="{{ route('my.profile') }}" class="btn btn-outline-secondary"><i class="fas fa-pencil-alt mr-2"></i>{{__('Editar Perfil')}}</a>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2 mb-md-0">
                                    <p class="mb-0"><i class="fa fa-phone mr-2"></i>{{auth()->user()->phone}}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-0"><i class="fa fa-envelope mr-2"></i>{{auth()->user()->email}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('includes.user_dashboard_stats')

                @if((bool)config('jobseeker.is_jobseeker_package_active'))
                    @php
                    $packages = App\Package::where('package_for', 'like', 'job_seeker')->get();
                    $package = Auth::user()->getPackage();
                    if(null !== $package){
                        $packages = App\Package::where('package_for', 'like', 'job_seeker')->where('id', '<>', $package->id)->where('package_price', '>=', $package->package_price)->get();
                    }
                    @endphp

                    @if(null !== $package)
                        @include('includes.user_package_msg')
                        @include('includes.user_packages_upgrade')
                    @else
                        @if(null !== $packages)
                            @include('includes.user_packages_new')
                        @endif
                    @endif
                @endif

                <div class="row">
                    <div class="col-lg-7 mb-4 mb-lg-0">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-light">
                                <h3 class="mb-0 text-secondary"><i class="fa fa-briefcase mr-2"></i>{{__('Trabajos Recomendados')}}</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    @if(null!==($matchingJobs))
                                        @foreach($matchingJobs as $match)
                                            <li class="mb-3 pb-3 border-bottom">
                                                <h4 class="mb-1"><a href="{{route('job.detail', [$match->slug])}}" class="text-dark">{{$match->title}}</a></h4>
                                                <p class="text-muted mb-0">{{$match->getCompany()->name}}</p>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-light">
                                <h3 class="mb-0 text-secondary"><i class="fa fa-users mr-2"></i>{{__('Mis Seguimientos')}}</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    @if(isset($followers) && null!==($followers))
                                        @foreach($followers as $follow)
                                            @php $company = DB::table('companies')->where('slug',$follow->company_slug)->where('is_active',1)->first(); @endphp
                                            <li class="mb-3 pb-3 border-bottom">
                                                <h5 class="mb-1">{{$company->name}}</h5>
                                                <p class="text-muted mb-2">{{$company->location}}</p>
                                                <a href="{{route('company.detail',$company->slug)}}" class="btn btn-sm btn-outline-secondary">{{__('Ver Detalles')}}</a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <a href="{{route('my.followings')}}" class="btn btn-block btn-outline-secondary"><i class="fa fa-user mr-2"></i>{{__('Ver Todos')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.footer')
@endsection

@push('scripts')
@include('includes.immediate_available_btn')
@endpush