<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
    </button> --}}
<!-- Modal -->
<div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="save-form">
                    <div class="form-group">
                        <label for="" class="form-label">Icon Name</label><a class="float-right"
                            href="https://icons.getbootstrap.com/" target="_blank">See all icon</a>
                        <input type="text" class="form-control" id="icon_name" placeholder="Enter icon name">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter title here">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Description</label>
                        <textarea id ="item_description" class="form-control" style="font-size: px; text-align: justify;"
                            name="item_description" rows="4"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="addItem()" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>
<script>
    async function addItem() {

        let icon_name = document.getElementById('icon_name').value;
        let title = document.getElementById('title').value;
        let item_description = document.getElementById('item_description').value;

        if (icon_name == "" && title == "" && item_description == "") {
            errorToast("Please enter any one field.");
        } else if (icon_name == "") {
            errorToast("Please enter icon name.");
        } else if (title == "") {
            errorToast("Please enter title.");
        } else if (description == "") {
            errorToast("Please enter description.");
        } else {
            showLoader();
            const response = await axios.post("{{ route('about-us.item-create') }}", {
                icon_name: icon_name,
                title: title,
                description: item_description
            });
            hideLoader();

            if (response.data.status == "success") {
                $("#addItem").modal("hide");
                // document.getElementById("modal-close").click();
                document.getElementById('save-form').reset();
                await getItemList();
                successToast(response.data.message);
            } else {
                errorToast(response.data.message);
            }

        }
    }
</script>
