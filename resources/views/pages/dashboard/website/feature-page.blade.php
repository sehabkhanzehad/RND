@extends('layouts.dashborad.master')
@section('content')
    @include('components.dashboard.service.feature.data')
    @include('components.dashboard.service.feature.create')
    @include('components.dashboard.service.feature.delete')
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
            7
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
            document.getElementById("blah1").src = "{{ asset('assets/dashboard/images/images.png') }}";
            document.getElementById("blah2").src = "{{ asset('assets/dashboard/images/images.png') }}";
            document.getElementById("image1").value = "";
            document.getElementById("image2").value = "";
            document.getElementById("save-form").reset();
            document.getElementById('modalTitle').innerHTML = "Add Feature";
            document.getElementById('addBtn').innerHTML = "Add";
            document.getElementById('addBtn').setAttribute("onclick", "addData()");
            $("#addModal").modal("show");
        }

        async function addData() {
            let title1 = document.getElementById('title1').value;
            let title2 = document.getElementById('title2').value;
            let description1 = document.getElementById('description1').value;
            let description2 = document.getElementById('description2').value;
            let image1 = document.getElementById('image1').files[0];
            let image2 = document.getElementById('image2').files[0];

            if (title1 == "" && title2 == "" && description1 == "" && description2 == "" && !image1 && !image2) {
                errorToast("Please fill all the fields.");
            } else if (title1 == "") {
                errorToast("Please enter title 1.");
            } else if (title2 == "") {
                errorToast("Please enter title 2.");
            } else if (description1 == "") {
                errorToast("Please enter description 1.");
            } else if (description2 == "") {
                errorToast("Please enter description 2.");
            } else if (image1 == "") {
                errorToast("Please select image 1.");
            } else if (image2 == "") {
                errorToast("Please select image 2.");
            } else {
                let formData = new FormData();
                formData.append('title1', title1);
                formData.append('title2', title2);
                formData.append('description1', description1);
                formData.append('description2', description2);
                formData.append('image1', image1);
                formData.append('image2', image2);

                let config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                    },
                }

                showLoader();

                try {
                    const response = await axios.post("{{ route('feature.create') }}", formData, config);
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

        async function updateFeature() {
            let id = document.getElementById('dataId').value;
            let title1 = document.getElementById('title1').value;
            let title2 = document.getElementById('title2').value;
            let description1 = document.getElementById('description1').value;
            let description2 = document.getElementById('description2').value;
            let image1 = document.getElementById('image1').files[0];
            let image2 = document.getElementById('image2').files[0];

            if (title1 == "") {
                errorToast("Please enter title 1.");
            } else if (title2 == "") {
                errorToast("Please enter title 2.");
            } else if (description1 == "") {
                errorToast("Please enter description 1.");
            } else if (description2 == "") {
                errorToast("Please enter description 2.");
            } else {
                let formData = new FormData();
                formData.append('id', id);
                formData.append('title1', title1);
                formData.append('title2', title2);
                formData.append('description1', description1);
                formData.append('description2', description2);
                formData.append('image1', image1);
                formData.append('image2', image2);

                let config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                    },
                }

                showLoader();

                try {
                    const response = await axios.post("{{ route('feature.update') }}", formData, config);
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
            const response = await axios.post("{{ route('feature.delete') }}", {
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
