<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
    </button> --}}
<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="form-group">
                        <label for="" class="form-label">Stat Name</label>
                        <input type="hidden" class="" id="stat_id">
                        <input type="text" class="form-control" id="stat_name" placeholder="Enter stat name">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Stat Value</label>
                        <input type="text" class="form-control" id="stat_value" placeholder="Enter stat value">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id = "addBtn" onclick="addStat()" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>
