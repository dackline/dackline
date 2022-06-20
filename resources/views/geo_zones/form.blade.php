@extends('layouts/contentLayoutMaster')

@section('title', isset($geoZone->id) ? __('Edit Geo Zone') : __('Create Geo Zone'))

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
    <form id="module-form" class="form form-horizontal" method="POST" action="{{ isset($geoZone->id) ? route('geo-zones.update', $geoZone->id) : route('geo-zones.store') }}" novalidate>
        @csrf
        @if(isset($geoZone->id))
            @method('PUT')
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ isset($geoZone->id) ? __('Update Geo Zone') : __('Create Geo Zone') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="name">{{ __('Name') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="name" class="form-control @error('name') error @enderror" name="name" placeholder="{{ __('Name') }}" value="{{ old('name', $geoZone->name) }}" />
                                        @error('name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="description">{{ __('Description') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea rows="3" id="description" class="form-control @error('description') error @enderror" name="description" placeholder="{{ __('Description') }}">{{ old('description', $geoZone->description) }}</textarea>
                                        @error('description')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Geo Zones</h4>
                    </div>
                    <div class="card-body repeater-default">
                        <div data-repeater-list="geozones">
                            <div class="row" data-repeater-item>
                                <div class="col-sm-5">
                                    <div class="mb-1 row">
                                        <div class="col-12">
                                            <label class="col-form-label" for="country">Country</label>
                                            <select class="select2 form-select" name="countryId">
                                                @foreach($countries as $option_country)
                                                    <option value="{{ $option_country->id }}">{{ $option_country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                    <i data-feather="plus" class="me-25"></i>
                                    <span>Add New</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary me-1">
                    {{ isset($geoZone->id) ? __('Save') : __('Create') }}
                </button>
            </div>
        </div>
    </form>
</section>
@endsection
@section('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/repeater/jquery.repeater.min.js')) }}"></script>
@endsection
@section('page-script')
<script>
$(document).ready(function() {
    $('.repeater-default').repeater({
        initEmpty: true,
        show: function (el) {
            $(this).slideDown();
            $('.select2-container').remove();
            $('.select2').select2({
                placeholder: "Select Country",
                allowClear: true
            });
            $('.select2-container').css('width','100%');
        },
        hide: function (deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        }
    });

    $('#module-form').validate({
        rules: {
            'name': {
                required: true
            },
            'description': {
                required: true
            },
        }
    });
});
</script>
@endsection
