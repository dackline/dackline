@extends('layouts/contentLayoutMaster')

@section('title', isset($order->id) ? __('Edit Order') : __('Create Order'))

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
    <style>
        .table-products td {
            padding: 0.75rem 0.2rem;
        }
    </style>
@endsection

@section('content')
    <!-- Basic Horizontal form layout section start -->
    <section>
        <form id="module-form" class="form form-horizontal" method="POST"
                action="{{ isset($order->id) ? route('admin::orders.update', $order->id) : route('admin::orders.store') }}"
                x-data="moduleData()" x-init="moduleInit()" x-on:submit="submit()" novalidate>
            @csrf
            @if(isset($order->id))
                @method('PUT')
            @endif
            <div class="row">
                <div class="col-md-12">
                    @include('admin.orders.form-components.sidebar')
                    <div class="accordion accordion-margin" id="accordionExample" data-toggle-hover="true">
                        @include('admin.orders.form-components.customer')
                        @include('admin.orders.form-components.shipping')
                        @include('admin.orders.form-components.payment')
                    </div>
                    @include('admin.orders.form-components.products')
                    @include('admin.orders.form-components.totals')
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                {{ isset($order->id) ? __('Save Order') : __('Create Order') }}
            </button>
        </form>
        @if(isset($order->id))
            <div class="mt-4">
                <livewire:admin.orders.order-history :orderId="$order->id"/>
            </div>

        @endif
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
            let rules = {}

            rules['name'] = {required: true}

            $('#module-form').validate({
                ignore: ".ignore",
                rules: rules
            });
        });
    </script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('storeOrderSidebar', {
                shippingMethod: "{{ old('shippingMethodId', $order->shipping_method_id) }}",
                paymentMethod: "{{ old('paymentMethodId', $order->payment_method_id) }}",
                assignee: "{{ old('assigneeId', $order->assignee_id) }}",
                orderStatus: "{{ old('orderStatusId', $order->order_status_id) }}",
            })

            Alpine.store('storeCustomers', {
                customers: [],
                customerOption: null,
                customer: {
                    customerId: "{{ old('customerId', $order->customer_id) }}",
                    firstName: "{{ old('customerFirstName', $order->firstname) }}",
                    lastName: "{{ old('customerLastName', $order->lastname) }}",
                    email: "{{ old('customerEmail', $order->email) }}",
                    emailInvoice: "{{ old('customerEmailInvoice', $order->email_invoice) }}",
                    phone: "{{ old('customerPhone', $order->phone) }}",
                    companyName: "{{ old('customerCompanyName', $order->company) }}",
                    vatNr: "{{ old('customerVatNr', $order->vat_nr) }}",
                    addresses: "{{ old('customerAddresses', optional($order->customer)->addresses) }}",
                },
            })

            Alpine.store('storeShippingAddress', {
                addresses: [],
                addressOption: null,
                shipping: {
                    firstName: "{{ old('shippingFirstName', $order->shipping_firstname) }}",
                    lastName: "{{ old('shippingLastName', $order->shipping_lastname) }}",
                    companyName: "{{ old('shippingCompanyName', $order->shipping_company) }}",
                    phone: "{{ old('shippingPhone', $order->shipping_phone) }}",
                    countryId: "{{ old('shippingCountryId', $order->shipping_country_id) }}",
                    address1: "{{ old('shippingAddress1', $order->shipping_address_1) }}",
                    address2: "{{ old('shippingAddress2', $order->shipping_address_2) }}",
                    city: "{{ old('shippingCity', $order->shipping_city) }}",
                    zipcode: "{{ old('shippingZipcode', $order->shipping_zipcode) }}",
                },
            })

            Alpine.store('storePaymentAddress', {
                addresses: [],
                addressOption: null,
                payment: {
                    firstName: "{{ old('paymentFirstName', $order->payment_firstname) }}",
                    lastName: "{{ old('paymentLastName', $order->payment_lastname) }}",
                    companyName: "{{ old('paymentCompanyName', $order->payment_company) }}",
                    phone: "{{ old('paymentPhone', $order->payment_phone) }}",
                    countryId: "{{ old('paymentCountryId', $order->payment_country_id) }}",
                    address1: "{{ old('paymentAddress1', $order->payment_address_1) }}",
                    address2: "{{ old('paymentAddress2', $order->payment_address_2) }}",
                    city: "{{ old('paymentCity', $order->payment_city) }}",
                    zipcode: "{{ old('paymentZipcode', $order->payment_zipcode) }}",
                },
            })

            Alpine.store('storeProducts', {
                items: @json($products),
            })
        })
    </script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        function moduleData() {
            return {
                moduleInit() {
                },
                submit() {
                },
                get subTotal() {
                    let decimals = 2
                    let products = this.$store.storeProducts.items

                    let total = products.reduce((total, _) => parseFloat(total) + parseFloat(_.total), 0)

                    return Number(Math.round(total + 'e' + decimals) + 'e-' + decimals).toFixed(decimals);
                },
                get shippingCost() {
                    let decimals = 2
                    let shippingMethods = JSON.parse(`@json($shippingMethods)`)
                    let shippingMethod = this.$store.storeOrderSidebar.shippingMethod
                    shippingMethod = shippingMethods.find(_ => _.id == shippingMethod)

                    let cost = 0
                    if(shippingMethod && shippingMethod.id != 0) {
                        cost = parseFloat(shippingMethod.cost)
                    }

                    return Number(Math.round(cost + 'e' + decimals) + 'e-' + decimals).toFixed(decimals);
                },
                get taxTotal() {
                    let decimals = 2
                    let products = this.$store.storeProducts.items

                    let total = products.reduce((total, _) => parseFloat(total) + parseFloat(_.tax), 0)

                    return Number(Math.round(total + 'e' + decimals) + 'e-' + decimals).toFixed(decimals);
                },
                get grandTotal() {
                    let decimals = 2
                    let total = parseFloat(this.subTotal) + parseFloat(this.taxTotal) + parseFloat(this.shippingCost)
                    return Number(Math.round(total + 'e' + decimals) + 'e-' + decimals).toFixed(decimals);
                }
            }
        }

        function sectionCustomer() {
            return {
                sectionCustomerInit() {
                    this.initCustomerSelect()

                    // update customer value in store from selected customer option
                    this.$watch('$store.storeCustomers.customerOption', value => {
                        if(value) {
                            let customerId = value.id
                            let customer = this.$store.storeCustomers.customers.find(customer => customer.id == customerId)

                            if(customer) {
                                this.$store.storeCustomers.customer.customerId = customerId
                                this.$store.storeCustomers.customer.firstName = customer.first_name
                                this.$store.storeCustomers.customer.lastName = customer.last_name
                                this.$store.storeCustomers.customer.email = customer.email
                                this.$store.storeCustomers.customer.emailInvoice = customer.email_invoice
                                this.$store.storeCustomers.customer.phone = customer.phone
                                this.$store.storeCustomers.customer.companyName = customer.company_name
                                this.$store.storeCustomers.customer.vatNr = customer.vat_nr
                                this.$store.storeCustomers.customer.addresses = customer.addresses
                                this.$store.storeShippingAddress.addresses = customer.addresses
                                this.$store.storePaymentAddress.addresses = customer.addresses
                            }

                            if(!customer) {
                                this.$store.storeCustomers.customer.customerId = ''
                                this.$store.storeCustomers.customer.firstName = ''
                                this.$store.storeCustomers.customer.lastName = ''
                                this.$store.storeCustomers.customer.email = ''
                                this.$store.storeCustomers.customer.emailInvoice = ''
                                this.$store.storeCustomers.customer.phone = ''
                                this.$store.storeCustomers.customer.companyName = ''
                                this.$store.storeCustomers.customer.vatNr = ''
                                this.$store.storeCustomers.customer.addresses = []
                            }
                        }
                    })
                },
                initCustomerSelect() {
                    let customerSelect = this.$refs['customer-select']
                    this.$nextTick(() => {
                        $(document).ready(() => {
                            $(customerSelect).wrap('<div class="position-relative"></div>');
                            $(customerSelect).select2({
                                dropdownAutoWidth: true,
                                dropdownParent: $(customerSelect).parent(),
                                width: '100%',
                                ajax: {
                                    url: "{{ route('api::search.customers') }}",
                                    type: 'POST',
                                    dataType: 'json',
                                    delay: 250,
                                    data: function (params) {
                                        return {
                                            query: params.term,
                                            page: params.page,
                                            _token: CSRF_TOKEN,
                                        };
                                    },
                                    processResults: (response, params) => {
                                        this.$store.storeCustomers.customers = response.data

                                        let results = response.data.map(item => ({
                                            id: item.id,
                                            text: item.full_name,
                                        }))

                                        return {
                                            results: results
                                        }
                                    },
                                },
                                placeholder: "{{ __('Search Customer') }}",
                                minimumInputLength: 1,
                            });
                            $(customerSelect).on("change", (e) => {
                                let selections = $(customerSelect).select2('data')
                                if(selections.length > 0)
                                    this.$store.storeCustomers.customerOption = selections[0]
                            });
                        })
                    })
                }
            }
        }

        function sectionShipping() {
            return {
                sectionShippingInit() {
                    // update address value in store from selected address option
                    this.$watch('$store.storeShippingAddress.addressOption', value => {
                        if(value) {
                            let addressId = value
                            let address = this.$store.storeShippingAddress.addresses.find(address => address.id == addressId)

                            if(address) {
                                this.$store.storeShippingAddress.shipping.firstName = address.first_name
                                this.$store.storeShippingAddress.shipping.lastName = address.last_name
                                this.$store.storeShippingAddress.shipping.companyName = address.company_name
                                this.$store.storeShippingAddress.shipping.phone = address.phone
                                this.$store.storeShippingAddress.shipping.countryId = address.country_id
                                this.$store.storeShippingAddress.shipping.address1 = address.address_1
                                this.$store.storeShippingAddress.shipping.address2 = address.address_2
                                this.$store.storeShippingAddress.shipping.city = address.city
                                this.$store.storeShippingAddress.shipping.zipcode = address.zipcode

                                // update country id in select2
                                $(this.$refs['select-shipping-country']).val(address.country_id).trigger('change')
                            }

                            if(!address) {
                                this.$store.storeShippingAddress.shipping.firstName = ''
                                this.$store.storeShippingAddress.shipping.lastName = ''
                                this.$store.storeShippingAddress.shipping.companyName = ''
                                this.$store.storeShippingAddress.shipping.phone = ''
                                this.$store.storeShippingAddress.shipping.countryId = ''
                                this.$store.storeShippingAddress.shipping.address1 = ''
                                this.$store.storeShippingAddress.shipping.address2 = ''
                                this.$store.storeShippingAddress.shipping.city = ''
                                this.$store.storeShippingAddress.shipping.zipcode = ''
                            }
                        }
                    })
                }
            }
        }

        function sectionPayment() {
            return {
                sectionPaymentInit() {
                    // update address value in store from selected address option
                    this.$watch('$store.storePaymentAddress.addressOption', value => {
                        if(value) {
                            let addressId = value
                            let address = this.$store.storePaymentAddress.addresses.find(address => address.id == addressId)

                            if(address) {
                                this.$store.storePaymentAddress.payment.firstName = address.first_name
                                this.$store.storePaymentAddress.payment.lastName = address.last_name
                                this.$store.storePaymentAddress.payment.companyName = address.company_name
                                this.$store.storePaymentAddress.payment.phone = address.phone
                                this.$store.storePaymentAddress.payment.countryId = address.country_id
                                this.$store.storePaymentAddress.payment.address1 = address.address_1
                                this.$store.storePaymentAddress.payment.address2 = address.address_2
                                this.$store.storePaymentAddress.payment.city = address.city
                                this.$store.storePaymentAddress.payment.zipcode = address.zipcode

                                // update country id in select2
                                $(this.$refs['select-payment-country']).val(address.country_id).trigger('change')
                            }

                            if(!address) {
                                this.$store.storePaymentAddress.payment.firstName = ''
                                this.$store.storePaymentAddress.payment.lastName = ''
                                this.$store.storePaymentAddress.payment.companyName = ''
                                this.$store.storePaymentAddress.payment.phone = ''
                                this.$store.storePaymentAddress.payment.countryId = ''
                                this.$store.storePaymentAddress.payment.address1 = ''
                                this.$store.storePaymentAddress.payment.address2 = ''
                                this.$store.storePaymentAddress.payment.city = ''
                                this.$store.storePaymentAddress.payment.zipcode = ''
                            }
                        }
                    })
                }
            }
        }

        function sectionProducts() {
            return {
                sectionProductsInit() {
                    // init sortable
                    Sortable.create(this.$refs['body'], {
                        animation: 150,
                        ghostClass: 'tw-bg-red-500',
                        handle: '.drag-handle'
                    });
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
                addProduct() {
                    this.$store.storeProducts.items.push({
                        uniqueId: this.getUniqueId(),
                        id: '',
                        name: '',
                        quantity: 1,
                        price: 0,
                        total: 0,
                        discount: 0,
                        discountPercent: 0,
                        tax: 0,
                        product: null,
                    })
                },
                copyProduct(index) {
                    let clone = _.cloneDeep(this.$store.storeProducts.items[index])
                    clone.uniqueId = this.getUniqueId()

                    this.$store.storeProducts.items.splice(index + 1, 0, clone)
                },
                deleteProduct(index) {
                    this.$store.storeProducts.items.splice(index, 1)
                },
            }
        }

        document.addEventListener('alpine:init', () => {
            Alpine.data('productItemRow', (product) => ({
                products: [], // for storing search result
                init() {
                    this.$nextTick(() => {
                        this.initSelect2()
                    })
                    this.$watch('product.product', value => {
                        if(value) {
                            this.product.name = this.product.product.product_name
                            this.product.price = this.product.product.price
                        }
                        this.calculateTotal()
                    })
                    this.$watch('product.quantity', value => {
                        this.calculateTotal()
                    })
                    this.$watch('product.price', value => {
                        this.calculateTotal()
                    })
                    this.$watch('product.discount', value => {
                        this.calculateTotal()
                    })
                    this.$watch('product.discountPercent', value => {
                        this.calculateDiscount()
                    })

                    this.calculateTotal()
                },
                initSelect2() {
                    let select = $(this.$refs['product-select'])

                    // for clone product select default value
                    if(this.product.product) {
                        $(select).append($('<option>').val(this.product.product.id).text(this.product.product.product_name));
                    }

                    $(select).wrap('<div class="position-relative"></div>');
                    $(select).select2({
                        dropdownAutoWidth: true,
                        dropdownParent: $(select).parent(),
                        width: '100%',
                        ajax: {
                            url: "{{ route('api::search.products') }}",
                            type: 'POST',
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    query: params.term,
                                    page: params.page,
                                    _token: CSRF_TOKEN,
                                };
                            },
                            processResults: (response, params) => {
                                this.products = response.data
                                let results = response.data.map(item => ({
                                    id: item.id,
                                    text: item.product_name,
                                }))

                                return {
                                    results: results
                                }
                            },
                        },
                        placeholder: "{{ __('Search Product') }}",
                        minimumInputLength: 1,
                    });
                    $(select).on("change", (e) => {
                        let selections = $(select).select2('data')
                        if(selections.length > 0) {
                            this.product.product = this.products.find(_ => _.id == selections[0].id)
                        }
                    });
                },
                calculateTotal() {
                    let total = 0
                    let decimals = 2
                    let price = parseFloat(this.product.price)
                    let quantity = parseFloat(this.product.quantity)
                    let discount = parseFloat(this.product.discount)
                    total = (price * quantity) - discount
                    let tax = 0
                    if(this.product.tax) {
                        tax = parseFloat(this.product.tax)
                    } else if(this.product.product) {
                        tax = this.product.product.tax ?
                            (
                                this.product.product.tax.type == 'percentage'
                                ? total * (parseInt(this.product.product.tax.tax_rate) / 100)
                                : parseFloat(this.product.product.tax.tax_rate)
                            )
                            : 0;
                    }

                    this.product.tax = Number(Math.round(tax + 'e' + decimals) + 'e-' + decimals).toFixed(decimals);
                    this.product.total = Number(Math.round(total + 'e' + decimals) + 'e-' + decimals).toFixed(decimals);
                },
                calculateDiscount() {
                    let decimals = 2
                    let discountPercent = parseInt(this.product.discountPercent)
                    let price = parseFloat(this.product.price) * parseInt(this.product.quantity)
                    let discount = price * (discountPercent / 100)
                    this.product.discount = Number(Math.round(discount + 'e' + decimals) + 'e-' + decimals).toFixed(decimals);
                },
            }))
        })
    </script>
@endsection

@pushOnce('custom-scripts')
<script src="{{ asset(mix('js/select2-component.js')) }}"></script>
@endPushOnce
