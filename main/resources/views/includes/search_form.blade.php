@if(Auth::guard('company')->check())

<form action="{{route('job.seeker.list')}}" method="get">

    <div class="searchbar">

        <div class="srchbox">

            <div class="row srcsubfld additional_fields">

                <div class="col-md-{{((bool)$siteSetting->country_specific_site)? 6:3}}">

                    {!! Form::select('functional_area_id[]', ['' => __('Please select functional area')]+$functionalAreas, Request::get('functional_area_id', null), array('class'=>'form-control', 'id'=>'functional_area_id')) !!}

                </div>



                @if((bool)$siteSetting->country_specific_site)

                {!! Form::hidden('country_id[]', Request::get('country_id[]', $siteSetting->default_country_id), array('id'=>'country_id')) !!}

                @else

                <div class="col-md-3">

                    {!! Form::select('country_id[]', ['' => __('Please select Country')]+$countries, Request::get('country_id', $siteSetting->default_country_id), array('class'=>'form-control', 'id'=>'country_id')) !!}

                </div>

                @endif



                <div class="col-md-3">

                    <span id="state_dd">

                        {!! Form::select('state_id[]', ['' => __('Please select State')], Request::get('state_id', null), array('class'=>'form-control', 'id'=>'state_id')) !!}

                    </span>

                </div>

                <div class="col-md-3">

                    <span id="city_dd">

                        {!! Form::select('city_id[]', ['' => __('Please select City')], Request::get('city_id', null), array('class'=>'form-control', 'id'=>'city_id')) !!}

                    </span>

                </div>

            </div>





            <div class="input-group">

                <input type="text" name="search" id="empsearch" value="{{Request::get('search', '')}}" class="form-control" placeholder="{{__('ingrese habilidades o detalles del buscador de candidatos')}}" autocomplete="off" />

                <span class="input-group-btn">

                    <input type="submit" class="btn" value="{{__('Buscar candidatos')}}">

                </span>

            </div>

        </div>







    </div>

</form>

@else

<form action="{{route('job.list')}}" method="get">

    <div class="searchbar">

        <div class="srchbox">

            <div class="row">

                <div class="col-lg-9 col-md-8">

                    <label for=""> {{__('Palabras clave / Título del empleo')}}</label>

                    <input type="text" name="search" id="jbsearch" value="{{Request::get('search', '')}}" class="form-control" placeholder="{{__('Enter Skills or job title')}}" autocomplete="off" />

                </div>

                <div class="col-lg-3 col-md-4">

                    <label for="">&nbsp;</label>

                    <input type="submit" class="btn" value="{{__('Buscar trabajo')}}">

                </div>

            </div>



            <div class="srcsubfld additional_fields">

                <div class="row">

                    <div class="col-lg-{{((bool)$siteSetting->country_specific_site)? 6:3}}">

                        <label for="">{{__('Select Functional Area')}}</label>

                        {!! Form::select('functional_area_id[]', ['' => __('Please select functional area')]+$functionalAreas, Request::get('functional_area_id', null), array('class'=>'form-control', 'id'=>'functional_area_id')) !!}

                    </div>



                    @if((bool)$siteSetting->country_specific_site)

                    {!! Form::hidden('country_id[]', Request::get('country_id[]', $siteSetting->default_country_id), array('id'=>'country_id')) !!}

                    @else

                    <div class="col-lg-3">

                        <label for="">{{__('Seleccione País')}}</label>

                        {!! Form::select('country_id[]', ['' => __('Seleccione País')]+$countries, Request::get('country_id', $siteSetting->default_country_id), array('class'=>'form-control', 'id'=>'country_id')) !!}

                    </div>

                    @endif



                    <div class="col-lg-3">

                        <label for="">{{__('Seleccione Departamento')}}</label>

                        <span id="state_dd">

                            {!! Form::select('state_id[]', ['' => __('Seleccione Departamento')], Request::get('state_id', null), array('class'=>'form-control', 'id'=>'state_id')) !!}

                        </span>

                    </div>



                    <div class="col-lg-3">

                        <label for="">{{__('Seleccione Ciudad')}}</label>

                        <span id="city_dd">

                            {!! Form::select('city_id[]', ['' => __('Seleccione Ciudad')], Request::get('city_id', null), array('class'=>'form-control', 'id'=>'city_id')) !!}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</form>

@endif