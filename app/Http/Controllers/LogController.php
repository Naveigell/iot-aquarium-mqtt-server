<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Drain;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function detail()
    {
        $details = Detail::latest()->paginate();

        return view('admin.pages.log.aquarium', compact('details'));
    }

    public function drain()
    {
        $drains = Drain::latest()->paginate();

        return view('admin.pages.log.drain', compact('drains'));
    }
}
