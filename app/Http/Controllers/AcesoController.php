<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('acceso.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoginsRequest $request)
    {
        dd("Avanza");
        $crencial = $request->getCredentials();
dd($crencial);
        if(!Auth::validate(($crencial)))
        {
            return redirect()->to('accesos')->withErrors('auth.failds');
        }

        $user = Auth::getProvider()->retrieveByCredentials($crencial);
        Auth::user($user);

        return $this->authenticated($request, $user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(LoginsRequest $request)
    {
        $crencial = $request->getCredentials();

        if(!Auth::validate(($crencial)))
        {
            return redirect()->to('accesos')->withErrors('auth.failds');
        }

        $user = Auth::getProvider()->retrieveByCredentials($crencial);
        Auth::user($user);

        return $this->authenticated($request, $user);
    }

    public function acceder(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if(!Auth::validate($credentials))
        {
            return redirect()->to('accesos')->withErrors('auth.failds');
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::user($user);
        dd($user);
        return Auth::id();
    }

    public function authenticated($request, $user)
    {
        return redirect('home');
    }
}
