<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::any('api', function() {

//    require_once ('nusoap.php');
    $server = new \nusoap_server();

    $server->configureWSDL('TestService', false, url('api'));

    $server->register('test',
        array('input' => 'xsd:string'),
        array('output' => 'xsd:string')
    );

    function test($input){
        return $input;
    }

    $rawPostData = file_get_contents("php://input");
    return \Response::make($server->service($rawPostData), 200, array('Content-Type' => 'text/xml; charset=ISO-8859-1'));

});