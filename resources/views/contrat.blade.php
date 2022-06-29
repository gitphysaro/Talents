<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Contrat | {{ $NOM  ?? ''}}</title>
<style> 
 .footer{
    position: absolute; 
    bottom: 0cm; 
    height: 0.7cm;
    width:100%;
    color: #616566;
    text-align: right; 
}
 </style> 
 </head>
<body style="background:white;">
<?php setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro'); ?>
<div class="header">
<p style="text-align: center;font-size: 23px;font-weight: bold;margin-top: 40px;"><u>CONTRAT DE STAGE</u></p>
<p style="text-align: left;font-size: 18px;font-weight: bold;"><u>Entre les soussignés</u> :</p>
<p style="text-align: left;font-size: 15px;">La Société <b>CENTRE DE LA RELATION CLIENT SAS</b>
sise à Dakar (Sénégal), Point E, Bld du Sud x Rue des Ecrivains, Immeuble EPI, représentée par 
<b>Monsieur Pape Abdoulaye BARRY</b> dûment habilité aux fins du présent contrat.</p>

<p style="text-align: left;font-size: 18px;font-weight: bold; margin-left: 500px;"><i> D'une part,</i></p>

<p style="text-align: left;font-size: 15px;">Et</p>
@if($SEXE == 'Femme')
<p style="text-align: left;font-size: 18px;font-weight: bold;">Mademoiselle {{ $PRENOM  ?? ''}} {{ $NOM  ?? ''}}</p>
@else
<p style="text-align: left;font-size: 18px;font-weight: bold;">Monsieur {{ $PRENOM  ?? ''}} {{ $NOM  ?? ''}}</p>
@endif

@if($NAISSANCE)
<p style="text-align: left;font-size: 15px;">Née le : <?php setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro'); echo ucwords(strftime('%d %B %Y',strtotime($NAISSANCE)));?> à {{ $LIEU  ?? ''}}</p>
@else
<p style="text-align: left;font-size: 15px;">Née le : </p>
@endif
<p style="text-align: left;font-size: 15px;">Fille de : {{ $PERE  ?? ''}} {{ $MERE  ?? ''}}</p>
@if($SEXE == 'Femme')
<p style="text-align: left;font-size: 15px;">Sexe : Féminin</p>
@elseif($SEXE == 'Homme')
<p style="text-align: left;font-size: 15px;">Sexe : Masculin</p>
@else
<p style="text-align: left;font-size: 15px;">Sexe : </p>
@endif
<p style="text-align: left;font-size: 15px;">Nationalité : {{ $NATIONALITE  ?? ''}}</p>
<p style="text-align: left;font-size: 15px;">Stagiaire diplômée de : {{ $ETAB  ?? ''}}</p>
<p style="text-align: left;font-size: 15px;">Emploi de référence de la stagiaire : {{ $REF  ?? ''}}</p>
<p style="text-align: left;font-size: 15px;">Catégorie : {{ $CATEGORIE  ?? ''}}</p>
<p style="text-align: left;font-size: 15px;">N° {{ $TYPE  ?? ''}} : {{ $NUMERO  ?? ''}}</p>
<p style="text-align: left;font-size: 15px;">Résidant habituellement à {{ $ADRESSE  ?? ''}} </p>

<p style="text-align: left;font-size: 15px;">Ci-après dénommé « l’agent » qui déclare être libre de tout engagement.</p>
<p style="text-align: left;font-size: 18px;font-weight: bold; margin-left: 500px;"><i> D'autre part,</i></p>
<p style="text-align: left;font-size: 18px;font-weight: bold;"><u>Il a été convenu ce qui suit</u> :</p>
<p style="text-align: left;font-size: 15px;">Conformément aux dispositions du Décret n°2015-777 fixant les règles applicables au contrat de stage. </p>
<p style="text-align: center;font-size: 18px;font-weight: bold;"><u>ENGAGEMENT DE L’ENTREPRISE</u></p>
<p style="text-align: left;font-size: 15px;">La Société <b>CENTRE DE LA RELATION CLIENT SAS</b> décide d’encadrer 
@if($SEXE == 'Femme')
<b>Mademoiselle {{ $PRENOM  ?? ''}} {{ $NOM  ?? ''}}</b>
@else
<b>Monsieur {{ $PRENOM  ?? ''}} {{ $NOM  ?? ''}}</b>
@endif
 et de lui faciliter l’intégration dans le monde du travail.
</p>
<p style="text-align: left;font-size: 15px;">Elle s’engage à délivrer à la stagiaire en fin de stage un certificat constatant l’exécution du présent contrat.</p>
<p style="text-align: center;font-size: 18px;font-weight: bold;"><u>OBLIGATIONS DE LA STAGIAIRE</u></p>
<p style="text-align: left;font-size: 15px;">
@if($SEXE == 'Femme')
<b>Mademoiselle {{ $PRENOM  ?? ''}} {{ $NOM  ?? ''}}</b>
@else
<b>Monsieur {{ $PRENOM  ?? ''}} {{ $NOM  ?? ''}}</b>
@endif

sera soumise au règlement intérieur de l’entreprise et aux ordres de la hiérarchie.</p>
<p style="text-align: left;font-size: 15px;">Elle s’engage à suivre assidûment le programme de stage.</p>

<p style="text-align: center;font-size: 18px;font-weight: bold;"><u>DUREE DU CONTRAT</u></p>
<p style="text-align: left;font-size: 15px;">Le présent contrat est signé pour une durée de six (06) mois à compter du 
<?php setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro'); echo ucwords(strftime("%d %B %Y",strtotime($DEBUT)));?>
 et se termine le 
<?php setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro'); echo ucwords(strftime("%d %B %Y",strtotime($FIN)));?>.</p>

<p style="text-align: center;font-size: 18px;font-weight: bold;"><u>OPTION D’EMBAUCHE</u></p>
<p style="text-align: left;font-size: 15px;">L’entreprise pourra faire signer à la stagiaire au début de son séjour une option d’embauche à l’issue de sa formation, sur la base des critères de recrutement définis par la convention collective.
</p>


<p style="text-align: center;font-size: 18px;font-weight: bold;"><u>PRESTATIONS ALLOUEES A LA STAGIAIRE</u></p>
<p style="text-align: left;font-size: 15px;">La stagiaire sera tenue de respecter les horaires définis par l’entreprise dans la limite des 173,33 heures par mois. Il sera accordé à la stagiaire une indemnité mensuelle de cent trois mille cinq cent huit francs (<b>103.508</b>) FCFA.</p>

<p style="text-align: center;font-size: 18px;font-weight: bold;"><u>FORMATION COMPLEMENTAIRE</u></p>
<p style="text-align: left;font-size: 15px;">La stagiaire pourra bénéficier d’une formation complémentaire dont les horaires seront définis en rapport avec son employeur.</p>

<p style="text-align: center;font-size: 18px;font-weight: bold;"><u>RUPTURE DU CONTRAT</u></p>
<p style="text-align: left;font-size: 15px;">Le contrat prendra fin à l’expiration de la durée fixée pour son exécution. Avant ce délai, il peut prendre fin dans les conditions fixées par la réglementation en vigueur notamment :</p>
<p style="text-align: left;font-size: 15px;">&nbsp;&nbsp;&nbsp;&nbsp;- D’accord parties constaté par écrit ;</p>
<p style="text-align: left;font-size: 15px; margin-top:-5px;">&nbsp;&nbsp;&nbsp;&nbsp;- En cas de force majeure ;</p>
<p style="text-align: left;font-size: 15px; margin-top:-5px;">&nbsp;&nbsp;&nbsp;&nbsp;- En cas de faute lourde;</p>
<p style="text-align: left;font-size: 15px; margin-top:-5px;">&nbsp;&nbsp;&nbsp;&nbsp;- A l’initiative de l’une des parties.</p>
	

<p style="text-align: center;font-size: 18px;font-weight: bold;"><u>REFERENCES AUX TEXTES APPLICABLES</u></p>
<p style="text-align: left;font-size: 15px;">Le présent contrat est soumis aux dispositions des textes suivants :</p>
<p style="text-align: left;font-size: 15px;">&nbsp;&nbsp;&nbsp;<img style="width: 12px;height:12px;" src="images/check.jpg"/>&nbsp;La loi 97-17 du 1er décembre 1997 portant Code du Travail, modifié ;</p>
<p style="text-align: left;font-size: 15px; margin-top:-5px;">&nbsp;&nbsp;&nbsp;<img style="width: 12px;height:12px;" src="images/check.jpg"/>&nbsp;Décret 2015- 777 du 02 juin 2015 fixant les règles applicables au contrat de stage;</p>
<p style="text-align: left;font-size: 15px; margin-top:-5px;">&nbsp;&nbsp;&nbsp;<img style="width: 12px;height:12px;" src="images/check.jpg"/>&nbsp;Convention Collective Nationale Interprofessionnelle (CCNI);</p>
<p style="text-align: left;font-size: 15px; margin-top:-5px;">&nbsp;&nbsp;&nbsp;<img style="width: 12px;height:12px;" src="images/check.jpg"/>&nbsp;Convention Collective du Commerce.</p>


<p style="text-align: center;font-size: 18px;font-weight: bold;"><u>LITIGE</u></p>
<p style="text-align: left;font-size: 15px;">Les litiges nés de l’exécution du contrat de stage sont réglés conformément à la législation du travail.</p>


<p style="text-align: right; font-size:15px;margin-top: 4px;">
        Dakar, le <?php setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro'); echo ucwords(strftime("%d %B %Y"));?>
        </p>
</div>
<p style="text-align: left;font-size: 18px;font-weight: bold;"><u>LA STAGIAIRE</u></p>
<p style="text-align: right;font-size: 18px;font-weight: bold;margin-top: -50px;"><u>L’EMPLOYEUR</u></p>
<p style="text-align: center;font-size: 18px;font-weight: bold;"><u>VISA INSPECTION DU TRAVAIL</u></p>
<!-- <div class="footer">   
        <p style="font-size:14px;font-weight: bold;margin-top: 4px;">
        Dakar, le <?php echo date("d/M/Y");  ?>
        </p>
  </div>    -->
</body>
</html>