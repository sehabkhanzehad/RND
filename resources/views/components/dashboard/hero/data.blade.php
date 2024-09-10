<div class="row">

    <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Update Background</h6>
                    <div class="form-group">
                        <label>Background Image</label>
                        <input id="background_iamge" type="file" name=""
                            onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])"
                            class="form-control">
                        <div class="my-3">
                            <img src="" id="blah1" width="80" alt="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Hover Image</label>
                        <input id="hover_image" type="file" name=""
                            onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])"
                            class="form-control">
                        <div class="my-3">
                            <img src="" id="blah2" width="50" alt="">
                        </div>
                    </div>
                    <button onclick="updateBackground()" type="submit"
                        class="btn btn-primary mr-2 float-right">Update</button>
                </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Update Text</h6>
                <div class="form-group">
                    <label>Title</label>
                    <input id="title" placeholder="Title here" value="" type="text" name=""
                        class="form-control">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea id ="description" placeholder="Footer Text" class="form-control" style="font-size: px; text-align: justify;"
                        name="" rows="11"></textarea>
                </div>
                <button onclick="updateContent()" type="submit" class="btn btn-primary mr-2 float-right">Update</button>
            </div>
        </div>
    </div>
</div>
