<?php 

namespace Dmocho\Updater;

class UpdaterBlueprint extends \Illuminate\Database\Schema\Blueprint
{
    public function authors()
    {
        $this->integer('created_by')->unsigned()->nullable();
        $this->integer('updated_by')->unsigned()->nullable();

        $this->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
        $this->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
    }

    public function softDeleters()
    {
        $this->integer('deleted_by')->unsigned()->nullable();
        $this->foreign('deleted_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
    }
}