@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link disabled" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="true">Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="transaction-tab" data-toggle="tab" href="#transaction" role="tab" aria-controls="transaction" aria-selected="false">Transaction</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="transaction" role="tabpanel" aria-labelledby="transaction-tab">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-2">
                            <div class="row justify-content-center">
                                <div class=" col-lg-6">
                                    <div class="p-5">
                                        <form class="transaction" method="post" action="/transaction/store">
                                            @csrf
                                            <div class="form-group">
                                                <label for="finance_name">Finance Name</label>
                                                <input type="text" class="form-control form-control-user @error('finance_name') is-invalid @enderror" id="finance_name" value="{{ old('finance_name') }}" name="finance_name">
                                                @error('finance_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="finance_account_id">Finance Account</label>
                                                <select class="form-control" id="finance_account_id" name="finance_account_id">
                                                    @foreach ($account as $data)
                                                    <option value="{{$data->id}}">{{$data->account_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" class="form-control form-control-user" id="description" value="{{ old('description') }}" name="description">
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input type="text" class="form-control form-control-user @error('amount') is-invalid @enderror" id="amount" value="{{ old('amount') }}" name="amount">
                                                @error('amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <a href="javascript:history.back()" class="btn btn-danger">Batal</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection