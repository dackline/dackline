@extends('layouts/contentLayoutMaster')

@section('title', isset($customer->id) ? __('Edit Customer') : __('Create Customer'))

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
    <form id="module-form" class="form form-horizontal" method="POST" action="{{ isset($customer->id) ? route('admin::customers.update', $customer->id) : route('admin::customers.store') }}" x-data="moduleData()" x-init="moduleInit()" x-on:submit="submit()" novalidate>
        @csrf
        @if(isset($customer->id))
            @method('PUT')
        @endif
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <div class="alert-body">{{ __('Please fix the form errors.') }}</div>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('General')  }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- Customer Group -->
                                <div class="col-12 tw-mb-4">
                                    <label class="col-form-label" for="customerGroupId">{{ __('Customer Group') }}</label>
                                    <select id="customerGroupId" name="customerGroupId" class="select2 form-select @error('customerGroupId') error @enderror" placeholder="{{ __('Select Customer Group') }}">
                                        <option value=""></option>
                                        @foreach($customerGroups as $customerGroup)
                                            <option value="{{ $customerGroup->id }}" @selected(old('customerGroupId', $customer->customer_group_id) == $customerGroup->id)>{{ $customerGroup->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('customerGroupId')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of Customer Group -->

                                <!-- First name -->
                                <div class="col-12 tw-mb-4">
                                    <label class="col-form-label" for="firstName">{{ __('First Name') }}</label>
                                    <input type="text" id="firstName" class="form-control @error('firstName') error @enderror" name="firstName" placeholder="{{ __('First Name') }}" value="{{ old('firstName', $customer->first_name) }}"/>
                                    @error('firstName')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of First name -->

                                <!-- Last Name -->
                                <div class="col-12 tw-mb-4">
                                    <label class="col-form-label" for="lastName">{{ __('Last Name') }}</label>
                                    <input type="text" id="lastName" class="form-control @error('lastName') error @enderror" name="lastName" placeholder="{{ __('Last Name') }}" value="{{ old('lastName', $customer->last_name) }}"/>
                                    @error('lastName')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of Last Name -->

                                <!-- Email -->
                                <div class="col-12 tw-mb-4">
                                    <label class="col-form-label" for="email">{{ __('Email') }}</label>
                                    <input type="text" id="email" class="form-control @error('email') error @enderror" name="email" placeholder="{{ __('Email') }}" value="{{ old('email', $customer->email) }}"/>
                                    @error('email')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of Email -->

                                <!-- Email Invoice -->
                                <div class="col-12 tw-mb-4">
                                    <label class="col-form-label" for="emailInvoice">{{ __('Email Invoice') }}</label>
                                    <input type="text" id="emailInvoice" class="form-control @error('emailInvoice') error @enderror" name="emailInvoice" placeholder="{{ __('Email Invoice') }}" value="{{ old('emailInvoice', $customer->email_invoice) }}"/>
                                    @error('emailInvoice')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of Email Invoice -->

                                <!-- Phone -->
                                <div class="col-12 tw-mb-4">
                                    <label class="col-form-label" for="phone">{{ __('Phone') }}</label>
                                    <input type="text" id="phone" class="form-control @error('phone') error @enderror" name="phone" placeholder="{{ __('Phone') }}" value="{{ old('phone', $customer->phone) }}"/>
                                    @error('phone')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of Phone -->
                            </div>

                            <div class="col-sm-6">
                                <!-- Company Name -->
                                <div class="col-12 tw-mb-4">
                                    <label class="col-form-label" for="companyName">{{ __('Company Name') }}</label>
                                    <input type="text" id="companyName" class="form-control @error('companyName') error @enderror" name="companyName" placeholder="{{ __('Company Name') }}" value="{{ old('companyName', $customer->company_name) }}"/>
                                    @error('companyName')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of Company Name -->

                                <!-- Vat Nr -->
                                <div class="col-12 tw-mb-4">
                                    <label class="col-form-label" for="vatNr">{{ __('Vat Nr') }}</label>
                                    <input type="text" id="vatNr" class="form-control @error('vatNr') error @enderror" name="vatNr" placeholder="{{ __('Vat Nr') }}" value="{{ old('vatNr', $customer->vat_nr) }}"/>
                                    @error('vatNr')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of Vat Nr -->

                                <!-- Country -->
                                <div class="col-12 tw-mb-4">
                                    <label class="col-form-label" for="countryId">{{ __('Country') }}</label>
                                    <select id="countryId" name="countryId" class="select2 form-select @error('countryId') error @enderror" placeholder="{{ __('Select Country') }}">
                                        <option value=""></option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" @selected(old('countryId', $customer->country_id) == $country->id)>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('countryId')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of Country -->

                                <!-- Password -->
                                <div class="col-12 tw-mb-4">
                                    <label class="col-form-label" for="password">{{ __('Password') }}</label>
                                    <input type="text" id="password" class="form-control @error('password') error @enderror" name="password" placeholder="{{ __('Password') }}" />
                                    @error('password')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End of Password -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Addresses')  }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="accordion accordion-border">
                            <template x-for="(address, addressIndex) in addresses">
                                <div class="accordion-item">
                                    <h2 class="accordion-header tw-relative" x-bind:id="'headingAddress' + addressIndex">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" x-bind:data-bs-target="'#accordionAddress'+ addressIndex" aria-expanded="false" x-bind:aria-controls="'#accordionAddress'+ addressIndex">
                                            <span x-text="'Address - '+ (addressIndex + 1)"></span>
                                        </button>

                                        <div x-on:click="deleteAddress(addressIndex)" class="btn btn-danger btn-sm tw-absolute tw-right-14 tw-top-3 tw-z-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4 tw-text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m19 7-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v3M4 7h16"/></svg>
                                        </div>
                                    </h2>
                                    <div x-bind:id="'accordionAddress' + addressIndex"  class="accordion-collapse collapse"  x-bind:aria-labelledby="'headingAddress' + addressIndex"  x-bind:data-bs-parent="'accordionAddress' + addressIndex">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <!-- Address Label -->
                                                    <div class="form-group mb-1">
                                                        <label class="form-label" x-bind:for="'addressLabel'+ addressIndex">{{ __('Address Label') }}</label>
                                                        <input type="text" class="form-control" placeholder="{{ __('Address Label') }}"
                                                            x-model="addresses[addressIndex].addressLabel"
                                                            x-bind:name="`addresses[${addressIndex}][addressLabel]`"
                                                            x-bind:id="`addresses[${addressIndex}][addressLabel]`"
                                                            :class="{'error': errors[`addresses.${addressIndex}.addressLabel`] !== undefined}"
                                                        />
                                                        <template x-if="errors[`addresses.${addressIndex}.addressLabel`] !== undefined">
                                                            <span class="error" x-text="errors[`addresses.${addressIndex}.addressLabel`]"></span>
                                                        </template>
                                                    </div>
                                                    <!-- End of Address Label -->

                                                    <!-- First Name -->
                                                    <div class="form-group mb-1">
                                                        <label class="form-label" x-bind:for="'firstName'+ addressIndex">{{ __('First Name') }}</label>
                                                        <input type="text" class="form-control" placeholder="{{ __('First Name') }}"
                                                            x-model="addresses[addressIndex].firstName"
                                                            x-bind:name="`addresses[${addressIndex}][firstName]`"
                                                            x-bind:id="`addresses[${addressIndex}][firstName]`"
                                                            :class="{'error': errors[`addresses.${addressIndex}.firstName`] !== undefined}"
                                                        />
                                                        <template x-if="errors[`addresses.${addressIndex}.firstName`] !== undefined">
                                                            <span class="error" x-text="errors[`addresses.${addressIndex}.firstName`]"></span>
                                                        </template>
                                                    </div>
                                                    <!-- End of First Name -->

                                                    <!-- Last Name -->
                                                    <div class="form-group mb-1">
                                                        <label class="form-label" x-bind:for="'lastName'+ addressIndex">{{ __('Last Name') }}</label>
                                                        <input type="text" class="form-control" placeholder="{{ __('Last Name') }}"
                                                            x-model="addresses[addressIndex].lastName"
                                                            x-bind:name="`addresses[${addressIndex}][lastName]`"
                                                            x-bind:id="`addresses[${addressIndex}][lastName]`"
                                                            :class="{'error': errors[`addresses.${addressIndex}.lastName`] !== undefined}"
                                                        />
                                                        <template x-if="errors[`addresses.${addressIndex}.lastName`] !== undefined">
                                                            <span class="error" x-text="errors[`addresses.${addressIndex}.lastName`]"></span>
                                                        </template>
                                                    </div>
                                                    <!-- End of Last Name -->

                                                    <!-- Company Name -->
                                                    <div class="form-group mb-1">
                                                        <label class="form-label" x-bind:for="'companyName'+ addressIndex">{{ __('Company Name') }}</label>
                                                        <input type="text" class="form-control" placeholder="{{ __('Company Name') }}"
                                                            x-model="addresses[addressIndex].companyName"
                                                            x-bind:name="`addresses[${addressIndex}][companyName]`"
                                                            x-bind:id="`addresses[${addressIndex}][companyName]`"
                                                            :class="{'error': errors[`addresses.${addressIndex}.companyName`] !== undefined}"
                                                        />
                                                        <template x-if="errors[`addresses.${addressIndex}.companyName`] !== undefined">
                                                            <span class="error" x-text="errors[`addresses.${addressIndex}.companyName`]"></span>
                                                        </template>
                                                    </div>
                                                    <!-- End of Company Name -->

                                                    <!-- Phone -->
                                                    <div class="form-group mb-1">
                                                        <label class="form-label" x-bind:for="'phone'+ addressIndex">{{ __('Phone') }}</label>
                                                        <input type="text" class="form-control" placeholder="{{ __('Phone') }}"
                                                            x-model="addresses[addressIndex].phone"
                                                            x-bind:name="`addresses[${addressIndex}][phone]`"
                                                            x-bind:id="`addresses[${addressIndex}][phone]`"
                                                            :class="{'error': errors[`addresses.${addressIndex}.phone`] !== undefined}"
                                                        />
                                                        <template x-if="errors[`addresses.${addressIndex}.phone`] !== undefined">
                                                            <span class="error" x-text="errors[`addresses.${addressIndex}.phone`]"></span>
                                                        </template>
                                                    </div>
                                                    <!-- End of Phone -->

                                                    <!-- Default -->
                                                    <div class="form-group mb-1">
                                                        <label class="form-label" x-bind:for="`addresses[${addressIndex}][default]`">
                                                            {{ __('Default') }}
                                                        </label>
                                                        <div class="form-check form-check-primary form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                               x-model="addresses[addressIndex].default"
                                                               x-bind:name="`addresses[${addressIndex}][default]`"
                                                               x-bind:id="`addresses[${addressIndex}][default]`"
                                                               x-bind:value="addresses[addressIndex].default == true ? 1 : 0"
                                                               x-bind:checked="addresses[addressIndex].default == 1"
                                                            />
                                                        </div>
                                                        <template x-if="errors[`addresses.${addressIndex}.default`] !== undefined">
                                                            <span class="error" x-text="errors[`addresses.${addressIndex}.default`]"></span>
                                                        </template>
                                                    </div>
                                                    <!-- End of Default -->
                                                </div>
                                                <div class="col-sm-6">
                                                    <!-- Address1 -->
                                                    <div class="form-group mb-1">
                                                        <label class="form-label" x-bind:for="'address1'+ addressIndex">{{ __('Address1') }}</label>
                                                        <input type="text" class="form-control" placeholder="{{ __('Address1') }}"
                                                            x-model="addresses[addressIndex].address1"
                                                            x-bind:name="`addresses[${addressIndex}][address1]`"
                                                            x-bind:id="`addresses[${addressIndex}][address1]`"
                                                            :class="{'error': errors[`addresses.${addressIndex}.address1`] !== undefined}"
                                                        />
                                                        <template x-if="errors[`addresses.${addressIndex}.address1`] !== undefined">
                                                            <span class="error" x-text="errors[`addresses.${addressIndex}.address1`]"></span>
                                                        </template>
                                                    </div>
                                                    <!-- End of Address1 -->

                                                    <!-- Address2 -->
                                                    <div class="form-group mb-1">
                                                        <label class="form-label" x-bind:for="'address2'+ addressIndex">{{ __('Address2') }}</label>
                                                        <input type="text" class="form-control" placeholder="{{ __('Address2') }}"
                                                            x-model="addresses[addressIndex].address2"
                                                            x-bind:name="`addresses[${addressIndex}][address2]`"
                                                            x-bind:id="`addresses[${addressIndex}][address2]`"
                                                            :class="{'error': errors[`addresses.${addressIndex}.address2`] !== undefined}"
                                                        />
                                                        <template x-if="errors[`addresses.${addressIndex}.address2`] !== undefined">
                                                            <span class="error" x-text="errors[`addresses.${addressIndex}.address2`]"></span>
                                                        </template>
                                                    </div>
                                                    <!-- End of Address2 -->

                                                    <!-- City -->
                                                    <div class="form-group mb-1">
                                                        <label class="form-label" x-bind:for="'city'+ addressIndex">{{ __('City') }}</label>
                                                        <input type="text" class="form-control" placeholder="{{ __('City') }}"
                                                            x-model="addresses[addressIndex].city"
                                                            x-bind:name="`addresses[${addressIndex}][city]`"
                                                            x-bind:id="`addresses[${addressIndex}][city]`"
                                                            :class="{'error': errors[`addresses.${addressIndex}.city`] !== undefined}"
                                                        />
                                                        <template x-if="errors[`addresses.${addressIndex}.city`] !== undefined">
                                                            <span class="error" x-text="errors[`addresses.${addressIndex}.city`]"></span>
                                                        </template>
                                                    </div>
                                                    <!-- End of City -->

                                                    <!-- Zipcode -->
                                                    <div class="form-group mb-1">
                                                        <label class="form-label" x-bind:for="'zipcode'+ addressIndex">{{ __('Zipcode') }}</label>
                                                        <input type="text" class="form-control" placeholder="{{ __('Zipcode') }}"
                                                            x-model="addresses[addressIndex].zipcode"
                                                            x-bind:name="`addresses[${addressIndex}][zipcode]`"
                                                            x-bind:id="`addresses[${addressIndex}][zipcode]`"
                                                            :class="{'error': errors[`addresses.${addressIndex}.zipcode`] !== undefined}"
                                                        />
                                                        <template x-if="errors[`addresses.${addressIndex}.zipcode`] !== undefined">
                                                            <span class="error" x-text="errors[`addresses.${addressIndex}.zipcode`]"></span>
                                                        </template>
                                                    </div>
                                                    <!-- End of Zipcode -->

                                                    <!-- Country -->
                                                    <div class="form-group mb-1">
                                                        <label class="form-label" x-bind:for="'countryId'+ addressIndex">{{ __('Country') }}</label>
                                                        <select class="form-control"
                                                            x-model="addresses[addressIndex].countryId"
                                                            x-bind:name="`addresses[${addressIndex}][countryId]`"
                                                            x-bind:id="`addresses[${addressIndex}][countryId]`"
                                                            :class="{'error': errors[`addresses.${addressIndex}.countryId`] !== undefined}"
                                                        >
                                                            <option value="">{{ __('Select Country') }}</option>
                                                            <template x-for="country in countries">
                                                                <option x-bind:value="country.id" x-bind:selected="addresses[addressIndex].countryId == country.id">
                                                                    <span x-text="country.name"></span>
                                                                </option>
                                                            </template>
                                                        </select>
                                                        <template x-if="errors[`addresses.${addressIndex}.countryId`] !== undefined">
                                                            <span class="error" x-text="errors[`addresses.${addressIndex}.countryId`]"></span>
                                                        </template>
                                                    </div>
                                                    <!-- End of Country -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="tw-my-4 tw-flex tw-justify-center">
                            <button type="button" class="btn btn-secondary" x-on:click="addAddress()">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                </span>
                                <span>{{ __('Add Address') }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary me-1">
            {{ isset($customer->id) ? __('Save') : __('Create') }}
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
        rules: {
            'customerGroupId': {
                required: true
            },
            'firstName': {
                required: true
            },
            'lastName': {
                required: true
            },
            'email': {
                required: true,
                email: true,
            },
            'emailInvoice': {
                email: true,
            },
            'countryId': {
                required: true
            },
        }
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

<script>
function moduleData(){
    return {
        addresses: JSON.parse(`@json(old('addresses', $addresses))`),
        errors: JSON.parse(`@json($errors->getMessages())`),
        countries: JSON.parse(`@json($countries)`),
        moduleInit(){
        },
        submit(){
        },
        addAddress() {
            this.addresses.push({
                addressLabel: '',
                firstName: '',
                lastName: '',
                companyName: '',
                phone: '',
                address1: '',
                address2: '',
                city: '',
                zipcode: '',
                countryId: '',
                default: 0,
            })
        },
        deleteAddress(index) {
            if(!confirm("{{ __('Are you sure to delete?') }}")) {
                return;
            }

            this.addresses.splice(index, 1)
        }
    }
}
</script>
@endsection
