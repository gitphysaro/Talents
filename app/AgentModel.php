<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentModel extends Model
{
    //
    protected $table = 'Agents';

    protected $fillable = ['Id_Candidat'];

	
   public function agentEntretien()
    {
        return $this->hasMany('App\Modeles\EntretienTelModel','CRC_Agents_Id');
    }
}
