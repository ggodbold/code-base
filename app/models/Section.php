<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Section extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'sections';

	public function page() {
		return $this->belongsTo('Page');
	}

	public function sectionType() {
		return $this->belongsTo('SectionType');
	}

	public function parent() {
		return $this->hasOne('Section');
	}
}
