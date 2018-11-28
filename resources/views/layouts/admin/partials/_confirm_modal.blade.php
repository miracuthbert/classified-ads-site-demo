<div class="modal fade" id="{{ $modal_id or "confirm-modal" }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><i class="fa fa-warning"></i> {{ $title or "Alert" }}</h4>
            </div>
            <div class="modal-body">
                <p>{{ $message or "Are you sure want to do this?" }}</p>
            </div>
            <div class="modal-footer">
                @if(isset($action))
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                            onclick="event.preventDefault(); document.getElementById('{{ $action }}').submit();">Yes
                    </button>
                @else
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
                @endif
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
