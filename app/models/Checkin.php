<?php
  class Checkin extends Eloquent {

    public function Venues()
    {
      return $this->belongsTo('Venue');
    }

    public function Users()
    {
      return $this->belongsTo('Users');
    }
}