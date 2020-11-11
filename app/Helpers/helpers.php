<?php


namespace App\Helpers;

use Carbon\Carbon;

if(! function_exists('removeAccent')) {
    function removeAccent($attribut) {
        return strtr($attribut,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY') ;
    }
}

if(! function_exists('carbon')) {
    function carbon() {
        return new Carbon();
    }
}
