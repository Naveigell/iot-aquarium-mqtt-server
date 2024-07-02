<?php

namespace App\Http\Controllers;

use App\Models\Drain;
use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;

class MqttMosquittoController extends Controller
{
    public function store()
    {
        MQTT::publish('/aquarium/drain/subscribe', json_encode(["drain" => true]));

        Drain::create();

        return redirect(route('dashboard.index'))->with('success', 'Berhasil meminta aquarium untuk menguras air');
    }
}
