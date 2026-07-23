<div class="card">

        <form method="POST" id="formVideoCreate" action="{{route('store.video')}}" files="true" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="modalVideoCreateForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
    
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold" id="title-archivo">Nuevo Video</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mx-3">
                            <div class="form-group">
                                <label for="title">Titulo (*) </label>
                            <input type="text" class="form-control" name="title" placeholder="Enter titulo" >
                            </div>
    
                            <div class="form-group">
                                <label for="description">Descripcion</label>
                                <textarea type="text" class="form-control" name="description" placeholder="Enter descripcion"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="description">Rol</label>
                                <select class="form-select" name="rol">
                                    <option>
                                        Candidato
                                    </option>
                                    <option>
                                        Empleador
                                    </option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                    <label for="title">Link (*) </label>
                                <input type="text" class="form-control" name="link" placeholder="Enter Link" >
                                </div>
    
                        </div>
    
                        <div class="modal-footer d-flex justify-content-center">
                            <button class="btn btn-danger"> Save </button>
                        </div>
                    </div>
                </div>
            </div>
    
        </form>
    
    </div>
    
