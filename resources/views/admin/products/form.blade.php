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
    <form id="module-form" class="form form-horizontal" method="POST" action="{{ isset($product->id) ? route('admin::products.update', $product->id) : route('admin::products.store') }}" x-data="moduleData()" x-init="moduleInit()" x-on:submit="submit()" novalidate>
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
                    <div class="line"></div>
                    <div class="step" data-target="#section-option" role="tab" id="section-option-trigger">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" class="tw-fill-white"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10 10-4.49 10-10S17.51 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3-8c0 1.66-1.34 3-3 3s-3-1.34-3-3 1.34-3 3-3 3 1.34 3 3z"/></svg>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">{{ __('Option') }}</span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#section-image" role="tab" id="section-image-trigger">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" class="tw-fill-white"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10 10-4.49 10-10S17.51 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3-8c0 1.66-1.34 3-3 3s-3-1.34-3-3 1.34-3 3-3 3 1.34 3 3z"/></svg>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">{{ __('Image') }}</span>
                            </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#section-custom-fields" role="tab" id="section-custom-fields-trigger">
                        <button type="button" class="step-trigger">
                            <span class="bs-stepper-box">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" class="tw-fill-white"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10 10-4.49 10-10S17.51 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3-8c0 1.66-1.34 3-3 3s-3-1.34-3-3 1.34-3 3-3 3 1.34 3 3z"/></svg>
                            </span>
                            <span class="bs-stepper-label">
                                <span class="bs-stepper-title">{{ __('Custom Fields') }}</span>
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
                            <div class="col-sm-6">
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

                                    <!-- MPN -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="mpn">{{ __('MPN') }}</label>
                                        <input type="text" id="mpn" class="form-control @error('mpn') error @enderror" name="mpn" placeholder="{{ __('MPN') }}" value="{{ old('mpn', $product->mpn) }}" />
                                        @error('mpn')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of MPN -->

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
                                            <option value="">{{ __('--- Select Tax ---') }}</option>
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
                                            <option value="">{{ __('--- Select Stock Status ---') }}</option>
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
                                </div>
                            </div>
                            <div class="col-sm-6">
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
                    <div id="section-option" class="content" role="tabpanel" aria-labelledby="section-option-trigger"
                        x-data="moduleProductOptions()" x-init="moduleProductOptionsInit()"
                    >
                        <div class="content-header">
                            <h5 class="mb-0">{{ __('Option') }}</h5>
                        </div>
                        <div class="row">
                            <div class="accordion accordion-border accordion-margin tw-mb-4"
                            x-ref="accordion"
                            >
                                <template x-for="(productOption, productOptionIndex) in $store.storeProductOptions.productOptions">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header tw-relative" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" x-bind:data-bs-target="'#productOption-'+productOptionIndex+'-'+productOption.id" aria-expanded="false" x-bind:aria-controls="'productOption-'+productOptionIndex+'-'+productOption.id">
                                                <span x-text="productOption.name"></span>
                                            </button>
                                            <div x-on:click="deleteProductOption(productOptionIndex)" class="btn btn-danger btn-sm tw-absolute tw-right-14 tw-top-3 tw-z-10">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4 tw-text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m19 7-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v3M4 7h16"/></svg>
                                            </div>
                                        </h2>
                                        <div x-bind:id="'productOption-'+productOptionIndex+'-'+productOption.id" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <input type="hidden" x-bind:name="'productOption['+ productOptionIndex +'][name]'" x-bind:value="productOption.name">
                                                <input type="hidden" x-bind:name="'productOption['+ productOptionIndex +'][optionId]'" x-bind:value="productOption.optionId">
                                                <input type="hidden" x-bind:name="'productOption['+ productOptionIndex +'][type]'" x-bind:value="productOption.type">
                                                <div class="row tw-mb-4">
                                                    <div class="col-sm-3">
                                                        <label for="">{{ __('Required') }}</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <select class="form-select"
                                                            x-bind:name="'productOption['+productOptionIndex+'][required]'"
                                                            x-bind:id="'productOption['+productOptionIndex+'][required]'"
                                                            x-model="productOption.required"
                                                        >
                                                            <option value="1">{{ __('Yes') }}</option>
                                                            <option value="0">{{ __('No') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>{{ __('Option Value') }}</th>
                                                                        <th>{{ __('Quantity') }}</th>
                                                                        <th>{{ __('Subtract Stock') }}</th>
                                                                        <th>{{ __('Price') }}</th>
                                                                        <th>{{ __('Weight') }}</th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <template x-for="(productOptionValue, productOptionValueIndex) in productOption.optionValues">
                                                                        <tr>
                                                                            <td>
                                                                                <span x-text="$store.storeProductOptions.getProductOptionValueName(productOptionValue.optionId, productOptionValue.optionValueId)"></span>
                                                                                <input type="hidden" x-bind:name="'productOption['+ productOptionIndex +'][productOptionValue]['+productOptionValueIndex +'][optionValueId]'" x-bind:value="productOptionValue.optionValueId">
                                                                            </td>
                                                                            <td>
                                                                                <span x-text="productOptionValue.quantity"></span>
                                                                                <input type="hidden" x-bind:name="'productOption['+ productOptionIndex +'][productOptionValue]['+productOptionValueIndex +'][quantity]'" x-bind:value="productOptionValue.quantity">
                                                                            </td>
                                                                            <td>
                                                                                <span x-text="productOptionValue.subtract ? 'Yes' : 'No'"></span>
                                                                                <input type="hidden" x-bind:name="'productOption['+ productOptionIndex +'][productOptionValue]['+productOptionValueIndex +'][subtract]'" x-bind:value="productOptionValue.subtract">
                                                                            </td>
                                                                            <td>
                                                                                <span x-text="productOptionValue.pricePrefix+productOptionValue.price"></span>
                                                                                <input type="hidden" x-bind:name="'productOption['+ productOptionIndex +'][productOptionValue]['+productOptionValueIndex +'][pricePrefix]'" x-bind:value="productOptionValue.pricePrefix">
                                                                                <input type="hidden" x-bind:name="'productOption['+ productOptionIndex +'][productOptionValue]['+productOptionValueIndex +'][price]'" x-bind:value="productOptionValue.price">
                                                                            </td>
                                                                            <td>
                                                                                <span x-text="productOptionValue.weightPrefix+productOptionValue.weight"></span>
                                                                                <input type="hidden" x-bind:name="'productOption['+ productOptionIndex +'][productOptionValue]['+productOptionValueIndex +'][weightPrefix]'" x-bind:value="productOptionValue.weightPrefix">
                                                                                <input type="hidden" x-bind:name="'productOption['+ productOptionIndex +'][productOptionValue]['+productOptionValueIndex +'][weight]'" x-bind:value="productOptionValue.weight">
                                                                            </td>
                                                                            <td>
                                                                                <button type="button" class="btn btn-danger btn-sm" x-on:click="removeProductOptionValue(productOption, productOptionValueIndex)">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4 tw-text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"/></svg>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    </template>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="5"></td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                                x-on:click="openProductOptionValueModal(productOption)"
                                                                            >
                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4 tw-text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Add Option -->
                            <div class="row tw-mb-4">
                                <div class="col-8">
                                    <label class="col-form-label" for="articleNr">{{ __('Add Option') }}</label>
                                    <select name="addOption" id="addOption" class="select2 form-select" placeholder="Select Option to Add"  x-ref="select2AddOption">
                                        <option value=""></option>
                                        @foreach ($options as $option)
                                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label class="col-form-label">&nbsp;</label>
                                    <div>
                                        <button type="button" class="btn btn-primary" x-on:click="addProductOption()">{{ __('Add Option') }}</button>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Add Option -->
                        </div>
                    </div>
                    <div id="section-image" class="content" role="tabpanel" aria-labelledby="section-image-trigger"
                        x-data="moduleSectionImage()" x-init="moduleSectionImageInit()"
                    >
                        <div class="content-header">
                            <h5 class="mb-0">{{ __('Image') }}</h5>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-3">
                                <div class="card" x-model="image" x-data="imageSelector(image)">
                                    <img x-bind:src="imageSrc" />
                                    <input type="hidden" name="image" x-bind:value="image.path">
                                    <div class="card-body">
                                        <button type="button" class="btn btn-primary btn-sm" x-on:click="openFileManager()">Edit</button>
                                        <button type="button" class="btn btn-warning btn-sm" x-on:click="clearImage()">Clear</button>
                                    </div>
                                </div>
                            </div>
                            <h3>{{ __('Additional Images') }}</h3>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td>{{ __('Image') }}</td>
                                            <td>{{ __('Sort Order') }}</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(additionalImage, additionalImageIndex) in additionalImages">
                                            <tr>
                                                <td style="width: 25%">
                                                    <div class="card" x-model="additionalImage.image" x-data="imageSelector(additionalImage.image)">
                                                        <img x-bind:src="imageSrc" class="tw-w-full"/>
                                                        <input type="hidden" x-bind:name="'productImage['+ additionalImageIndex +'][image]'" x-bind:value="additionalImage.image.path">
                                                        <div class="card-body">
                                                            <button type="button" class="btn btn-primary btn-sm" x-on:click="openFileManager()">Edit</button>
                                                            <button type="button" class="btn btn-warning btn-sm" x-on:click="clearImage()">Clear</button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" x-bind:name="'productImage['+ additionalImageIndex +'][sortOrder]'" x-model="additionalImage.sortOrder">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-secondary" x-on:click="deleteAdditionalImage(additionalImageIndex)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"/></svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" type="button" x-on:click="addAdditionalImage()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="section-custom-fields" class="content" role="tabpanel" aria-labelledby="section-custom-fields-trigger">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-fields-general-tab" data-bs-toggle="tab" href="#custom-fields-general" role="tab" aria-selected="true">
                                    <span>{{ __('General') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-fields-wheel-tab" data-bs-toggle="tab" href="#custom-fields-wheel" role="tab" aria-selected="true">
                                    <span>{{ __('Wheels') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-fields-tire-tab" data-bs-toggle="tab" href="#custom-fields-tire" role="tab" aria-selected="true">
                                    <span>{{ __('Tires') }}</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="custom-fields-general" aria-labelledby="custom-fields-general-tab" role="tabpanel">
                                <div class="row">
                                    <!-- Supplier ID -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="supplierId">{{ __('Supplier ID') }}</label>
                                        <input type="text" id="supplierId" class="form-control @error('supplierId') error @enderror" name="supplierId" placeholder="{{ __('Supplier ID') }}" value="{{ old('supplierId', optional($product->customFields)->supplier_id) }}"/>
                                        @error('supplierId')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Supplier ID -->

                                    <!-- Manufacture Date -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="manufactureDate">{{ __('Manufacture Date') }}</label>
                                        <input type="text" id="manufactureDate" class="form-control @error('manufactureDate') error @enderror" name="manufactureDate" placeholder="{{ __('Manufacture Date') }}" value="{{ old('manufactureDate', optional($product->customFields)->manufacture_date) }}"/>
                                        @error('manufactureDate')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Manufacture Date -->

                                    <!-- Width -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="width">{{ __('Width') }}</label>
                                        <input type="text" id="width" class="form-control @error('width') error @enderror" name="width" placeholder="{{ __('Width') }}" value="{{ old('width', optional($product->customFields)->width) }}"/>
                                        @error('width')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Width -->

                                    <!-- Size -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="size">{{ __('Size') }}</label>
                                        <input type="text" id="size" class="form-control @error('size') error @enderror" name="size" placeholder="{{ __('Size') }}" value="{{ old('size', optional($product->customFields)->size) }}"/>
                                        @error('size')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Size -->

                                    <!-- Purchase Price -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="purchasePrice">{{ __('Purchase Price') }}</label>
                                        <input type="text" id="purchasePrice" class="form-control @error('purchasePrice') error @enderror" name="purchasePrice" placeholder="{{ __('Purchase Price') }}" value="{{ old('purchasePrice', optional($product->customFields)->purchase_price) }}"/>
                                        @error('purchasePrice')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Purchase Price -->
                                </div>
                            </div>

                            <div class="tab-pane" id="custom-fields-wheel" aria-labelledby="custom-fields-wheel-tab" role="tabpanel">
                                <div class="row">
                                    <!-- Wheel Color -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="wheelColor">{{ __('Wheel Color') }}</label>
                                        <input type="text" id="wheelColor" class="form-control @error('wheelColor') error @enderror" name="wheelColor" placeholder="{{ __('Wheel Color') }}" value="{{ old('wheelColor', optional($product->customFields)->wheel_color) }}"/>
                                        @error('wheelColor')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Wheel Color -->

                                    <!-- Wheel ET -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="wheelEt">{{ __('Wheel ET') }}</label>
                                        <input type="text" id="wheelEt" class="form-control @error('wheelEt') error @enderror" name="wheelEt" placeholder="{{ __('Wheel ET') }}" value="{{ old('wheelEt', optional($product->customFields)->wheel_et) }}"/>
                                        @error('wheelEt')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Wheel ET -->

                                    <!-- Wheel Center Bore -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="wheelCenterBore">{{ __('Wheel Center Bore') }}</label>
                                        <input type="text" id="wheelCenterBore" class="form-control @error('wheelCenterBore') error @enderror" name="wheelCenterBore" placeholder="{{ __('Wheel Center Bore') }}" value="{{ old('wheelCenterBore', optional($product->customFields)->wheel_center_bore) }}"/>
                                        @error('wheelCenterBore')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Wheel Center Bore -->

                                    <!-- Wheel Max Load -->
                                    <div class="col-12 tw-mb-4">
                                        <label class="col-form-label" for="wheelMaxLoad">{{ __('Wheel Max Load') }}</label>
                                        <input type="text" id="wheelMaxLoad" class="form-control @error('wheelMaxLoad') error @enderror" name="wheelMaxLoad" placeholder="{{ __('Wheel Max Load') }}" value="{{ old('wheelMaxLoad', optional($product->customFields)->wheel_max_load) }}"/>
                                        @error('wheelMaxLoad')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Wheel Max Load -->

                                    <div class="row">
                                        <!-- PCD1 -->
                                        <div class="col-sm-2 tw-mb-4">
                                            <label class="col-form-label" for="wheelPcd1">{{ __('PCD1') }}</label>
                                            <input type="text" id="wheelPcd1" class="form-control @error('wheelPcd1') error @enderror" name="wheelPcd1" placeholder="{{ __('PCD1') }}" value="{{ old('wheelPcd1', optional($product->customFields)->wheel_pcd['pcd_1'] ?? '') }}"/>
                                            @error('wheelPcd1')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- End of PCD1 -->

                                        <!-- PCD2 -->
                                        <div class="col-sm-2 tw-mb-4">
                                            <label class="col-form-label" for="wheelPcd2">{{ __('PCD2') }}</label>
                                            <input type="text" id="wheelPcd2" class="form-control @error('wheelPcd2') error @enderror" name="wheelPcd2" placeholder="{{ __('PCD2') }}" value="{{ old('wheelPcd2', optional($product->customFields)->wheel_pcd['pcd_2'] ?? '') }}"/>
                                            @error('wheelPcd2')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- End of PCD2 -->

                                        <!-- PCD3 -->
                                        <div class="col-sm-2 tw-mb-4">
                                            <label class="col-form-label" for="wheelPcd3">{{ __('PCD3') }}</label>
                                            <input type="text" id="wheelPcd3" class="form-control @error('wheelPcd3') error @enderror" name="wheelPcd3" placeholder="{{ __('PCD3') }}" value="{{ old('wheelPcd3', optional($product->customFields)->wheel_pcd['pcd_3'] ?? '') }}"/>
                                            @error('wheelPcd3')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- End of PCD3 -->

                                        <!-- PCD4 -->
                                        <div class="col-sm-2 tw-mb-4">
                                            <label class="col-form-label" for="wheelPcd4">{{ __('PCD4') }}</label>
                                            <input type="text" id="wheelPcd4" class="form-control @error('wheelPcd4') error @enderror" name="wheelPcd4" placeholder="{{ __('PCD4') }}" value="{{ old('wheelPcd4', optional($product->customFields)->wheel_pcd['pcd_4'] ?? '') }}"/>
                                            @error('wheelPcd4')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- End of PCD4 -->

                                        <!-- PCD5 -->
                                        <div class="col-sm-2 tw-mb-4">
                                            <label class="col-form-label" for="wheelPcd5">{{ __('PCD5') }}</label>
                                            <input type="text" id="wheelPcd5" class="form-control @error('wheelPcd5') error @enderror" name="wheelPcd5" placeholder="{{ __('PCD5') }}" value="{{ old('wheelPcd5', optional($product->customFields)->wheel_pcd['pcd_5'] ?? '') }}"/>
                                            @error('wheelPcd5')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- End of PCD5 -->

                                        <!-- PCD6 -->
                                        <div class="col-sm-2 tw-mb-4">
                                            <label class="col-form-label" for="wheelPcd6">{{ __('PCD6') }}</label>
                                            <input type="text" id="wheelPcd6" class="form-control @error('wheelPcd6') error @enderror" name="wheelPcd6" placeholder="{{ __('PCD6') }}" value="{{ old('wheelPcd6', optional($product->customFields)->wheel_pcd['pcd_6'] ?? '') }}"/>
                                            @error('wheelPcd6')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- End of PCD6 -->

                                        <!-- PCD7 -->
                                        <div class="col-sm-2 tw-mb-4">
                                            <label class="col-form-label" for="wheelPcd7">{{ __('PCD7') }}</label>
                                            <input type="text" id="wheelPcd7" class="form-control @error('wheelPcd7') error @enderror" name="wheelPcd7" placeholder="{{ __('PCD7') }}" value="{{ old('wheelPcd7', optional($product->customFields)->wheel_pcd['pcd_7'] ?? '') }}"/>
                                            @error('wheelPcd7')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- End of PCD7 -->

                                        <!-- PCD8 -->
                                        <div class="col-sm-2 tw-mb-4">
                                            <label class="col-form-label" for="wheelPcd8">{{ __('PCD8') }}</label>
                                            <input type="text" id="wheelPcd8" class="form-control @error('wheelPcd8') error @enderror" name="wheelPcd8" placeholder="{{ __('PCD8') }}" value="{{ old('wheelPcd8', optional($product->customFields)->wheel_pcd['pcd_8'] ?? '') }}"/>
                                            @error('wheelPcd8')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- End of PCD8 -->

                                        <!-- PCD9 -->
                                        <div class="col-sm-2 tw-mb-4">
                                            <label class="col-form-label" for="wheelPcd9">{{ __('PCD9') }}</label>
                                            <input type="text" id="wheelPcd9" class="form-control @error('wheelPcd9') error @enderror" name="wheelPcd9" placeholder="{{ __('PCD9') }}" value="{{ old('wheelPcd9', optional($product->customFields)->wheel_pcd['pcd_9'] ?? '') }}"/>
                                            @error('wheelPcd9')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- End of PCD9 -->

                                        <!-- PCD10 -->
                                        <div class="col-sm-2 tw-mb-4">
                                            <label class="col-form-label" for="wheelPcd10">{{ __('PCD10') }}</label>
                                            <input type="text" id="wheelPcd10" class="form-control @error('wheelPcd10') error @enderror" name="wheelPcd10" placeholder="{{ __('PCD10') }}" value="{{ old('wheelPcd10', optional($product->customFields)->wheel_pcd['pcd_10'] ?? '') }}"/>
                                            @error('wheelPcd10')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- End of PCD10 -->

                                        <!-- PCD11 -->
                                        <div class="col-sm-2 tw-mb-4">
                                            <label class="col-form-label" for="wheelPcd11">{{ __('PCD11') }}</label>
                                            <input type="text" id="wheelPcd11" class="form-control @error('wheelPcd11') error @enderror" name="wheelPcd11" placeholder="{{ __('PCD11') }}" value="{{ old('wheelPcd11', optional($product->customFields)->wheel_pcd['pcd_11'] ?? '') }}"/>
                                            @error('wheelPcd11')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- End of PCD11 -->

                                        <!-- PCD12 -->
                                        <div class="col-sm-2 tw-mb-4">
                                            <label class="col-form-label" for="wheelPcd12">{{ __('PCD12') }}</label>
                                            <input type="text" id="wheelPcd12" class="form-control @error('wheelPcd12') error @enderror" name="wheelPcd12" placeholder="{{ __('PCD12') }}" value="{{ old('wheelPcd12', optional($product->customFields)->wheel_pcd['pcd_12'] ?? '') }}"/>
                                            @error('wheelPcd12')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- End of PCD12 -->

                                        <!-- PCD13 -->
                                        <div class="col-sm-2 tw-mb-4">
                                            <label class="col-form-label" for="wheelPcd13">{{ __('PCD13') }}</label>
                                            <input type="text" id="wheelPcd13" class="form-control @error('wheelPcd13') error @enderror" name="wheelPcd13" placeholder="{{ __('PCD13') }}" value="{{ old('wheelPcd13', optional($product->customFields)->wheel_pcd['pcd_13'] ?? '') }}"/>
                                            @error('wheelPcd13')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- End of PCD13 -->

                                        <!-- PCD14 -->
                                        <div class="col-sm-2 tw-mb-4">
                                            <label class="col-form-label" for="wheelPcd14">{{ __('PCD14') }}</label>
                                            <input type="text" id="wheelPcd14" class="form-control @error('wheelPcd14') error @enderror" name="wheelPcd14" placeholder="{{ __('PCD14') }}" value="{{ old('wheelPcd14', optional($product->customFields)->wheel_pcd['pcd_14'] ?? '') }}"/>
                                            @error('wheelPcd14')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- End of PCD14 -->

                                        <!-- PCD15 -->
                                        <div class="col-sm-2 tw-mb-4">
                                            <label class="col-form-label" for="wheelPcd15">{{ __('PCD15') }}</label>
                                            <input type="text" id="wheelPcd15" class="form-control @error('wheelPcd15') error @enderror" name="wheelPcd15" placeholder="{{ __('PCD15') }}" value="{{ old('wheelPcd15', optional($product->customFields)->wheel_pcd['pcd_15'] ?? '') }}"/>
                                            @error('wheelPcd15')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- End of PCD15 -->

                                        <!-- PCD16 -->
                                        <div class="col-sm-2 tw-mb-4">
                                            <label class="col-form-label" for="wheelPcd16">{{ __('PCD16') }}</label>
                                            <input type="text" id="wheelPcd16" class="form-control @error('wheelPcd16') error @enderror" name="wheelPcd16" placeholder="{{ __('PCD16') }}" value="{{ old('wheelPcd16', optional($product->customFields)->wheel_pcd['pcd_16'] ?? '') }}"/>
                                            @error('wheelPcd16')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!-- End of PCD16 -->
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="custom-fields-tire" aria-labelledby="custom-fields-tire-tab" role="tabpanel">
                                <div class="row">
                                    <!-- Tyre Holohation Mark -->
                                    <div class="col-6 tw-mb-4">
                                        <label class="col-form-label" for="tyreHolohationMark">{{ __('Tyre Holohation Mark') }}</label>
                                        <input type="text" id="tyreHolohationMark" class="form-control @error('tyreHolohationMark') error @enderror" name="tyreHolohationMark" placeholder="{{ __('Tyre Holohation Mark') }}" value="{{ old('tyreHolohationMark', optional($product->customFields)->tyre_holohation_mark) }}"/>
                                        @error('tyreHolohationMark')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Tyre Holohation Mark -->

                                    <!-- Tyre Runflat RTF -->
                                    <div class="col-6 tw-mb-4">
                                        <label class="col-form-label" for="tyreRunflatRtf">{{ __('Tyre Runflat RTF') }}</label>
                                        <input type="text" id="tyreRunflatRtf" class="form-control @error('tyreRunflatRtf') error @enderror" name="tyreRunflatRtf" placeholder="{{ __('Tyre Runflat RTF') }}" value="{{ old('tyreRunflatRtf', optional($product->customFields)->tyre_runflat_rtf) }}"/>
                                        @error('tyreRunflatRtf')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Tyre Runflat RTF -->

                                    <!-- Tyre Profile -->
                                    <div class="col-6 tw-mb-4">
                                        <label class="col-form-label" for="tyreProfile">{{ __('Tyre Profile') }}</label>
                                        <input type="text" id="tyreProfile" class="form-control @error('tyreProfile') error @enderror" name="tyreProfile" placeholder="{{ __('Tyre Profile') }}" value="{{ old('tyreProfile', optional($product->customFields)->tyre_profile) }}"/>
                                        @error('tyreProfile')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Tyre Profile -->

                                    <!-- Tyre SNOWIGAN -->
                                    <div class="col-6 tw-mb-4">
                                        <label class="col-form-label" for="tyreSnowigan">{{ __('Tyre SNOWIGAN') }}</label>
                                        <input type="text" id="tyreSnowigan" class="form-control @error('tyreSnowigan') error @enderror" name="tyreSnowigan" placeholder="{{ __('Tyre SNOWIGAN') }}" value="{{ old('tyreSnowigan', optional($product->customFields)->tyre_snowigan) }}"/>
                                        @error('tyreSnowigan')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Tyre SNOWIGAN -->

                                    <!-- Tyre Construction Type -->
                                    <div class="col-6 tw-mb-4">
                                        <label class="col-form-label" for="tyreConstructionType">{{ __('Tyre Construction Type') }}</label>
                                        <input type="text" id="tyreConstructionType" class="form-control @error('tyreConstructionType') error @enderror" name="tyreConstructionType" placeholder="{{ __('Tyre Construction Type') }}" value="{{ old('tyreConstructionType', optional($product->customFields)->tyre_construction_type) }}"/>
                                        @error('tyreConstructionType')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Tyre Construction Type -->

                                    <!-- Tyre Studded -->
                                    <div class="col-6 tw-mb-4">
                                        <label class="col-form-label" for="tyreStudded">{{ __('Tyre Studded') }}</label>
                                        <input type="text" id="tyreStudded" class="form-control @error('tyreStudded') error @enderror" name="tyreStudded" placeholder="{{ __('Tyre Studded') }}" value="{{ old('tyreStudded', optional($product->customFields)->tyre_studded) }}"/>
                                        @error('tyreStudded')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Tyre Studded -->

                                    <!-- Tyre Load Index -->
                                    <div class="col-6 tw-mb-4">
                                        <label class="col-form-label" for="tyreLoadIndex">{{ __('Tyre Load Index') }}</label>
                                        <input type="text" id="tyreLoadIndex" class="form-control @error('tyreLoadIndex') error @enderror" name="tyreLoadIndex" placeholder="{{ __('Tyre Load Index') }}" value="{{ old('tyreLoadIndex', optional($product->customFields)->tyre_load_index) }}"/>
                                        @error('tyreLoadIndex')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Tyre Load Index -->

                                    <!-- Tyre Label Roll -->
                                    <div class="col-6 tw-mb-4">
                                        <label class="col-form-label" for="tyreLabelRoll">{{ __('Tyre Label Roll') }}</label>
                                        <input type="text" id="tyreLabelRoll" class="form-control @error('tyreLabelRoll') error @enderror" name="tyreLabelRoll" placeholder="{{ __('Tyre Label Roll') }}" value="{{ old('tyreLabelRoll', optional($product->customFields)->tyre_label_roll) }}"/>
                                        @error('tyreLabelRoll')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Tyre Label Roll -->

                                    <!-- Tyre Speed Rating -->
                                    <div class="col-6 tw-mb-4">
                                        <label class="col-form-label" for="tyreSpeedRating">{{ __('Tyre Speed Rating') }}</label>
                                        <input type="text" id="tyreSpeedRating" class="form-control @error('tyreSpeedRating') error @enderror" name="tyreSpeedRating" placeholder="{{ __('Tyre Speed Rating') }}" value="{{ old('tyreSpeedRating', optional($product->customFields)->tyre_speed_rating) }}"/>
                                        @error('tyreSpeedRating')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Tyre Speed Rating -->

                                    <!-- Tyre Label Wet -->
                                    <div class="col-6 tw-mb-4">
                                        <label class="col-form-label" for="tyreLabelWet">{{ __('Tyre Label Wet') }}</label>
                                        <input type="text" id="tyreLabelWet" class="form-control @error('tyreLabelWet') error @enderror" name="tyreLabelWet" placeholder="{{ __('Tyre Label Wet') }}" value="{{ old('tyreLabelWet', optional($product->customFields)->tyre_label_wet) }}"/>
                                        @error('tyreLabelWet')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Tyre Label Wet -->

                                    <!-- Tyre C-Flag -->
                                    <div class="col-6 tw-mb-4">
                                        <label class="col-form-label" for="tyreCFlag">{{ __('Tyre C-Flag') }}</label>
                                        <input type="text" id="tyreCFlag" class="form-control @error('tyreCFlag') error @enderror" name="tyreCFlag" placeholder="{{ __('Tyre C-Flag') }}" value="{{ old('tyreCFlag', optional($product->customFields)->tyre_c_flag) }}"/>
                                        @error('tyreCFlag')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Tyre C-Flag -->

                                    <!-- Tyre Label Noise 1 -->
                                    <div class="col-6 tw-mb-4">
                                        <label class="col-form-label" for="tyreLabelNoise1">{{ __('Tyre Label Noise 1') }}</label>
                                        <input type="text" id="tyreLabelNoise1" class="form-control @error('tyreLabelNoise1') error @enderror" name="tyreLabelNoise1" placeholder="{{ __('Tyre Label Noise 1') }}" value="{{ old('tyreLabelNoise1', optional($product->customFields)->tyre_label_noise_1) }}"/>
                                        @error('tyreLabelNoise1')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Tyre Label Noise 1 -->

                                    <!-- Tyre Category Info -->
                                    <div class="col-6 tw-mb-4">
                                        <label class="col-form-label" for="tyreCategoryInfo">{{ __('Tyre Category Info') }}</label>
                                        <input type="text" id="tyreCategoryInfo" class="form-control @error('tyreCategoryInfo') error @enderror" name="tyreCategoryInfo" placeholder="{{ __('Tyre Category Info') }}" value="{{ old('tyreCategoryInfo', optional($product->customFields)->tyre_category_info) }}"/>
                                        @error('tyreCategoryInfo')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Tyre Category Info -->

                                    <!-- Tyre Label Noise 2 -->
                                    <div class="col-6 tw-mb-4">
                                        <label class="col-form-label" for="tyreLabelNoise2">{{ __('Tyre Label Noise 2') }}</label>
                                        <input type="text" id="tyreLabelNoise2" class="form-control @error('tyreLabelNoise2') error @enderror" name="tyreLabelNoise2" placeholder="{{ __('Tyre Label Noise 2') }}" value="{{ old('tyreLabelNoise2', optional($product->customFields)->tyre_label_noise_2) }}"/>
                                        @error('tyreLabelNoise2')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- End of Tyre Label Noise 2 -->
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

<!-- Modal Product Option Value -->
<div
    x-data="moduleModalProductOptionvalue()"
    x-init="moduleModalProductOptionvalueInit()"
    x-on:show-product-option-value-modal.window="show()"
    x-on:hide-product-option-value-modal.window="hide()"
    x-on:toggle-product-option-value-modal.window="toggle()"
>
    <div class="modal fade text-start" id="modalProductOptionValue" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true"
        x-ref="modal"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">{{ __('Option Value') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Option Value -->
                    <div class="col-12 tw-mb-4">
                        <label class="col-form-label" for="optionValue">{{ __('Option Value') }}</label>
                        <select name="optionValues" id="optionValues" class="form-select" x-model="$store.storeModalProductOptionValue.productOptionValue.optionValueId">
                            <template x-for="optionValue in $store.storeModalProductOptionValue.optionValues">
                                <option x-bind:value="optionValue.id" x-text="optionValue.name"></option>
                            </template>
                        </select>
                    </div>
                    <!-- End of Option Value -->

                    <!-- Quantity -->
                    <div class="col-12 tw-mb-4">
                        <label class="col-form-label" for="quantity">{{ __('Quantity') }}</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" x-model="$store.storeModalProductOptionValue.productOptionValue.quantity" />
                    </div>
                    <!-- End of Quantity -->

                    <!-- Subtract -->
                    <div class="col-12 tw-mb-4">
                        <label class="col-form-label" for="optionValue">{{ __('Subtract') }}</label>
                        <select name="subtract" id="subtract" class="form-select" x-model="$store.storeModalProductOptionValue.productOptionValue.subtract">
                            <option value="1">{{ __('Yes') }}</option>
                            <option value="0">{{ __('No') }}</option>
                        </select>
                    </div>
                    <!-- End of Subtract -->

                    <!-- Price -->
                    <div class="col-12 tw-mb-4">
                        <label class="col-form-label" for="optionValue">{{ __('Price') }}</label>
                        <div class="input-group">
                            <select name="pricePrefix" id="pricePrefix" class="form-select" x-model="$store.storeModalProductOptionValue.productOptionValue.pricePrefix">
                                <option value="+">+</option>
                                <option value="-">-</option>
                            </select>
                            <input type="text" name="price"  placeholder="Price" id="price" class="form-control" x-model="$store.storeModalProductOptionValue.productOptionValue.price">
                        </div>
                    </div>
                    <!-- End of Price -->

                    <!-- Weight -->
                    <div class="col-12 tw-mb-4">
                        <label class="col-form-label" for="optionValue">{{ __('Weight') }}</label>
                        <div class="input-group">
                            <select name="weightPrefix" id="weightPrefix" class="form-select" x-model="$store.storeModalProductOptionValue.productOptionValue.weightPrefix">
                                <option value="+">+</option>
                                <option value="-">-</option>
                            </select>
                            <input type="text" name="weight"  placeholder="Weight" id="weight" class="form-control" x-model="$store.storeModalProductOptionValue.productOptionValue.weight">
                        </div>
                    </div>
                    <!-- End of Weight -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                        x-on:click="addProductOptionValue"
                    >{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal Product Option Value -->
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

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('storeProductOptions', {
            options: JSON.parse('@json($options)'),
            productOptions: JSON.parse('@json($productOptions)'),
            selectedOption: null,
            init() {
            },
            getOption(optionId) {
                return this.options.find((option) => option.id == optionId)
            },
            getUniqueId() {
                let array = new Uint32Array(8)
                window.crypto.getRandomValues(array)
                let str = ''
                for (let i = 0; i < array.length; i++) {
                    str += (i < 2 || i > 5 ? '' : '-') + array[i].toString(16).slice(-4)
                }
                return str
            },
            addProductOption() {
                if(!this.selectedOption)
                    return null

                let selectedOption = this.getOption(this.selectedOption)
                this.productOptions.push({
                    id: this.getUniqueId(),
                    optionId: selectedOption.id,
                    type: selectedOption.type,
                    name: selectedOption.name,
                    required: 0,
                    optionValues: [],
                })
                this.selectedOption = null
            },
            deleteProductOption(index) {
                this.productOptions.splice(index, 1)
            },
            getProductOptionValueName(optionId, optionValueId) {
                let option = this.options.find(_ => _.id == optionId)

                if(!option)
                    return ''

                let optionValue = option.values.find(_ => _.id == optionValueId)

                if(!optionValue)
                    return ''

                return optionValue.name
            }
        });

        Alpine.store('storeModalProductOptionValue', {
            modal: null,
            productOptionValue: {},
            optionValues: [],
            init() {
                this.resetProductOptionValue()
            },
            resetProductOptionValue() {
                this.productOptionValue = {
                    productOptionId: null,
                    productId: null,
                    optionId: null,
                    optionValueId: null,
                    optionValue: null,
                    quantity: 1,
                    subtract: 0,
                    price: 0,
                    pricePrefix: '+',
                    weight: 0,
                    weightPrefix: '+',
                }
            },
        });
    })
</script>
<script>
    function moduleProductOptions() {
        return {
            moduleProductOptionsInit() {
                $(this.$refs.select2AddOption).on('change', (e) => {
                    this.$store.storeProductOptions.selectedOption = e.target.value
                })
            },
            addProductOption() {
                this.$store.storeProductOptions.addProductOption()
                $(this.$refs.select2AddOption).val('').trigger('change')
            },
            deleteProductOption(index) {
                if(!confirm("{{ __('Are you sure to delete?') }}"))
                    return

                this.$store.storeProductOptions.deleteProductOption(index)
            },
            async openProductOptionValueModal(productOption) {
                let option = this.$store.storeProductOptions.getOption(productOption.optionId)
                this.$store.storeModalProductOptionValue.optionValues = option.values
                this.$store.storeModalProductOptionValue.productOptionValue.productOptionId = productOption.id
                this.$store.storeModalProductOptionValue.productOptionValue.optionId = productOption.optionId

                if(option.values.length > 0) {
                    this.$store.storeModalProductOptionValue.productOptionValue.optionValueId = option.values[0].id
                }

                this.$dispatch('show-product-option-value-modal')
            },
            removeProductOptionValue(productOption, productOptionValueIndex) {
                if(!confirm("{{ __('Are you sure to delete?') }}"))
                    return

                let _productOption = this.$store.storeProductOptions.productOptions.find(_ => _.id == productOption.id)

                _productOption.optionValues.splice(productOptionValueIndex, 1)
            }
        }
    }

    function moduleModalProductOptionvalue() {
        return {
            moduleModalProductOptionvalueInit() {
                this.$store.storeModalProductOptionValue.modal = new bootstrap.Modal($(this.$refs.modal), {})
            },
            show() {
                this.$store.storeModalProductOptionValue.modal.show()
            },
            hide() {
                this.$store.storeModalProductOptionValue.modal.hide()
            },
            toggle() {
                this.$store.storeModalProductOptionValue.modal.toggle()
            },
            addProductOptionValue() {
                let productOption = this.$store.storeProductOptions.productOptions.find(_ => _.id == this.$store.storeModalProductOptionValue.productOptionValue.productOptionId)

                productOption.optionValues.push($.extend(true, {}, this.$store.storeModalProductOptionValue.productOptionValue))

                this.$dispatch('hide-product-option-value-modal')

                this.$store.storeModalProductOptionValue.resetProductOptionValue()
            }
        }
    }
</script>

<script>
    function moduleSectionImage() {
        return  {
            image: {
                url: "{{ $productImage ? $productImage['image']['url'] : '' }}",
                path: "{{ $productImage ? $productImage['image']['path'] : '' }}",
            },
            additionalImages: JSON.parse('@json($additionalImages)'),
            moduleSectionImageInit() {
            },
            addAdditionalImage() {
                this.additionalImages.push({
                    image: {
                        url: '',
                        path: '',
                    },
                    sortOrder: 0,
                })
            },
            deleteAdditionalImage(index) {
                if(!confirm("{{ __('Are you sure to delete?') }}")) {
                    return
                }

                this.additionalImages.splice(index, 1)
            }
        }
    }

</script>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('imageSelector', (image = {url: '', path: ''}) => ({
            defaultImage: "{{ url('/no-image.png') }}",
            image: image,
            fileManager: {
                routePrefix: "route('admin::unisharp.lfm.show') }}",
                type: 'image',
            },
            get imageSrc() {
                if(this.image.url) {
                    return this.image.url
                }
                return this.defaultImage
            },
            init() {
            },
            openFileManager() {
                window.open(this.fileManager.routePrefix + '?multiple=false&type=' + this.fileManager.type, 'FileManager', 'width=900,height=600')
                window.SetUrl = (items) => {
                    let item = items[items.length - 1]
                    let path = item.path.replace('/thumbs', '')
                    let url = item.thumb_url;
                    this.image.url = url
                    this.image.path = path
                    this.$dispatch('input',  this.image)
                };
            },
            clearImage() {
                this.image.url = ''
                this.image.path = ''
                this.$dispatch('input',  this.image)
            },
        }))
    })
</script>
@endsection