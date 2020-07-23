<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;

class AddressesController extends Controller
{
    public function index(){
        $addresses = Address::with('country', 'city', 'user')->get();
        return view('admin.addresses.index', compact('addresses'));
    }
}
