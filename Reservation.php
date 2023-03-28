<?php
class Reservation
{
    //Regarder booking.com pour mieux visualiser
    private string $_dateArrivee;
    private string $_dateDepart;
    //Un client fait UNE réservation
    private Client $_client; // pour afficher qui a fait la réservation : _c
    private Hotel $_hotel; //pour afficher quel hotel on a réservé 
    private Chambre $_chambre; //pour afficher quelle chambre on réserve 
    public function __construct(string $dateArrivee, string $dateDepart, Client $client, Chambre $chambre)
    {
        $this->_dateArrivee = $dateArrivee;
        $this->_dateDepart = $dateDepart;
        $this->_hotel =  $chambre->get_hotel();
        $this->_chambre = $chambre;
        $this->_client = $client;
        $this->_client->ajouterReservation($this);
        $this->_hotel->ajouterReservation($this);
        $this->_chambre->ajouterReservation($this);
        $this->_chambre->setDisponibilité(false);
    }
    //______________________SETTERS_________________________________
    public function setDepart(string $dateDepart) 
    {
        $this->_dateDepart = $dateDepart;
    }
    public function setArrivee(string $dateArrivee)
    {
        $this->_dateArrivee = $dateArrivee;
    }
    public function setClient(Client $client)
    {
        $this->_client = $client;
    }
//________________________________GETTERS_____________________

    public function getDepart() : string
    {
        return $this->_dateDepart;
    }
    public function getArrivee() : string
    {
        return $this->_dateArrivee;
    }
    public function getClient() : Client
    {
        return $this->_client;
    }
    public function getChambre() : Chambre
    {
        return $this->_chambre;
    }
    public function getHotel() : Hotel
    {
        return $this->_hotel;
    }
    public function __toString()
    {
        $result =" -----</em> Chambre ".$this->_chambre." ( ".$this->getChambre()->afficherWifi();
        $result.=" ~ ".$this->getChambre()->getNbLits()." Lits ~ ". $this->getChambre()->getPrix(). "$) ***";
        $result .= " du " . $this->_dateArrivee. " au ".$this->_dateDepart. "<br>";
        return $result;
    }
}