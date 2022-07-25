<?php

namespace App\Http\Livewire\Admin\Customers;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;

class CustomerTable extends DataTableComponent
{
    protected $model = Customer::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects(['customers.last_name as last_name', 'customers.first_name as first_name', 'customers.company_name as company_name']);
        $this->setSearchDebounce(500);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name")
                ->label(
                    fn($row, Column $column) => $row->full_name_with_company
                )
                ->searchable(static function (Builder $query, $term) {
                    return $query
                        ->orWhere('customers.first_name', 'like', '%'. strtolower($term) .'%')
                        ->orWhere('customers.last_name', 'like', '%'. strtolower($term) .'%')
                        ->orWhere('customers.company_name', 'like', '%'. strtolower($term) .'%');
                }),
            Column::make("Email", "email")
                ->searchable()
                ->sortable(),
            Column::make("Phone", "phone")
                ->searchable()
                ->sortable(),
            Column::make('Country', 'country.name'),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make('Actions')
                ->label(
                    fn($row, Column $column) => view('admin.customers.list-actions', ['row' => $row])
                )
        ];
    }

    public function deleteCustomer($customerId)
    {
        $customer = Customer::findOrFail($customerId);

        $customer->delete();

        session()->flash('message', __('Customer Deleted'));
    }
}
