<!-- Shipping Accordion -->
<div class="accordion-item"  x-data="sectionShipping()" x-init="sectionShippingInit()">
    <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-shipping" aria-expanded="true" aria-controls="accordion-shipping">
            {{ __('Shipping') }}
        </button>
    </h2>
    <div id="accordion-shipping" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="select-shipping-address">{{ __('Shipping Address') }}</label>
                        <select class="form-select @error('shippingAddressId') error @enderror" name="shippingAddressId" id="shippingAddressId"
                            x-ref="select"
                            x-model="$store.storeShippingAddress.addressOption"
                            x-bind:data-options="JSON.stringify($store.storeShippingAddress.addresses.map(_ => ({ id: _.id, name: _.address_label })))"
                            x-data='select2Component(`{{ __('Select Address') }}`)'
                        ></select>
                    </div>
                </div>
            </div>
            <div class="row tw-mt-4">
                <div class="col-sm-6">
                    <!-- First Name -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="shippingFirstName">{{ __('First Name') }}</label>
                        <input type="text" id="shippingFirstName" class="form-control @error('shippingFirstName') error @enderror" name="shippingFirstName" placeholder="{{ __('First Name') }}" x-model="$store.storeShippingAddress.shipping.firstName"/>
                        @error('shippingFirstName')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of First Name -->

                    <!-- Last Name -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="shippingLastName">{{ __('Last Name') }}</label>
                        <input type="text" id="shippingLastName" class="form-control @error('shippingLastName') error @enderror" name="shippingLastName" placeholder="{{ __('Last Name') }}" x-model="$store.storeShippingAddress.shipping.lastName"/>
                        @error('shippingLastName')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Last Name -->

                    <!-- Company Name -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="shippingCompanyName">{{ __('Company Name') }}</label>
                        <input type="text" id="shippingCompanyName" class="form-control @error('shippingCompanyName') error @enderror" name="shippingCompanyName" placeholder="{{ __('Company Name') }}" x-model="$store.storeShippingAddress.shipping.companyName"/>
                        @error('shippingCompanyName')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Company Name -->

                    <!-- Phone -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="shippingPhone">{{ __('Phone') }}</label>
                        <input type="text" id="shippingPhone" class="form-control @error('shippingPhone') error @enderror" name="shippingPhone" placeholder="{{ __('Phone') }}" x-model="$store.storeShippingAddress.shipping.phone"/>
                        @error('shippingPhone')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Phone -->

                    <!-- Country -->
                    <div class="form-group tw-mb-2">
                        <label class="form-label" for="shippingCountryId">{{ __('Country') }}</label>
                        <select class="select2 form-select @error('shippingCountryId') error @enderror" name="shippingCountryId" x-ref="select-shipping-country" x-model="$store.storeShippingAddress.shipping.countryId">
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('shippingCountryId')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Country -->
                </div>

                <div class="col-sm-6">
                    <!-- Address 1 -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="shippingAddress1">{{ __('Address 1') }}</label>
                        <input type="text" id="shippingAddress1" class="form-control @error('shippingAddress1') error @enderror" name="shippingAddress1" placeholder="{{ __('Address 1') }}" x-model="$store.storeShippingAddress.shipping.address1"/>
                        @error('shippingAddress1')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Address 1 -->

                    <!-- Address 2 -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="shippingAddress2">{{ __('Address 2') }}</label>
                        <input type="text" id="shippingAddress2" class="form-control @error('shippingAddress2') error @enderror" name="shippingAddress2" placeholder="{{ __('Address 2') }}" x-model="$store.storeShippingAddress.shipping.address2"/>
                        @error('shippingAddress2')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Address 2 -->

                    <!-- City -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="shippingCity">{{ __('City') }}</label>
                        <input type="text" id="shippingCity" class="form-control @error('shippingCity') error @enderror" name="shippingCity" placeholder="{{ __('City') }}" x-model="$store.storeShippingAddress.shipping.city"/>
                        @error('shippingCity')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of City -->

                    <!-- Zip Code -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="shippingZipcode">{{ __('Zip Code') }}</label>
                        <input type="text" id="shippingZipcode" class="form-control @error('shippingZipcode') error @enderror" name="shippingZipcode" placeholder="{{ __('Zip Code') }}" x-model="$store.storeShippingAddress.shipping.zipcode"/>
                        @error('shippingZipcode')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Zip Code -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Shipping Accordion -->
