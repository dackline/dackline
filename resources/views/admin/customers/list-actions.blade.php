<span class="tw-flex">
    <a href="{{ route('admin::customers.edit', $row->id) }}" class="btn btn-sm btn-icon btn-outline-secondary waves-effect">
        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
    </a>
    <button type="button" class="btn btn-sm btn-icon btn-outline-danger waves-effect tw-ml-1" wire:click="deleteCustomer({{ $row->id }})" onclick="confirm('{{ __('Are you sure to delete?') }}') || event.stopImmediatePropagation()">
        <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4" viewBox="0 0 24 24"fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M10 11v6M14 11v6"/></svg>
    </button>
</span>
