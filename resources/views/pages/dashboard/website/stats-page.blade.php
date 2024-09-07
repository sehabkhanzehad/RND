@extends('layouts.dashborad.master')

@section('content')
    @include('components.dashboard.aboutus.stats.data')
    @include('components.dashboard.aboutus.stats.stat-create')
    {{-- @include('components.dashboard.aboutus.stats.stat-update') --}}
    @include('components.dashboard.aboutus.stats.stat-delete')
@endsection


@section('script')
    <script>
        getData()

        async function getData() {
            showLoader();
            const respons = await axios.get("{{ route('stats.data') }}");
            hideLoader();

            let tableList = $("#tableList");
            let tableData = $("#tableData");

            tableData.DataTable().destroy();
            tableList.empty();

            respons.data.data.forEach(function(item, index) {
                let row = `<tr>
                    <td>${index + 1}</td>
                    <td>${item.stat_name}</td>
                    <td>${item.stat_value}</td>
                    <td>
                        <button type="button"class="editBtn btn btn-success" data-no="${item.id}">Edit</button>
                        <button type="button"class="deleteBtn btn btn-danger" data-no="${item.id}">Delete</button>
                    </td>
                    </tr>`;
                tableList.append(row);
            });

            $(".editBtn").on("click", async function() {
                let id = $(this).data("no");
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
            const respons = await axios.get("{{ route('stat.id') }}", {
                params: {
                    stat_id: id
                }
            });
            hideLoader();
            document.getElementById('stat_id').value = respons.data.data.id;
            document.getElementById('modalTitle').innerHTML = "Edit Item";
            document.getElementById('stat_name').value = respons.data.data.stat_name;
            document.getElementById('stat_value').value = respons.data.data.stat_value;
            document.getElementById('addBtn').innerHTML = "Update";
            document.getElementById('addBtn').setAttribute("onclick", "updateStat()");
        }

        async function addStat() {
            let stat_name = document.getElementById('stat_name').value;
            let stat_value = document.getElementById('stat_value').value;

            if (stat_name == "" && stat_value == "") {
                errorToast("Please enter any one field.");
            } else if (stat_name == "") {
                errorToast("Please enter stat name.");
            } else if (stat_value == "") {
                errorToast("Please enter stat value.");
            } else {
                showLoader();
                try {
                    const response = await axios.post("{{ route('stat.create') }}", {
                        stat_name: stat_name,
                        stat_value: stat_value,
                    });
                    hideLoader();

                    if (response.data.status == "success") {
                        $("#addModal").modal("hide");
                        // document.getElementById("modal-close").click();
                        document.getElementById('save-form').reset();
                        await getData();
                        successToast(response.data.message);
                    } else {
                        errorToast(response.data.message);
                    }
                } catch (err) {
                    hideLoader();
                    warningToast("Stat is already exist.");
                }

            }
        }

        async function updateStat() {
            let stat_id = document.getElementById('stat_id').value;
            let stat_name = document.getElementById('stat_name').value;
            let stat_value = document.getElementById('stat_value').value;

            if (stat_name == "" && stat_value == "") {
                errorToast("Please enter any one field.");
            } else if (stat_name == "") {
                errorToast("Please enter stat name.");
            } else if (stat_value == "") {
                errorToast("Please enter stat value.");
            } else {
                showLoader();
                try {
                    const response = await axios.post("{{ route('stat.update') }}", {
                        stat_id: stat_id,
                        stat_name: stat_name,
                        stat_value: stat_value,
                    });
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
                    warningToast("Stat is already exist.");
                }

            }

        }

        async function deleteItem() {
            let id = $("#deleteId").val();
            showLoader();
            const response = await axios.post("{{ route('stat.delete') }}", {
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
