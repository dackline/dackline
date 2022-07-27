@extends('layouts/contentLayoutMaster')

@section('title', __('Informations'))

@section('content')
<!-- Basic Tables start -->
<div class="row">
    <div class="col-12">
        <div class="tw-mb-8">
            <a href="{{ route('admin::informations.create') }}" class="btn btn-primary waves-effect waves-float waves-light">
                <i data-feather="plus"></i>
                <span>{{ __('Add Information') }}</span>
            </a>
        </div>
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <div class="alert-body">{!! \Session::get('success') !!}</div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('Informations') }}</h4>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __("ID") }}</th>
                            <th>{{ __("Title") }}</th>
                            <th>{{ __("URL") }}</th>
                            <th>{{ __('Sort Order') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($informations as $information)
                        <tr>
                            <td>
                                <span class="fw-bold">{{ $information->id }}</span>
                            </td>
                            <td>
                                <span class="fw-bold">{{ $information->translate(app()->getLocale())->title }}</span>
                            </td>
                            <td>{{ $information->url }}</td>
                            <td>{{ $information->sort_order }}</td>
                            <td class="tw-flex tw-items-center">
                                <a href="{{ route('admin::informations.edit', $information->id) }}" class="btn btn-sm btn-icon btn-outline-secondary waves-effect">
                                    <i data-feather="edit-2"></i>
                                </a>
                                <form method="POST" action="route('admin::informations.destroy', $information->id) }}" onsubmit="return confirm('{{ __('Are you sure to delete?') }}');" class="tw-inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-sm btn-icon btn-outline-danger waves-effect tw-ml-2">
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
        {{ $informations->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>
@endsection
