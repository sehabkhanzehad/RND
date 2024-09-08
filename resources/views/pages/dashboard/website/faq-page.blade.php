@extends('layouts.dashborad.master')

@section('content')
    @include('components.dashboard.faq.data')
    @include('components.dashboard.faq.create')
    @include('components.dashboard.faq.delete')
@endsection


@section('script')
    <script>
        getData()

        async function getData() {
            showLoader();
            const respons = await axios.get("{{ route('faq.data') }}");
            hideLoader();

            let tableList = $("#tableList");
            let tableData = $("#tableData");

            tableData.DataTable().destroy();
            tableList.empty();

            respons.data.data.forEach(function(item, index) {
                let row = `<tr>
                    <td>${index + 1}</td>
                    <td class="text-wrap">${item.question}</td>
                    <td class="text-wrap text-justify">${item.answer}</td>
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
            const respons = await axios.get("{{ route('faq.id') }}", {
                params: {
                    id: id
                }
            });
            hideLoader();
            document.getElementById('dataId').value = respons.data.data.id;
            document.getElementById('modalTitle').innerHTML = "Edit FAQ";
            document.getElementById('question').value = respons.data.data.question;
            document.getElementById('answer').value = respons.data.data.answer;
            document.getElementById('addBtn').innerHTML = "Update";
            document.getElementById('addBtn').setAttribute("onclick", "updateData()");
        }
        function openModal() {
            document.getElementById("save-form").reset();
            document.getElementById('modalTitle').innerHTML = "Add FAQ";
            document.getElementById('addBtn').innerHTML = "Add";
            document.getElementById('addBtn').setAttribute("onclick", "addData()");
            $("#addModal").modal("show");
        }

        async function addData() {
            let question = document.getElementById('question').value;
            let answer = document.getElementById('answer').value;

            if (question == "" && answer == "") {
                errorToast("Please enter any one field.");
            } else if (question == "") {
                errorToast("Please enter question.");
            } else if (answer == "") {
                errorToast("Please enter answer.");
            } else {
                showLoader();
                try {
                    const response = await axios.post("{{ route('faq.create') }}", {
                        question: question,
                        answer: answer,
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
                    warningToast("Something went wrong.");
                }

            }
        }

        async function updateData() {
            let id = document.getElementById('dataId').value;
            let question = document.getElementById('question').value;
            let answer = document.getElementById('answer').value;

            if (question == "" && answer == "") {
                errorToast("Please enter any one field.");
            } else if (question == "") {
                errorToast("Please enter question.");
            } else if (answer == "") {
                errorToast("Please enter answer.");
            } else {
                showLoader();
                try {
                    const response = await axios.post("{{ route('faq.update') }}", {
                        id: id,
                        question: question,
                        answer: answer,
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
                    warningToast("Something went wrong.");
                }

            }

        }

        async function deleteItem() {
            let id = $("#deleteId").val();
            showLoader();
            const response = await axios.post("{{ route('faq.delete') }}", {
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
