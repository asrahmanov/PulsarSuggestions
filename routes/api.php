<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$router->get('/', function () use ($router) {
    abort(404);
});




reg_routes('suggestions', \App\Http\Controllers\Api\SuggestionsController::class,
    $router,
    [],
    [],
    [
        ['method' => 'get', 'uri' => 'get-by-id', 'pathParams'=>['id']],
    ]
);

reg_routes('suggestions-category', \App\Http\Controllers\Api\SuggestionsCategoryController::class,
    $router,
    [],
    [],
    [
        ['method' => 'get', 'uri' => 'get-by-id', 'pathParams'=>['id']],
    ]
);


reg_routes('suggestions-subdivision', \App\Http\Controllers\Api\SuggestionsSubdivisionController::class,
    $router,
    [],
    [],
    [
        ['method' => 'get', 'uri' => 'get-by-id', 'pathParams'=>['id']],
    ]
);



function reg_routes($name, $controllerName, $router, $only = [], $except = [], $customUses = [])
{

    $router->group([
        'prefix' => "/$name",
        'as' => $name,
    ], function () use ($router, $controllerName, $only, $except, $customUses) {

        foreach ($customUses as $item) {

            $customMethod = $item['method'];
            $customUri = $item['uri'];
            $patParamsUri = '';
            if (isset($item['pathParams']) && is_array($item['pathParams'])) {
                foreach ($item['pathParams'] as $pathParamsItem) {
                    $patParamsUri .= '/{' . $pathParamsItem . '}';
                }
            }
            $action = '';
            $routName = '';

            foreach (explode('-', $customUri) as $keyUriItem => $uriItem) {
                if ($keyUriItem === 0) {
                    $action .= strtolower($uriItem);
                    $routName .= strtolower($uriItem);
                } else {
                    $action .= ucfirst(strtolower($uriItem));
                    $routName .= '_' . strtolower($uriItem);
                }

            }
            $router->$customMethod("/$customUri$patParamsUri", [
                'as' => $routName,
                'uses' => "$controllerName@$action"
            ]);
        }

        if (only_or_except($only, $except, 'index')) {
            $router->get('/', [
                'as' => 'index',
                'uses' => "$controllerName@index"
            ]);
        }
        if (only_or_except($only, $except, 'store')) {
            $router->post('/', [
                'as' => 'store',
                'uses' => "$controllerName@store"
            ]);
        }
        if (only_or_except($only, $except, 'show')) {
            $router->get("/{id}", [
                'as' => 'show',
                'uses' => "$controllerName@show"
            ]);
        }
        if (only_or_except($only, $except, 'update')) {
            $router->put("/{id}", [
                'as' => 'update',
                'uses' => "$controllerName@update"
            ]);
        }
        if (only_or_except($only, $except, 'update')) {
            $router->patch("/{id}", [
                'as' => 'update',
                'uses' => "$controllerName@update"
            ]);
        }
        if (only_or_except($only, $except, 'destroy')) {
            $router->delete("/{id}", [
                'as' => 'destroy',
                'uses' => "$controllerName@destroy"
            ]);
        }


    });

}
