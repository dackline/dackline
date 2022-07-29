<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Order;
use App\Models\OrderData;
use App\Models\OrderStatus;
use App\Models\OrderHistory as OrderHistoryModel;
use Exception;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class OrderHistory extends Component
{
    public $orderStatusId = '';
    public $type = '';
    public $predefinedText = '';
    public $message = '';
    public $orderId;

    public $predefinedTexts;

    protected $rules = [
        'orderStatusId' => 'required',
        'type' => 'required',
        'message' => 'required'
    ];

    public function mount($orderId)
    {
        $this->orderId = $orderId;
        $this->predefinedTexts = collect([
            [ 'id' => 1, 'name' => 'Predefined Text 1', 'text' => 'Some text for predefined text 1', ],
            [ 'id' => 2, 'name' => 'Predefined Text 2', 'text' => 'Some text for predefined text 2', ],
            [ 'id' => 3, 'name' => 'Predefined Text 3', 'text' => 'Some text for predefined text 3', ],
            [ 'id' => 4, 'name' => 'Predefined Text 4', 'text' => 'Some text for predefined text 4', ],
            [ 'id' => 5, 'name' => 'Predefined Text 5', 'text' => 'Some text for predefined text 5', ],
        ]);
    }

    public function render()
    {
        $statuses = OrderStatus::withTranslation()->get();
        $histories = OrderHistoryModel::where('order_id', $this->orderId)->get();

        return view('livewire.admin.orders.order-history', [
            'statuses' => $statuses,
            'predefinedTexts' => $this->predefinedTexts,
            'histories' => $histories
        ]);
    }

    public function updatedPredefinedText($value)
    {
        if (!$value)
            return;

        $predefinedText = $this->predefinedTexts->first(fn ($item) => $item['id'] == $value);
        if  (!$predefinedText)
            return;

        $this->message = $predefinedText['text'];
    }

    public function store()
    {
        $this->validate();

        $order = Order::findOrFail($this->orderId);

        // Check update is only for order data not quotation data
        if($order->orderable_type != OrderData::class) {
            throw ValidationException::withMessages(['order_id' => [__('History entries can only be created only for orders.')]]);
        }

        $data = [
            'order_id' => $this->orderId,
            'type' => $this->type,
            'message' => $this->message,
            'order_status' => OrderStatus::where('id', $this->orderStatusId)->first()->name,
        ];

        OrderHistoryModel::create($data);

        // update order status
        Order::where('id', $this->orderId)->update([
            'order_status_id' => $this->orderStatusId,
        ]);

        // reset inputs
        $this->orderStatusId = '';
        $this->type = '';
        $this->predefinedText = '';
        $this->message;
    }
}
