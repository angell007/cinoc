<div class="modal fade" id="fileModalUploaded" tabindex="-1" role="dialog" aria-labelledby="fileModalUpLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document"> <!-- Cambiado a modal-lg para hacer el modal más ancho -->

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title" id="fileModalUpLabel">Nuevo Participante Companie</h5>

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
                            <label for="name">Nombre Empresa</label>
                            <input class="form-control" id="name" aria-describedby="name" placeholder="Ingrese el nombre de la empresa">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="id_number">Documento</label>
                            <input class="form-control" id="id_number" aria-describedby="id_number" placeholder="Ingrese el documento">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="employe">Nombre Empleado</label>
                            <input class="form-control" id="employe" aria-describedby="employe" name="employe" placeholder="Ingrese el nombre del empleado">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="position">Cargo</label>
                            <input class="form-control" id="position" aria-describedby="position" name="position" placeholder="Ingrese el cargo">
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
