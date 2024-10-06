@extends('layouts.dashborad.master')

@section('content')
    @include('components.dashboard.project.data')
    @include('components.dashboard.project.create')
    @include('components.dashboard.project.delete')
@endsection

@section('script')
    <script>
        getData()

        async function getData() {
            showLoader();
            const respons = await axios.get("{{ route('project.data') }}");
            hideLoader();

            let tableList = $("#tableList");
            let tableData = $("#tableData");

            tableData.DataTable().destroy();
            tableList.empty();

            respons.data.data.forEach(function(item, index) {
                let row = `<tr>
                    <td>${index + 1}</td>
                    <td>${item.name}</td>
                    <td>${item.category}</td>
                    <td> <img src="${item.image}" class="rounded-circle wd-35" alt="team"></td>
                    <td>${item.url}</td>
                    <td>${item.published_date}</td>
                    <td>
                        <button type="button"class="editBtn btn btn-success" data-no="${item.id}">Edit</button>
                        <button type="button"class="deleteBtn btn btn-danger" data-no="${item.id}">Delete</button>
                    </td>
                    </tr>`;
                tableList.append(row);
            });
            // <td class="text-wrap text-justify">${item.description}</td>


            $(".editBtn").on("click", async function() {
                let id = $(this).data("no");
                document.getElementById("save-form").reset();
                await fillupEditForm(id);
                $("#addModal").modal("show");
            });

            $(".deleteBtn").on("click", function() {
                let id = $(this).data("no");
                $("#deleteModal").modal("show");
                $("#deleteId").val(id);
            });

            $('#tableData').DataTable({
                "bInfo": false,
                "bLengthChange": false,
                "paging": false
            });

        }

        async function fillupEditForm(id) {
            showLoader();
            const respons = await axios.get("{{ route('project.id') }}", {
                params: {
                    id: id
                }
            });
            hideLoader();
            document.getElementById('dataId').value = respons.data.data.id;
            document.getElementById('modalTitle').innerHTML = "Edit Project";
            document.getElementById('addBtn').innerHTML = "Update";
            document.getElementById('addBtn').setAttribute("onclick", "updateProject()");

            document.getElementById('name').value = respons.data.data.name;
            document.getElementById('description').value = respons.data.data.description;
            document.getElementById('blah1').src = respons.data.data.image;
            document.getElementById('category').value = respons.data.data.category;
            document.getElementById('url').value = respons.data.data.url;
            document.getElementById('published_date').value = respons.data.data.published_date;
        }

        function openModal() {
            document.getElementById("blah1").src = "{{ asset('assets/dashboard/images/default_profile.png') }}";
            document.getElementById("save-form").reset();
            document.getElementById('modalTitle').innerHTML = "Add Project";
            document.getElementById('addBtn').innerHTML = "Add";
            document.getElementById('addBtn').setAttribute("onclick", "addData()");
            $("#addModal").modal("show");
        }

        async function addData() {
            let name = document.getElementById('name').value;
            let category = document.getElementById('category').value;
            let image = document.getElementById('image').files[0];
            let description = document.getElementById('description').value;
            let url = document.getElementById('url').value;
            let published_date = document.getElementById('published_date').value;


            if (name == "" || !image) {
                errorToast("Name and image are required.");
            } else if (name == "") {
                errorToast("Please enter a project name.");
            } else if (!image) {
                errorToast("Please select an image.");
            } else {
                let formData = new FormData();
                formData.append('name', name);
                formData.append('category', category);
                formData.append('image', image);
                formData.append('description', description);
                formData.append('url', url);
                formData.append('published_date', published_date);

                let config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                    },
                }
                showLoader();
                try {
                    const response = await axios.post("{{ route('project.create') }}", formData, config);
                    hideLoader();

                    if (response.data.status == "success") {
                        $("#addModal").modal("hide");
                        await getData();
                        document.getElementById('save-form').reset();
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

        async function updateProject() {
            let id = document.getElementById('dataId').value;
            let name = document.getElementById('name').value;
            let category = document.getElementById('category').value;
            let image = document.getElementById('image').files[0];
            let description = document.getElementById('description').value;
            let url = document.getElementById('url').value;
            let published_date = document.getElementById('published_date').value;

            if (name == "") {
                errorToast("Please enter a project name.");
            } else {
                let formData = new FormData();
                formData.append('id', id);
                formData.append('name', name);
                formData.append('image', image);
                formData.append('category', category);
                formData.append('description', description);
                formData.append('url', url);
                formData.append('published_date', published_date);

                let config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                    },
                }

                showLoader();
                try {
                    const response = await axios.post("{{ route('project.update') }}", formData, config);
                    hideLoader();

                    if (response.data.status == "success") {
                        $("#addModal").modal("hide");
                        document.getElementById('save-form').reset();
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

        async function deleteItem() {
            let id = $("#deleteId").val();
            showLoader();
            const response = await axios.post("{{ route('project.delete') }}", {
                id: id
            });
            hideLoader();
            if (response.data.status == "success") {
                $("#deleteModal").modal("hide");
                await getData();
                successToast(response.data.message);
            } else {
                errorToast(response.data.message);
            }
        }
    </script>
@endsection
