<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Detail;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function __invoke()
    {
        $details = Detail::latest()->take(10)->get();

        $temperatures = $details->pluck('temperature');
        $phs          = $details->pluck('ph');
        $dates        = $details->pluck('created_at')->map(fn($date) => $date->format('d F Y, H:i:s'));

        return response()->json([
            "data" => [
                "temperatures" => $temperatures,
                "phs"          => $phs,
                "dates"        => $dates
            ],
        ]);
    }
}
