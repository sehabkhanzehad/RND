<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Update About Us</h6>
                <div class="form-group">
                    <label>Video Link</label>
                    <input id="video_link" value="" type="text" name="video_link" class="form-control">
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input id="image" type="file" name="image"
                        onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])"
                        class="form-control">
                    <div class="my-3">
                        <img src="" id="blah1" width="100" alt="">
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea id ="description" class="form-control" style="font-size: px; text-align: justify;" name="description"
                        rows="6"></textarea>
                </div>
                <button onclick="upadteAbout()" type="submit" class="btn btn-primary mr-2">Update</button>
            </div>
        </div>
    </div>


    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title d-inline-block">Item</h6>
                <button type="button" class="btn btn-primary btn-icon d-inline-block float-right">
                    <i data-feather="plus-circle"></i>
                </button>
                <div class="table-responsive">
                    <table class="table table-hover" id="tableData">
                        <thead>
                            <tr class="bg-light">
                                <th>#</th>
                                <th>Icon</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableList">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // getItemList();

    async function getItemList() {
        showLoader();
        const respons = await axios.get("{{ route('about-us.item-data') }}");
        hideLoader();

        // let tableList = $("#tableList");
        // let tableData = $("#tableData");

        tableData.DataTable().destroy();
        tableList.empty();

        respons.data.data.forEach(function(item, index) {
            let row = `<tr>
                <td>${index + 1}</td>
                <td><i class="bi bi-${item.icon_name}"></i></td>
                <td>${item.title}</td>
                <td>${item.description}</td>
                <td>
                    <button type="button" id="editBtn" class="btn btn-success btn-icon" data-no="${item.id}" data-toggle="modal" data-target="editItem"><i data-feather="edit"></i></button>

                    <button type="button" class="deleteBtn btn btn-danger btn-icon" data-no="${item.id}"><i data-feather="trash"></i></button>
                </td>
            </tr>`;
            tableList.append(row);
        });

        // $(".editBtn").on("click", async function() {
        //     let categoryId = $(this).data("no");
        //     await fillupUpdateForm(categoryId);
        //     $("#update-modal").modal("show");
        // });

        $(".deleteBtn").on("click", function() {
            let id = $(this).data("no");
            $("#deleteModal").modal("show");
            // document.getElementById("deleteId").value = id;
            $("#deleteId").val(id);
        });



        new DataTable('#tableData', {

            "bInfo": false,
            "bLengthChange": false,
            "paging": false
        });
    }
</script>
