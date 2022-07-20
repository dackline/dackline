<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOrderRequest;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ShippingMethod;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        $breadcrumbs = [
            ['link' => route('admin::dashboard'), 'name' => "Dashboard"], ['name' => __('Orders')]
        ];

        return view('admin.orders.list', compact('orders', 'breadcrumbs'));
    }

    public function create()
    {
        $countries = Country::all();
        $shippingMethods = ShippingMethod::all();
        $paymentMethods = PaymentMethod::all();
        $orderStatuses = OrderStatus::with(['translations'])->get();
        $adminUsers = User::role('admin')->get();

        return view('admin.orders.form', compact('countries','shippingMethods', 'paymentMethods', 'orderStatuses', 'adminUsers'));
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
            'order_status_id' => $validated['orderStatusId'],
            'assignee_id' => $validated['assigneeId'],
            'ip' => $request->ip(),
            'delivery_date' => $validated['deliveryDate'] ?? null,

            'currency_id' => $store->currency->id,
            'currency_code' => $store->currency->code,
            'currency_value' => $store->currency->value,
        ];

        $order = Order::create($data);

        // insert order products
        if($request->has('products') && count($request->input('products')) > 0) {
            $products = [];
            foreach($request->input('products') as $product) {
                $products[] = [
                    'order_id' => $order->id,
                    'product_id' => $product['productId'],
                    'name' => $product['name'],
                    'article_nr' => null,
                    'quantity' => (int)$product['quantity'],
                    'price' => (float)$product['price'],
                    'total' => (float)$product['total'],
                    'tax' => (float)$product['tax'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            $order->products()->insert($products);
        }

        return redirect(route('admin::orders.index'))->with('success', __('Order Created.'));
    }

    public function destroy(Order $order)
    {
        $order->products()->delete();
        $order->delete();

        return redirect()->back()->with('success', __('Order Deleted.'));
    }
}
