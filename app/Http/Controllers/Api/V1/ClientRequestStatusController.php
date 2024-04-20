<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientRequestResource;
use App\Models\ClientRequest;
use \Illuminate\Http\Request;

class ClientRequestStatusController extends Controller
{
    public function __invoke(Request $request,ClientRequest $clientRequest){
        $clientRequest->status=$request->status;
        $clientRequest->save();

        return ClientRequestResource::make($clientRequest);
    }
}
