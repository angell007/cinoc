<!-- Modal -->

<div class="modal fade" id="ModalUpCvList" tabindex="-1" role="dialog" aria-labelledby="ModalUpCvList" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Crear lista de hojas de vida remitidas</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>

            <form action="{{ route('create-list-sendedcvs') }}" method="post">

                {{ csrf_field() }}

                <div class="modal-body">

                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombre">

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-success">Eviar</button>

                </div>

            </form>

        </div>

    </div>

</div>
