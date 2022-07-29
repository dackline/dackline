<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\OrderData;
use App\Models\OrderStatus;
use App\Models\QuotationData;
use App\Models\QuotationStatus;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ListOrders extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $orderType;

    public function mount($orderType)
    {
        $this->orderType = $orderType;
    }

    public function render()
    {
        $items = app($this->orderType)->with('order')->orderBy('created_at', 'desc')->paginate(50);

        $statuses = [];
        if($this->orderType == OrderData::class)
            $statuses = OrderStatus::withTranslation()->get();
        else if($this->orderType == QuotationData::class)
            $statuses = QuotationStatus::withTranslation()->get();

        return view('livewire.admin.orders.list-orders', [
            'items' => $items,
            'orderType' => $this->orderType,
            'isOrder' => $this->orderType == OrderData::class,
            'statuses' => $statuses,
        ]);
    }

    public function updateOrderStatus($value, $orderId)
    {
        $data = [];
        if($this->isOrder()) {
            $data['order_status_id'] = (int) $value;
        } else {
            $data['quotation_status_id'] = (int) $value;
        }

        app($this->orderType)->where('id', $orderId)->update($data);

        session()->flash('message', $this->isOrder() ? __('Order status updated.') : __('Quotation status updated.'));
    }

    public function deleteOrder($orderId)
    {
        // resovle item based on type
        $item = app($this->orderType)->with('order')->findOrFail($orderId);

        // remove order histories
        $item->order->histories()->delete();

        // remove order products
        $item->order->products()->detach();

        // remove order
        $item->order->delete();

        // remove item itself
        $item->delete();

        session()->flash('message', $this->isOrder() ? __('Order deleted.') : __('Quotation deleted.'));
    }

    public function printOrder($orderId)
    {
        // resovle item based on type
        $item = app($this->orderType)->where('id', $orderId)->with('order', 'order.assignee', 'order.products')->first();
        $data = $item->order;

        $pdfContent = Pdf::loadView('admin.orders.invoice', [
            'item' => $item,
            'data' => $data,
            'totals' => $data->getTotals(),
            'type' => $this->isOrder() ? 'order' : 'quotation'
        ])->output();

        return response()->streamDownload(
            fn () => print($pdfContent),
            $this->isOrder() ? "order-$orderId.pdf" : "quotation-$orderId.pdf"
        );
    }

    public function generateOrder($quotationId)
    {
        $quotationData = QuotationData::findOrFail($quotationId);
        $newOrder = $quotationData->order->duplicate();

        $orderData = OrderData::create([
            'order_status_id' => OrderStatus::whereTranslation('name', 'Processing')->first()->id,
        ]);
        $orderData->order()->save($newOrder);

        // Update quotation statsus
        $quotationData->quotation_status_id = QuotationStatus::whereTranslation('name', 'History')->first()->id;
        $quotationData->save();

        return redirect()->to(route('admin::orders.edit', $orderData));
    }

    private function isOrder() {
        return $this->orderType == OrderData::class;
    }
}
