<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class logModel extends Model
{
    protected $table = 'LOGS';

    protected $fillable = ['ID','ACTION','DETAILS','ETAT','ADRESSE_IP','PRENOM_NOM','created_by','created_at','updated_at'];
}
