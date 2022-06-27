@extends('layouts/contentLayoutMaster')

@section('title', isset($category->id) ? __('Edit Category') : __('Create Category'))

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
@endsection

@section('content')
<!-- Basic Horizontal form layout section start -->
<section>
    <form id="module-form" class="form form-horizontal" method="POST" action="{{ isset($category->id) ? route('categories.update', $category->id) : route('categories.store') }}" x-data="moduleData()" x-init="moduleInit()" x-on:submit="submit()" novalidate>
        @csrf
        @if(isset($category->id))
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
                                                <!-- Name -->
                                                <div class="col-12 tw-mb-4"">
                                                    <label class="col-form-label" for="{{ $locale }}[name]">{{ __('Name') }} ({{ strtoupper($locale) }})</label>
                                                    <input type="text" id="{{ $locale }}[name]" class="form-control @error($locale. '.name') error @enderror" name="{{ $locale }}[name]" placeholder="{{ __('Name') }}" value="{{ old($locale. '.name', optional($category->translate($locale))->name) }}"/>
                                                    @error($locale. '.name')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!-- End of Name -->

                                                <!-- Description -->
                                                <div class="col-12 tw-mb-4"">
                                                    <label class="col-form-label" for="{{ $locale }}[description]">{{ __('Description') }} ({{ strtoupper($locale) }})</label>
                                                    <div class="editor-wrapper">
                                                        <div x-ref="{{ $locale }}DescriptionEditor">{!! old($locale. '.description', optional($category->translate($locale))->description) !!}</div>
                                                        <textarea id="{{ $locale }}[description]" name="{{ $locale }}[description]" class="form-control @error($locale. '.description') error @enderror" placeholder="{{ __('Description') }}" x-ref="{{ $locale }}DescriptionEditorValue" style="display: none"></textarea>
                                                    </div>
                                                    @error($locale. '.description')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!-- End of Description -->

                                                <!-- Meta Title -->
                                                <div class="col-12 tw-mb-4"">
                                                    <label class="col-form-label" for="{{ $locale }}[metaTitle]">{{ __('Meta Title') }} ({{ strtoupper($locale) }})</label>
                                                    <input type="text" id="{{ $locale }}[metaTitle]" class="form-control @error($locale. '.metaTitle') error @enderror" name="{{ $locale }}[metaTitle]" placeholder="{{ __('Meta Title') }}" value="{{ old($locale. '.metaTitle', optional($category->translate($locale))->meta_title) }}"/>
                                                    @error($locale. '.metaTitle')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!-- End of Meta Title -->
                                            </div>

                                            <!-- Meta Description -->
                                            <div class="col-12 tw-mb-4"">
                                                <label class="col-form-label" for="{{ $locale }}[metaDescription]">{{ __('Meta Description') }} ({{ strtoupper($locale) }})</label>
                                                <textarea id="{{ $locale }}[metaDescription]" name="{{ $locale }}[metaDescription]" class="form-control @error($locale. '.metaDescription') error @enderror" placeholder="{{ __('Meta Description') }}">{{ old($locale. '.metaDescription', optional($category->translate($locale))->meta_description) }}</textarea>
                                                @error($locale. '.metaDescription')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- End of Meta Description -->

                                            <!-- Title Tag -->
                                            <div class="col-12 tw-mb-4"">
                                                <label class="col-form-label" for="{{ $locale }}[titleTag]">{{ __('Title Tag') }} ({{ strtoupper($locale) }})</label>
                                                <input type="text" id="{{ $locale }}[titleTag]" name="{{ $locale }}[titleTag]" class="form-control @error($locale. '.titleTag') error @enderror" placeholder="{{ __('Title Tag') }}" value="{{ old($locale. '.titleTag', optional($category->translate($locale))->title_tag) }}"/>
                                                @error($locale. '.titleTag')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- End of Title Tag -->

                                            <!-- Alt Tag -->
                                            <div class="col-12 tw-mb-4"">
                                                <label class="col-form-label" for="{{ $locale }}[altTag]">{{ __('Alt Tag') }} ({{ strtoupper($locale) }})</label>
                                                <input type="text" id="{{ $locale }}[altTag]" name="{{ $locale }}[altTag]" class="form-control @error($locale. '.altTag') error @enderror" placeholder="{{ __('Alt Tag') }}" value="{{ old($locale. '.altTag', optional($category->translate($locale))->alt_tag) }}"/>
                                                @error($locale. '.altTag')
                                                    <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- End of Alt Tag -->
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
                                <input type="number" id="sortOrder" class="form-control @error('sortOrder') error @enderror" name="sortOrder" placeholder="{{ __('Sort Order') }}" value="{{ old('sortOrder', $category->sort_order) }}"/>
                                @error('sortOrder')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 tw-mb-4">
                                <label class="form-label" for="parentId">{{ __('Parent') }}</label>
                                <select id="parentId" name="parentId" class="select2 form-select @error('parentId') error @enderror" placeholder="{{ __('Select Parent Category') }}">
                                    <option></option>
                                    @foreach($categories as $optCategory)
                                        <option value="{{ $optCategory->id }}" @if(old('parentId', $category->parent_id) == $optCategory->id) selected @endif>{{ optional($optCategory->translate(app()->getLocale()))->name }}</option>
                                    @endforeach
                                </select>
                                @error('parentId')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 tw-mb-4">
                                <label class="form-label" for="storeId">{{ __('Stores') }}</label>
                                <select id="storeId" name="storeId[]" class="select2 form-select @error('storeId') error @enderror" placeholder="{{ __('Select Store(s)') }}" multiple>
                                    @foreach($stores as $store)
                                        <option value="{{ $store->id }}" @if(in_array($store->id, old('storeId', $category->stores->pluck('id')->toArray()))) selected @endif>{{ $store->store_name }}</option>
                                    @endforeach
                                </select>
                                @error('storeId')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 tw-mb-4"">
                                <label class="col-form-label" for="designTemplate">{{ __('Design Template') }}</label>
                                <input type="text" id="designTemplate" class="form-control @error('designTemplate') error @enderror" name="designTemplate" placeholder="{{ __('Design Template') }}" value="{{ old('designTemplate', $category->design_template) }}"/>
                                @error('designTemplate')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 tw-mb-4"">
                                <label class="col-form-label" for="image">{{ __('Image') }}</label>
                                <input type="text" id="image" class="form-control @error('image') error @enderror" name="image" placeholder="{{ __('Image') }}" value="{{ old('image', $category->image) }}"/>
                                @error('image')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 tw-mb-4">
                                <label class="form-label" for="status">{{ __('Status') }}</label>
                                <select class="form-select @error('status') error @enderror" name="status">
                                    <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary me-1">
            {{ isset($category->id) ? __('Save') : __('Create') }}
        </button>
    </form>
</section>
@endsection
@section('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
@endsection
@section('page-script')
<script>

$(document).ready(function() {
    let rules = {}

    rules['name'] = { required: true }

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
            placeholder: $this.attr('placeholder'),
            allowClear: true,
        });
    });
});
</script>

<script>
function moduleData(){
    return {
        moduleInit(){
            @foreach ($locales as $locale)
                new Quill(this.$refs["{{ $locale }}DescriptionEditor"], { theme: 'snow' })
            @endforeach
        },
        submit(){
            @foreach ($locales as $locale)
                this.$refs["{{ $locale }}DescriptionEditorValue"].value = this.$refs["{{ $locale }}DescriptionEditor"].__quill.root.innerHTML;
            @endforeach
        }
    }
}
</script>
@endsection
