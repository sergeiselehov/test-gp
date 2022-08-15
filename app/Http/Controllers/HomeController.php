<?php

namespace App\Http\Controllers;

use App\Services\GPImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $imageUrl = GPImage::get($request->app);
        return response("<img src='$imageUrl'>");
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function indexJson(Request $request): JsonResponse
    {
        $imageUrl = GPImage::get($request->app);
        return response()->json(['app_icon' => $imageUrl]);
    }
}