@extends('layouts/contentLayoutMaster')

@section('title', isset($store->id) ? __('Edit Tax') : __('Create Tax'))

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
                    <h4 class="card-title">{{ isset($store->id) ? __('Update Store') : __('Create Store') }}</h4>
                </div>
                @if($errors->any())
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            @endif
                <div class="card-body">
                    <form id="module-form" class="form form-horizontal" method="POST" action="{{ isset($store->id) ? route('stores.update', $store->id) : route('stores.store') }}" novalidate>
                        @csrf
                        @if(isset($store->id))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="store-name">{{ __('Store Name') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="store-name" class="form-control @error('storeName') error @enderror" name="storeName" placeholder="{{ __('Store Name') }}" value="{{ old('storeName', $store->store_name) }}" />
                                        @error('storeName')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="store-url">{{ __('Store URL') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="store-url" class="form-control @error('storeUrl') error @enderror" name="storeUrl" placeholder="{{ __('Store URL') }}" value="{{ old('storeUrl', $store->store_url) }}" />
                                        @error('storeUrl')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="meta-title">{{ __('Meta Title') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="meta-title" class="form-control @error('metaTitle') error @enderror" name="metaTitle" placeholder="{{ __('Meta Title') }}" value="{{ old('metaTitle', $store->meta_title) }}" />
                                        @error('metaTitle')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="meta-description">{{ __('Meta Description') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea id="meta-description" name="metaDescription" class="form-control @error('metaDescription') error @enderror" placeholder="{{ __('Meta Description') }}">{{ old('metaDescription', $store->meta_description) }}</textarea>
                                        @error('metaDescription')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="meta-keywords">{{ __('Meta Keywords') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea id="meta-keywords" name="metaKeywords" class="form-control @error('metaKeywords') error @enderror" placeholder="{{ __('Meta Keywords') }}">{{ old('metaKeywords', $store->meta_keywords) }}</textarea>
                                        @error('metaKeywords')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="address">{{ __('Address') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea id="address" name="address" class="form-control @error('address') error @enderror" placeholder="{{ __('Address') }}">{{ old('address', $store->address) }}</textarea>
                                        @error('address')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="email">{{ __('Email') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="email" class="form-control @error('email') error @enderror" name="email" placeholder="{{ __('Email') }}" value="{{ old('email', $store->email) }}" />
                                        @error('email')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="phone">{{ __('Phone') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="phone" class="form-control @error('phone') error @enderror" name="phone" placeholder="{{ __('Phone') }}" value="{{ old('phone', $store->phone) }}" />
                                        @error('phone')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="country">{{ __('Country') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select id="country" name="countryId" class="form-select @error('countryId') error @enderror">
                                            @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('countryId', $country->id) == $store->country_id ? 'selected' : '' }}>{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('countryId')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="currencyId">{{ __('Currency') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select id="currencyId" name="currencyId" class="form-select @error('currencyId') error @enderror">
                                            @foreach($currencies as $currency)
                                            <option value="{{ $currency->id }}" {{ old('currencyId', $currency->id) == $store->currency_id ? 'selected' : '' }}>{{ $currency->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('currencyId')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="taxId">{{ __('Tax') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select id="taxId" name="taxId" class="form-select @error('taxId') error @enderror">
                                            @foreach($taxes as $tax)
                                            <option value="{{ $tax->id }}" {{ old('taxId', $tax->id) == $store->tax_id ? 'selected' : '' }}>{{ $tax->tax_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('taxId')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label">{{ __('Default') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-check form-check-inline">
                                            <input id="defaultCheckbox" name="default" class="form-check-input" type="checkbox"  value="1" {{ old('default', $store->default) ==  1 ? 'checked' : '' }} />
                                            <label class="form-check-label" for="defaultCheckbox">Default</label>
                                        </div>
                                        @error('default')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary me-1">
                                    {{ isset($store->id) ? __('Save') : __('Create') }}
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
            'storeName': {
                required: true
            },
            'storeUrl': {
                required: true,
            },
            'metaTitle': {
                required: true,
            },
            'address': {
                required: true,
            },
            'email': {
                required: true,
                email: true,
            },
            'phone': {
                required: true,
            }

        }
    });
});
</script>
@endsection
