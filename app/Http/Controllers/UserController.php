<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

class UserController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/user/login",
     *     summary="Login user",
     *     operationId="login",
     *     tags={"User"},
     *     @OA\RequestBody(
     *         description="Logs in a user",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *     ),
     * 
    *  @OA\Response(
    *         response="200",
    *         description="ok",
    *                     @OA\JsonContent(
    *                         type="string",
    *                         description="JWT access token",
    *                         example="Bearer 4|oeXad4kChJT43wli90LOd1VbFhtuGuEdvxvEHMAtcb025185"
    *                     ),
    *                       
    *     ),
     * )
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = $request->user();
        $token = $user->createToken('API Token')->plainTextToken;
        
        return response('Bearer ' . $token);
    }

    /**
     * Add OpenApi definition for current user
     * @OA\Get(
     *    path="/api/user/current",
     *    summary="Get current user",
     *    security={{"sanctum":{}}},
     *    tags={"User"},
     *    description="Returns the current user",
     *    operationId="current",
     *    @OA\Response(
     *      response=200,
     *      description="OK",
     *      @OA\JsonContent(ref="#/components/schemas/UserResource")
     *    )
     * )
     * 
     */
    public function current(Request $request)
    {
        return new UserResource($request->user()->load('company.tenant'));
    }   
}
