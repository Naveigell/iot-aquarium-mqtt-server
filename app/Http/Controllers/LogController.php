<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __invoke()
    {
        $details = Detail::latest()->paginate();

        return view('admin.pages.log.index', compact('details'));
    }
}
