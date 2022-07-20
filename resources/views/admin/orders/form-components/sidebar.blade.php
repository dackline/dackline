<div class="card tw-mt-3">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3">
                <!-- Shipping Method -->
                <div class="form-group tw-mb-2">
                    <label for="select-shipping-method" class="col-form-label">{{ __('Shipping Method') }}</label>
                    <select class="form-select @error('shippingMethodId') error @enderror" name="shippingMethodId" id="shippingMethodId"
                        x-ref="select"
                        x-model="$store.storeOrderSidebar.shippingMethod"
                        x-bind:data-options='`@json($shippingMethods)`'
                        x-data='select2Component(`{{ __('Shipping Method') }}`)'
                    ></select>
                    @error('shippingMethodId')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- End of Shipping Method -->
            </div>
            <div class="col-sm-3">
                <!-- Payment Method -->
                <div class="form-group tw-mb-2">
                    <label for="select-payment-method" class="col-form-label">{{ __('Payment Method') }}</label>
                    <select class="form-select @error('paymentMethodId') error @enderror" name="paymentMethodId" id="paymentMethodId"
                        x-ref="select"
                        x-model="$store.storeOrderSidebar.paymentMethod"
                        x-bind:data-options='`@json($paymentMethods)`'
                        x-data='select2Component(`{{ __('Payment Method') }}`)'
                    ></select>
                    @error('paymentMethodId')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- End of Payment Method -->
            </div>

            <div class="col-sm-3">
                <!-- Assignee -->
                <div class="form-group tw-mb-2">
                    <label for="select-order-assignee" class="col-form-label">{{ __('Assignee') }}</label>
                    <select class="form-select @error('assigneeId') error @enderror" name="assigneeId" id="assigneeId"
                        x-ref="select"
                        x-model="$store.storeOrderSidebar.assignee"
                        x-bind:data-options='`@json($adminUsers)`'
                        x-data='select2Component(`{{ __('Assignee') }}`)'
                    ></select>
                    @error('assigneeId')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- End of Assignee -->
            </div>

            <div class="col-sm-3">
                <!-- Order Status -->
                <div class="form-group tw-mb-2">
                    <label for="select-order-status" class="col-form-label">{{ __('Order Status') }}</label>
                    <select class="form-select @error('orderStatusId') error @enderror" name="orderStatusId" id="orderStatusId"
                        x-data='select2Component(`{{ __('Order Status') }}`)'
                        x-ref="select"
                        x-bind:data-options='`@json($orderStatuses)`'
                        x-model="$store.storeOrderSidebar.orderStatus"
                    ></select>
                    @error('orderStatusId')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <!-- End of Order Status -->
            </div>
        </div>
    </div>
</div>
