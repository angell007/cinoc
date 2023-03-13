<div class="modal fade" id="fileModalUploaded" tabindex="-1" role="dialog" aria-labelledby="fileModalUpLabel"
    aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="fileModalUpLabel">Nuevo Participante Companie</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <form action="{{ route('upload-participant') }}" method="post" id="form">



                {{ csrf_field() }}



                <div class="modal-body">




                    <div class="form-group">

                        <label for="name">Nombre Empresa</label>

                        <input class="form-control" id="name" aria-describedby="name" placeholder="">

                    </div>

                    <div class="form-group">

                        <label for="name">Documento</label>

                        <input class="form-control" id="id_number" aria-describedby="id_number" placeholder="">

                    </div>

                    <div class="form-group">

                        <label for="employe">Nombre Empresa</label>

                        <input class="form-control" id="employe" aria-describedby="employe" name="employe" placeholder="">

                    </div>

                    <div class="form-group">

                        <label for="position">Cargo</label>

                        <input class="form-control" id="position" aria-describedby="position" name="position" placeholder="">

                    </div>


                    <div class="form-group">

                        <label for="name">Contacto</label>

                        <input class="form-control" id="phone" aria-describedby="phone" placeholder="">

                    </div>

                    <div class="form-group">

                        <label for="name">Email</label>

                        <input type="email" class="form-control" id="email" aria-describedby="email"
                            placeholder="">

                    </div>


                    <div class="form-group">

                        <label for="name">Estado</label>

                        <select class="form-control" id="status" name="status">

                            <option>Culminó</option>

                            <option>Asistió</option>

                            <option>Direccionado</option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-success">Save changes</button>

                </div>

            </form>

        </div>

    </div>

</div>
