<?php
class Chambre
{
    //La chambre est liée à UN hotel
    private Hotel $_Hotel;
    //La chambre peut être réservée PLUSIEURS fois
    private array $_reservations = [];
    private int $_numeroChambre;
    private bool $_wifi;
    private bool $_disponibilite;
    private float $_prix;
    private int $_nbLits;
    //private int $_chambresDisponible; 
    //private int $_chambresIndisponible;

    public function __construct(Hotel $Hotel, int $numeroChambre, bool $wifi, float $prix, int $nbLits)
    {
        $this->_Hotel = $Hotel;
        $this->_numeroChambre = $numeroChambre;
        $this->_wifi = $wifi;
        $this->_disponibilite = true;
        $this->_prix = $prix;
        $this->_nbLits = $nbLits;
        $this->_Hotel->ajouterChambre($this);
        //$this->_chambresDisponible = $chambreDisponible;
        //this->_chambresIndisponible = $chambresIndisponible;
    }
//__________________SETTERS
    public function setHotel()
    {

    }
    public function setNumeroChambre(int $numeroChambre)
    {
        $this->_numeroChambre = $numeroChambre;
    }
    public function setWifi()
    {
        $this->_wifi = true;
    }
    public function setDisponibilité($bool)
    {
        $this->_disponibilite = $bool;
    }
/*    public function setChambresDisponible(int $chambreDisponible)
    {
        $this->_chambresDisponible = $chambreDisponible;
    }
    public function setChambresIndisponible(int $chambresIndisponible)
    {
        $this->_chambresIndisponible = $chambresIndisponible;
    }
*/
    // ______________________________GETTERS__________________________
    public function getNumeroChambre() : int
    {
        return $this->_numeroChambre;
    }
    public function getWifi() : bool
    {
        return $this->_wifi;
    }
    public function getDisponibilite() : bool
    {
        return $this->_disponibilite;
    }
/*    public function getChambresDisponibles() : int
    {
        return $this->_chambresDisponible
    }
    public function getChambresIndisponibles() : int
    {
        return $this->_chambresIndisponible
    }
*/
    public function getPrix() : float
    {
        return $this->_prix;
    }
    public function getNbLits() : int
    {
        return $this->_nbLits;
    }
    //_______________________________________METHODESç____________________________
    public function afficherWifi() : string
    {
        if ($this->_wifi)
        {
            $result = "Wifi ON";
            return $result;
        }
        else 
        {
            $result = "Wifi OFF";
            return $result;
        }
    }
    public function afficherDisponibilite() : string
    {
        if ($this->_disponibilite)
        {
            $result = "Chambre disponible";
            return $result;
        }
        else 
        {
            $result = "Chambre indisponible";
            return $result;
        }
    }
    public function infosChambre()
    {
        $result = "Chambre ".$this->_numeroChambre.".<br>";
        $result .= $this->afficherWifi()."<br>";
        $result .= $this->afficherDisponibilite()."<br>";
        return $result;
    }
    public function ajouterReservation(Reservation $reservation)
    {
        $this->_reservations[] = $reservation;
    }
    public function __toString()
    {
        $result = "$this->_numeroChambre";
        return $result;
    }

    /**
     * Get the value of _Hotel
     */ 
    public function get_Hotel()
    {
        return $this->_Hotel;
    }
}