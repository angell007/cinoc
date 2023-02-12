<div class="modal-body">
    <div class="form-body">
        <div class="formrow" id="div_title">
            <input class="form-control" id="titleExp" placeholder="{{__('Experience Title')}}" name="title" type="text" value="{{(isset($profileExperience)? $profileExperience->title:'')}}">
            <span class="help-block text-danger title-error"></span>
        </div>
        
        <div class="formrow" id="div_title">
            <input class="form-control" id="titleExp" placeholder="Cargo" name="title" type="text" value="">
            <span class="help-block text-danger title-error"></span>
        </div>
        
        <div class="formrow" id="div_title">
            <input class="form-control" id="titleExp" placeholder="Ocupacíon" name="title" type="text" value="">
            <span class="help-block text-danger title-error"></span>
        </div>

        <div class="formrow" id="div_company">
            <input class="form-control" id="companyExp" placeholder="{{__('Company')}}" name="company" type="text" value="{{(isset($profileExperience)? $profileExperience->company:'')}}">
            <span class="help-block text-danger company-error"></span>
        </div>

        <div class="formrow" id="div_country_id">
            <?php
            $country_id = (isset($profileExperience) ? $profileExperience->country_id : $siteSetting->default_country_id);
            ?>
            {!! Form::select('country_id', [''=>__('Select Country')]+$countries, $country_id, array('class'=>'form-control', 'id'=>'experience_country_id')) !!}
            <span class="help-block text-danger country_id-error"></span>
        </div>

        <div class="formrow" id="div_state_id">
            <span id="default_state_experience_dd">
                {!! Form::select('state_id', [''=>__('Select State')], null, array('class'=>'form-control', 'id'=>'experience_state_id')) !!}
            </span>
            <span class="help-block text-danger state_id-error"></span>
        </div>

        <div class="formrow" id="div_city_id">
            <span id="default_city_experience_dd">
                
                {!! Form::select('city_id', [''=>__('Select State')], null, array('class'=>'form-control', 'id'=>'_id')) !!}

                <!--{!! Form::select('city_id', [''=>__('Select City')], null, array('class'=>'form-control', 'id'=>'city_idd')) !!}-->
            </span>
            <span class="help-block text-danger city_id-error"></span>
        </div>

        <div class="formrow" id="div_date_start">
            <input class="form-control datepicker" autocomplete="off" id="date_startExp" placeholder="{{__('Experience Start Date')}}" name="date_start" type="text" value="{{(isset($profileExperience->date_start)? $profileExperience->date_start->format('Y-m-d'):'')}}">
            <span class="help-block text-danger date_start-error"></span>
        </div>
        <div class="formrow" id="div_date_end">
            <input class="form-control datepicker" autocomplete="off" id="date_endExp" placeholder="{{__('Experience End Date')}}" name="date_end" type="text" value="{{(isset($profileExperience->date_end)? $profileExperience->date_end->format('Y-m-d'):'')}}">
            <span class="help-block text-danger date_end-error"></span>
        </div>
        <div class="formrow" id="div_is_currently_working">
            <label for="is_currently_working" class="bold">{{__('Laborando actualmente?')}}</label>
            <div class="radio-list">
                <?php
                $val_1_checked = '';
                $val_2_checked = 'checked="checked"';

                if (isset($profileExperience) && $profileExperience->is_currently_working == 1) {
                    $val_1_checked = 'checked="checked"';
                    $val_2_checked = '';
                }
                ?>
                <label class="radio-inline"><input id="currently_working" name="is_currently_working" type="radio" value="1" {{$val_1_checked}}> {{__('Yes')}} </label>
                <label class="radio-inline"><input id="not_currently_working" name="is_currently_working" type="radio" value="0" {{$val_2_checked}}> {{__('No')}} </label>
            </div>
            <span class="help-block text-danger is_currently_working-error"></span>
        </div>
        
        
        <!--<div class="formrow" id="adjunto">-->
        <!-- <label for="ppt" class="form-control" data-role="button" data-inline="true" data-mini="true" data-corners="false">Click aquí para adjuntar un archivo</label>-->
        <!-- <input id="ppt" type="file" name="ppt" multiple data-role="button" data-inline="true" data-mini="true" data-corners="false" style="opacity: 0;"/>-->
        <!--</div>-->
        
        
        <!--<div class="formrow" id="div_image">-->
        <!--    <label>Adjuntar un archivo</label>-->
        <!--    <div class="uploadphotobx dropzone needsclick dz-clickable" id="dropzone"> <i class="fa fa-upload" aria-hidden="true"></i>-->
        <!--        <div class="dz-message" data-dz-message><span>{{__('Click aquí para adjuntar un archivo')}}.</span></div>-->
        <!--        <div class="fallback">-->
        <!--            <input name="adjun" type="file" />-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <span class="help-block text-danger image-error"></span>-->
        <!--</div>-->
        
        
        <div class="formrow" id="file-adjunto">
            <label>Adjuntar un archivo</label>
            <input type="file" name="adjunto" accept="image/png, image/jpeg" class="form-control" id="adjunto" placeholder="{{__('Adjunto')}}"></input>
            <span class="help-block text-danger adjunto-error"></span>
        </div>

        <div class="formrow" id="div_description">
            <textarea name="description" class="form-control" id="descriptionExp" placeholder="{{__('Experience description')}}">{{(isset($profileExperience)? $profileExperience->description:'')}}</textarea>
            <span class="help-block text-danger description-error"></span>
        </div>
        
       <!-- type="file"-->
       <!--id="avatar" name="avatar"-->
       <!--accept="image/png, image/jpeg">-->
       
    </div>
</div>