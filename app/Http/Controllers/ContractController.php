<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Http\Resources\Contract as ContractResource;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::all();
        return ContractResource::collection($contracts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $contract = Contract::create($this->validateRequest());
        return new ContractResource($contract);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Contract $contract)
    {
        $contract->update($this->validateRequest());
        return new ContractResource($contract);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();
    }

    /**
     * Validate request
     */
    public function validateRequest()
    {
        return request()->validate([
            'name' => 'required | unique:contracts',
        ]);
    }
}
