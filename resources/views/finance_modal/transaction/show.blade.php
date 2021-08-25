<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4 mt-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3 mb-4">
            <h6 class="m-0 font-weight-bold text-primary">All Finance Transaction</h6>
            <form action="\transaction\restore" method="post">
                @csrf
                <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-folder-plus fa-sm text-white-50"></i> Restore All Deleted Transaction</button>
            </form>
            <a href="\transaction\create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-folder-plus fa-sm text-white-50"></i> Create New Transaction</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableTransaction" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Transaction Date</th>
                            <th>Finance Account</th>
                            <th>Finance Account Name</th>
                            <th>Reference</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction as $data)
                        <tr>
                            <td>{{$data->created_at}}</td>
                            <td>{{$data->finance_name}}</td>
                            <td>{{$data->account_name}}</td>
                            <td>{{$data->description}}</td>
                            <td>{{$data->amount}}</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item detail" href="\transaction\{{ $data->id }}\detail">View</a>
                                            <a class="dropdown-item edit" href="\transaction\{{ $data->id }}">Edit</a>
                                            <form action="\transaction\{{$data->id}}\delete" method="post">
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