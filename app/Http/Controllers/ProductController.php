<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index(){
        return "hasant";
    }


    // Location API Free Cash Data
    // Cash and latest refresh
    public function products(){
       try{
            $products = [];
            Cache::forget('product');
            $response = Cache::remember('product', now()->addMinutes(2), function () {
               return Http::get('http://ip-api.com/json/24.48.0.1')->json();
            });

            $products = $response ?? [];
            dd($products);
            
       }catch(\Exception $ex){
            return response()->json([
                    'error' => 'API Respones Faild ',
                    'status' =>401
                ],401);
       }

        // dd($products);
        return view('products.index', compact('products'));
    }

    // Location API Free
    // public function products(){
    //    try{
    //         $products = [];
    //         // $response = Http::get('http://ip-api.com/json');
    //         $response = Http::get('http://ip-api.com/json',[
    //             'query' => ''
    //         ]);
    //         $products = $response->json();
    //         dd($products);
            
    //    }catch(\Exception $ex){
    //         return response()->json([
    //                 'error' => 'API Respones Faild ',
    //                 'status' =>401
    //             ],401);
    //    }

    //     // dd($products);
    //     return view('products.index', compact('products'));
    // }

    // Paid API
    // public function products(){
    //    try{
    //         $products = [];
    //         $apiKey = config('services.new-api.key');
    //         // dd($apiKey);
    //         // x-api-key: pub_facf1875a8c0fb821f104ecfa14a48af
    //         $response = Http::withHeader('x-api-key', 'pub_facf1875a8c0fb821f104ecfa14a48af')->get('https://reqres.in/api/users');
    //         $products = $response->json();
    //         dd($products);
            
    //    }catch(\Exception $ex){
    //         return response()->json([
    //                 'error' => 'API Respones Faild ',
    //                 'status' =>401
    //             ],401);
    //    }

    //     // dd($products);
    //     return view('products.index', compact('products'));
    // }

    // free api
    // public function products(){
    //    try{
    //         $products = [];
    //         // $response = Http::timeout(0.2)->retry(3, 400)->get('https://fakestoreapi.com/products');
    //         $response = Http::timeout(0.2)->retry(3, 400, function($exception, $request){
    //             Log::warning("API Failed and Attempting it again. Due to thie error".$exception->getMessage());
    //             return $exception instanceof ConnectionException;
    //         })->get('https://fakestoreapi.com/products');

    //         // if ($response->failed()) {
    //         //     return response()->json([
    //         //         'error' => 'API Respones Faild ',
    //         //         'status' => $response->status()
    //         //     ], 401);
    //         //     // throw new \Exception('API Respones Faild');
    //         // }

    //         if ($response->successful()) {
    //             $products =  $response->json();
    //         }
    //    }catch(\Exception $ex){
    //     return response()->json([
    //             'error' => 'API Respones Faild ',
    //             'status' =>401
    //         ],401);
    //    }

    //     // dd($products);
    //     return view('products.index', compact('products'));
    // }

    public function create(){
        return view('products.create');
    }
}