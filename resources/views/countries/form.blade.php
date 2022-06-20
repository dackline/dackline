@extends('layouts/contentLayoutMaster')

@section('title', isset($country->id) ? __('Edit Country') : __('Create Country'))

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
                    <h4 class="card-title">{{ isset($country->id) ? __('Update Country') : __('Create Country') }}</h4>
                </div>
                <div class="card-body">
                    <form id="module-form" class="form form-horizontal" method="POST" action="{{ isset($country->id) ? route('countries.update', $country->id) : route('countries.store') }}" novalidate>
                        @csrf
                        @if(isset($country->id))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="name">{{ __('Name') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="name" class="form-control @error('name') error @enderror" name="name" placeholder="{{ __('Name') }}" value="{{ old('name', $country->name) }}" />
                                        @error('name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="iso-code-2">{{ __('ISO Code 2') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="iso-code-2" class="form-control @error('isoCode2') error @enderror" name="isoCode2" placeholder="{{ __('ISO Code 2') }}" value="{{ old('isoCode2', $country->iso_code_2) }}" />
                                        @error('isoCode2')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="iso-code-3">{{ __('ISO Code 3') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="iso-code-3" class="form-control @error('isoCode3') error @enderror" name="isoCode3" placeholder="{{ __('ISO Code 3') }}" value="{{ old('isoCode3', $country->iso_code_3) }}" />
                                        @error('isoCode3')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="value">{{ __('Postcode Required') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-select @error('postcodeRequired') error @enderror" name="postcodeRequired">
                                            <option value="1" {{ old('postcodeRequired', $country->postcode_required) == 1 ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ old('postcodeRequired', $country->postcode_required) == 0 ? 'selected' : '' }}>No</option>
                                        </select>
                                        @error('postcodeRequired')
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
                                            <option value="1" {{ old('status', $country->status) == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $country->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-9 offset-sm-3">
                                <button type="submit" class="btn btn-primary me-1">
                                    {{ isset($country->id) ? __('Save') : __('Create') }}
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
            'name': {
                required: true
            },
        }
    });
});
</script>
@endsection
