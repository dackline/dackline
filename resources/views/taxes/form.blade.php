@extends('layouts/contentLayoutMaster')

@section('title', isset($tax->id) ? __('Edit Tax') : __('Create Tax'))

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- Basic Horizontal form layout section start -->
<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ isset($tax->id) ? __('Update Tax') : __('Create Tax') }}</h4>
                </div>
                <div class="card-body">
                    <form id="module-form" class="form form-horizontal" method="POST" action="{{ isset($tax->id) ? route('taxes.update', $tax->id) : route('taxes.store') }}" novalidate>
                        @csrf
                        @if(isset($tax->id))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="tax-name">{{ __('Tax Name') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="tax-name" class="form-control @error('taxName') error @enderror" name="taxName" placeholder="{{ __('Tax Name') }}" value="{{ old('taxName', $tax->tax_name) }}" required />
                                        @error('taxName')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="tax-rate">{{ __('Tax Rate') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="tax-rate" class="form-control @error('taxRate') error @enderror" name="taxRate" placeholder="{{ __('Tax Rate') }}" value="{{ old('taxRate', $tax->tax_rate) }}" />
                                        @error('taxRate')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="value">{{ __('Type') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-select @error('type') error @enderror" name="type">
                                            <option value="fixed_amount" {{ old('type', $tax->type) == 'fixed_amount' ? 'selected' : '' }}>{{ __('Fixed Amount') }}</option>
                                            <option value="percentage" {{ old('type', $tax->type) == 'percentage' ? 'selected' : '' }}>{{ __('Percentage') }}</option>
                                        </select>
                                        @error('type')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="value">{{ __('Geo Zone') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-select @error('geoZone') error @enderror" name="geoZoneId">
                                            @foreach($geoZones as $geoZone)
                                            <option value="{{ $geoZone->id }}" {{ old('geoZone', $tax->geo_zone_id) == $geoZone->id ? 'selected' : '' }}>{{ $geoZone->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('geoZoneId')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="value">{{ __('Status') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-select @error('status') error @enderror" name="status">
                                            <option value="1" {{ old('status', $tax->status) == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                                            <option value="0" {{ old('status', $tax->status) == 0 ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                        </select>
                                        @error('status')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary me-1">
                                    {{ isset($tax->id) ? __('Save') : __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection
@section('page-script')
<script>
$(document).ready(function() {
    $('#module-form').validate({
        rules: {
            'taxName': {
                required: true
            },
            'taxRate': {
                required: true,
                number: true
            }
        }
    });
});
</script>
@endsection
