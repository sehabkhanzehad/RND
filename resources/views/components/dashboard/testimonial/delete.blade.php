{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="text-danger text-center" id="exampleModalLabel">Are you sure?</h4>
                <h5 class="text-center">Once delete, you can't get it back.</h5>
                <form>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="deleteId">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="deleteItem()" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
