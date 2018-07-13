<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    
 protected $fillable = array(		
			'name','slug'
        );


        public function users()
        {
           return $this->hasMany(User::class);
        }
        

}
