<div id="section-history">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ __('Order History') }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <!-- Type -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="historyType">{{ __('Type') }}</label>
                        <select name="historyType" id="historyType" class="form-control">
                            <option value="1">Type1</option>
                            <option value="2">Type2</option>
                            <option value="3">Type3</option>
                        </select>
                        @error('historyType')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Type -->

                    <!-- Predefined Text -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="historyPredefinedText">{{ __('Predefined Text') }}</label>
                        <select name="historyPredefinedText" id="historyPredefinedText" class="form-control">
                            <option value="1">Predefined Text 1</option>
                            <option value="2">Predefined Text 2</option>
                            <option value="3">Predefined Text 3</option>
                        </select>
                        @error('historyPredefinedText')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Predefined Text -->

                    <!-- Message -->
                    <div class="form-group tw-mb-2">
                        <label class="col-form-label" for="historyMessage">{{ __('Message') }}</label>
                        <input type="text" id="historyMessage" class="form-control @error('historyMessage') error @enderror" name="historyMessage" placeholder="{{ __('Message') }}" x-model="$store.storeCustomers.customer.firstName"/>
                        @error('historyMessage')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End of Message -->

                    <div class="mt-2">
                        <button type="button" class="btn btn-primary">{{ __('Create') }}</button>
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
