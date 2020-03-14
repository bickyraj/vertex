<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ActivityDestination extends Pivot
{
	protected $guarded = ['id'];
}
