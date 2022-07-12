@extends('layouts/contentLayoutMaster')

@section('title', isset($shippingMethod->id) ? __('Edit Shipping Method') : __('Create Shipping Method'))

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
        <form id="module-form" class="form form-horizontal" method="POST"
              action="{{ isset($shippingMethod->id) ? route('admin::shipping-methods.update', $shippingMethod->id) : route('admin::shipping-methods.store') }}"
              x-data="moduleData()" x-init="moduleInit()" x-on:submit="submit()" novalidate>
            @csrf
            @if(isset($shippingMethod->id))
                @method('PUT')
            @endif
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Data')  }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Name -->
                                <div class="col-12 tw-mb-4">
                                    <label class="col-form-label" for="name">{{ __('Name') }}</label>
                                    <input type="text" id="name"
                                           class="form-control @error('name') error @enderror" name="name"
                                           placeholder="{{ __('Name') }}"
                                           value="{{ old('name', $shippingMethod->name) }}"/>
                                    @error('name')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of Name -->

                                <!-- Description -->
                                <div class="col-12 tw-mb-4">
                                    <label class="col-form-label" for="description">{{ __('Description') }}</label>
                                    <input type="text" id="description"
                                           class="form-control @error('description') error @enderror" name="description"
                                           placeholder="{{ __('Description') }}"
                                           value="{{ old('description', $shippingMethod->description) }}"/>
                                    @error('description')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of Description -->

                                <!-- Total -->
                                <div class="col-12 tw-mb-4">
                                    <label class="col-form-label" for="total">{{ __('Total') }}</label>
                                    <input type="text" id="total"
                                           class="form-control @error('total') error @enderror" name="total"
                                           placeholder="{{ __('Total') }}"
                                           value="{{ old('total', $shippingMethod->total) }}"/>
                                    @error('total')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of Total -->

                                <!-- Cost -->
                                <div class="col-12 tw-mb-4">
                                    <label class="col-form-label" for="cost">{{ __('Cost') }}</label>
                                    <input type="text" id="cost"
                                           class="form-control @error('cost') error @enderror" name="cost"
                                           placeholder="{{ __('Cost') }}"
                                           value="{{ old('cost', $shippingMethod->cost) }}"/>
                                    @error('cost')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of Cost -->

                                <!-- Store -->
                                <div class="col-12 tw-mb-4">
                                    <label class="form-label" for="storeId">{{ __('Store') }}</label>
                                    <select class="select2 form-select @error('storeId') error @enderror" name="storeId" placeholder="{{ __('--- Select Store ---') }}">
                                        <option></option>
                                        @foreach($stores as $store)
                                            <option value="{{ $store->id }}" {{ old('storeId', $shippingMethod->store_id) == $store->id ? 'selected' : '' }}>{{ $store->store_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('storeId')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of Store -->

                                <!-- Geo Zone -->
                                <div class="col-12 tw-mb-4">
                                    <label class="form-label" for="geoZoneId">{{ __('Geo Zone') }}</label>
                                    <select class="select2 form-select @error('geoZoneId') error @enderror" name="geoZoneId" placeholder="{{ __('--- Select Geo Zone ---') }}">
                                        <option></option>
                                        @foreach($geoZones as $geoZone)
                                            <option value="{{ $geoZone->id }}" {{ old('geoZoneId', $shippingMethod->geo_zone_id) == $geoZone->id ? 'selected' : '' }}>{{ $geoZone->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('geoZoneId')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of Geo Zone -->

                                <!-- Status -->
                                <div class="col-12 tw-mb-4">
                                    <label class="form-label" for="status">{{ __('Status') }}</label>
                                    <select class="form-select @error('status') error @enderror" name="status">
                                        <option
                                            value="1" {{ old('status', $shippingMethod->status) == 1 ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option
                                            value="0" {{ old('status', $shippingMethod->status) == 0 ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                    @error('status')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of status -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary me-1">
                {{ isset($shippingMethod->id) ? __('Save') : __('Create') }}
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
        $(document).ready(function () {
            let rules = {
                storeId: {
                    required: true,
                },
                geoZoneId: {
                    required: true
                }
            }

            rules['name'] = {required: true}

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
