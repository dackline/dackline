<div>
    <div id="section-history">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('Order History') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <!-- Order Status -->
                        <div class="form-group tw-mb-2">
                            <label class="col-form-label @error('orderStatusId') error @enderror" for="orderStatusId">{{ __('Order Status') }}</label>
                            <select name="orderStatusId" id="orderStatusId" class="form-control @error('orderStatusId') error @enderror" wire:model="orderStatusId">
                                <option value="" disabled>{{ __('Select Order Status') }}</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('orderStatusId')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- End of Order Status -->

                        <!-- Type -->
                        <div class="form-group tw-mb-2">
                            <label class="col-form-label @error('type') error @enderror" for="type">{{ __('Type') }}</label>
                            <select name="type" id="type" class="form-control @error('type') error @enderror" wire:model="type">
                                <option value="" disabled>{{ __('Select Type') }}</option>
                                <option value="1">Type1</option>
                                <option value="2">Type2</option>
                                <option value="3">Type3</option>
                            </select>
                            @error('type')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- End of Type -->

                        <!-- Predefined Text -->
                        <div class="form-group tw-mb-2">
                            <label class="col-form-label @error('predefinedText') error @enderror" for="predefinedText">{{ __('Predefined Text') }}</label>
                            <select name="predefinedText" id="predefinedText" class="form-control @error('predefinedText') error @enderror" wire:model="predefinedText">
                                <option value="" disabled>{{ __('Select Predefined Text') }}</option>
                                @foreach ($predefinedTexts as $predefinedText)
                                    <option value="{{ $predefinedText['id'] }}">{{ $predefinedText['name'] }}</option>
                                @endforeach
                            </select>
                            @error('predefinedText')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- End of Predefined Text -->

                        <!-- Message -->
                        <div class="form-group tw-mb-2">
                            <label class="col-form-label @error('message') error @enderror" for="message">{{ __('Message') }}</label>
                            <textarea id="message" name="message" class="form-control @error('message') error @enderror" placeholder="{{ __('Message') }}" wire:model="message"></textarea>
                            @error('message')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- End of Message -->

                        <div class="mt-2">
                            <button type="button" class="btn btn-primary" wire:click="store">{{ __('Create Order History') }}</button>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Comment') }}</th>
                                    <th>{{ __('Order Status') }}</th>
                                    <th>{{ __('Customer Notified') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($histories->count() <= 0)
                                <tr>
                                    <td colspan="4" align="center">{{ __('No order histories available.') }}</td>
                                </tr>
                                @endif
                                @foreach ($histories as $history)
                                    <tr>
                                        <td>{{ $history->created_at }}</td>
                                        <td>{{ $history->message }}</td>
                                        <td>{{ $history->order_status }}</td>
                                        <td>N/A</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
