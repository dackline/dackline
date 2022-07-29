<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOrderRequest;
use App\Http\Requests\Admin\UpdateOrderRequest;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderData;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\QuotationData;
use App\Models\QuotationStatus;
use App\Models\ShippingMethod;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\Admin\DetermineOrderTypeTrait;

class OrderController extends Controller
{
    use DetermineOrderTypeTrait;

    public function index()
    {
        $orderType = $this->orderType;
        $isOrder = $this->orderType == OrderData::class ? true : false;

        $breadcrumbs = [
            ['link' => route('admin::dashboard'), 'name' => "Dashboard"], ['name' => $orderType == OrderData::class ? __('Orders') : __('Quotations')]
        ];

        return view('admin.orders.list', compact('breadcrumbs', 'orderType', 'isOrder'));
    }

    public function create()
    {
        $item = resolve($this->orderType);
        $order = new Order();
        $countries = Country::all();
        $shippingMethods = ShippingMethod::all();
        $paymentMethods = PaymentMethod::all();
        $orderStatuses = OrderStatus::with(['translations'])->get();
        $quotationStatuses = QuotationStatus::with(['translations'])->get();
        $adminUsers = User::role('admin')->get();
        $products = [];
        $isOrder = $this->orderType == OrderData::class ? true : false;

        return view('admin.orders.form', compact('order', 'item', 'countries','shippingMethods', 'paymentMethods', 'orderStatuses', 'quotationStatuses', 'adminUsers', 'products', 'isOrder'));
    }

    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();

        // retrive default store
        $store = Store::where('default', 1)->with('currency')->first();
        $customer = Customer::find($validated['customerId']);
        $paymentCountry = Country::find($validated['paymentCountryId']);
        $paymentMethod = PaymentMethod::find($validated['paymentMethodId']);
        $shippingCountry = Country::find($validated['shippingCountryId']);
        $shippingMethod = ShippingMethod::find($validated['shippingMethodId']);

        // orderdata or quotation data based on type
        $params = [];
        if($this->orderType == OrderData::class) {
            $params['order_status_id'] = $validated['orderStatusId'];
        } elseif ($this->orderType == QuotationData::class) {
            $params['quotation_status_id'] = $validated['quotationStatusId'];
        }

        // create orderdata or quotation data based on type
        $typeObj = app($this->orderType)->create($params);

        $data = [
            'store_id' => $store->id,
            'store_name' => $store->store_name,
            'store_url' => $store->store_url,

            'customer_id' => $validated['customerId'],
            'customer_group_id' => $customer->customer_group_id,
            'firstname' => $validated['customerFirstName'],
            'lastname' => $validated['customerLastName'],
            'email' => $validated['customerEmail'],
            'email_invoice' => $validated['customerEmailInvoice'],
            'phone' => $validated['customerPhone'],
            'company' => $validated['customerCompanyName'],
            'vat_nr' => $validated['customerVatNr'],

            'payment_firstname' => $validated['paymentFirstName'],
            'payment_lastname' => $validated['paymentLastName'],
            'payment_company' => $validated['paymentCompanyName'],
            'payment_phone' => $validated['paymentPhone'],
            'payment_address_1' => $validated['paymentAddress1'],
            'payment_address_2' => $validated['paymentAddress2'],
            'payment_city' => $validated['paymentCity'],
            'payment_zipcode' => $validated['paymentZipcode'],
            'payment_country' => $paymentCountry->name,
            'payment_country_id' => $paymentCountry->id,
            'payment_method_id' => $paymentMethod->id,
            'payment_method' => $paymentMethod->name,

            'shipping_firstname' => $validated['shippingFirstName'],
            'shipping_lastname' => $validated['shippingLastName'],
            'shipping_company' => $validated['shippingCompanyName'],
            'shipping_phone' => $validated['shippingPhone'],
            'shipping_address_1' => $validated['shippingAddress1'],
            'shipping_address_2' => $validated['shippingAddress2'],
            'shipping_city' => $validated['shippingCity'],
            'shipping_zipcode' => $validated['shippingZipcode'],
            'shipping_country' => $shippingCountry->name,
            'shipping_country_id' => $shippingCountry->id,
            'shipping_method_id' => $shippingMethod->id,
            'shipping_method' => $shippingMethod->name,

            'comment' => $validated['comment'] ?? null,
            'total' => $validated['total'] ?? 0,
            'assignee_id' => $validated['assigneeId'],
            'ip' => $request->ip(),
            'delivery_date' => $validated['deliveryDate'] ?? null,

            'currency_id' => $store->currency->id,
            'currency_code' => $store->currency->code,
            'currency_value' => $store->currency->value,
        ];

        $typeObj->order()->create($data);

        $order = $typeObj->order;

        // insert order products
        if($request->has('products') && count($request->input('products')) > 0) {
            foreach($request->input('products') as $product) {
                $order->products()->attach($product['productId'], [
                    'name' => $product['name'],
                    'article_nr' => null,
                    'quantity' => (int)$product['quantity'],
                    'price' => (float)$product['price'],
                    'total' => (float)$product['total'],
                    'tax' => (float)$product['tax'],
                    'discount' => (float)$product['discount'],
                    'discount_percent' => (float)$product['discountPercent'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        // save order totals
        $available_totals = config('dackline.available_totals');
        $totals = [];
        $order->refresh()->orderTotals()->delete();
        collect($available_totals)->each(function($total) use ($order, &$totals) {
            $method_name = 'get'. ucfirst($total['code']);
            $value = $order->{$method_name}();
            $totals[] = [
                'order_id' => $order->id,
                'code' => $total['code'],
                'title' => $total['name'],
                'value' => $value,
                'sort_order' => $total['sort_order'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        });
        $order->orderTotals()->insert($totals);

        if($this->orderType == OrderData::class)
            return redirect(route('admin::orders.index'))->with('success', __('Order Created.'));
        else if($this->orderType == QuotationData::class)
            return redirect(route('admin::quotations.index'))->with('success', __('Quotation Created.'));
    }

    public function edit($order)
    {
        // resolve order based on type
        $item = resolve($this->orderType)->with('order')->findOrFail($order);

        $order = $item->order;
        $countries = Country::all();
        $shippingMethods = ShippingMethod::all();
        $paymentMethods = PaymentMethod::all();
        $orderStatuses = OrderStatus::with(['translations'])->get();
        $quotationStatuses = QuotationStatus::with(['translations'])->get();
        $adminUsers = User::role('admin')->get();
        $isOrder = $this->orderType == OrderData::class ? true : false;

        $order->load('products', 'products.tax', 'customer', 'paymentMethod', 'shippingMethod', 'assignee');

        if($this->isOrder()) {
            $item->load('orderStatus');
        }

        if(!$this->isOrder()) {
            $item->load('quotationStatus');
        }

        $products = [];
        foreach($order->products as $product) {
            $products[] = [
                'uniqueId' => \Illuminate\Support\Str::uuid()->toString(),
                'id' => $product->pivot->product_id,
                'name' => $product->pivot->name,
                'quantity' => $product->pivot->quantity,
                'price' => $product->pivot->price,
                'total' => $product->pivot->total,
                'tax' => $product->pivot->tax,
                'discount' => $product->pivot->discount,
                'discountPercent' => $product->pivot->discount_percent,
                'product' => $product,
            ];
        }

        $breadcrumbs = [
            ['link' => $this->isOrder() ? route('admin::orders.index') : route('admin::quotations.index'), 'name' => $this->isOrder() ? __('Orders') : __('Quotations')], ['name' => __('Edit')]
        ];

        return view('admin.orders.form', compact('item', 'order', 'breadcrumbs', 'countries', 'shippingMethods', 'paymentMethods', 'orderStatuses', 'quotationStatuses', 'adminUsers', 'products', 'isOrder'));
    }

    public function update(UpdateOrderRequest $request, $order)
    {
        $validated = $request->validated();

        // resolve order based on type
        $item = resolve($this->orderType)->with('order')->findOrFail($order);

        // update orderdata or quotation data based on type
        $params = [];
        if($this->orderType == OrderData::class) {
            $params['order_status_id'] = $validated['orderStatusId'];
        } elseif ($this->orderType == QuotationData::class) {
            $params['quotation_status_id'] = $validated['quotationStatusId'];
        }

        // create orderdata or quotation data based on type
        $item->update($params);

        $order = $item->order;

        // retrive default store
        $store = Store::where('default', 1)->with('currency')->first();
        $customer = Customer::find($validated['customerId']);
        $paymentCountry = Country::find($validated['paymentCountryId']);
        $paymentMethod = PaymentMethod::find($validated['paymentMethodId']);
        $shippingCountry = Country::find($validated['shippingCountryId']);
        $shippingMethod = ShippingMethod::find($validated['shippingMethodId']);

        $data = [
            'store_id' => $store->id,
            'store_name' => $store->store_name,
            'store_url' => $store->store_url,

            'customer_id' => $validated['customerId'],
            'customer_group_id' => $customer->customer_group_id,
            'firstname' => $validated['customerFirstName'],
            'lastname' => $validated['customerLastName'],
            'email' => $validated['customerEmail'],
            'email_invoice' => $validated['customerEmailInvoice'],
            'phone' => $validated['customerPhone'],
            'company' => $validated['customerCompanyName'],
            'vat_nr' => $validated['customerVatNr'],

            'payment_firstname' => $validated['paymentFirstName'],
            'payment_lastname' => $validated['paymentLastName'],
            'payment_company' => $validated['paymentCompanyName'],
            'payment_phone' => $validated['paymentPhone'],
            'payment_address_1' => $validated['paymentAddress1'],
            'payment_address_2' => $validated['paymentAddress2'],
            'payment_city' => $validated['paymentCity'],
            'payment_zipcode' => $validated['paymentZipcode'],
            'payment_country' => $paymentCountry->name,
            'payment_country_id' => $paymentCountry->id,
            'payment_method_id' => $paymentMethod->id,
            'payment_method' => $paymentMethod->name,

            'shipping_firstname' => $validated['shippingFirstName'],
            'shipping_lastname' => $validated['shippingLastName'],
            'shipping_company' => $validated['shippingCompanyName'],
            'shipping_phone' => $validated['shippingPhone'],
            'shipping_address_1' => $validated['shippingAddress1'],
            'shipping_address_2' => $validated['shippingAddress2'],
            'shipping_city' => $validated['shippingCity'],
            'shipping_zipcode' => $validated['shippingZipcode'],
            'shipping_country' => $shippingCountry->name,
            'shipping_country_id' => $shippingCountry->id,
            'shipping_method_id' => $shippingMethod->id,
            'shipping_method' => $shippingMethod->name,

            'comment' => $validated['comment'] ?? null,
            'total' => $validated['total'] ?? 0,
            'assignee_id' => $validated['assigneeId'],
            'ip' => $request->ip(),
            'delivery_date' => $validated['deliveryDate'] ?? null,

            'currency_id' => $store->currency->id,
            'currency_code' => $store->currency->code,
            'currency_value' => $store->currency->value,
        ];

        $order->update($data);

        // update products
        $order->products()->detach();
        if($request->has('products') && count($request->input('products')) > 0) {
            foreach($request->input('products') as $product) {
                $order->products()->attach($product['productId'], [
                    'name' => $product['name'],
                    'article_nr' => null,
                    'quantity' => (int)$product['quantity'],
                    'price' => (float)$product['price'],
                    'total' => (float)$product['total'],
                    'tax' => (float)$product['tax'],
                    'discount' => (float)$product['discount'],
                    'discount_percent' => (float)$product['discountPercent'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }

        // save order totals
        $available_totals = config('dackline.available_totals');
        $totals = [];
        $order->refresh()->orderTotals()->delete();
        collect($available_totals)->each(function($total) use ($order, &$totals) {
            $method_name = 'get'. ucfirst($total['code']);
            $value = $order->{$method_name}();
            $totals[] = [
                'order_id' => $order->id,
                'code' => $total['code'],
                'title' => $total['name'],
                'value' => $value,
                'sort_order' => $total['sort_order'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        });
        $order->orderTotals()->insert($totals);

        return redirect($this->isOrder() ? route('admin::orders.index') : route('admin::quotations.index'))->with('success', $this->isOrder() ? __('Order updated.') : __('Quotation updated.'));
    }
}
