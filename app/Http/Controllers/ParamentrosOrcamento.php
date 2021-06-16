<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class ParamentrosOrcamento extends Controller
{
    public static function paramentros()
    {
        $volume_lata = 0.018;
        $area_reboco = 35;
        $concreto = [
            "areia" => $volume_lata * 4 * 7.142857143,
            "pedra" => $volume_lata * 5.5 * 7.142857143,
            "saco_cimento" => 7.142857143
        ];
        $contrapiso = [
            "areia" => 0.75,
            "saco_cimento" => 0.25,
            "espessura" => 0.25
        ];
        $reboco = [
            "areia" => ($volume_lata * 9)/$area_reboco,
            "cal" => 2/$area_reboco,
            "saco_cimento" => 1/$area_reboco
        ];
        $parede = [
            "tijolos" => 33,
            "area_reboco" =>((0.09*0.19)+(0.09*0.14))*33,
            "reboco" => $reboco
        ];

        return compact("concreto", "contrapiso", "reboco", "parede");
    }
}
