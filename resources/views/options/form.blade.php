@extends('layouts/contentLayoutMaster')

@section('title', isset($option->id) ? __('Edit Option') : __('Create Option'))

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <style>
        .input-group svg {
            width: 20px;
        }
    </style>
@endsection

@section('content')
<!-- Basic Horizontal form layout section start -->
<section>
    <form id="module-form" class="form form-horizontal" method="POST" action="{{ isset($option->id) ? route('options.update', $option->id) : route('options.store') }}" x-data="moduleData()" x-init="moduleInit()" x-on:submit="submit()" novalidate>
        @csrf
        @if(isset($option->id))
            @method('PUT')
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Option')  }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 tw-mb-4"">
                                <label class="col-form-label" for="name">{{ __('Name') }}</label>
                                @foreach ($locales as $locale)
                                <div class="tw-mb-1">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon-search1">
                                            {!! get_locale_icon($locale) !!}
                                        </span>
                                        <input type="text" id="{{ $locale }}[name]" name="{{ $locale }}[name]" class="form-control @error($locale. '.name') error @enderror" placeholder="{{ __('Name') }} ({{ strtoupper($locale) }})" value="{{ old($locale. '.name', optional($option->translate($locale))->name) }}"/>
                                    </div>
                                    @error($locale. '.name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endforeach
                            </div>

                            <div class="col-12 tw-mb-4">
                                <label class="col-form-label" for="type">{{ __('Type') }}</label>
                                <select class="form-select @error('type') error @enderror" name="type">
                                    <option value="select" {{ old('type', $option->type) == 'select' ? 'selected' : '' }}>{{ __('Select') }}</option>
                                    <option value="checkbox" {{ old('type', $option->type) == 'checkbox' ? 'selected' : '' }}>{{ __('Checkbox') }}</option>
                                </select>
                                @error('type')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 tw-mb-4">
                                <label class="col-form-label" for="sortOrder">{{ __('Sort Order') }}</label>
                                <input type="number" id="sortOrder" class="form-control @error('sortOrder') error @enderror" name="sortOrder" placeholder="{{ __('Sort Order') }}" value="{{ old('sortOrder', $option->sort_order) }}"/>
                                @error('sortOrder')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" x-data="moduleOptionValue()" x-init="init()">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Option Values')  }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __("Option Value Name") }}</th>
                                        <th>{{ __('Sort Order') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="(optionValue, index) in optionValues">
                                        <tr>
                                            <td>
                                                <template x-for="locale in locales">
                                                    <div class="tw-mb-1">
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon-search1" x-html="localesMeta[locale].icon"></span>
                                                            <input type="text" class="form-control" placeholder="{{ __('Option Value Name') }}"
                                                                x-bind:class="{'error': errors[`optionValues.${index}.${locale}.name`] !== undefined}"
                                                                x-model="optionValues[index][locale].name"
                                                                x-bind:name="`optionValues[${index}][${locale}][name]`"
                                                                x-bind:id="`optionValues[${index}][${locale}][name]`"
                                                            />
                                                        </div>

                                                        <template x-if="errors[`optionValues.${index}.${locale}.name`] !== undefined">
                                                            <span class="error" x-text="errors[`optionValues.${index}.${locale}.name`]"></span>
                                                        </template>
                                                    </div>
                                                </template>
                                            </td>
                                            <td>
                                                <div class="tw-mb-1">
                                                    <input type="number" class="form-control" placeholder="{{ __('Sort Order') }}"
                                                        x-bind:class="{'error': errors[`optionValues.${index}.sortOrder`] !== undefined}"
                                                        x-model="optionValues[index].sortOrder"
                                                        x-bind:name="`optionValues[${index}][sortOrder]`"
                                                        x-bind:id="`optionValues[${index}][sortOrder]`"
                                                    />
                                                    <template x-if="errors[`optionValues.${index}.sortOrder`] !== undefined">
                                                        <span class="error" x-text="errors[`optionValues.${index}.sortOrder`]"></span>
                                                    </template>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" x-on:click="deleteItem(index)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m19 7-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td align="right">
                                            <button type="button" class="btn btn-primary btn-sm" x-on:click="addOptionValue">
                                                <i data-feather="plus"></i>
                                                <span>{{ __('Add') }}</span>
                                            </button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary me-1">
            {{ isset($option->id) ? __('Save') : __('Create') }}
        </button>
    </form>
</section>
@endsection
@section('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection
@section('page-script')
<script>

$(document).ready(function() {
    let rules = {}
    $('#module-form').validate({
        ignore: ".ignore",
        rules: rules
    });
});
</script>

@php
    $optionValues = [];
    if(isset($option->id)) {
        foreach ($option->values as $value) {
            $result = [
                'sortOrder' => $value->sort_order
            ];
            foreach($value->translations as $translation) {
                $result[$translation->locale] = [
                    'name' => $translation->name
                ];
            }
            $optionValues[] = $result;
        }
    }
@endphp

<script>
window.localesMeta = {{ Illuminate\Support\Js::from(config('translatable.locales_meta')) }}

function moduleData(){
    return {
        moduleInit(){

        },
        submit(){

        }
    }
}

function moduleOptionValue() {
    return {
        optionValues: JSON.parse(`@json(old('optionValues', $optionValues))`),
        errors: JSON.parse(`@json($errors->getMessages())`),
        locales: JSON.parse('@json($locales)'),
        localesMeta: window.localesMeta,
        init() {

        },
        addOptionValue() {
            let row = {}
            row['sortOrder'] = 0
            this.locales.forEach(locale => {
                row[locale] = {
                    name: '',
                }
            })
            this.optionValues.push(row)
        },
        deleteItem(index) {
            if(!confirm("Are you sure to delete?")) {
                return false;
            }

            this.optionValues.splice(index, 1)
        }
    }
}
</script>
@endsection
