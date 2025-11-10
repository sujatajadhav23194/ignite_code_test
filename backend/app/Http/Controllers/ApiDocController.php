<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Ignite Code Test API",
 *     version="1.0.0",
 *     description="Swagger demo for Laravel 12 + PHP 8.3"
 * )
 */
class ApiDocController extends Controller
{
    /**
     * Simple test endpoint
     *
     * @OA\Get(
     *     path="/api/test",
     *     operationId="getTest",
     *     tags={"Test"},
     *     summary="Returns a hello message",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Swagger is working on Laravel 12 + PHP 8.3!")
     *         )
     *     )
     * )
     */
    public function test()
    {
        return response()->json(['message' => 'Swagger is working on Laravel 12 + PHP 8.3!']);
    }
}
