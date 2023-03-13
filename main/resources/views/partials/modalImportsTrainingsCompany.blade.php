<!-- Modal -->

<div class="modal fade" id="fileModalUpTrainings" tabindex="-1" role="dialog" aria-labelledby="fileModalUpTrainings"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileModalUpLabel">Importar Listado de capacitacion empresas
                </h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">&times;
                    </span> </button>
            </div>
            <form action="{{ route('file-import-trainings') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="text" class="form-control" name="name"placeholder="Titulo de la capacitación">
                    <br>
                    <input type="hidden" class="form-control" name="to" value="Empresas">
                    {{-- <label for="">Dirigido a : </label> --}}
                    {{-- <select class="form-control" name="to" placeholder=" Dirigido a : ">
                        <option value="Empresas"> Empresas </option>
                        <option value="Oferentes"> Oferentes </option>
                    </select> --}}
                    <br>
                    <select class="form-control" name="type">
                        <option value="Capacitación"> Capacitación </option>
                        <option value="Asesoria"> Asesoria </option>
                    </select> <input type="file" class="custom-up" name="file" id="fileUp">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Eviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
