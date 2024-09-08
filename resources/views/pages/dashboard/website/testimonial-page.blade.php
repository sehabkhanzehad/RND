@extends('layouts.dashborad.master')

@section('content')
    @include('components.dashboard.testimonial.data')
    @include('components.dashboard.testimonial.create')
    @include('components.dashboard.testimonial.delete')
@endsection

@section('script')
    <script>
        getData()

        async function getData() {
            showLoader();
            const respons = await axios.get("{{ route('testimonial.data') }}");
            hideLoader();

            let tableList = $("#tableList");
            let tableData = $("#tableData");

            tableData.DataTable().destroy();
            tableList.empty();

            respons.data.data.forEach(function(item, index) {
                let row = `<tr>
                    <td>${index + 1}</td>
                    <td>${item.name}</td>
                    <td>${item.designation}</td>
                    <td> <img src="${item.image}" class="rounded-circle wd-35" alt="image"></td>
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
            const respons = await axios.get("{{ route('testimonial.id') }}", {
                params: {
                    id: id
                }
            });
            hideLoader();
            document.getElementById('dataId').value = respons.data.data.id;
            document.getElementById('modalTitle').innerHTML = "Edit Testimonial";
            document.getElementById('addBtn').innerHTML = "Update";
            document.getElementById('addBtn').setAttribute("onclick", "updateTestimonial()");

            document.getElementById('name').value = respons.data.data.name;
            document.getElementById('designation').value = respons.data.data.designation;
            document.getElementById('description').value = respons.data.data.description;
            document.getElementById('blah1').src = respons.data.data.image;
        }

        function openModal() {
            document.getElementById("blah1").src = "{{ asset("assets/dashboard/images/default_profile.png") }}";
            document.getElementById("save-form").reset();
            document.getElementById('modalTitle').innerHTML = "Add Testimonial";
            document.getElementById('addBtn').innerHTML = "Add";
            document.getElementById('addBtn').setAttribute("onclick", "addData()");
            $("#addModal").modal("show");
        }

        async function addData() {
            let name = document.getElementById('name').value;
            let designation = document.getElementById('designation').value;
            let description = document.getElementById('description').value;
            let image = document.getElementById('image').files[0];

            if (name == "" && designation == "" && description == "" && !image) {
                errorToast("Please enter any one field.");
            } else if (name == "") {
                errorToast("Please enter name.");
            } else if (designation == "") {
                errorToast("Please enter designation.");
            } else if (description == "") {
                errorToast("Please enter description.");
            } else if (!image) {
                errorToast("Please select an image.");
            } else {

                let formData = new FormData();
                formData.append('name', name);
                formData.append('designation', designation);
                formData.append('image', image);
                formData.append('description', description);

                let config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                    },
                }

                showLoader();

                try {
                    const response = await axios.post("{{ route('testimonial.create') }}", formData, config);
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

        async function updateTestimonial() {
            let id = document.getElementById('dataId').value;
            let name = document.getElementById('name').value;
            let designation = document.getElementById('designation').value;
            let description = document.getElementById('description').value;
            let image = document.getElementById('image').files[0];

           if (name == "") {
                errorToast("Please enter name.");
            } else if (designation == "") {
                errorToast("Please enter designation.");
            } else if (description == "") {
                errorToast("Please enter description.");
            } else {

                let formData = new FormData();
                formData.append('id', id);
                formData.append('name', name);
                formData.append('designation', designation);
                formData.append('image', image);
                formData.append('description', description);

                let config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                    },
                }

                showLoader();
                try {
                    const response = await axios.post("{{ route('testimonial.update') }}", formData, config);
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
            const response = await axios.post("{{ route('testimonial.delete') }}", {
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
