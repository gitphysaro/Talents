<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = 'Employe';

protected $fillable = ['CRC_Agents_Id','Nom','Prenom','Prenom2','Prenom3','Prenom4','Statut','Fonction','Date_Naissance','Lieu_Naissance','Telephone1','Telephone2',
'Adresse','CP','Ville','Nationalite','Centre' ,'Taux_Horaire','Taux_Horaire_Mn',
'created_by','updated_by','Actif','created_at','updated_at',
'Date_Demission','Motif_Demission','Date_Embauche','DureeContrat','Date_FinContrat','Renouvellement_Count','Situation_mat','Numero_Compte',
'PN_Pere','PN_Mere','Etablissement','Emploi_ref','Categorie','Type_Identification','Numero_Identification'];


    
}