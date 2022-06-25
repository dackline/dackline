@extends('layouts/contentLayoutMaster')

@section('title', isset($information->id) ? __('Edit Information') : __('Create Information'))

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('content')
<!-- Basic Horizontal form layout section start -->
<section>
    <form id="module-form" class="form form-horizontal" method="POST" action="{{ isset($information->id) ? route('informations.update', $information->id) : route('informations.store') }}" novalidate>
        @csrf
        @if(isset($information->id))
            @method('PUT')
        @endif
        <div class="row">
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('General')  }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="nav nav-tabs" role="tablist">
                                    @foreach ($locales as $locale)
                                        <li class="nav-item">
                                            <a class="nav-link @if($loop->first) active @endif" id="lang-{{ $locale }}-tab" data-bs-toggle="tab" href="#lang-{{ $locale }}" aria-controls="home" role="tab" aria-selected="true">
                                                <span class="tw-w-8">{!! get_locale_icon($locale) !!}</span>
                                                {{ get_locale_title($locale) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach ($locales as $locale)
                                        <div class="tab-pane @if($loop->first) active @endif" id="lang-{{ $locale }}" aria-labelledby="lang-{{ $locale }}-tab" role="tabpanel">
                                            <div class="row">
                                                <!-- Title -->
                                                <div class="col-12 tw-mb-4"">
                                                    <label class="col-form-label" for="{{ $locale }}[title]">{{ __('Title') }} ({{ strtoupper($locale) }})</label>
                                                    <input type="text" id="{{ $locale }}[title]" class="form-control @error($locale. '.title') error @enderror" name="{{ $locale }}[title]" placeholder="{{ __('Title') }}" value="{{ old($locale. '.title', optional($information->translate($locale))->title) }}"/>
                                                    @error($locale. '.title')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!-- End of Title -->

                                                <!-- Description -->
                                                <div class="col-12 tw-mb-4"">
                                                    <label class="col-form-label" for="{{ $locale }}[description]">{{ __('Description') }} ({{ strtoupper($locale) }})</label>
                                                    <textarea id="{{ $locale }}[description]" name="{{ $locale }}[description]" class="form-control @error($locale. '.description') error @enderror" placeholder="{{ __('Description') }}">{{ old($locale. '.description', optional($information->translate($locale))->description) }}</textarea>
                                                    @error($locale. '.description')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!-- End of Description -->

                                                <!-- Meta Title -->
                                                <div class="col-12 tw-mb-4"">
                                                    <label class="col-form-label" for="{{ $locale }}[metaTitle]">{{ __('Meta Title') }} ({{ strtoupper($locale) }})</label>
                                                    <input type="text" id="{{ $locale }}[metaTitle]" class="form-control @error($locale. '.metaTitle') error @enderror" name="{{ $locale }}[metaTitle]" placeholder="{{ __('Meta Title') }}" value="{{ old($locale. '.metaTitle', optional($information->translate($locale))->meta_title) }}"/>
                                                    @error($locale. '.metaTitle')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!-- End of Meta Title -->
                                            </div>

                                            <!-- Meta Description -->
                                            <div class="col-12 tw-mb-4"">
                                                <label class="col-form-label" for="{{ $locale }}[metaDescription]">{{ __('Meta Description') }} ({{ strtoupper($locale) }})</label>
                                                <textarea id="{{ $locale }}[metaDescription]" name="{{ $locale }}[metaDescription]" class="form-control @error($locale. '.metaDescription') error @enderror" placeholder="{{ __('Meta Description') }}">{{ old($locale. '.metaDescription', optional($information->translate($locale))->meta_description) }}</textarea>
                                                @error($locale. '.metaDescription')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- End of Meta Description -->

                                            <!-- URL -->
                                            <div class="col-12 tw-mb-4"">
                                                <label class="col-form-label" for="{{ $locale }}[url]">{{ __('URL') }} ({{ strtoupper($locale) }})</label>
                                                <input type="text" id="{{ $locale }}[url]" name="{{ $locale }}[url]" class="form-control @error($locale. '.url') error @enderror" placeholder="{{ __('URL') }}" value="{{ old($locale. '.url', optional($information->translate($locale))->url) }}"/>
                                                @error($locale. '.url')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- End of URL -->
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Data')  }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 tw-mb-4">
                                <label class="col-form-label" for="sortOrder">{{ __('Sort Order') }}</label>
                                <input type="number" id="sortOrder" class="form-control @error('sortOrder') error @enderror" name="sortOrder" placeholder="{{ __('Sort Order') }}" value="{{ old('sortOrder', $information->sort_order) }}"/>
                                @error('sortOrder')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 tw-mb-4">
                                <label class="form-label" for="storeId">{{ __('Stores') }}</label>
                                <select id="storeId" name="storeId[]" class="select2 form-select @error('storeId') error @enderror" placeholder="{{ __('Select Store(s)') }}" multiple>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id }}" @if(in_array($store->id, old('storeId', $information->stores->pluck('id')->toArray()))) selected @endif>{{ $store->store_name }}</option>
                                    @endforeach
                                </select>
                                @error('storeId')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 tw-mb-4"">
                                <label class="form-check-label" for="footer">{{ __('Footer') }}</label>
                                <div class="form-check form-check-primary form-switch">
                                    <input type="checkbox" class="form-check-input" id="footer" name="footer" value="1" {{ old('footer', $information->footer) == '1' ? 'checked' : '' }}/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary me-1">
            {{ isset($information->id) ? __('Save') : __('Create') }}
        </button>
    </form>
</section>
@endsection
@section('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
<script>

$(document).ready(function() {
    let rules = {}
    @foreach ($locales as $locale)
        rules['{{ $locale }}[title]'] = { required: true }
        rules['{{ $locale }}[description]'] = { required: true }
        rules['{{ $locale }}[metaTitle]'] = { required: true }
    @endforeach

    $('#module-form').validate({
        ignore: ".ignore",
        rules: rules
    });

    var select2 = $('.select2')
    select2.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $this.parent(),
            placeholder: $this.attr('placeholder')
        });
    });
});
</script>
@endsection
