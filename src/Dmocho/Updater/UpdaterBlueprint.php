<?php 

namespace Dmocho\Updater;

class UpdaterBlueprint extends \Illuminate\Database\Schema\Blueprint
{
    public function authors()
    {
        $this->integer(config('updater.blueprint.created_by'))->unsigned()->nullable();
        $this->integer(config('updater.blueprint.updated_by'))->unsigned()->nullable();

        $this->foreign(config('updater.blueprint.created_by'))->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
        $this->foreign(config('updater.blueprint.updated_by'))->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
    }

    public function softDeleters()
    {
        $this->integer(config('updater.blueprint.deleted_by'))->unsigned()->nullable();
        $this->foreign(config('updater.blueprint.deleted_by'))->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
    }
}