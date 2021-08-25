@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('/account*') ? 'active' : '' }}" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="true">Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('/transaction*') ? 'active' : '' }}" id="transaction-tab" data-toggle="tab" href="#transaction" role="tab" aria-controls="transaction" aria-selected="false">Transaction</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="account" role="tabpanel" aria-labelledby="account-tab">
            @include('finance_modal.account.show')
        </div>
        <div class="tab-pane" id="transaction" role="tabpanel" aria-labelledby="transaction-tab">
            @include('finance_modal.transaction.show')
        </div>
    </div>
    @endsection