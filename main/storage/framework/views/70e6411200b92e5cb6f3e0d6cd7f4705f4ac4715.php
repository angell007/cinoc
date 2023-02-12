<?php if(Auth::guard('company')->check()): ?>

<form action="<?php echo e(route('job.seeker.list')); ?>" method="get">

    <div class="searchbar">

        <div class="srchbox">

            <div class="row srcsubfld additional_fields">

                <div class="col-md-<?php echo e(((bool)$siteSetting->country_specific_site)? 6:3); ?>">

                    <?php echo Form::select('functional_area_id[]', ['' => __('Please select functional area')]+$functionalAreas, Request::get('functional_area_id', null), array('class'=>'form-control', 'id'=>'functional_area_id')); ?>


                </div>



                <?php if((bool)$siteSetting->country_specific_site): ?>

                <?php echo Form::hidden('country_id[]', Request::get('country_id[]', $siteSetting->default_country_id), array('id'=>'country_id')); ?>


                <?php else: ?>

                <div class="col-md-3">

                    <?php echo Form::select('country_id[]', ['' => __('Please select Country')]+$countries, Request::get('country_id', $siteSetting->default_country_id), array('class'=>'form-control', 'id'=>'country_id')); ?>


                </div>

                <?php endif; ?>



                <div class="col-md-3">

                    <span id="state_dd">

                        <?php echo Form::select('state_id[]', ['' => __('Please select State')], Request::get('state_id', null), array('class'=>'form-control', 'id'=>'state_id')); ?>


                    </span>

                </div>

                <div class="col-md-3">

                    <span id="city_dd">

                        <?php echo Form::select('city_id[]', ['' => __('Please select City')], Request::get('city_id', null), array('class'=>'form-control', 'id'=>'city_id')); ?>


                    </span>

                </div>

            </div>





            <div class="input-group">

                <input type="text" name="search" id="empsearch" value="<?php echo e(Request::get('search', '')); ?>" class="form-control" placeholder="<?php echo e(__('ingrese habilidades o detalles del buscador de candidatos')); ?>" autocomplete="off" />

                <span class="input-group-btn">

                    <input type="submit" class="btn" value="<?php echo e(__('Buscar candidatos')); ?>">

                </span>

            </div>

        </div>







    </div>

</form>

<?php else: ?>

<form action="<?php echo e(route('job.list')); ?>" method="get">

    <div class="searchbar">

        <div class="srchbox">

            <div class="row">

                <div class="col-lg-9 col-md-8">

                    <label for=""> <?php echo e(__('Palabras clave / Título del empleo')); ?></label>

                    <input type="text" name="search" id="jbsearch" value="<?php echo e(Request::get('search', '')); ?>" class="form-control" placeholder="<?php echo e(__('Enter Skills or job title')); ?>" autocomplete="off" />

                </div>

                <div class="col-lg-3 col-md-4">

                    <label for="">&nbsp;</label>

                    <input type="submit" class="btn" value="<?php echo e(__('Buscar trabajo')); ?>">

                </div>

            </div>



            <div class="srcsubfld additional_fields">

                <div class="row">

                    <div class="col-lg-<?php echo e(((bool)$siteSetting->country_specific_site)? 6:3); ?>">

                        <label for=""><?php echo e(__('Select Functional Area')); ?></label>

                        <?php echo Form::select('functional_area_id[]', ['' => __('Please select functional area')]+$functionalAreas, Request::get('functional_area_id', null), array('class'=>'form-control', 'id'=>'functional_area_id')); ?>


                    </div>



                    <?php if((bool)$siteSetting->country_specific_site): ?>

                    <?php echo Form::hidden('country_id[]', Request::get('country_id[]', $siteSetting->default_country_id), array('id'=>'country_id')); ?>


                    <?php else: ?>

                    <div class="col-lg-3">

                        <label for=""><?php echo e(__('Seleccione País')); ?></label>

                        <?php echo Form::select('country_id[]', ['' => __('Seleccione País')]+$countries, Request::get('country_id', $siteSetting->default_country_id), array('class'=>'form-control', 'id'=>'country_id')); ?>


                    </div>

                    <?php endif; ?>



                    <div class="col-lg-3">

                        <label for=""><?php echo e(__('Seleccione Departamento')); ?></label>

                        <span id="state_dd">

                            <?php echo Form::select('state_id[]', ['' => __('Seleccione Departamento')], Request::get('state_id', null), array('class'=>'form-control', 'id'=>'state_id')); ?>


                        </span>

                    </div>



                    <div class="col-lg-3">

                        <label for=""><?php echo e(__('Seleccione Ciudad')); ?></label>

                        <span id="city_dd">

                            <?php echo Form::select('city_id[]', ['' => __('Seleccione Ciudad')], Request::get('city_id', null), array('class'=>'form-control', 'id'=>'city_id')); ?>


                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</form>

<?php endif; ?><?php /**PATH C:\laragon\www\cinoc\main\resources\views/includes/search_form.blade.php ENDPATH**/ ?>