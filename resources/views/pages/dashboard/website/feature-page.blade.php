@extends("layouts.dashborad.master")
@section("content")
@include('components.dashboard.service.feature.data')
@include("components.dashboard.service.feature.create")
@include("components.dashboard.service.feature.delete")
@endsection

@section('script')
    <script>
        getData()

        async function getData() {
            showLoader();
            const respons = await axios.get("{{ route('feature.data') }}");
            hideLoader();

            let tableList = $("#tableList");
            let tableData = $("#tableData");

            tableData.DataTable().destroy();
            tableList.empty();

            respons.data.data.forEach(function(item, index) {
                let row = `<tr>
                    <td>${index + 1}</td>
                    <td class="text-wrap">${item.title1}</td>
                    <td> <img src="${item.image1}" class="rounded-circle wd-35" alt="team"></td>

                    <td class="text-wrap">${item.title2}</td>
                    <td> <img src="${item.image2}" class="rounded-circle wd-35" alt="team"></td>
                    <td>
                        <button type="button"class="editBtn btn btn-success" data-no="${item.id}">Edit</button>
                        <button type="button"class="deleteBtn btn btn-danger" data-no="${item.id}">Delete</button>
                    </td>
                    </tr>`;
                tableList.append(row);
            });
            // <td class="text-wrap text-justify">${item.description2}</td>

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

        async function fillupEditForm(id) {
            showLoader();
            const respons = await axios.get("{{ route('feature.id') }}", {
                params: {
                    id: id
                }
            });
            hideLoader();
            document.getElementById('dataId').value = respons.data.data.id;
            document.getElementById('modalTitle').innerHTML = "Edit Feature";
            document.getElementById('addBtn').innerHTML = "Update";
            document.getElementById('addBtn').setAttribute("onclick", "updateFeature()");

            document.getElementById('title1').value = respons.data.data.title1;
            document.getElementById('description1').value = respons.data.data.description1;
            document.getElementById('blah1').src = respons.data.data.image1;
            document.getElementById('title2').value = respons.data.data.title2;
            document.getElementById('description2').value = respons.data.data.description2;
            document.getElementById('blah2').src = respons.data.data.image2;


        }

        function openModal() {
            document.getElementById("blah1").src = "{{ asset("assets/dashboard/images/default_profile.png") }}";
            document.getElementById("blah2").src = "{{ asset("assets/dashboard/images/default_profile.png") }}";
            document.getElementById("save-form").reset();
            document.getElementById('modalTitle').innerHTML = "Add Feature";
            document.getElementById('addBtn').innerHTML = "Add";
            document.getElementById('addBtn').setAttribute("onclick", "addData()");
            $("#addModal").modal("show");
        }

        async function addData() {
            let name = document.getElementById('name').value;
            let designation = document.getElementById('designation').value;
            let description = document.getElementById('description').value;
            let image = document.getElementById('image').files[0];
            let linkedin = document.getElementById('linkedin').value;
            let github = document.getElementById('github').value;
            let facebook = document.getElementById('facebook').value;
            let whatsapp = document.getElementById('whatsapp').value;

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
                formData.append('linkedin_link', linkedin);
                formData.append('github_link', github);
                formData.append('facebook_link', facebook);
                formData.append('whatsapp_link', whatsapp);

                let config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                    },
                }

                showLoader();

                try {
                    const response = await axios.post("{{ route('team.create') }}", formData, config);
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

        async function updateFeature() {
            let id = document.getElementById('dataId').value;
            let name = document.getElementById('name').value;
            let designation = document.getElementById('designation').value;
            let description = document.getElementById('description').value;
            let image = document.getElementById('image').files[0];
            let linkedin = document.getElementById('linkedin').value;
            let github = document.getElementById('github').value;
            let facebook = document.getElementById('facebook').value;
            let whatsapp = document.getElementById('whatsapp').value;

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
                formData.append('linkedin_link', linkedin);
                formData.append('github_link', github);
                formData.append('facebook_link', facebook);
                formData.append('whatsapp_link', whatsapp);

                let config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                    },
                }

                showLoader();

                try {
                    const response = await axios.post("{{ route('team.update') }}", formData, config);
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
            const response = await axios.post("{{ route('team.delete') }}", {
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
