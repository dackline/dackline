@extends('layouts/contentLayoutMaster')

@section('title', __('Stores'))

@section('content')
<!-- Basic Tables start -->
<div class="row">
    <div class="col-12">
        <div class="tw-mb-8">
            <a href="{{ route('stores.create') }}" class="btn btn-primary waves-effect waves-float waves-light">
                <i data-feather="plus"></i>
                <span>{{ __('Add Store') }}</span>
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
                <h4 class="card-title">{{ __('Stores') }}</h4>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('Store Name') }}</th>
                            <th>{{ __('Store URL') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stores as $store)
                        <tr>
                            <td>
                                <span class="fw-bold">{{ $store->store_name }}</span>
                            </td>
                            <td>{{ $store->store_url }}</td>
                            <td>
                                <a href="{{ route('stores.edit', $store->id) }}" class="btn btn-sm btn-icon btn-outline-secondary waves-effect">
                                    <i data-feather="edit-2"></i>
                                </a>
                                <form method="POST" action="{{ route('stores.destroy', $store->id) }}" onsubmit="return confirm('{{ __('Are you sure to delete?') }}');" class="tw-inline-block">
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
        {{ $stores->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection
