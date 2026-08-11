@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('Dashboard')]) 
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">@include('flash::message')
        <div class="row"> @include('includes.user_dashboard_menu')
            <div class="col-lg-9">
				
		<div class="profileban">
			<div class="abtuser">
				<div class="row">
					<div class="col-lg-2 col-md-2">
						<div class="uavatar">{{auth()->user()->printUserImage()}}</div>
					</div>
					<div class="col-lg-10 col-md-10">
						<div class="row">
							<div class="col-lg-7">
								<h4>{{auth()->user()->name}}</h4> 
								<h6><i class="fa fa-map-marker" aria-hidden="true"></i> {{Auth::user()->getLocation()}}</h6>
							</div>
							<div class="col-lg-5"><div class="editbtbn"><a href="{{ route('my.profile') }}"><i class="fas fa-pencil-alt" aria-hidden="true"></i> {{__('Edit Profile')}}</a>
						</div></div>
						</div>

						<ul class="row userdata">
							<li class="col-lg-6 col-md-6"><i class="fa fa-phone" aria-hidden="true"></i> {{auth()->user()->phone}}</li>							
							<li class="col-lg-6 col-md-6"><i class="fa fa-envelope" aria-hidden="true"></i> {{auth()->user()->email}}</li>
						</ul>

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
			
			</div>
               
        </div>
    </div>
</div>
@include('includes.footer')
@endsection
@push('scripts')
@include('includes.immediate_available_btn')
@endpush