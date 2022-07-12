<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreCustomerRequest;
use App\Http\Requests\Admin\UpdateCustomerRequest;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerGroup;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate(10);

        $breadcrumbs = [
            ['link' => route('admin::dashboard'), 'name' => "Dashboard"], ['name' => "Customers"]
        ];

        return view('admin.customers.list', compact('customers', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = new Customer();
        $customerGroups = CustomerGroup::all();
        $countries = Country::all();
        $addresses = [];

        $breadcrumbs = [
            ['link' => route('admin::customers.index'), 'name' => "Customers"], ['name' => "Create"]
        ];

        return view('admin.customers.form', compact('customer', 'breadcrumbs', 'customerGroups', 'countries', 'addresses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $validated = $request->validated();

        // create user
        $user = User::create([
            'name' => implode(' ', [$validated['firstName'], $validated['lastName']]),
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // assign customer role to user
        $user->assignRole('customer');

        $data = [
            'customer_group_id' => $validated['customerGroupId'],
            'user_id' => $user->id,
            'first_name' => $validated['firstName'],
            'last_name' => $validated['lastName'],
            'email' => $validated['email'],
            'email_invoice' => $validated['emailInvoice'],
            'phone' => $validated['phone'],
            'company_name' => $validated['companyName'],
            'vat_nr' => $validated['vatNr'],
            'country_id' => $validated['countryId'],
        ];

        $customer = Customer::create($data);

        // save address info
        if(isset($validated['addresses']) && count($validated['addresses'])) {
            $data = [];
            foreach($validated['addresses'] as $address) {
                $data[] = [
                    'customer_id' => $customer->id,
                    'country_id' => $address['countryId'],
                    'address_label' => $address['addressLabel'],
                    'first_name' => $address['firstName'],
                    'last_name' => $address['lastName'],
                    'company_name' => $address['companyName'],
                    'phone' => $address['phone'],
                    'address_1' => $address['address1'],
                    'address_2' => $address['address2'],
                    'city' => $address['city'],
                    'zipcode' => $address['zipcode'],
                    'default' => isset($address['default']) ? (int)$address['default'] : 0,
                ];
            }

            $customer->addresses()->insert($data);
        }

        return redirect(route('admin::customers.index'))->with('success', __('Customer Created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $customerGroups = CustomerGroup::all();
        $countries = Country::all();
        $addresses = [];

        foreach($customer->addresses as $address) {
            $addresses[] = [
                'countryId' =>  $address['country_id'],
                'addressLabel' =>  $address['address_label'],
                'firstName' =>  $address['first_name'],
                'lastName' =>  $address['last_name'],
                'companyName' =>  $address['company_name'],
                'phone' =>  $address['phone'],
                'address1' =>  $address['address_1'],
                'address2' =>  $address['address_2'],
                'city' =>  $address['city'],
                'zipcode' =>  $address['zipcode'],
                'default' => $address['default'],
            ];
        }

        $breadcrumbs = [
            ['link' => route('admin::customers.index'), 'name' => "Customers"], ['name' => "Edit"]
        ];

        return view('admin.customers.form', compact('customer', 'breadcrumbs', 'customerGroups', 'countries', 'addresses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $validated = $request->validated();

        // update user password
        if($request->has('password') && !empty($validated['password']) && $customer->user) {
            $customer->user()->update([
                'password' => Hash::make($validated['password'])
            ]);
        }

        // update email
        if($request->has('email') && !empty($validated['email']) && $customer->user) {
            $customer->user()->update([
                'email' => $validated['email']
            ]);
        }

        // check user created for this customer
        if(!$customer->user) {
            // create user
            $user = User::create([
                'name' => implode(' ', [$validated['firstName'], $validated['lastName']]),
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // assign customer role to user
            $user->assignRole('customer');
        }

        $data = [
            'customer_group_id' => $validated['customerGroupId'],
            'first_name' => $validated['firstName'],
            'last_name' => $validated['lastName'],
            'email' => $validated['email'],
            'email_invoice' => $validated['emailInvoice'],
            'phone' => $validated['phone'],
            'company_name' => $validated['companyName'],
            'vat_nr' => $validated['vatNr'],
            'country_id' => $validated['countryId'],
        ];

        $customer->update($data);

        // save address info
        $customer->addresses()->delete();
        if(isset($validated['addresses']) && count($validated['addresses'])) {
            $data = [];
            foreach($validated['addresses'] as $address) {
                $data[] = [
                    'customer_id' => $customer->id,
                    'country_id' => $address['countryId'],
                    'address_label' => $address['addressLabel'],
                    'first_name' => $address['firstName'],
                    'last_name' => $address['lastName'],
                    'company_name' => $address['companyName'],
                    'phone' => $address['phone'],
                    'address_1' => $address['address1'],
                    'address_2' => $address['address2'],
                    'city' => $address['city'],
                    'zipcode' => $address['zipcode'],
                    'default' => isset($address['default']) ? (int)$address['default'] : 0,
                ];
            }

            $customer->addresses()->insert($data);
        }

        return redirect(route('admin::customers.index'))->with('success', __('Customer Updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->back()->with('success', __('Customer Deleted.'));
    }
}
