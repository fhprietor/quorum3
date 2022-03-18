<?php

namespace App\Http\Controllers;

use App\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WeightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $count = Weight::all()->count();
        $weights = Weight::with('user')
            ->orderBy('email','ASC')
            ->paginate(15);
        return view('weights.index',['weights' => $weights, 'count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('weights.create');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'checkPI'],
            'weight' => 'numeric|min:0'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:weights'],
            'weight' => 'numeric|min:0'
        ]);

        Weight::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'weight' => $request['weight']]);
        return redirect(route('weights.index'))
            ->with('success', 'Preinscripción agregada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function show(Weight $weight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Weight  $weight
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Weight $weight)
    {
        return view('weights.edit',compact('weight'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Weight  $weight
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Weight $weight)
    {
       $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255|unique:weights,email,'. $weight->id,
           'weight' => 'numeric|min:0'
        ]);
        $weight->name = $request['name'];
        $weight->email = $request['email'];
        $weight->weight = $request['weight'];
        $weight->save();
        return redirect(route('weights.index'))
            ->with('success', 'Preinscripción actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weight $weight)
    {
        $weight->delete();
        return redirect(route('weights.index'))
            ->with('success', 'Preregistro borrado');
    }

}
