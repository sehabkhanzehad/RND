<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add FAQ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="form-group">
                        <label for="" class="form-label">Question</label>
                        <input type="hidden" class="" id="dataId">
                        <input type="text" class="form-control" id="question" placeholder="Enter question">
                    </div>
                    <div class="form-group">
                        <label>Answer</label>
                        <textarea id ="answer" class="form-control" style="font-size: px; text-align: justify;" name="anwer" rows="5" placeholder="Enter answer"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="addBtn" onclick="addData()" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>
