<?php

namespace Api\Users\Models;

use Infrastructure\Database\Eloquent\Model;

use Api\Users\Models\Trip;

class Feedback extends Model
{
   protected $fillable = [
      'trip_id',
      'comment',
      'rating'
   ];

   public $timestamps = [
       'created_at',
       'updated_at'
   ];

   public function trips()
   {
       return $this->belongsTo(Trip::class, 'id', 'trip_id');
   }
}