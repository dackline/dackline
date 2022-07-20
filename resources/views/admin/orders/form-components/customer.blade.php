<!-- Customer Accordion -->
<div class="accordion-item"  x-data="sectionCustomer()" x-init="sectionCustomerInit()">
    <h2 class="accordion-header" id="headingCustomer">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-customer" aria-expanded="true" aria-controls="accordion-customer">
            {{ __('Customer') }}
        </button>
    </h2>
    <div id="accordion-customer" class="accordion-collapse collapse show" aria-labelledby="headingCustomer" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="row">
                <div class="col-9">
                    <div class="form-group">
                        <label class="form-label" for="select-customer">{{ __('Customer') }}</label>
                        <select class="select2-data-ajax form-select" id="select-customer" x-ref="customer-select"></select>
                        <input type="hidden" name="customerId" x-bind:value="$store.storeCustomers.customer.customerId">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="form-label">&nbsp;</label>
                        <div>
                            <a href="{{ route('admin::customers.create') }}" class="btn btn-primary" target="_blank">{{ __('Add Customer') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row tw-mt-4">
                <div class="col-sm-6">
                    <!-- First Name -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="customerFirstName">{{ __('First Name') }}</label>
                        <input type="text" id="customerFirstName" class="form-control @error('customerFirstName') error @enderror" name="customerFirstName" placeholder="{{ __('First Name') }}" x-model="$store.storeCustomers.customer.firstName"/>
                        @error('customerFirstName')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of First Name -->

                    <!-- Last Name -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="customerLastName">{{ __('Last Name') }}</label>
                        <input type="text" id="customerLastName" class="form-control @error('customerLastName') error @enderror" name="customerLastName" placeholder="{{ __('Last Name') }}" x-model="$store.storeCustomers.customer.lastName"/>
                        @error('customerLastName')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Last Name -->

                    <!-- Email -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="customerEmail">{{ __('Email') }}</label>
                        <input type="text" id="customerEmail" class="form-control @error('customerEmail') error @enderror" name="customerEmail" placeholder="{{ __('Email') }}" x-model="$store.storeCustomers.customer.email"/>
                        @error('customerEmail')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Email -->

                    <!-- Email Invoice -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="customerEmailInvoice">{{ __('Email Invoice') }}</label>
                        <input type="text" id="customerEmailInvoice" class="form-control @error('customerEmailInvoice') error @enderror" name="customerEmailInvoice" placeholder="{{ __('Email Invoice') }}" x-model="$store.storeCustomers.customer.emailInvoice"/>
                        @error('customerEmailInvoice')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Email Invoice -->

                    <!-- Phone -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="customerPhone">{{ __('Phone') }}</label>
                        <input type="text" id="customerPhone" class="form-control @error('customerPhone') error @enderror" name="customerPhone" placeholder="{{ __('Phone') }}" x-model="$store.storeCustomers.customer.phone"/>
                        @error('customerPhone')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Phone -->
                </div>

                <div class="col-sm-6">
                    <!-- Company Name -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="customerCompanyName">{{ __('Company Name') }}</label>
                        <input type="text" id="customerCompanyName" class="form-control @error('customerCompanyName') error @enderror" name="customerCompanyName" placeholder="{{ __('Company Name') }}" x-model="$store.storeCustomers.customer.companyName"/>
                        @error('customerCompanyName')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Company Name -->

                    <!-- Vat Nr -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="customerVatNr">{{ __('Vat Nr') }}</label>
                        <input type="text" id="customerVatNr" class="form-control @error('customerVatNr') error @enderror" name="customerVatNr" placeholder="{{ __('Vat Nr') }}" x-model="$store.storeCustomers.customer.vatNr"/>
                        @error('customerVatNr')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Vat Nr -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Customer Accordion -->
