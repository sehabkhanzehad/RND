<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Feature</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="save-form">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-label">Title 1</label>
                                <input type="hidden" class="" id="dataId">
                                <input type="text" class="form-control" id="title1" placeholder="Enter title here">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="form-label">Title 2</label>
                                <input type="text" class="form-control" id="title2" placeholder="Enter title here">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Image 1</label>
                                <input id="image1" type="file" name=""
                                    onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])"
                                    class="form-control">

                                <div class="my-3">
                                    <img src="{{ asset("assets/dashboard/images/default_profile.png") }}" style="border-radius: 5px" id="blah1" width="80" height="80" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Image 2</label>
                                <input id="image2" type="file" name=""
                                    onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])"
                                    class="form-control">

                                <div class="my-3">
                                    <img src="{{ asset("assets/dashboard/images/default_profile.png") }}" style="border-radius: 5px" id="blah2" width="80" height="80" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id ="description1" class="form-control" style="font-size: px; text-align: justify;" name=""
                                    rows="8"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea id ="description2" class="form-control" style="font-size: px; text-align: justify;" name=""
                                    rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button"class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="addBtn" onclick="addData()" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>
