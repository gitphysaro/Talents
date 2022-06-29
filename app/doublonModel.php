<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doublonModel extends Model
{
    protected $table = 'Doublons';
    protected $fillable = ['Id','Nom','Prenom1','Prenom2','Prenom3','Prenom4','Date_Embauche','DureeContrat','Date_FinContrat','Renouvellement_Count',
    'Statut','Fonction','Taux_Horaire','Taux_Horaire_Mn','created_at','updated_at','Centre','updated_by',
    'Date_Naissance','Lieu_Naissance','Telephone1','Telephone2','Adresse','CP','Ville','accessLevel',
    'Nationalite','Date_Demission','Motif_Demission','Etat','Date_creation','Date_fermeture','PotentielDoublons','Id_AModifier','Commentaire','Reintegration','Source','Id_AgentRH'];


}
