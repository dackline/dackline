@extends('layouts/contentLayoutMaster')

@section('title', __('Currencies'))

@section('content')
<!-- Basic Tables start -->
<div class="row">
    <div class="col-12">
        <div class="tw-mb-8">
            <a href="{{ route('countries.create') }}" class="btn btn-primary waves-effect waves-float waves-light">
                <i data-feather="plus"></i>
                <span>{{ __('Add Currency') }}</span>
            </a>
        </div>
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <div class="alert-body">{!! \Session::get('success') !!}</div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Currencies</h4>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Code</th>
                            <th>Value</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($currencies as $currency)
                        <tr>
                            <td>
                                <span class="fw-bold">{{ $currency->title }}</span>
                            </td>
                            <td>{{ $currency->code }}</td>
                            <td>{{ $currency->value }}</td>
                            <td><span class="badge rounded-pill badge-light-primary me-1">{{ $currency->statusName }}</span></td>
                            <td>
                                <a href="{{ route('currencies.edit', ['currency' => $currency->id]) }}" class="btn btn-sm btn-icon btn-outline-secondary waves-effect">
                                    <i data-feather="edit-2"></i>
                                </a>
                                <form method="POST" action="/currencies/{{$currency->id}}" onsubmit="return confirm('{{ __('Are you sure to delete?') }}');" class="tw-inline-block">
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
        {{ $currencies->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection
