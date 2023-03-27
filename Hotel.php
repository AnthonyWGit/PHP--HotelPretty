
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
    private array $_chambresDispo;
    private array $_reservations;
    public function __construct(string $nomHotel, string $nomRue, string $numeroRue, string $codePostal, string $ville)
    {
        $this->_nomHotel = $nomHotel;
        $this->_nomRue = $nomRue;
        $this->_numeroRue = $numeroRue;
        $this->_codePostal = $codePostal;
        $this->_ville = $ville;
        $this->_chambres = [];
        $this->_chambresDispo = [];
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
    public function getNomHotel() : string
    {
        return $this->_nomHotel ;
    }
    public function getNumeroRue() : string
    {
        return $this->_numeroRue ;
    }
    public function getNomRue() : string
    {
        return $this->_nomRue ;
    }
    public function getCodePostal() : string
    {
        return $this->_codePostal ;
    }
    public function getVille() : string
    {
        return $this->_ville ;
    }
    public function getChambresDispo() : array
    {
        return $this->_chambresDispo;
    }
    //____________________________________________________

    public function ajouterChambre(Chambre $chambre)
    {
        $this->_chambres[] = $chambre;
    }
    /* Chambres disponibles = création d'un array associatif constitué uniquement de 
    $_chambresDispo [] = $chambre => $disponibilité OU
    compter le nombre de chambres totales - le nombre de réservations*/
    public function ajouterChambreDispo(Chambre $chambreDispo)
    {
        $this->_chambresDispo[] = $chambreDispo;
    }
 
    public function ajouterReservation(Reservation $reservation)
    {
        $this->_reservations[] = $reservation;
    }
 
    public function afficherChambres() : string
    {
        $result = "<h3>Chambres de l'hôtel ".$this->_nomHotel." ".$this->_ville. " </h3><br>";
        $result .="<table>";
        $result .="<tr><th>Numéro de chambre</th><th>Wifi</th><th>Disponibilité</th><th>Prix</th></tr>";
        foreach ($this->_chambres as $chambre)
        {
            $result .="<tr>";
            $result .="<td>Chambre numéro ".$chambre->getNumeroChambre()."</td>";
            if ($chambre->getWifi(true))
            {
                $result .="<td>".$chambre->afficherWifi()."  <i class='bi bi-wifi'></i></td>";
            }
            else
            {
                $result.="<td>".$chambre->afficherWifi()." <i class='bi bi-emoji-frown-fill'></i></td>";
            }
            $result .="<td>".$chambre->afficherDisponibilite()."</td>";
            $result .="<td>".str_replace(".",",",$chambre->getPrix())." $</td>";
            $result .="</tr>";
        }
        $result .="</table>";
        return $result;
    }
    public function infosHotel() : string
    {
        $soustraction = count($this->_chambres) - count($this->_chambresDispo);
        $result = "<h3>Hotel ".$this->_nomHotel ." ".$this->_ville." </h3><br>";
        $result .= $this->_numeroRue. " ".$this->_nomRue." ".$this->_ville. " ".$this->_codePostal." <br>";
        $result .= "Nombre de chambres : ".count($this->_chambres)." <br>"; //count pour compter les éléments dans un array
        $result .= "Nombre de chambres dispo : ".count($this->_chambresDispo) ."<br>";
        if ($soustraction = 1)
        {
            $result .= "Chambre réservée : ".$soustraction."<br><br>";
        }
        else
        {
            $result .= "Chambres réservées : ".$soustraction."<br><br>";
        }
        return $result;
    }
    public function infosReservation() 
    {
        $result = "<h5>Réservations de l'hôtel ".$this->_nomHotel." ".$this->_ville. " </h5>";
        if (empty($this->_chambres)== false)
        {
            if ($this->_chambres == $this->_chambresDispo)
            {
                $result .= "Il n'y a aucune réservation.";
            }
            else
            {
                $result .= count($this->_reservations). " réservations <br>";
                foreach ($this->_reservations as $reservation)
                {
                    $result.="<strong>".$reservation->getClient(). "</strong> | Chambre ". $reservation->getChambre()." | ";
                    $result.= "du ".$reservation->getArrivee(). " au ".$reservation->getDepart() ."<br><br>"; 
                }
            }
        }   
        else
        {
            $result .= "<br>Cet hotel est délabré et n'a plus de chambres.<br>";
        }
    return $result;
    }
    public function __toString()
    {
        $result = $this->_nomHotel. " ".$this->_ville;
        return $result;
    }
}