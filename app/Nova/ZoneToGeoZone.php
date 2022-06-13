<?php

namespace App\Nova;

use App\Models\Zone;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class ZoneToGeoZone extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ZoneToGeoZone::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
    * Indicates if the resource should be displayed in the sidebar.
    *
    * @var bool
    */
    public static $displayInNavigation = false;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Country'),
            BelongsTo::make('Zone')->exceptOnForms(),
            Select::make('Zone', 'zone_id')->dependsOn(['country'], function(Select $field, NovaRequest $request, FormData $formData) {
                $options = Zone::where('country_id', $formData->country)->pluck('name', 'id');
                $field->options($options);
            })->onlyOnForms(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        if(!empty($request->input('viaResource')) && !empty($request->input('viaResourceId'))) {
            return '/resources/'.$request->input('viaResource').'/'.$request->input('viaResourceId');
        }
        return '/resources/'.static::uriKey().'/'.$resource->getKey();
    }

    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        if(!empty($request->input('viaResource')) && !empty($request->input('viaResourceId'))) {
            return '/resources/'.$request->input('viaResource').'/'.$request->input('viaResourceId');
        }

        return '/resources/'.static::uriKey().'/'.$resource->getKey();
    }
}
