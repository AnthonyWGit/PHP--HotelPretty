<?php
class Hotel
{
    private string $_nomHotel;
    private string $_nomRue;
    private string $_numeroRue;
    private string $_codePostal;
    private string $_ville;
    // un hotel a plusieurs chambres
    private array $_chambres;
    // private array $_chambresDispo; 
    private array $_reservations;
    public function __construct(string $nomHotel, string $nomRue, string $numeroRue, string $codePostal, string $ville)
    {
        $this->_nomHotel = $nomHotel;
        $this->_nomRue = $nomRue;
        $this->_numeroRue = $numeroRue;
        $this->_codePostal = $codePostal;
        $this->_ville = $ville;
        $this->_chambres = [];
        $this->_reservations = [];
    }
    //SETTERS
    public function setNomHotel(string $nomHotel)
    {
        $this->_nomHotel = $nomHotel;
    }
    public function setNomRue(string $nomRue)
    {
        $this->_nomRue = $nomRue;
    }
    public function setNumeroRue(string $numeroRue)
    {
        $this->_numeroRue = $numeroRue;
    }
    public function setCodePostal(string $codePostal)
    {
        $this->_codePostal = $codePostal;
    }
    public function setVille(string $ville)
    {
        $this->_ville = $ville;
    }

    // __________________GETTERS_________________________
    public function getNomHotel(): string
    {
        return $this->_nomHotel;
    }
    public function getNumeroRue(): string
    {
        return $this->_numeroRue;
    }
    public function getNomRue(): string
    {
        return $this->_nomRue;
    }
    public function getCodePostal(): string
    {
        return $this->_codePostal;
    }
    public function getVille(): string
    {
        return $this->_ville;
    }

    //____________________________________________________

    public function ajouterChambre(Chambre $chambre)
    {
        $this->_chambres[] = $chambre;
    }
    /* Chambres disponibles = création d'un array associatif constitué uniquement de 
    $_chambresDispo [] = $chambre => $disponibilité OU
    compter le nombre de chambres totales - le nombre de réservations*/

    public function ajouterReservation(Reservation $reservation)
    {
        $this->_reservations[] = $reservation;
    }

    public function afficherChambres()  //Ci-dessous exemple de bonne écriture PHP/HTML
    {
        ?>
        <h3>Chambres de l'hôtel
            <?= $this->_nomHotel ?>
            <?= $this->_ville ?>
        </h3><br>
        <table>
            <tr>
                <th>Chambre</th>
                <th>Wifi</th>
                <th>Disponibilité</th>
                <th>Prix</th>
            </tr>

            <?php
            foreach ($this->_chambres as $chambre) {
                $wifi = ($chambre->getWifi()) ? 'bi bi-wifi' : 'bi bi-emoji-frown-fill';    //Si la chambre a du wifi mettre "bi bi-wifi" dans $wifi sinon mettre 'bi bi-emoji-frown-fill'
                ?>
                <tr>
                    <td>Chambre numéro
                        <?= $chambre->getNumeroChambre() ?>
                    </td>

                    <td><i class="<?= $wifi ?>"></i></td>
                    <td>
                        <?= $chambre->afficherDisponibilite() ?>
                    </td>
                    <td>
                        <?= str_replace(".", ",", $chambre->getPrix()) ?>
                    </td>
                </tr>


                <?php
            }
            ?>
        </table>

        <?php

    }

    public function NbChambresDisponible()
    {
        foreach($this->_chambres as $chambreDispo)
        {
            if ($chambreDispo->getDisponibilite() == false)
            {
                $test[] = $chambreDispo;
            }
            else
            {

            }
        }
        return $test;
    }
    // Pour afficher les chambres disponibles et les chambres réservées on peut utiliser deux façons différentes
    public function infosHotel(): string
    {
        $soustraction = count($this->_chambres) - count($this->_reservations); 
        $result  = "<h3>Hotel " . $this->_nomHotel . " " . $this->_ville . " </h3><br>";
        $result .= $this->_numeroRue . " " . $this->_nomRue . " " . $this->_ville . " " . $this->_codePostal . " <br>";
        $result .= "Nombre de chambres : " . count($this->_chambres) . " <br>"; //count pour compter les éléments dans un array
        $result .= "Nombre de chambres dispo : " . $soustraction. " ". count($this->NbChambresDisponible()) . "<br>";
        if ($soustraction == 1) {
            $result .= "Chambre réservée : " . count($this->_reservations) ." ". (($this->NbChambresDisponible()) - ($this->_chambres)) ."<br><br>";
        } else {
            $result .= "Chambres réservées : " . count($this->_reservations) ." ". count($this->_chambres) - count($this->NbChambresDisponible()) . "<br><br>";
        }
        return $result;
    }
    public function infosReservation()
    {
        $result = "<h5>Réservations de l'hôtel " . $this->_nomHotel . " " . $this->_ville . " </h5>";
        if (empty($this->_chambres) == false) {
             if (count($this->_chambres) == (count($this->_chambres) - count($this->_reservations))) {
                 $result .= "Il n'y a aucune réservation.";
             } else {
                 $result .= count($this->_reservations) . " réservations <br>";
                 foreach ($this->_reservations as $reservation) {
                     $result .= "<strong>" . $reservation->getClient() . "</strong> | Chambre " . $reservation->getChambre() . " | ";
                     $result .= "du " . $reservation->getArrivee() . " au " . $reservation->getDepart() . "<br><br>";
                 }
             }
        } else {
            $result .= "<br>Cet hotel est délabré et n'a plus de chambres.<br>";
        }
        return $result;
    }
    public function __toString()
    {
        $result = $this->_nomHotel . " " . $this->_ville;
        return $result;
    }
}