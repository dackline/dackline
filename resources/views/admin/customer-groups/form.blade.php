@extends('layouts/contentLayoutMaster')

@section('title', isset($customerGroup->id) ? __('Edit Customer Group') : __('Create Customer Group'))

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
    <!-- Basic Horizontal form layout section start -->
    <section>
        <form id="module-form" class="form form-horizontal" method="POST"
              action="{{ isset($customerGroup->id) ? route('admin::customer-groups.update', $customerGroup->id) : route('admin::customer-groups.store') }}"
              x-data="moduleData()" x-init="moduleInit()" x-on:submit="submit()" novalidate>
            @csrf
            @if(isset($customerGroup->id))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs" role="tablist">
                                @foreach ($locales as $locale)
                                    <li class="nav-item">
                                        <a class="nav-link @if($loop->first) active @endif"
                                           id="lang-{{ $locale }}-tab" data-bs-toggle="tab"
                                           href="#lang-{{ $locale }}" aria-controls="home" role="tab"
                                           aria-selected="true">
                                            <span class="tw-w-8">{!! get_locale_icon($locale) !!}</span>
                                            {{ get_locale_title($locale) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content">
                                @foreach ($locales as $locale)
                                    <div class="tab-pane @if($loop->first) active @endif"
                                         id="lang-{{ $locale }}"
                                         aria-labelledby="lang-{{ $locale }}-tab" role="tabpanel">
                                        <div class="row">
                                            <!-- Name -->
                                            <div class="col-12 tw-mb-4">
                                                <label class="col-form-label"
                                                       for="{{ $locale }}[name]">{{ __('Name') }}
                                                    ({{ strtoupper($locale) }})</label>
                                                <input type="text" id="{{ $locale }}[name]"
                                                       class="form-control @error($locale. '.name') error @enderror"
                                                       name="{{ $locale }}[name]"
                                                       placeholder="{{ __('Name') }}"
                                                       value="{{ old($locale. '.name', optional($customerGroup->translate($locale))->name) }}"/>
                                                @error($locale. '.name')
                                                <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- End of Name -->

                                            <!-- Description -->
                                            <div class="col-12 tw-mb-4">
                                                <label class="col-form-label"
                                                       for="{{ $locale }}[description]">{{ __('Description') }}
                                                    ({{ strtoupper($locale) }})</label>
                                                <textarea id="{{ $locale }}[description]"
                                                          name="{{ $locale }}[description]"
                                                          class="form-control @error($locale. '.description') error @enderror"
                                                          placeholder="{{ __('Description') }}">{{ old($locale. '.description', optional($customerGroup->translate($locale))->description) }}</textarea>
                                                @error($locale. '.description')
                                                <span class="error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- End of Description -->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary me-1">
                {{ isset($customerGroup->id) ? __('Save') : __('Create') }}
            </button>
        </form>
    </section>
@endsection
@section('vendor-script')
@endsection
@section('page-script')
    <script>
        $(document).ready(function () {
        });
    </script>

    <script>
        function moduleData() {
            return {
                moduleInit() {
                },
                submit() {
                }
            }
        }
    </script>
@endsection
