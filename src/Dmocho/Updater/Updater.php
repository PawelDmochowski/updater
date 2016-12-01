<?php
// app/Database/Eloquent/Updater.php

namespace Dmocho\Updater;

use Auth;
use Request;

trait Updater {

    static $CREATED_BY = 'created_by';
    static $UPDATED_BY = 'updated_by';
    static $DELETED_BY = 'deleted_by';

    protected static function bootUpdater()
    {
        /*
         * During a model create Eloquent will also update the updated_at field so
         * need to have the updated_by field here as well
         * */ 
        static::creating(function($model) {
            if (Auth::user()) {
                $user = Auth::user();
            } elseif (Request::user()) {
                $user = Request::user();
            }
            if (isset($user)) {
                $model->{config('updater.blueprint.created_by')} = $user->id;
                $model->{config('updater.blueprint.updated_by')} = $user->id;
            }
        });
 
        static::updating(function($model)  {
            if (Auth::user()) {
                $user = Auth::user();
            } elseif (Request::user()) {
                $user = Request::user();
            }
            if (isset($user)) {
                $model->{config('updater.blueprint.updated_by')} = $user->id;
            }
        });
        /*
         * Deleting a model is slightly different than creating or deleting. For
         * deletes we need to save the model first with the deleted_by field
         * */
        static::deleting(function($model)  {
            if (Auth::user()) {
                $user = Auth::user();
            } elseif (Request::user()) {
                $user = Request::user();
            }
            if (isset($user) && isset($model->{config('updater.blueprint.deleted_by')})) {
                $model->{config('updater.blueprint.deleted_by')} = $user->id;
                $model->save();
            }
        });
    }
    
    /**
     * Get responsible the user that created the object.
     */
    public function createdBy()
    {
        return $this->belongsTo(config('updater.model.created_by'), config('updater.blueprint.created_by'));
    }

    /**
     * Get responsible the user that updated the object.
     */
    public function updatedBy()
    {
        return $this->belongsTo(config('updater.model.updated_by'), config('updater.blueprint.updated_by'));
    }

    /**
     * Get responsible the user that modified the object.
     */
    public function deletedBy()
    {
        return $this->belongsTo(config('updater.model.deleted_by'), config('updater.blueprint.deleted_by'));
    }
}
