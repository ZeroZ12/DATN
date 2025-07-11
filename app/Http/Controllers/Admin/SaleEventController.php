<?php

namespace App\Http\Controllers;

use App\Models\SaleEvent;
use Illuminate\Http\Request;

class SaleEventController extends Controller
{
    public function index()
    {
        $activeSaleEvents = SaleEvent::active()->with('bienTheSanPhams')->get();

        $hasSaleEvents = $activeSaleEvents->isNotEmpty();

        return view('sales.events', compact('activeSaleEvents', 'hasSaleEvents'));
    }
}
