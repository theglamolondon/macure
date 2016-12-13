<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 06/12/2016
 * Time: 21:51
 */

namespace App\Http;


use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

trait HelperFunctions
{
    public function withSuccess($message)
    {
        //session()->flush();
        $messageBag = session()->has('status') ? session()->get('status') : new MessageBag() ;

        if(is_array($message)){
            foreach ($message as $value){
                $messageBag->add('success',$value);
            }
        }elseif(is_string($message)){
            $messageBag->add('success',$message);
        }
        //dd($messageBag);
        session()->flash('status',$messageBag);
        return $this;
    }
}