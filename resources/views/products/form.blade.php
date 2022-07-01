@extends('layouts/contentLayoutMaster')

@section('title', isset($product->id) ? __('Edit Product') : __('Create Product'))

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">

    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
@endsection

@section('content')
<!-- Basic Horizontal form layout section start -->
<section>
    <form id="module-form" class="form form-horizontal" method="POST" action="{{ isset($product->id) ? route('products.update', $product->id) : route('products.store') }}" x-data="moduleData()" x-init="moduleInit()" x-on:submit="submit()" novalidate>
        @csrf
        @if(isset($product->id))
            @method('PUT')
        @endif
        <section class="horizontal-wizard">
            <div class="bs-stepper horizontal-wizard-product">
                <div class="bs-stepper-header" role="tablist">
                    <div class="step" data-target="#section-general" role="tab" id="section-general-trigger">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" class="tw-fill-white"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10 10-4.49 10-10S17.51 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3-8c0 1.66-1.34 3-3 3s-3-1.34-3-3 1.34-3 3-3 3 1.34 3 3z"/></svg>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">{{ __('General') }}</span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#section-data" role="tab" id="section-data-trigger">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" class="tw-fill-white"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10 10-4.49 10-10S17.51 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3-8c0 1.66-1.34 3-3 3s-3-1.34-3-3 1.34-3 3-3 3 1.34 3 3z"/></svg>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">{{ __('Data') }}</span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#section-links" role="tab" id="section-links-trigger">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" class="tw-fill-white"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10 10-4.49 10-10S17.51 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3-8c0 1.66-1.34 3-3 3s-3-1.34-3-3 1.34-3 3-3 3 1.34 3 3z"/></svg>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">{{ __('Links') }}</span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <div id="section-general" class="content" role="tabpanel" aria-labelledby="section-general-trigger">
                        <div class="content-header">
                            <h5 class="mb-0">{{ __('General') }}</h5>
                        </div>
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
                                                <!-- Product Name -->
                                                <div class="col-12 tw-mb-4">
                                                    <label class="col-form-label" for="{{ $locale }}[productName]">{{ __('Product Name') }} ({{ strtoupper($locale) }})</label>
                                                    <input type="text" id="{{ $locale }}[productName]" class="form-control @error($locale. '.productName') error @enderror" name="{{ $locale }}[productName]" placeholder="{{ __('Product Name') }}" value="{{ old($locale. '.productName', optional($product->translate($locale))->product_name) }}"/>
                                                    @error($locale. '.productName')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!-- End of Product Name -->

                                                <!-- Description -->
                                                <div class="col-12 tw-mb-4"">
                                                    <label class="col-form-label" for="{{ $locale }}[description]">{{ __('Description') }} ({{ strtoupper($locale) }})</label>
                                                    <div class="editor-wrapper">
                                                        <div x-ref="{{ $locale }}DescriptionEditor">{!! old($locale. '.description', optional($product->translate($locale))->description) !!}</div>
                                                        <textarea id="{{ $locale }}[description]" name="{{ $locale }}[description]" class="form-control @error($locale. '.description') error @enderror" placeholder="{{ __('Description') }}" x-ref="{{ $locale }}DescriptionEditorValue" style="display: none"></textarea>
                                                    </div>
                                                    @error($locale. '.description')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!-- End of Description -->

                                                <!-- Meta Title -->
                                                <div class="col-12 tw-mb-4">
                                                    <label class="col-form-label" for="{{ $locale }}[metaTitle]">{{ __('Meta Title') }} ({{ strtoupper($locale) }})</label>
                                                    <input type="text" id="{{ $locale }}[metaTitle]" class="form-control @error($locale. '.metaTitle') error @enderror" name="{{ $locale }}[metaTitle]" placeholder="{{ __('Meta Title') }}" value="{{ old($locale. '.metaTitle', optional($product->translate($locale))->meta_title) }}"/>
                                                    @error($locale. '.metaTitle')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!-- End of Meta Title -->

                                                <!-- Meta Description -->
                                                <div class="col-12 tw-mb-4">
                                                    <label class="col-form-label" for="{{ $locale }}[metaDescription]">{{ __('Meta Description') }} ({{ strtoupper($locale) }})</label>
                                                    <textarea id="{{ $locale }}[metaDescription]" name="{{ $locale }}[metaDescription]" class="form-control @error($locale. '.metaDescription') error @enderror" placeholder="{{ __('Meta Description') }}">{{ old($locale. '.metaDescription', optional($product->translate($locale))->meta_description) }}</textarea>
                                                    @error($locale. '.metaDescription')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!-- End of Meta Description -->

                                                <!-- SEO H1 Tag -->
                                                <div class="col-12 tw-mb-4">
                                                    <label class="col-form-label" for="{{ $locale }}[seoH1Tag]">{{ __('SEO H1 Tag') }} ({{ strtoupper($locale) }})</label>
                                                    <input type="text" id="{{ $locale }}[seoH1Tag]" class="form-control @error($locale. '.seoH1Tag') error @enderror" name="{{ $locale }}[seoH1Tag]" placeholder="{{ __('SEO H1 Tag') }}" value="{{ old($locale. '.seoH1Tag', optional($product->translate($locale))->seo_h1_tag) }}"/>
                                                    @error($locale. '.seoH1Tag')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!-- End of SEO H1 Tag -->
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="section-data" class="content" role="tabpanel" aria-labelledby="section-data-trigger">
                        <div class="content-header">
                            <h5 class="mb-0">{{ __('Data') }}</h5>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <!-- Article Nr -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="articleNr">{{ __('Article Nr') }}</label>
                                        <input type="text" id="articleNr" class="form-control @error('articleNr') error @enderror" name="articleNr" placeholder="{{ __('Article Nr') }}" value="{{ old('articleNr', $product->article_nr) }}" />
                                        @error('articleNr')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Article Nr -->

                                    <!-- EAN -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="ean">{{ __('EAN') }}</label>
                                        <input type="text" id="ean" class="form-control @error('ean') error @enderror" name="ean" placeholder="{{ __('EAN') }}" value="{{ old('ean', $product->ean) }}" />
                                        @error('ean')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of EAN -->

                                    <!-- SKU -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="sku">{{ __('SKU') }}</label>
                                        <input type="text" id="sku" class="form-control @error('sku') error @enderror" name="sku" placeholder="{{ __('SKU') }}" value="{{ old('sku', $product->sku) }}" />
                                        @error('sku')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of SKU -->

                                    <!-- Location -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="location">{{ __('Location') }}</label>
                                        <input type="text" id="location" class="form-control @error('location') error @enderror" name="location" placeholder="{{ __('Location') }}" value="{{ old('location', $product->location) }}" />
                                        @error('location')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Location -->

                                    <!-- Price -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="price">{{ __('Price') }}</label>
                                        <input type="text" id="price" class="form-control @error('price') error @enderror" name="price" placeholder="{{ __('Price') }}" value="{{ old('price', $product->price) }}" />
                                        @error('price')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Price -->

                                    <!-- Tax -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="form-label" for="taxId">{{ __('Tax') }}</label>
                                        <select class="form-select @error('taxId') error @enderror" name="taxId">
                                            <option value="0">{{ __('--- Select Tax ---') }}</option>
                                            @foreach($taxes as $tax)
                                                <option value="{{ $tax->id }}" {{ old('taxId', $product->tax_id) == $tax->id ? 'selected' : '' }}>{{ $tax->tax_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('taxId')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Tax -->

                                    <!-- URL -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="url">{{ __('URL') }}</label>
                                        <input type="text" id="url" class="form-control @error('url') error @enderror" name="url" placeholder="{{ __('URL') }}" value="{{ old('url', $product->url) }}" />
                                        @error('url')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of URL -->

                                    <!-- Design Template -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="designTemplate">{{ __('Design Template') }}</label>
                                        <input type="text" id="designTemplate" class="form-control @error('designTemplate') error @enderror" name="designTemplate" placeholder="{{ __('Design Template') }}" value="{{ old('designTemplate', $product->design_template) }}" />
                                        @error('designTemplate')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Design Template -->

                                    <!-- Quantity -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="quantity">{{ __('Quantity') }}</label>
                                        <input type="text" id="quantity" class="form-control @error('quantity') error @enderror" name="quantity" placeholder="{{ __('Quantity') }}" value="{{ old('quantity', $product->quantity) }}" />
                                        @error('quantity')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Quantity -->

                                    <!-- Minimum Quantity -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="minimumQuantity">{{ __('Minimum Quantity') }}</label>
                                        <input type="text" id="minimumQuantity" class="form-control @error('minimumQuantity') error @enderror" name="minimumQuantity" placeholder="{{ __('Minimum Quantity') }}" value="{{ old('minimumQuantity', $product->minimum_quantity) }}" />
                                        @error('minimumQuantity')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Minimum Quantity -->

                                    <!-- Subtract -->
                                    <div class="col-12 tw-mb-4"">
                                        <label class="form-check-label" for="subtract">{{ __('Subtract') }}</label>
                                        <div class="form-check form-check-primary form-switch">
                                            <input type="checkbox" class="form-check-input" id="subtract" name="subtract" value="1" {{ old('subtract', $product->subtract) == '1' ? 'checked' : '' }}/>
                                        </div>
                                    </div>
                                    <!-- End of Subtract -->

                                    <!-- Stock Status -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="form-label" for="stockStatusId">{{ __('Stock Status') }}</label>
                                        <select class="form-select @error('stockStatusId') error @enderror" name="stockStatusId">
                                            <option value="0">{{ __('--- Select Stock Status ---') }}</option>
                                            @foreach($stockStatuses as $stockStatus)
                                                <option value="{{ $stockStatus->id }}" {{ old('stockStatusId', $product->stock_status_id) == $stockStatus->id ? 'selected' : '' }}>{{ $stockStatus->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('stockStatusId')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Stock Status -->

                                    <!-- Date Available -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="dateAvailable">{{ __('Date Available') }}</label>
                                        <input type="text" id="dateAvailable" class="form-control flatpickr-basic @error('dateAvailable') error @enderror" name="dateAvailable" placeholder="{{ __('Date Available') }} (YYYY-MM-DD)" value="{{ old('dateAvailable', $product->date_available) }}" />
                                        @error('dateAvailable')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Date Available -->

                                    <!-- Weight -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="weight">{{ __('Weight') }}</label>
                                        <input type="text" id="weight" class="form-control @error('weight') error @enderror" name="weight" placeholder="{{ __('Weight') }}" value="{{ old('weight', $product->weight) }}" />
                                        @error('weight')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Weight -->

                                    <!-- Sort Order -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="sortOrder">{{ __('Sort Order') }}</label>
                                        <input type="number" id="sortOrder" class="form-control @error('sortOrder') error @enderror" name="sortOrder" placeholder="{{ __('Sort Order') }}" value="{{ old('sortOrder', $product->sort_order) }}"/>
                                        @error('sortOrder')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Sort Order -->

                                    <!-- Status -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="form-label" for="status">{{ __('Status') }}</label>
                                        <select class="form-select @error('status') error @enderror" name="status">
                                            <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>{{ __('Active') }}</option>
                                            <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>{{ __('Inactive') }}</option>
                                        </select>
                                        @error('status')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Status -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="section-links" class="content" role="tabpanel" aria-labelledby="section-links-trigger">
                        <div class="content-header">
                            <h5 class="mb-0">{{ __('Links') }}</h5>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <!-- Manufacturer -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="form-label" for="manufacturerId">{{ __('Manufacturer') }}</label>
                                        <select class="select2 form-select @error('manufacturerId') error @enderror" name="manufacturerId" placeholder="{{ __('--- Select Manufacturer ---') }}">
                                            <option></option>
                                            @foreach($manufacturers as $manufacturer)
                                                <option value="{{ $manufacturer->id }}" {{ old('manufacturerId', $product->manufacturer_id) == $manufacturer->id ? 'selected' : '' }}>{{ $manufacturer->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('manufacturerId')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Manufacturer -->

                                    <!-- Categories -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="form-label" for="categoryId">{{ __('Categories') }}</label>
                                        <select id="categoryId" name="categoryId[]" class="select2 form-select @error('categoryId') error @enderror" placeholder="{{ __('Select Category(s)') }}" multiple>
                                            @foreach($categories as $category)
                                                <option value="{{ $category['id'] }}" @selected(in_array($category['id'], old('categoryId', $product->categories->pluck('id')->toArray())))>{{ $category['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('categoryId')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Categories -->

                                    <!-- Store -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="form-label" for="storeId">{{ __('Stores') }}</label>
                                        <select id="storeId" name="storeId[]" class="select2 form-select @error('storeId') error @enderror" placeholder="{{ __('Select Store(s)') }}" multiple>
                                            @foreach($stores as $store)
                                                <option value="{{ $store->id }}" @if(in_array($store->id, old('storeId', $product->stores->pluck('id')->toArray()))) selected @endif>{{ $store->store_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('storeId')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Store -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <button type="submit" class="btn btn-primary me-1">
            {{ isset($product->id) ? __('Save') : __('Create') }}
        </button>
    </form>
</section>
@endsection
@section('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
<script>

$(document).ready(function() {
    let rules = {}

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
            allowClear: $this.attr('multiple') ? false : true,
            placeholder: $this.attr('placeholder')
        });
    });
    $('.select2-search__field').css('width', '100%');

    // setup stepper
    var horizontalWizard = document.querySelector('.horizontal-wizard-product'),
        bsStepper = document.querySelectorAll('.bs-stepper');

    // Adds crossed class
    if (typeof bsStepper !== undefined && bsStepper !== null) {
        for (var el = 0; el < bsStepper.length; ++el) {
            bsStepper[el].addEventListener('show.bs-stepper', function (event) {
                var index = event.detail.indexStep;
                var numberOfSteps = $(event.target).find('.step').length - 1;
                var line = $(event.target).find('.step');

                // The first for loop is for increasing the steps,
                // the second is for turning them off when going back
                // and the third with the if statement because the last line
                // can't seem to turn off when I press the first item. ¯\_(ツ)_/¯

                for (var i = 0; i < index; i++) {
                    line[i].classList.add('crossed');

                    for (var j = index; j < numberOfSteps; j++) {
                        line[j].classList.remove('crossed');
                    }
                }
                if (event.detail.to == 0) {
                    for (var k = index; k < numberOfSteps; k++) {
                        line[k].classList.remove('crossed');
                    }
                    line[0].classList.remove('crossed');
                }
            });
        }
    }
    var numberedStepper = new Stepper(horizontalWizard, {
        linear: false
    })

    // setup datepicekr
    var basicPickr = $('.flatpickr-basic').flatpickr()


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
