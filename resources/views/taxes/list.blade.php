@extends('layouts/contentLayoutMaster')

@section('title', __('Taxes'))

@section('content')
<!-- Basic Tables start -->
<div class="row">
    <div class="col-12">
        <div class="tw-mb-8">
            <a href="{{ route('taxes.create') }}" class="btn btn-primary waves-effect waves-float waves-light">
                <i data-feather="plus"></i>
                <span>{{ __('Add Tax') }}</span>
            </a>
        </div>
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <div class="alert-body">{!! \Session::get('success') !!}</div>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Taxes</h4>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('Tax Name') }}</th>
                            <th>{{ __('Tax Rate') }}</th>
                            <th>{{ __('Type') }}</th>
                            <th>{{ __('Geo Zone') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($taxes as $tax)
                        <tr>
                            <td>
                                <span class="fw-bold">{{ $tax->tax_name }}</span>
                            </td>
                            <td>{{ $tax->tax_rate }}</td>
                            <td>{{ $tax->type }}</td>
                            <td>{{ $tax->geoZone->name }}</td>
                            <td><span class="badge rounded-pill badge-light-primary me-1">{{ $tax->statusName }}</span></td>
                            <td>
                                <a href="{{ route('taxes.edit', $tax->id) }}" class="btn btn-sm btn-icon btn-outline-secondary waves-effect">
                                    <i data-feather="edit-2"></i>
                                </a>
                                <form method="POST" action="{{ route('taxes.destroy', $tax->id) }}" onsubmit="return confirm('{{ __('Are you sure to delete?') }}');" class="tw-inline-block">
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
        {{ $taxes->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection
