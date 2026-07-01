<div class="row profilestat">
    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <i class="fa fa-eye fa-3x mb-3 text-primary" aria-hidden="true"></i>
                <h4 class="card-title mb-0">{{Auth::user()->num_profile_views}}</h4>
                <p class="card-text text-muted">{{__('Vistas del perfil')}}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <i class="fa fa-user-o fa-3x mb-3 text-success" aria-hidden="true"></i>
                <h4 class="card-title mb-0"><a href="{{route('my.followings')}}" class="text-decoration-none">{{Auth::user()->countFollowings()}}</a></h4>
                <p class="card-text text-muted">{{__('Siguiendo')}}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <i class="fa fa-briefcase fa-3x mb-3 text-warning" aria-hidden="true"></i>
                <h4 class="card-title mb-0"><a href="{{url('my-profile#cvs')}}" class="text-decoration-none">{{Auth::user()->countProfileCvs()}}</a></h4>
                <p class="card-text text-muted">{{__('Mis CVs')}}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <i class="fa fa-envelope-o fa-3x mb-3 text-danger" aria-hidden="true"></i>
                <h4 class="card-title mb-0"><a href="{{route('my.messages')}}" class="text-decoration-none">{{Auth::user()->countUserMessages()}}</a></h4>
                <p class="card-text text-muted">{{__('Mensajes')}}</p>
            </div>
        </div>
    </div>
</div>