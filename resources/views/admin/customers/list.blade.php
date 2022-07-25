@extends('layouts/contentLayoutMaster')

@section('title', __('Customers'))

@section('content')
<!-- Basic Tables start -->
<div class="row">
    <div class="col-12">
        <div class="tw-mb-8">
            <a href="{{ route('admin::customers.create') }}" class="btn btn-primary waves-effect waves-float waves-light">
                <i data-feather="plus"></i>
                <span>{{ __('Add Customer') }}</span>
            </a>
        </div>
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <div class="alert-body">{!! \Session::get('success') !!}</div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('Customers') }}</h4>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __("ID") }}</th>
                            <th>{{ __("Name") }}</th>
                            <th>{{ __("Email") }}</th>
                            <th>{{ __("Phone") }}</th>
                            <th>{{ __("Country") }}</th>
                            <th>{{ __("Created At") }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>
                                <span class="fw-bold">{{ $customer->full_name_with_company }}</span>
                            </td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->country->name }}</td>
                            <td>{{ $customer->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('admin::customers.edit', $customer->id) }}" class="btn btn-sm btn-icon btn-outline-secondary waves-effect">
                                    <i data-feather="edit-2"></i>
                                </a>
                                <form method="POST" action="route('admin::customers.destroy', $customer->id) }}" onsubmit="return confirm('{{ __('Are you sure to delete?') }}');" class="tw-inline-block">
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
        {{ $customers->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection
