<div class="row tw-mt-10">
    <div class="offset-sm-8 col-sm-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('Totals') }}</h4>
            </div>
            <div class="card-body">
                <ul class="tw-list-none tw-m-0 tw-p-0">
                    <li class="tw-text-lg tw-mb-2 tw-flex tw-align-middle tw-items-center tw-justify-center">
                        <span class="">{{ __('Sub Total') }} :</span>
                        <span class="tw-font-bold tw-ml-auto" x-text="subTotal"></span>
                    </li>
                    <li class="tw-text-lg tw-mb-2 tw-flex tw-align-middle tw-items-center tw-justify-center">
                        <span class="">{{ __('Shipping') }} :</span>
                        <span class="tw-font-bold tw-ml-auto" x-text="shippingCost"></span>
                    </li>
                    <li class="tw-text-lg tw-mb-2 tw-flex tw-align-middle tw-items-center tw-justify-center">
                        <span class="">{{ __('Tax') }} :</span>
                        <span class="tw-font-bold tw-ml-auto" x-text="taxTotal"></span>
                    </li>
                    <li class="tw-text-lg tw-mb-2 tw-flex tw-align-middle tw-items-center tw-justify-center">
                        <span class="">{{ __('Total') }} :</span>
                        <span class="tw-font-bold tw-ml-auto" x-text="grandTotal"></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
