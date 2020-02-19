<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApartmentUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
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
    public function build()
    {
        return $this->view('mail.updateroommail' , compact("description" , "image" , "beds" , "bath" , "adress" , "lat" , "lon" , "rooms" , "square_mt" , "ads_expired" , "show"));
    }
}
