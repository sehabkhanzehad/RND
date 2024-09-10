@extends('layouts.dashborad.master')
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Website</a></li>
            <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </ol>
    </nav>

    @include('components.dashboard.aboutus.about.data')
    @include('components.dashboard.aboutus.about.item-create')
    @include('components.dashboard.aboutus.about.item-delete')
@endsection

@section('script')
    <script>
        getData();
        getItemList();

        async function getData() {
            showLoader();
            const response = await axios.get("{{ route('about-us.data') }}");
            hideLoader();

            if (response.data.status == "success") {
                document.getElementById('video_link').value = response.data.data.video_link;
                document.getElementById('description').value = response.data.data.description;
                document.getElementById('blah1').src = response.data.data.image;
            } else {
                errorToast(response.data.message);
            }
        }

        async function upadteAbout() {
            let videoLink = document.getElementById('video_link').value;
            let image = document.getElementById('image').files[0];
            let description = document.getElementById('description').value;


            if (videoLink == "" && description == "") {
                errorToast("Please enter any one field.");
            } else if (videoLink == "") {
                errorToast("Please enter video link.");
            } else if (description == "") {
                errorToast("Please enter a description.");
            } else {

                let formData = new FormData();
                formData.append('video_link', videoLink);
                formData.append('image', image);
                formData.append('description', description);

                let config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                    },
                }
                showLoader();
                try {
                    const response = await axios.post("{{ route('about-us.update') }}", formData, config);
                    hideLoader();
                    if (response.data.status == "success") {
                        await getData();
                        successToast(response.data.message);
                    } else {
                        errorToast(response.data.message);
                    }
                } catch (err) {
                    hideLoader();
                    errorToast("Something wen't wrong. Please try again later.");
                }


            }
        }

        async function getItemList() {
            showLoader();
            const respons = await axios.get("{{ route('about-us.item-data') }}");
            hideLoader();

            let tableList = $("#tableList");
            let tableData = $("#tableData");

            tableData.DataTable().destroy();
            tableList.empty();

            respons.data.data.forEach(function(item, index) {
                let row = `<tr>
                                <td>${index + 1}</td>
                                <td><i class="bi bi-${item.icon_name}"></i></td>
                                <td class="text-wrap">${item.title}</td>
                                <td class="text-wrap text-justify">${item.description}</td>
                                <td>
                                    <button type="button"class="editBtn btn btn-success" data-no="${item.id}">Edit</button>
                                    <button type="button"class="deleteBtn btn btn-danger" data-no="${item.id}">Delete</button>
                                </td>
                            </tr>`;
                tableList.append(row);
            });

            $(".editBtn").on("click", async function() {
                let id = $(this).data("no");
                document.getElementById("save-form").reset();
                await fillupEditForm(id);
                $("#addModal").modal("show");
            });

            $(".deleteBtn").on("click", function() {
                let id = $(this).data("no");
                $("#deleteModal").modal("show");
                // document.getElementById("deleteId").value = id;
                $("#deleteId").val(id);
            });

            $('#tableData').DataTable({
                "bInfo": false,
                "bLengthChange": false,
                "paging": false
            });

        }

        async function addData() {
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
                try {
                    const response = await axios.post("{{ route('about-us.item-create') }}", {
                        icon_name: icon_name,
                        title: title,
                        description: item_description
                    });
                    hideLoader();

                    if (response.data.status == "success") {
                        $("#addItem").modal("hide");
                        document.getElementById('save-form').reset();
                        await getItemList();
                        successToast(response.data.message);
                    } else {
                        errorToast(response.data.message);
                    }
                } catch (err) {
                    hideLoader();
                    errorToast("Something wen't wrong. Please try again later.");
                }

            }
        }

        function openModal(){
            document.getElementById("save-form").reset();
            document.getElementById('modalTitle').innerHTML = "Add Item";
            document.getElementById('addBtn').innerHTML = "Add";
            document.getElementById('addBtn').setAttribute("onclick", "addData()");
            $("#addModal").modal("show");
        }

        async function fillupEditForm(id) {
            showLoader();
            const respons = await axios.get("{{ route('about-us.item-id') }}", {
                params: {
                    id: id
                }
            });
            hideLoader();
            document.getElementById('dataId').value = respons.data.data.id;
            document.getElementById('modalTitle').innerHTML = "Edit Item";
            document.getElementById('addBtn').innerHTML = "Update";
            document.getElementById('addBtn').setAttribute("onclick", "updateItem()");

            document.getElementById('dataId').value = respons.data.data.id;
            document.getElementById('icon_name').value = respons.data.data.icon_name;
            document.getElementById('title').value = respons.data.data.title;
            document.getElementById('item_description').value = respons.data.data.description;
        }

        function openModal() {
            document.getElementById("save-form").reset();
            document.getElementById('modalTitle').innerHTML = "Add Item";
            document.getElementById('addBtn').innerHTML = "Add";
            document.getElementById('addBtn').setAttribute("onclick", "addData()");
            $("#addModal").modal("show");
        }

        async function updateItem() {
            let id = document.getElementById('dataId').value;
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
                try {
                    const response = await axios.post("{{ route('about-us.item-update') }}", {
                        id: id,
                        icon_name: icon_name,
                        title: title,
                        description: item_description
                    });
                    hideLoader();

                    if (response.data.status == "success") {
                        $("#addModal").modal("hide");
                        document.getElementById('save-form').reset();
                        await getItemList();
                        successToast(response.data.message);
                    } else {
                        errorToast(response.data.message);
                    }
                } catch (err) {
                    hideLoader();
                    errorToast("Something wen't wrong. Please try again later.");
                }
            }

        }

        async function deleteItem() {
            let id = $("#deleteId").val();
            showLoader();
            const response = await axios.post("{{ route('about-us.item-delete') }}", {
                id: id
            });
            hideLoader();
            if (response.data.status == "success") {
                $("#deleteModal").modal("hide");
                await getItemList();
                successToast(response.data.message);
            } else {
                errorToast(response.data.message);
            }
        }
    </script>
@endsection
