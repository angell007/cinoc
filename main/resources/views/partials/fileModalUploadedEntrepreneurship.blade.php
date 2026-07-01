<div class="modal fade" id="fileModalUploaded" tabindex="-1" role="dialog" aria-labelledby="fileModalUpLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document"> <!-- Cambiado a modal-lg para hacer el modal más ancho -->

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title" id="fileModalUpLabel">Nuevo Participante Emprendimiento</h5>

                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <form action="{{ route('upload-participant') }}" method="post" id="form">

                {{ csrf_field() }}

                <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="created_at">Fecha</label>
                            <input type="date" class="form-control" id="created_at" aria-describedby="created_at" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Nombre</label>
                            <input class="form-control" id="name" aria-describedby="name" placeholder="Ingrese el nombre">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="identifier">Identificación</label>
                            <input class="form-control" id="identifier" aria-describedby="identifier" placeholder="Ingrese la identificación">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="phone">Contacto</label>
                            <input class="form-control" id="phone" aria-describedby="phone" placeholder="Ingrese el contacto">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="email" placeholder="Ingrese el email">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="sexo">Sexo</label>
                            <input class="form-control" id="sexo" aria-describedby="sexo" placeholder="Ingrese el sexo">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="segmento">Segmento</label>
                            <input class="form-control" id="segmento" aria-describedby="segmento" placeholder="Ingrese el segmento">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="functional_area">Área funcional</label>
                            <input class="form-control" id="functional_area" aria-describedby="functional_area" placeholder="Ingrese el área funcional">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="rol">Rol</label>
                            <input class="form-control" id="rol" aria-describedby="rol" placeholder="Ingrese el rol">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="entrepreneurship_name">Nombre del Emprendimiento</label>
                            <input class="form-control" id="entrepreneurship_name" aria-describedby="entrepreneurship_name" placeholder="Ingrese el nombre del emprendimiento">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="status">Estado</label>
                            <select class="form-control" id="status" name="status">
                                <option value="" disabled selected>Seleccione el estado</option>
                                <option value="culmino">Culminó</option>
                                <option value="asistio">Asistió</option>
                                <option value="direccionado">Direccionado</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar cambios</button>
                </div>

            </form>

        </div>

    </div>

</div>
