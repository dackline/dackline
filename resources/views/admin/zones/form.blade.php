@extends('layouts/contentLayoutMaster')

@section('title', isset($zone->id) ? __('Edit Zone') : __('Create Zone'))

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

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
                    <h4 class="card-title">{{ isset($zone->id) ? __('Update Zone') : __('Create Zone') }}</h4>
                </div>
                <div class="card-body">
                    <form id="module-form" class="form form-horizontal" method="POST" action="{{ isset($zone->id) ? route('admin::zones.update', $zone->id) : route('admin::zones.store') }}" novalidate>
                        @csrf
                        @if(isset($zone->id))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="name">{{ __('Name') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="name" class="form-control @error('name') error @enderror" name="name" placeholder="{{ __('Name') }}" value="{{ old('name', $zone->name) }}" />
                                        @error('name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="code">{{ __('Code') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="code" class="form-control @error('code') error @enderror" name="code" placeholder="{{ __('Code') }}" value="{{ old('code', $zone->code) }}" />
                                        @error('code')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="country">{{ __('Country') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="select2 form-select" name="countryId" placeholder="{{ __('Select Store') }}">
                                            @foreach($countries as $option_country)
                                                <option value="{{ $option_country->id }}" {{ old('countryId', $zone->country_id) == $option_country->id ? 'selected' : '' }}>{{ $option_country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('countryId')
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
                                            <option value="1" {{ old('status', $zone->status) === 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $zone->status) === 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary me-1">
                                    {{ isset($zone->id) ? __('Save') : __('Create') }}
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
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
<script>
$(document).ready(function() {
    // select2
    var select = $('.select2');
    select.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            // the following code is used to disable x-scrollbar when click in select input and
            // take 100% width in responsive also
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $this.parent(),
            allowClear: true,
            placeholder: $this.attr('placeholder')
        });
    });
    $('#module-form').validate({
        rules: {
            'name': {
                required: true
            },
            'countryId': {
                required: true
            }
        }
    });
});
</script>
@endsection
