<!-- Modal -->
<div class="modal fade" id="fileModalUp" tabindex="-1" role="dialog" aria-labelledby="fileModalUpLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileModalUpLabel">Upload Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('file-upload')}}" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="modal-body">

                    <input type="file" class="custom-up"  name="file" id="fileUp">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>