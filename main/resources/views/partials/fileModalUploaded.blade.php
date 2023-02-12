<!-- Modal -->
<div class="modal fade" id="fileModalUploaded" tabindex="-1" role="dialog" aria-labelledby="fileModalUpLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileModalUpLabel">Nuevo Participante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('upload-participant')}}" method="post" id="form">

                {{ csrf_field() }}

                <div class="modal-body">

                    <!--<input type="file" class="custom-up"  name="file" id="fileUp">-->
                    
                      <div class="form-group">
                        <label for="name">Nombre</label>
                        <input  class="form-control" id="name" aria-describedby="name" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="name">Contacto</label>
                        <input class="form-control" id="phone" aria-describedby="phone" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="name">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="email" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="name">Documento</label>
                        <input  class="form-control" id="id_number" aria-describedby="id_number" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="name">Semestre</label>
                        <select  class="form-control" id="semester" name="semester">
                              <option>I</option>
                              <option>II</option>
                              <option>III</option>
                              <option>IV</option>
                              <option>V</option>
                              <option>VI</option>
                              <option>VII</option>
                              <option>VIII</option>
                              <option>IX</option>
                              <option>X</option>
                            </select>
                      </div>
                      <div class="form-group">
                        <label for="name">Estado</label>
                       <select  class="form-control" id="status" name="status">
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