<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApartmentCreateMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     * 
     */
    private $description;
    private $image;
    private $beds;
    private $bath;
    private $address;
    private $lat;
    private $lon;
    private $rooms;
    private $square_mt;
    private $ads_expired;
    private $show;
    public function __construct(){

       $this -> description =  $description;
       $this -> image =  $image;
       $this -> beds =  $beds;
       $this -> bath =  $bath;
       $this -> address =  $address;
       $this -> lat =  $lat;
       $this -> lon =  $lon;
       $this -> rooms =  $rooms;
       $this -> square_mt =  $square_mt;
       $this -> ads_expired =  $ads_expired;
       $this -> show =  $show;
       
      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){   
        
        $description = $this -> description;
        $image = $this -> image;
        $beds = $this -> beds;
        $bath = $this -> bath;
        $address = $this -> address;
        $lat = $this -> lat;
        $lon = $this -> lon;
        $rooms = $this -> rooms;
        $square_mt = $this -> square_mt;
        $ads_expired = $this ->ads_expired;
        $show = $this -> show;

        return $this->view('mail.mailcreateapartmentmail' , compact("description" , "image" , "beds" , "bath" , "adress" , "lat" , "lon" , "rooms" , "square_mt" , "ads_expired" , "show"));
    }
}
