<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Suggestions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return response(Suggestions::get(), 200);
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

        return Suggestions::select()
            ->where(['id' => $id])
            ->get();
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
     *          @OA\Property(property="category_id",description="0", type="number", example="1"),
     *          @OA\Property(property="subdivision_id",description="0", type="number", example="1"),
     *          @OA\Property(property="file_name",description="0", type="string", example="текст"),
     *          @OA\Property(property="description",description="0", type="string", example="Текст"),
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
     *          @OA\Property(property="category_id",description="0", type="number", example="1"),
     *          @OA\Property(property="subdivision_id",description="0", type="number", example="1"),
     *          @OA\Property(property="file_name",description="0", type="string", example="текст"),
     *          @OA\Property(property="description",description="0", type="string", example="Текст"),
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

       if($request->id > 0) {
           $form = Suggestions::whereId($request->id)->first();
       } else {
           $form = new Suggestions();
       }

        $validator = $form->validate($request->all());
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        $form->fill($request->only($form->getFillable()))->save();
        return response(
            Suggestions::whereId($form->id)->first()->toArray(), 200);


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
     *          @OA\Property(property="category_id",description="0", type="number", example="1"),
     *          @OA\Property(property="subdivision_id",description="0", type="number", example="1"),
     *          @OA\Property(property="file_name",description="0", type="string", example="текст"),
     *          @OA\Property(property="description",description="0", type="string", example="Текст"),
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
     *          @OA\Property(property="category_id",description="0", type="number", example="1"),
     *          @OA\Property(property="subdivision_id",description="0", type="number", example="1"),
     *          @OA\Property(property="file_name",description="0", type="string", example="текст"),
     *          @OA\Property(property="description",description="0", type="string", example="Текст"),
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
