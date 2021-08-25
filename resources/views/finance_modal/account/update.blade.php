@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="true">Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" id="transaction-tab" data-toggle="tab" href="#transaction" role="tab" aria-controls="transaction" aria-selected="false">Transaction</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="account" role="tabpanel" aria-labelledby="account-tab">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <form class="account" method="post" action="/account/{{ $financeAccount->id }}/update">
                                            @method('patch')
                                            @csrf
                                            <div class="form-group">
                                                <label for="account_name">Account Name</label>
                                                <input type="text" class="form-control form-control-user @error('account_name') is-invalid @enderror" id="account_name" value="{{$financeAccount->account_name}}" name="account_name">
                                                @error('account_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="account_type">Account Type</label>
                                                <input type="text" class="form-control form-control-user @error('account_type') is-invalid @enderror" id="account_type" value="{{$financeAccount->account_type}}" name="account_type">
                                                @error('account_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <input type="text" class="form-control form-control-user" id="description" value="{{$financeAccount->description}}" name="description">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
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