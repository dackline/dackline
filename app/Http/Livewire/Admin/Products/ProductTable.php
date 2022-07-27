<?php

namespace App\Http\Livewire\Admin\Products;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class ProductTable extends DataTableComponent
{
    protected $model = Product::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setEagerLoadAllRelationsStatus(true);
    }

    public function builder(): Builder
    {
        return Product::query()
            ->withTranslation();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->searchable()
                ->sortable(),
            Column::make("Name")
                ->label(
                    fn($row, Column $column) => $row->product_name
                )
                ->searchable(static function (Builder $query, $term) {
                    return $query->orWhereTranslationLike('product_name', '%' . $term . '%');
                })
                ->sortable(),
            Column::make("Article nr", "article_nr")
                ->searchable()
                ->sortable(),
            Column::make("SKU", "sku")
                ->searchable()
                ->sortable(),
            Column::make("Price", "price")
                ->sortable(),
            Column::make("Quantity", "quantity")
                ->format(function($value, $column) {
                    $color = 'bg-success';
                    if($value <= 0)
                        $color = 'bg-danger';
                    else if($value > 0 && $value < 4)
                        $color = 'bg-warning';
                    return '<span class="badge rounded-pill ' . $color . '">'. $value .'</span>';
                })
                ->html()
                ->sortable(),
            BooleanColumn::make("Status", "status")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->format(fn($value, $row, $column) => $value->format('Y-m-d'))
                ->sortable(),
            Column::make('Actions')
                ->label(
                    fn($row, Column $column) => view('admin.products.list-actions', ['row' => $row])
                )
        ];
    }

    public function deleteProduct($productId) {
        $product = Product::findOrFail($productId);

        $product->deleteTranslations();

        $product->customFields()->delete();

        $product->stores()->detach();

        $product->delete();

        session()->flash('message', __('Product Deleted'));
    }
}
