@extends('layouts/contentLayoutMaster')

@section('title', isset($currency->id) ? __('Edit Currency') : __('Create Currency'))

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
                    <h4 class="card-title">{{ isset($currency->id) ? __('Update Currency') : __('Create Currency') }}</h4>
                </div>
                <div class="card-body">
                    <form id="module-form" class="form form-horizontal" method="POST" action="{{ isset($currency->id) ? route('admin::currencies.update', $currency->id) : route('admin::currencies.store') }}" novalidate>
                        @csrf
                        @if(isset($currency->id))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="currency-title">{{ __('Currency Title') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="currency-title" class="form-control @error('currencyTitle') error @enderror" name="currencyTitle" placeholder="{{ __('Currency Title') }}" value="{{ old('currencyTitle', $currency->title) }}" />
                                        @error('currencyTitle')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="code">{{ __('Code') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="code" class="form-control @error('code') error @enderror" name="code" placeholder="{{ __('Code') }}" value="{{ old('code', $currency->code) }}" />
                                        @error('code')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="symbol-left">{{ __('Symbol Left') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="symbol-left" class="form-control @error('symbolLeft') error @enderror" name="symbolLeft" placeholder="{{ __('Symbol Left') }}" value="{{ old('symbolLeft', $currency->symbol_left) }}" />
                                        @error('symbolLeft')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="symbol-right">{{ __('Symbol Right') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="symbol-right" class="form-control @error('symbolRight') error @enderror" name="symbolRight" placeholder="{{ __('Symbol Right') }}" value="{{ old('symbolRight', $currency->symbol_right) }}" />
                                        @error('symbolRight')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="decimal-places">{{ __('Decimal Places') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" id="decimal-places" class="form-control @error('decimalPlaces') error @enderror" name="decimalPlaces" placeholder="{{ __('Decimal Places') }}" value="{{ old('decimalPlaces', $currency->decimal_places) }}" />
                                        @error('decimalPlaces')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="value">{{ __('Value') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="value" class="form-control @error('value') error @enderror" name="value" placeholder="{{ __('Value') }}" value="{{ old('value', $currency->value) }}" />
                                        @error('value')
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
                                            <option value="1" {{ old('status', $currency->status) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $currency->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary me-1">
                                    {{ isset($currency->id) ? __('Save') : __('Create') }}
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
            'currencyTitle': {
                required: true
            },
            'code': {
                required: true
            },
            'value': {
                number: true,
            }
        }
    });
});
</script>
@endsection
