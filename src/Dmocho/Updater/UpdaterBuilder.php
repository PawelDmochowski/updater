<?php

namespace Dmocho\Updater;

use Illuminate\Database\Schema\Builder;

class UpdaterBuilder extends Builder {
	protected function createBlueprint($table, Closure $callback = null)
	{
		return new UpdaterBlueprint($table, $callback);
	}
}
