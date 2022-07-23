@extends('layouts/contentLayoutMaster')

@section('title', $isOrder ?__('Orders') : __('Quotations'))

@section('content')
<!-- Basic Tables start -->
<div class="row">
    <div class="col-12">
        <div class="tw-mb-8">
            <a href="{{ $isOrder ? route('admin::orders.create') : route('admin::quotations.create') }}" class="btn btn-primary waves-effect waves-float waves-light">
                <i data-feather="plus"></i>
                <span>{{ $isOrder ? __('Add Order') : __('Add Quotation') }}</span>
            </a>
        </div>
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <div class="alert-body">{!! \Session::get('success') !!}</div>
            </div>
        @endif
        <livewire:admin.orders.list-orders orderType="{{ $orderType }}" />
    </div>
</div>
@endsection
