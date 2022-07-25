@extends('layouts/contentLayoutMaster')

@section('title', __('Products'))

@section('content')
<!-- Basic Tables start -->
<div class="row">
    <div class="col-12">
        <div class="tw-mb-8">
            <a href="{{ route('admin::products.create') }}" class="btn btn-primary waves-effect waves-float waves-light">
                <i data-feather="plus"></i>
                <span>{{ __('Add Product') }}</span>
            </a>
        </div>
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <div class="alert-body">{!! \Session::get('success') !!}</div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('Products') }}</h4>
            </div>
            <div class="card-body">
                <livewire:admin.products.product-table />
            </div>
        </div>
    </div>
</div>
@endsection
