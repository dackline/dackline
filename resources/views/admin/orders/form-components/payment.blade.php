<!-- Payment Accordion -->
<div class="accordion-item" x-data="sectionPayment()" x-init="sectionPaymentInit()">
    <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-payment" aria-expanded="true" aria-controls="accordion-payment">
            {{ __('Payment') }}
        </button>
    </h2>
    <div id="accordion-payment" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="select-payment-address">{{ __('Payment Address') }}</label>
                        <select class="form-select @error('paymentAddressId') error @enderror" name="paymentAddressId" id="paymentAddressId"
                            x-ref="select"
                            x-model="$store.storePaymentAddress.addressOption"
                            x-bind:data-options="JSON.stringify($store.storePaymentAddress.addresses.map(_ => ({ id: _.id, name: _.address_label })))"
                            x-data='select2Component(`{{ __('Select Address') }}`)'
                        ></select>
                    </div>
                </div>
            </div>
            <div class="row tw-mt-4">
                <div class="col-sm-6">
                    <!-- First Name -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="paymentFirstName">{{ __('First Name') }}</label>
                        <input type="text" id="paymentFirstName" class="form-control @error('paymentFirstName') error @enderror" name="paymentFirstName" placeholder="{{ __('First Name') }}" x-model="$store.storePaymentAddress.payment.firstName"/>
                        @error('paymentFirstName')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of First Name -->

                    <!-- Last Name -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="paymentLastName">{{ __('Last Name') }}</label>
                        <input type="text" id="paymentLastName" class="form-control @error('paymentLastName') error @enderror" name="paymentLastName" placeholder="{{ __('Last Name') }}" x-model="$store.storePaymentAddress.payment.lastName"/>
                        @error('paymentLastName')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Last Name -->

                    <!-- Company Name -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="paymentCompanyName">{{ __('Company Name') }}</label>
                        <input type="text" id="paymentCompanyName" class="form-control @error('paymentCompanyName') error @enderror" name="paymentCompanyName" placeholder="{{ __('Company Name') }}" x-model="$store.storePaymentAddress.payment.companyName"/>
                        @error('paymentCompanyName')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Company Name -->

                    <!-- Phone -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="paymentPhone">{{ __('Phone') }}</label>
                        <input type="text" id="paymentPhone" class="form-control @error('paymentPhone') error @enderror" name="paymentPhone" placeholder="{{ __('Phone') }}" x-model="$store.storePaymentAddress.payment.phone"/>
                        @error('paymentPhone')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Phone -->

                    <!-- Country -->
                    <div class="form-group tw-mb-2">
                        <label class="form-label" for="paymentCountryId">{{ __('Country') }}</label>
                        <select class="select2 form-select @error('paymentCountryId') error @enderror" name="paymentCountryId" x-ref="select-payment-country" x-model="$store.storePaymentAddress.payment.countryId">
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('paymentCountryId')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Country -->
                </div>

                <div class="col-sm-6">
                    <!-- Address 1 -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="paymentAddress1">{{ __('Address 1') }}</label>
                        <input type="text" id="paymentAddress1" class="form-control @error('paymentAddress1') error @enderror" name="paymentAddress1" placeholder="{{ __('Address 1') }}" x-model="$store.storePaymentAddress.payment.address1"/>
                        @error('paymentAddress1')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Address 1 -->

                    <!-- Address 2 -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="paymentAddress2">{{ __('Address 2') }}</label>
                        <input type="text" id="paymentAddress2" class="form-control @error('paymentAddress2') error @enderror" name="paymentAddress2" placeholder="{{ __('Address 2') }}" x-model="$store.storePaymentAddress.payment.address2"/>
                        @error('paymentAddress2')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Address 2 -->

                    <!-- City -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="paymentCity">{{ __('City') }}</label>
                        <input type="text" id="paymentCity" class="form-control @error('paymentCity') error @enderror" name="paymentCity" placeholder="{{ __('City') }}" x-model="$store.storePaymentAddress.payment.city"/>
                        @error('paymentCity')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of City -->

                    <!-- Zip Code -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="paymentZipcode">{{ __('Zip Code') }}</label>
                        <input type="text" id="paymentZipcode" class="form-control @error('paymentZipcode') error @enderror" name="paymentZipcode" placeholder="{{ __('Zip Code') }}" x-model="$store.storePaymentAddress.payment.zipcode"/>
                        @error('paymentZipcode')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Zip Code -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Payment Accordion -->
