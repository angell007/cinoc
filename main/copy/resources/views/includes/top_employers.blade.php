<div class="section bg py-5">
    <div class="container">
        <!-- título mejorado -->
        <div class="text-center mb-5">
            <h2 class="display-4 text-warning">Empresas <span class="font-weight-bold">Destacadas</span></h2>
            <p class="lead text-warning-50">Descubre las mejores oportunidades laborales</p>
        </div>

        <!-- Carrusel de empresas mejorado -->
        <div class="owl-carousel owl-theme">
            @if(isset($topCompanyIds) && count($topCompanyIds))
                @foreach($topCompanyIds as $company_id_num_jobs)
                    <?php
                    $company = App\Company::where('id', '=', $company_id_num_jobs->company_id)->where('is_featured', true)->active()->first();
                    if (null !== $company) {
                        ?>
                        <div class="item">
                            <div class="card shadow-sm hover-shadow-lg">
                                <div class="card-body text-center">
                                    <a href="{{route('company.detail', $company->slug)}}" class="d-block mb-3" title="{{$company->name}}">
                                        {{$company->printCompanyImage()}}
                                    </a>
                                    <h5 class="card-title">{{$company->name}}</h5>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Banner mejorado -->
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                {!! $siteSetting->index_page_below_top_employes_ad !!}
            </div>
        </div>
    </div>
</div>
