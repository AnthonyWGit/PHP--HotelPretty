<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet/stylesheet.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css'>    
    <title>Document</title>
</head>
    <body>
        <div class="wrapper">
<?php
//Fichiers classe
spl_autoload_register(function ($class) {
    include $class . '.php';
});
$result = "";
//Instancier des hotels
$ibisStbg = new Hotel("Ibis", "Rue de la Fonderie", "9", "67540", "Oswtald");
$paxHotelParis = new Hotel("Pax","Rue Simart", "7", "75018", "Paris");
$hotelF1 = new Hotel("F1", "j.M Tjibaou"," 205", "84000", "Avignon");
//Instancier des client(e)s
$marieGeorges = new Client("Georges","Marie","50", "Femme");
$cantalCharleot = new Client("Cantal","Charlot","43","Homme");
//Instancier des chambres 
$chambre1 = new Chambre($ibisStbg, 1, false,  200.99, 2);
$chambre2 = new Chambre($ibisStbg, 2, true, 50, 1);
$chambre3 = new Chambre($ibisStbg, 3, false,  200.99, 2);
$chambre4 = new Chambre($ibisStbg, 4, true, 50, 1);
$chambre5 = new Chambre($ibisStbg, 5, false,  200.99, 2);
$chambre6 = new Chambre($ibisStbg, 6, true, 50, 1);
$chambre7 = new Chambre($ibisStbg, 7, false, 50, 1);
$chambre8 = new Chambre($paxHotelParis, 7, false,  50, 1);
$chambre9 = new Chambre($paxHotelParis, 7, false,  50, 1);
$chambre10 = new Chambre($paxHotelParis, 10, true, 3888, 4);
//Instancier des réservations
$reservation2 = new Reservation("09 mai 2023", "13 mai 2023", $marieGeorges, $chambre1);
$reservation1 = new Reservation("02 mai 2023", "05 mai 2023", $marieGeorges, $chambre1);
$reservation3 = new Reservation("16 mai 2023", "19 mai 2023", $marieGeorges, $chambre5);
$reservation4 = new Reservation("25 juin 2020", "30 juin 2020",$cantalCharleot,$chambre7);
/*
echo $marieGeorges ->getNomClient();
echo $ibisStbg->getVille();
echo $chambre1->afficherWifi();                      TESTS USELESS
echo $chambre1->afficherDisponibilite();
*/
echo $ibisStbg->afficherChambres();
/* echo $chambre1->infosChambre();
echo $chambre2->infosChambre();
*/
echo $ibisStbg->infosHotel();
echo $marieGeorges->afficherReservationDuClient();
echo $ibisStbg->infosReservation();
echo $paxHotelParis->infosReservation();
echo $hotelF1->infosReservation();  
?>

        </div>
    </body>
</html>