<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntretienTelModel extends Model
{
    protected $table = 'EntretienTelephonique';
    
    public function agent()
	{
	    return $this->belongsTo('App\Modeles\AgentModel', 'CRC_Agents_Id','CRC_Agents_Id');
	}
}
