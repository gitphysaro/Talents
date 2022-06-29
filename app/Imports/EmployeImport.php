<?php

namespace App\Imports;

use App\Employe;
use DateTime;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    /*HeadingRowFormatter::extend('custom', function($value) {
    return 'do-something-custom' . $value; 
});*/
/*public $model = Employe::class;
public $header = [
        'CRC_Agents_Id',  'Nom', 'Prenom','Date_Embauche', 'Fonction', 'Statut', 'Taux_Horaire', 'Taux_Horaire_Mn'
    ];
    
    public $verifyHeader = true; // Header verification toggle
    
    public $truncate = true; // We want to truncate table before the import
    */
    public function model(array $row)
    {
        $dt = new DateTime();
        //return new $this->model($row);
        return new Employe([
              'CRC_Agents_Id' => $row[0],
              'Nom' => $row[1],
                            'Prenom' =>  $row[2],
                            'Date_Embauche' =>  $row[3],
                            'Fonction' =>  $row[4],
                            'Statut' =>  $row[5],
                            'Taux_Horaire' =>  $row[6],
                            'Taux_Horaire_Mn' =>  $row[7],
                            'created_at'=>  $dt->format('Y-m-d H:i:s'),
                            'updated_at'=>  $dt->format('Y-m-d H:i:s')

            /*'CRC_Agents_Id' => $row['CRC_Agents_Id'],
              'Nom' => $row['Nom'],
                            'Prenom' =>  $row['Prenom'],
                            'Date_Embauche' =>  $row['Date_Embauche'],
                            'Fonction' =>  $row['Fonction'],
                            'Statut' =>  $row['Statut'],
                            'Taux_Horaire' =>  $row['Taux_Horaire'],
                            'Taux_Horaire_Mn' =>  $row['Taux_Horaire_Mn'],
                            'created_at'=>  $dt->format('Y-m-d H:i:s'),
                            'updated_at'=>  $dt->format('Y-m-d H:i:s')*/

        ]);
    }


     //  public function headingRow(): int
     // {
     //     return 1;
     // }
}
