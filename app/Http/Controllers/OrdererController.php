<?php

namespace App\Http\Controllers;

use App\Models\Orderer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrdererController extends Controller
{
    public function index()
    {
        $orderers=Orderer::with('projects')->get();
        return view('orderers.index',['orderers'=>$orderers]);
    }

    public function create()
    {
        return view('orderers.create');
    }

    public function show(Orderer $orderer)
    {
        return view('orderers.show',['orderer'=>$orderer]);
    }
    public function store(Request $request)
    {
        // Validate the form data, including image validation
        $validatedData = $request->validate([
            'orderer_name' => 'required|string|max:255',
            'orderer_email' => 'nullable|email',
            'orderer_phone' => 'nullable|string|max:15',
            'orderer_brand' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // max size of 2MB
        ]);

        // Handle image upload if provided
        if ($request->hasFile('orderer_brand')) {
            $validatedData['orderer_brand'] = $request->file('orderer_brand')->store('orderer_brands', 'public');
        }

        // Save orderer to the database
        $neworderer=Orderer::create($validatedData);

        return redirect()->route('orderers.show',$neworderer)->with('success', 'New orderer created successfully.');
    }
    public function destroy(Orderer $orderer)
    {
        $orderer->delete();
        return redirect()->route('dashboard')->with('success',$orderer->orderer_name.'از لیست کارفرمایان حذف شد');
    }
}
