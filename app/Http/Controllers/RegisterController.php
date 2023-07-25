<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Providers\WhatsappService;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, WhatsappService $whatsappService)
    {
        $request->validate([
            'phone' => ['required', 'regex:/^221(70|76|77|78)[0-9]{7}$/i', 'unique:users,phone'],
            'name' => 'required|string',
            'password' => 'required|min:4'
        ], [
            'phone.required' => 'Le numéro de téléphone est obligatoire.',
            'phone.unique' => 'Ce numéro de téléphone existe déjà.',
            'phone.regex' => 'Le numéro de téléphone doit être au format (2217...).',
            'name.required' => 'Le nom est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit comporter au moins :min caractères.'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        // $user->email = "Indéfini";
        $user->password = Hash::make($request->password);

        $user->save();

        try {
            $whatsappService->sendMessage(formatPhoneNumber($request->phone, false));
        } catch (\Throwable $th) {
        }

        return  redirect('/login')->with('success', 'Votre compte a été créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
