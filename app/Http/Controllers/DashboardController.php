<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $details = Detail::latest()->take(10)->get();

        $temperatures = $details->pluck('temperature');
        $phs          = $details->pluck('ph');
        $dates        = $details->pluck('created_at')->map(fn($date) => $date->format('d F Y, H:i:s'));

        $temperature  = optional($details->first())->temperature;
        $ph           = optional($details->first())->ph;

        return view('admin.pages.dashboard.index', compact('details', 'temperatures', 'phs', 'dates', 'temperature', 'ph'));
    }
}
