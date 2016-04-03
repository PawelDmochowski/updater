<?php
// app/Database/Eloquent/Updater.php

namespace Dmocho\Updater;

use Auth;

trait UpdaterTrait {

    protected static function bootUpdater()
    {
        /*
         * During a model create Eloquent will also update the updated_at field so
         * need to have the updated_by field here as well
         * */ 
        static::creating(function($model) {
            if (Auth::user()) {
                $model->created_by = Auth::user()->id;
                $model->updated_by = Auth::user()->id;
            }
        });
 
        static::updating(function($model)  {
            if (Auth::user()) {
                $model->updated_by = Auth::user()->id;
            }
        });
        /*
         * Deleting a model is slightly different than creating or deleting. For
         * deletes we need to save the model first with the deleted_by field
         * */
        static::deleting(function($model)  {
            if (Auth::user() && isset($model->deleted_by)) {
                $model->deleted_by = Auth::user()->id;
                $model->save();
            }
        });
    }
    
    /**
     * Get responsible the user that created the object.
     */
    public function createdBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * Get responsible the user that modified the object.
     */
    public function modifiedBy()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * Get responsible the user that modified the object.
     */
    public function deletedBy()
    {
        return $this->belongsTo('App\User', 'deleted_by');
    }
}
