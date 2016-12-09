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
    public function withSuccess(array $data, $key = 'default')
    {
        session()->flash(
            'success', session()->put($key, $data)
        );
        return $this;
    }
}