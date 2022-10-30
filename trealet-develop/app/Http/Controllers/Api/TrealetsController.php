<?php

namespace Vanguard\Http\Controllers\Api;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Resources\StepQuestResource;
use Vanguard\Trealets;

class TrealetsController extends Controller
{
    public function index()
    {
        return StepQuestResource::collection(Trealets::where('type', Trealets::STEPQUEST_TYPE)->get());
    }

    public function show($id)
    {
        return new StepQuestResource(Trealets::find($id));
    }
}
