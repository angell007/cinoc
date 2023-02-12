<div class="userloginbox">
	<div class="container">
		<div class="titleTop">
			<h3>Bolsa de Empleo de la IES-CINOC </h3>
		</div>
		<p class="text-dark " style="font-weight: 900;">
		    La Bolsa de Empleo de la IES-CINOC, busca ser la primera opción para sus Egresados y Estudiantes en la búsqueda de empleo.
		</p>
		<p class="align-content">
                    Facilitar el acercamiento entre los oferentes, estudiantes y egresados, de la Bolsa de
                    Empleo de la Institución de Educación Superior - Colegio Integrado Nacional Oriente
                    de Caldas que están en disposición de ofrecer sus servicios, y los demandantes,
                    empleadores, interesados en recibir hojas de vida para cubrir una vacante; de esta
                    manera consolidar su grupo de trabajo preparando el proceso de incursión al
                    mercado laboral de los Egresados y Estudiantes de la IES-CINOC, a través de la
                    publicación de ofertas laborales de acuerdo a su perfil académico. La postulación a
                    las ofertas laborales a través de la Bolsa de Empleo, será de uso exclusivo para
                    Estudiantes activos y Egresados de la Institución de Educación Superior - Colegio
                    Integrado Nacional Oriente.
		</p>

		<?php if(!Auth::user() && !Auth::guard('company')->user()): ?>
		<!-- <div class="viewallbtn"><a href="<?php echo e(route('register')); ?>"> <?php echo e(__('Get Started Today')); ?> </a></div> -->
		<?php else: ?>
		<div class="viewallbtn"><a href="<?php echo e(url('my-profile')); ?>"><?php echo e(__('Build Your CV')); ?> </a></div>
		<?php endif; ?>
	</div>
</div><?php /**PATH C:\laragon\www\cinoc\main\resources\views/includes/login_text.blade.php ENDPATH**/ ?>