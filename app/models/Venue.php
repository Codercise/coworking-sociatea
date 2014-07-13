<?php

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