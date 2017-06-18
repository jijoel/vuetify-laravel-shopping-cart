<?php namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        return $request->all();
    }
}
