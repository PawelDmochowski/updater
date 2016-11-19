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

    public function dropAuthors() {
        $this->dropColumn(config('updater.blueprint.created_by'));
        $this->dropColumn(config('updater.blueprint.updated_by'));
        $this->dropForeign([config('updater.blueprint.created_by'),config('updater.blueprint.updated_by')]);
    }

    public function dropSoftDeleters()
    {
        $this->dropColumn(config('updater.blueprint.deleted_by'));
        $this->dropForeign([config('updater.blueprint.deleted_by')]);
    }
}