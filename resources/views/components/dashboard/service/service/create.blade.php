<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Serive</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="save-form">
                    <div class="form-group">
                        <label for="" class="form-label">Service Name</label>
                        <input type="hidden" class="" id="dataId">
                        <input type="text" class="form-control" id="name" placeholder="Enter service name">
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input id="image" type="file" name="image"
                            onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])"
                            class="form-control">

                        <div class="my-3">
                            <img src="{{ asset('assets/dashboard/images/default_profile.png') }}"
                                style="border-radius: 5px" id="blah1" width="80" height="80" alt="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea id="shortDes" class="form-control" style="font-size: px; text-align: justify;" name="short_des"
                            rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="closeBtn" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id ="addBtn" onclick="addData()" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>
