@extends('layouts/contentLayoutMaster')

@section('title', isset($geoZone->id) ? __('Edit Geo Zone') : __('Create Geo Zone'))

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- Basic Horizontal form layout section start -->
<section>
    <form id="module-form" class="form form-horizontal" method="POST" action="{{ isset($geoZone->id) ? route('admin::geo-zones.update', $geoZone->id) : route('admin::geo-zones.store') }}" novalidate>
        @csrf
        @if(isset($geoZone->id))
            @method('PUT')
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ isset($geoZone->id) ? __('Update Geo Zone') : __('Create Geo Zone') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="name">{{ __('Name') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="name" class="form-control @error('name') error @enderror" name="name" placeholder="{{ __('Name') }}" value="{{ old('name', $geoZone->name) }}" />
                                        @error('name')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="description">{{ __('Description') }}</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea rows="3" id="description" class="form-control @error('description') error @enderror" name="description" placeholder="{{ __('Description') }}">{{ old('description', $geoZone->description) }}</textarea>
                                        @error('description')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Geo Zones') }}</h4>
                    </div>
                    <div class="card-body" x-data="geoZoneState()">
                        <template x-for="(geoZone, index) in $store.geoZones.items" :key="`geo-zone-${geoZone.id}`">
                            <div class="row" x-data="geoZoneRow(geoZone, index)" x-init="geoZoneRowInit()">
                                <div class="col-sm-5">
                                    <div class="mb-1 row">
                                        <div class="col-12">
                                            <label class="col-form-label" for="country">{{ __('Country') }}</label>
                                            <select class="select2 form-select" x-model="$store.geoZones.items[index].countryId" x-bind:name="`geoZones[${index}][countryId]`">
                                                <option value="0" disabled selected>{{ __('Select Country') }}</option>
                                                @foreach($countries as $option_country)
                                                    <option value="{{ $option_country->id }}">{{ $option_country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="mb-1 row">
                                        <div class="col-12">
                                            <label class="col-form-label" for="zone">{{ __('Zone') }}</label>
                                            <select x-ref="select-zone-id" class="select2 form-select" x-model="$store.geoZones.items[index].zoneId" x-bind:name="`geoZones[${index}][zoneId]`">
                                                <option value="0">{{ __('All Zones') }}</option>
                                                <template x-for="(zone, index) in $store.geoZones.items[index].zones">
                                                    <option x-bind:value="zone.id" x-text="zone.name"></option>
                                                </template>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="mb-1 row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="d-block">&nbsp;</label>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-danger" x-on:click="deleteGeoZone">
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-icon btn-primary" type="button" data-repeater-create x-on:click="addGeoZone()">
                                    <i data-feather="plus" class="me-25"></i>
                                    <span>Add New</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary me-1">
                    {{ isset($geoZone->id) ? __('Save') : __('Create') }}
                </button>
            </div>
        </div>
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
    $('#module-form').validate({
        rules: {
            'name': {
                required: true
            },
            'description': {
                required: true
            },
        }
    });
});
</script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('geoZones', {
            items: JSON.parse(`{!! isset($geoZone->id) ? $geoZone->zones->map(fn($zone) => ["id" => $zone->pivot->id,"countryId" => $zone->pivot->country_id, "zoneId" => $zone->pivot->zone_id])->toJson() : collect([])->toJson() !!}`),
            loadedZones: [],
            addGeoZone() {
                this.items.push({
                    id: "id_" + Math.random().toString(16).slice(2),
                    countryId: 0,
                    zoneId: 0,
                    zones: [],
                })
            },
            deleteGeoZone(geoZone) {
                let index = this.items.findIndex(_ => _.id == geoZone.id)
                this.items.splice(index, 1)
            }
        })
    })
</script>
<script>
    const geoZoneState = () => ({
        addGeoZone() {
            this.$store.geoZones.addGeoZone();
        },
    })

    const geoZoneRow = (geoZone, index) => ({
        geoZone: geoZone,
        async geoZoneRowInit() {
            this.$watch(`geoZone.countryId`, () => {
                if(this.geoZone.countryId) {
                    this.getZonesByCountry(this.geoZone.countryId)
                }
                this.geoZone.zoneId = 0
            })
            if(this.geoZone.countryId)
                await this.getZonesByCountry(this.geoZone.countryId)
            $(this.$refs['select-zone-id']).val(this.geoZone.zoneId)
        },
        async getZonesByCountry() {
            // check if zone is already loaded
            let countryZones = this.$store.geoZones.loadedZones.find(_ => _.countryId == this.geoZone.countryId)
            if(countryZones) {
                this.geoZone.zones = countryZones.zones
                return;
            }

            var url = `route('admin::zones-by-country', ":id") }}`
            url = url.replace(':id', this.geoZone.countryId);
            let response = await fetch(url)
            let json = await response.json()
            this.geoZone.zones = json.data
            this.$store.geoZones.loadedZones.push({ countryId: this.geoZone.countryId, zones: json.data })
        },
        deleteGeoZone() {
            if(!confirm("Are you sure to delete?"))
                return
            this.$store.geoZones.deleteGeoZone(this.geoZone)
        }
    })
</script>
@endsection
