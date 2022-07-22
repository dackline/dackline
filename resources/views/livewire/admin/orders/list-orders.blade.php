<div>
    <style>
        td, th {
            padding: 0.4rem !important;
        }
    </style>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                <div class="alert-body">
                    {{ session('message') }}
                </div>
            </div>
        @endif
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ __('Orders') }}</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table tw-table-fixed">
                    <col style="width: 5%">
                    <col style="width: 25%">
                    <col style="width: 10%">
                    <col style="width: 10%">
                    <col style="width: 20%">
                    <col style="width: 10%">
                    <thead>
                        <tr>
                            <th class="tw-text-center">{{ __("O. ID") }}</th>
                            <th>{{ __("Customer") }}</th>
                            <th>{{ __("Date Created") }}</th>
                            <th class="tw-text-right">{{ __("Total") }}</th>
                            <th class="tw-text-center">{{ __("Status") }}</th>
                            <th class="tw-text-right">{{ __('Actions') }}</>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $index => $order)
                        <tr>
                            <td class="tw-text-center">
                                <span class="fw-bold">{{ $order->id }}</span>
                            </td>
                            <td>
                                <span class="fw-bold">{{ $order->full_name_with_company }}</span>
                            </td>
                            <td>
                                <span class="fw-bold">{{ $order->created_at->format('Y-m-d') }}</span>
                            </td>
                            <td class="tw-text-right">
                                <span class="fw-bold">{{ $order->total }}</span>
                            </td>
                            <td class="tw-text-center">
                                <select class="form-select" wire:change="updateOrderStatus($event.target.value, '{{ $order->id }}')">
                                    @foreach ($orderStatuses as $status)
                                        <option value="{{ $status->id }}" @selected($status->id == $order->order_status_id)>{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tw-text-right">
                                <a href="#" class="btn btn-sm btn-icon btn-outline-secondary waves-effect">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h2m2 4h6a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2zm8-12V5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v4h10z"/></svg>
                                </a>
                                <a href="{{ route('admin::orders.edit', $order->id) }}" class="btn btn-sm btn-icon btn-outline-secondary waves-effect">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
                                </a>
                                <button type="button" class="btn btn-sm btn-icon btn-outline-danger waves-effect" wire:click="deleteOrder({{ $order->id }})" onclick="confirm('{{ __('Are you sure to delete?') }}') || event.stopImmediatePropagation()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4" viewBox="0 0 24 24"fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M10 11v6M14 11v6"/></svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="tw-flex tw-justify-end">
        {{ $orders->links() }}
    </div>
</div>
