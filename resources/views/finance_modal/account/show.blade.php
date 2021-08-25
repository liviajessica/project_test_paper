<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3 mb-4">
            <h6 class="m-0 font-weight-bold text-primary">All Finance Account</h6>
            <form action="\account\restore" method="post">
                @csrf
                <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-folder-plus fa-sm text-white-50"></i> Restore All Deleted Account</button>
            </form>
            <a href="\account\create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-folder-plus fa-sm text-white-50"></i> Create New Account</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableAccount" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Account Name</th>
                            <th>Description</th>
                            <th>Ammount Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($account as $data)
                        <tr>
                            <td>{{$data->account_name}}</td>
                            <td>{{$data->description}}</td>
                            <td>{{$data->account_type}}</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item detail" href="\account\{{ $data->id }}\detail">View</a>
                                            <a class="dropdown-item edit" href="\account\{{ $data->id }}">Edit</a>
                                            <form action="\account\{{$data->id}}\delete" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="dropdown-item" type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->