<div class="row">
    <div class="col-md-12 grid-margin stretch-card m-auto">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title d-inline-block">Projects</h6>
                <button onclick="openModal()" type="button" class="btn btn-primary btn-icon d-inline-block float-right">
                {{-- data-toggle="modal"
                    data-target="#addModal" --}}
                <i data-feather="plus-circle"></i>
                </button>
                <div class="table-responsive">
                    <table id="tableData" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Image</th>
                                {{-- <th>Description</th> --}}
                                <th>URL</th>
                                <th>Published Date</th>
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
