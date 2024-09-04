@extends('layouts.sidenav')
@section('content')
    @include('components.dashboard.category.category-list')
    @include('components.dashboard.category.category-delete')
    @include('components.dashboard.category.category-create')
    @include('components.dashboard.category.category-update')
@endsection

@section('scripts')
    <script>
        // For Category List
        categoryList();
        async function categoryList() {
            showLoader();
            const respons = await axios.get("{{ route('category.list') }}");
            hideLoader();



            $("#tableData").DataTable().destroy();
            $("#tableList").empty();

            respons.data.forEach(function(item, index) {
                let row = `<tr>
                        <td>${index + 1}</td>
                        <td>${item.name}</td>
                        <td>
                            <i style="cursor:pointer; color:green; border: 1px solid green; background-color: white; padding: 3px 5px; border-radius: 5px" data-no="${item.id}" class="editBtn bi bi-pencil-square"></i>

                            <i style="cursor:pointer; color:red; border: 1px solid red; background-color: white; padding: 3px 5px; border-radius: 5px" data-no="${item.id}" class="deleteBtn bi bi-trash"></i>

                        </td>
                    </tr>`;
                $("#tableList").append(row);
            });

            $(".editBtn").on("click", async function() {
                let categoryId = $(this).data("no");
                await fillupUpdateForm(categoryId);
                $("#update-modal").modal("show");
            });

            $(".deleteBtn").on("click", function() {
                let id = $(this).data("no");
                $("#delete-modal").modal("show");
                $("#deleteID").val(id);
            });

            new DataTable('#tableData', {
                // order: [
                //     [0, 'asc']
                // ],
                // lengthMenu: [5, 10, 15, 20, 30]
            });
        }


        // For Category Create
        document.getElementById("store").addEventListener("click", async function() {
            let categoryName = document.getElementById("categoryName").value;

            if (categoryName == "") {
                errorToast("Please enter category name.");
            } else {
                showLoader();
                const respons = await axios.post("{{ route('category.create') }}", {
                    name: categoryName
                });
                hideLoader();

                if (respons.data.status == "success") {
                    document.getElementById("modal-close").click();
                    document.getElementById('save-form').reset();
                    await categoryList();
                    successToast(respons.data.message);
                } else {
                    errorToast(respons.data.message);
                }
            }
        });

        // For Category Update
         async function fillupUpdateForm(categoryId) {
            document.getElementById("updateID").value = categoryId;
             showLoader();
             let respons = await axios.post("{{ route('category.details') }}", {
                 categoryId: categoryId
             })
             hideLoader();
             document.getElementById("categoryNameUpdate").value = respons.data.name;
         }


        async function update() {
            let categoryId = document.getElementById("updateID").value;
            let categoryName = document.getElementById("categoryNameUpdate").value;

            if (categoryName == "") {
                errorToast("Please enter category name.");
            } else {
                showLoader();
                try{
                const respons = await axios.post("{{ route('category.update') }}", {
                    categoryId: categoryId,
                    categoryName: categoryName
                });
                hideLoader();
                if (respons.data.status == "success") {
                    document.getElementById("update-modal-close").click();
                    await categoryList();
                    successToast(respons.data.message);
                } else {
                    errorToast(respons.data.message);
                }
                }catch(err){
                    hideLoader();
                    document.getElementById("update-modal-close").click();
                    errorToast("Something went wrong, Please try again.");
                }
            }
        }



        // For Category Delete
        async function categoryDelete() {
            let categoryId = document.getElementById("deleteID").value;

            showLoader();
            try{
            const respons = await axios.post("{{ route('category.delete') }}", {
                categoryId: categoryId
            });
            hideLoader();

            if (respons.data.status == "success") {
                document.getElementById("delete-modal-close").click();
                await categoryList();
                successToast(respons.data.message);
            } else {
                errorToast(respons.data.message);
            }
            }catch(err){
                hideLoader();
                document.getElementById("delete-modal-close").click();
                errorToast("Something went wrong, Please try again.");
            }
        }
    </script>
@endsection
