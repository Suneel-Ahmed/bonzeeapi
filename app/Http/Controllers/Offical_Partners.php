<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Offical_partnersModel;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PartnersResource;

class Offical_Partners extends Controller
{
    // Get All Partners 
    public function index(){
        $partners = Offical_partnersModel::get();
        if($partners->count() > 0){
                return PartnersResource::collection($partners);
        }
        else{
            return response()->json(['message' => 'No Record Available'] , 200);
        }
    }

    // Create Partners 
    public function store(Request $request ){

        if (Auth::user()->type !== 'admin') {
            return response()->json([
                'message' => 'Unauthorized access. Only admins can perform this action.',
            ], 403);
        }

        $validator = Validator::make($request->all(),[
            'partner_name' => 'required|string|max:255',
            'partner_img' => 'required'
        ]);

if($validator->fails()){
    return response()->json([
        'message' => 'all fields are required',
        'error' => $validator->messages()
    ], 422);
}
       $partners = Offical_partnersModel::create([
            'partner_name' => $request->partner_name,
            'partner_img' => $request->partner_img
        ]);

        return response()->json([
            'message' => 'Partner Created Successfully',
            'data' => $partners
        ], 201);
    }

    // Single Show Partners 
    public function show(Offical_partnersModel $partner){
        return response()->json(['data'=> $partner]);
    }


    // Update Partners 
    public function update(Request $request , Offical_partnersModel $partner){
        $validator = Validator::make($request->all(),[
            'partner_name' => 'required|string|max:255',
            'partner_img' => 'required'
        ]);

            if($validator->fails()){
                return response()->json([
                    'message' => 'all fields are required',
                    'error' => $validator->messages()
                ], 422);
            }
       $partner->update([
            'partner_name' => $request->partner_name,
            'partner_img' => $request->partner_img
        ]);

        return response()->json([
            'message' => 'Partner Updated Successfully',
            'data' => $partner
        ], 201);
    }

    // Delete Partners
    public function destroy(Offical_partnersModel $partner){
        $partner->delete();
        return response()->json([
            'message' => 'Partner Deleted Successfully',
            'data' => $partner
        ], 200);
    }
}
