@extends('layouts/contentLayoutMaster')

@section('title', __('Shipping Methods'))

@section('content')
    <!-- Basic Tables start -->
    <div class="row">
        <div class="col-12">
            <div class="tw-mb-8">
                <a href="{{ route('admin::shipping-methods.create') }}" class="btn btn-primary waves-effect waves-float waves-light">
                    <i data-feather="plus"></i>
                    <span>{{ __('Add Shipping Method') }}</span>
                </a>
            </div>
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <div class="alert-body">{!! \Session::get('success') !!}</div>
                </div>
            @endif
            @if (\Session::has('error'))
                <div class="alert alert-danger">
                    <div class="alert-body">{!! \Session::get('error') !!}</div>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Shipping Methods') }}</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __("Name") }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($shippingMethods as $shippingMethod)
                            <tr>
                                <td>
                                    <span class="fw-bold">{{ $shippingMethod->name }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin::shipping-methods.edit', $shippingMethod->id) }}" class="btn btn-sm btn-icon btn-outline-secondary waves-effect">
                                        <i data-feather="edit-2"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin::shipping-methods.destroy', $shippingMethod->id) }}" onsubmit="return confirm('{{ __('Are you sure to delete?') }}');" class="tw-inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-sm btn-icon btn-outline-danger waves-effect">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $shippingMethods->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection
