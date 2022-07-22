@php
    $configData = Helper::applClasses();
@endphp
<div class="tw-mt-4" x-data="sectionProducts()" x-init="sectionProductsInit()">
    <table class="table-products table table-responsive tw-table-fixed tw-min-w-full">
        <col style="width: 3%">
        <col style="width: 20%">
        <col style="width: 17%">
        <col style="width: 5%">
        <col style="width: 10%">
        <col style="width: 5%">
        <col style="width: 10%">
        <col style="width: 10%">
        <col style="width: 10%">
        <col style="width: 10%">
        <thead>
            <tr>
                <th></th>
                <th>{{ __('Product ID') }}</th>
                <th>{{ __('Name') }}</th>
                <th class="tw-text-right">{{ __('Qty') }}</th>
                <th class="tw-text-right">{{ __('Price') }}</th>
                <th class="tw-text-right">{{ __('(%)') }}</th>
                <th class="tw-text-right">{{ __('Discount') }}</th>
                <th class="tw-text-right">{{ __('Tax') }}</th>
                <th class="tw-text-right">{{ __('Total') }}</th>
                <th class="tw-text-right">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody x-ref="body">
            <template
                x-for="(product, productIndex) in $store.storeProducts.items"
                x-bind:key="`${product.uniqueId}-${productIndex}`"
            >
                <tr x-data="productItemRow(product)">
                    <td>
                        <span class="drag-handle tw-cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="tw-w-6 tw-h-6 {{ $configData['theme'] === 'light' ? 'tw-fill-black' : 'tw-fill-white' }}" fill="none" viewBox="0 0 48 48"><path d="M17.5 40q-1.45 0-2.475-1.025Q14 37.95 14 36.5q0-1.45 1.025-2.475Q16.05 33 17.5 33q1.45 0 2.475 1.025Q21 35.05 21 36.5q0 1.45-1.025 2.475Q18.95 40 17.5 40Zm13 0q-1.45 0-2.475-1.025Q27 37.95 27 36.5q0-1.45 1.025-2.475Q29.05 33 30.5 33q1.45 0 2.475 1.025Q34 35.05 34 36.5q0 1.45-1.025 2.475Q31.95 40 30.5 40Zm-13-12.5q-1.45 0-2.475-1.025Q14 25.45 14 24q0-1.45 1.025-2.475Q16.05 20.5 17.5 20.5q1.45 0 2.475 1.025Q21 22.55 21 24q0 1.45-1.025 2.475Q18.95 27.5 17.5 27.5Zm13 0q-1.45 0-2.475-1.025Q27 25.45 27 24q0-1.45 1.025-2.475Q29.05 20.5 30.5 20.5q1.45 0 2.475 1.025Q34 22.55 34 24q0 1.45-1.025 2.475Q31.95 27.5 30.5 27.5ZM17.5 15q-1.45 0-2.475-1.025Q14 12.95 14 11.5q0-1.45 1.025-2.475Q16.05 8 17.5 8q1.45 0 2.475 1.025Q21 10.05 21 11.5q0 1.45-1.025 2.475Q18.95 15 17.5 15Zm13 0q-1.45 0-2.475-1.025Q27 12.95 27 11.5q0-1.45 1.025-2.475Q29.05 8 30.5 8q1.45 0 2.475 1.025Q34 10.05 34 11.5q0 1.45-1.025 2.475Q31.95 15 30.5 15Z"/></svg>
                        </span>
                    </td>
                    <td>
                        <div class="form-group">
                            <select class="select2 form-select" x-ref="product-select"></select>
                            <input type="hidden" x-bind:name="`products[${productIndex}][productId]`" x-bind:value="product.product ? product.product.id : ''">
                        </div>
                    </td>
                    <td>
                        <input type="text" x-bind:name="`products[${productIndex}][name]`" class="form-control" placeholder="{{ __('Name') }}" x-model="product.name">
                    </td>
                    <td>
                        <input type="number" x-bind:name="`products[${productIndex}][quantity]`" class="form-control tw-text-right" placeholder="{{ __('Quantity') }}" x-model="product.quantity">
                    </td>
                    <td>
                        <input type="text" x-bind:name="`products[${productIndex}][price]`" class="form-control tw-text-right" placeholder="{{ __('Price') }}" x-model="product.price">
                    </td>
                    <td>
                        <input type="number" x-bind:name="`products[${productIndex}][discountPercent]`" class="form-control tw-text-right" placeholder="{{ __('%') }}" x-model="product.discountPercent">
                    </td>
                    <td>
                        <input type="text" x-bind:name="`products[${productIndex}][discount]`" class="form-control tw-text-right" placeholder="{{ __('Discount') }}" x-bind:value="product.discount" disabled>
                        <input type="hidden" x-bind:name="`products[${productIndex}][discount]`" x-bind:value="product.discount">
                    </td>
                    <td>
                        <input type="text"  class="form-control tw-text-right" placeholder="{{ __('Tax') }}"  x-bind:value="product.tax" disabled>
                        <input type="hidden" x-bind:name="`products[${productIndex}][tax]`" x-bind:value="product.tax">
                    </td>
                    <td>
                        <input type="number" x-bind:name="`products[${productIndex}][total]`" class="form-control tw-text-right" placeholder="{{ __('Total') }}" x-model="product.total">
                    </td>
                    <td align="right">
                        <button type="button" class="btn btn-info btn-sm" x-on:click="copyProduct(productIndex)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7v8a2 2 0 0 0 2 2h6M8 7V5a2 2 0 0 1 2-2h4.586a1 1 0 0 1 .707.293l4.414 4.414a1 1 0 0 1 .293.707V15a2 2 0 0 1-2 2h-2M8 7H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-2"/></svg>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" x-on:click="deleteProduct(productIndex)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"/></svg>
                        </button>
                    </td>
                </tr>
            </template>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="10" align="right">
                    <button type="button" class="btn btn-primary btn-sm" x-on:click="addProduct()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        <span>{{ __('Add Product') }}</span>
                    </button>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
