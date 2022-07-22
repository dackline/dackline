<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\OrderStatus;
use Livewire\Component;
use Livewire\WithPagination;

class ListOrders extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(50);
        $orderStatuses = OrderStatus::withTranslation()->get();

        return view('livewire.admin.orders.list-orders', [
            'orders' => $orders,
            'orderStatuses' => $orderStatuses,
        ]);
    }

    public function updateOrderStatus($value, $orderId)
    {
        Order::where('id', $orderId)->update([
            'order_status_id' => (int) $value,
        ]);

        session()->flash('message', __('Order status updated.'));
    }

    public function deleteOrder($orderId)
    {
        $order = Order::findOrFail($orderId);

        // remove order histories
        $order->histories()->delete();

        // remove order products
        $order->products()->detach();

        // remove order
        $order->delete();

        session()->flash('message', __('Order deleted.'));
    }
}
