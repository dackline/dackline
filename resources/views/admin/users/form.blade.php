@extends('layouts/contentLayoutMaster')

@section('title', isset($user->id) ? __('Edit User') : __('Create User'))

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('content')
<!-- Basic Horizontal form layout section start -->
<section>
    <form id="module-form" class="form form-horizontal" method="POST" action="{{ isset($user->id) ? route('admin::users.update', $user->id) : route('admin::users.store') }}" x-data="moduleData()" x-init="moduleInit()" x-on:submit="submit()" novalidate>
        @csrf
        @if(isset($user->id))
            @method('PUT')
        @endif
        <div class="row">
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Data')  }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 tw-mb-4"">
                                <label class="col-form-label" for="name">{{ __('Name') }}</label>
                                <input type="text" id="name" class="form-control @error('name') error @enderror" name="name" placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}"/>
                                @error('name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 tw-mb-4"">
                                <label class="col-form-label" for="email">{{ __('Email') }}</label>
                                <input type="text" id="email" class="form-control @error('email') error @enderror" name="email" placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}"/>
                                @error('email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 tw-mb-4"">
                                <label class="col-form-label" for="password">{{ __('Password') }}</label>
                                <input type="password" id="password" class="form-control @error('password') error @enderror" name="password" placeholder="{{ __('Password') }}" />
                                @error('password')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary me-1">
            {{ isset($user->id) ? __('Save') : __('Create') }}
        </button>
    </form>
</section>
@endsection
@section('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
<script>

$(document).ready(function() {
    let rules = {}

    rules['name'] = { required: true }
    rules['email'] = { required: true }
    rules['password'] = { required: true }

    $('#module-form').validate({
        ignore: ".ignore",
        rules: rules
    });

    var select2 = $('.select2')
    select2.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $this.parent(),
            placeholder: $this.attr('placeholder')
        });
    });
});
</script>

<script>
function moduleData(){
    return {
        moduleInit(){

        },
        submit(){

        }
    }
}
</script>
@endsection
