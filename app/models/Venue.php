<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Venue extends Eloquent {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'venues';

  public function Checkins()
  {
    return $this->has_many('Checkins');
  }
}