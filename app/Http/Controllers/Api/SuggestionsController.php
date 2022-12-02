<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Suggestions;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SuggestionsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @OA\Get (
     *     path="/api/suggestions",
     *     tags={"Suggestions"},
     *     @OA\Response(
     *          response=200,
     *          description="",
     *      ),
     * )
     */
    public function index()
    {
        return response(Suggestions::with(['category', 'status', 'subdivision'])->get(), 200);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @OA\Get (
     *     tags={"Suggestions"},
     *     path="/api/suggestions/get-by-id/{id}",
     *     @OA\Parameter( name="id", in="path", required=false, description="1", @OA\Schema( type="integer" ) ),
     *
     *     @OA\Response(
     *          response=200,
     *          description="",
     *      @OA\JsonContent(
     *     type="object",
     *                      )
     *                  ),
     *      )
     */
    public function getById($id)
    {

        return Suggestions::with(['category', 'status', 'subdivision'])->select()
            ->where(['id' => $id])
            ->get();
    }




    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @OA\Get (
     *     tags={"Suggestions"},
     *     path="/api/suggestions/get-file-by-id/{id}",
     *     @OA\Parameter( name="id", in="path", required=false, description="1", @OA\Schema( type="integer" ) ),
     *
     *     @OA\Response(
     *          response=200,
     *          description="",
     *      @OA\JsonContent(
     *     type="object",
     *                      )
     *                  ),
     *      )
     */
    public function getFileById($id)
    {

        $suggestions = Suggestions::find($id);
        $path = $suggestions->file_name;

        return Storage::disk('upload' )->download($path);



    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @OA\Post(
     *     path="/api/suggestions",
     *     tags={"Suggestions"},
     *     @OA\RequestBody(
     *    request="Create Suggestions",
     *    description="Create Suggestions Fields",
     *    @OA\JsonContent(
     *        type="object",
     *        required={""},
     *          @OA\Property(property="fio",description="0", type="string", example="Текст"),
     *          @OA\Property(property="user_id",description="0", type="number", example="0"),
     *          @OA\Property(property="status_id",description="0", type="number", example="1"),
     *          @OA\Property(property="premium",description="0", type="number", example="0"),
     *          @OA\Property(property="oneself",description="0", type="number", example="0"),
     *          @OA\Property(property="category_id",description="0", type="number", example="1"),
     *          @OA\Property(property="subdivision_id",description="0", type="number", example="1"),
     *          @OA\Property(property="file_name",description="0", type="string", example="текст"),
     *          @OA\Property(property="description",description="0", type="string", example="Текст"),
     *          @OA\Property(property="economy",description="0", type="string", example="Текст"),
     *    )
     * ),
     *     @OA\Response(
     *          response=200,
     *          description="Success Create",
     *          @OA\JsonContent(
     *             type="object",
     *          @OA\Property(property="id", type="number", example="1"),
     *          @OA\Property(property="fio",description="0", type="string", example="Текст"),
     *          @OA\Property(property="user_id",description="0", type="number", example="0"),
     *          @OA\Property(property="status_id",description="0", type="number", example="1"),
     *          @OA\Property(property="premium",description="0", type="number", example="0"),
     *          @OA\Property(property="oneself",description="0", type="number", example="0"),
     *          @OA\Property(property="category_id",description="0", type="number", example="1"),
     *          @OA\Property(property="subdivision_id",description="0", type="number", example="1"),
     *          @OA\Property(property="file_name",description="0", type="string", example="текст"),
     *          @OA\Property(property="description",description="0", type="string", example="Текст"),
     *          @OA\Property(property="economy",description="0", type="string", example="Текст"),
     *         )
     *      ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation errors",
     *      @OA\JsonContent(
     *     type="object",
     *     title="errors",
     *     description="errors object",
     *     @OA\Property(
     *     property="errors",
     *     type="object",
     *     title="Validation errors",
     *     description="Validation errors object",
     *     @OA\Property(property="field1", type="array", @OA\Items(example="The field1 field is required.")),
     * )
     * )
     *      ),
     * )
     */
    public function store(Request $request)
    {
//        Storage::disk('upload')->;

//        $table->string('fio');
//        $table->integer('user_id');
//        $table->integer('category_id');
//        $table->integer('subdivision_id');
//        $table->string('description');
//        $table->string('file_name');
        $path = "";
        if ($request->hasFile('file')){
            $file = $request->file('file');
            $path = \Storage::disk('upload')
                ->putFileAs('/',
                    request()
                        ->file('file'),
                    'template__' . Str::slug($request->name, '_') . '_' . Carbon::now()->format('dmy') . '.' .
                    request()->file('file')->getClientOriginalExtension());
            $request->merge(['file_name' => $path]);
        }


        if ($request->id > 0) {
            $suggestions = Suggestions::whereId($request->id)->first();
        } else {
            $suggestions = new Suggestions();
        }

        $suggestions->fill($request->only($suggestions->getFillable()))->save();
        return response(
            Suggestions::whereId($suggestions->id)->first()->toArray(), 200);


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @OA\Patch (
     *     path="/api/suggestions/{id}",
     *     tags={"Suggestions"},
     *     @OA\Parameter(
     *      name="id",
     *      in="path",
     *      @OA\Schema(
     *           type="number"
     *      )
     *   ),
     *     @OA\RequestBody(
     *    request="Update Suggestions",
     *    description="Update Suggestions Fields",
     *    @OA\JsonContent(
     *        type="object",
     *        required={""},
     *          @OA\Property(property="fio",description="0", type="string", example="Текст"),
     *          @OA\Property(property="user_id",description="0", type="number", example="0"),
     *          @OA\Property(property="status_id",description="0", type="number", example="1"),
     *          @OA\Property(property="premium",description="0", type="number", example="0"),
     *          @OA\Property(property="oneself",description="0", type="number", example="0"),
     *          @OA\Property(property="category_id",description="0", type="number", example="1"),
     *          @OA\Property(property="subdivision_id",description="0", type="number", example="1"),
     *          @OA\Property(property="file_name",description="0", type="string", example="текст"),
     *          @OA\Property(property="description",description="0", type="string", example="Текст"),
     *          @OA\Property(property="economy",description="0", type="string", example="Текст"),
     *    )
     * ),
     *     @OA\Response(
     *          response=200,
     *          description="Success Create",
     *          @OA\JsonContent(
     *             type="object",
     *          @OA\Property(property="id", type="number", example="1"),
     *          @OA\Property(property="fio",description="0", type="string", example="Текст"),
     *          @OA\Property(property="user_id",description="0", type="number", example="0"),
     *          @OA\Property(property="status_id",description="0", type="number", example="1"),
     *          @OA\Property(property="premium",description="0", type="number", example="0"),
     *          @OA\Property(property="oneself",description="0", type="number", example="0"),
     *          @OA\Property(property="category_id",description="0", type="number", example="1"),
     *          @OA\Property(property="subdivision_id",description="0", type="number", example="1"),
     *          @OA\Property(property="file_name",description="0", type="string", example="текст"),
     *          @OA\Property(property="description",description="0", type="string", example="Текст"),
     *          @OA\Property(property="economy",description="0", type="string", example="Текст"),
     *
     *         )
     *      ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation errors",
     *      @OA\JsonContent(
     *     type="object",
     *     title="errors",
     *     description="errors object",
     *     @OA\Property(
     *     property="errors",
     *     type="object",
     *     title="Validation errors",
     *     description="Validation errors object",
     *     @OA\Property(property="field1", type="array", @OA\Items(example="The field1 field is required.")),
     *     @OA\Property(property="field2", type="array",  @OA\Items(example="The field2 field is required."))
     * )
     * )
     *      ),
     * )
     */
    public function update(Request $request)
    {
        $entity = Suggestions::whereId($request->id)->first();
        if (!$entity) {
            return response([], 404);
        }

        $validator = $entity->validate($request->all(), false);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        $entity->fill($request->only($entity->getFillable()));

        if ($entity->save()) {

            return response($entity->toArray(), 200);
        } else {
            return response('anyError', 500);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @OA\Delete  (
     *     path="/api/suggestions/{id}",
     *     tags={"Suggestions"},
     *     @OA\Parameter(
     *      name="id",
     *      in="path",
     *      @OA\Schema(
     *           type="number"
     *      )
     *   ),
     *     @OA\Response(
     *          response=200,
     *          description="Success Delete",
     *          @OA\JsonContent(
     *             type="object",
     *              @OA\Property(property="is_deleted", type="boolean", example=true),
     *         )
     *      ),
     *     @OA\Response(
     *          response=400,
     *          description="Error Delete",
     *          @OA\JsonContent(
     *             type="object",
     *              @OA\Property(property="is_deleted", type="boolean", example=false),
     *         )
     *      ),
     *
     * )
     */
    public function destroy($id)
    {
        $is_deleted = (bool)Suggestions::whereId($id)->delete();

        return response(['is_deleted' => $is_deleted], $is_deleted ? 200 : 400);
    }
}
