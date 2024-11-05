<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Communes;
use App\Http\Requests\CommunesRequest;

/** 
 * @OA\PathItem(path="/api/communes")
 * 
 * 
 * @OA\Server(url="http://localhost:8000")
 */
class CommunesController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/communes",
     *     tags={"communes"},
     *     summary="Return communes",
     *     description="Return list of communes",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unsuccessful operation",
     *     ),
     * )
     */
    public function getCommunes()
    {
        try {
            $regions = Communes::all();
            return response()->json($regions);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong while fetching regions', "Succes" => False]);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/communes",
     *     tags={"communes"},   
     *     summary="Create commune",
     *     description="Create commune",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="description", type="string"), 
     *             @OA\Property(property="trash", type="string", enum={"A", "I"}),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unsuccessful operation",
     *     ),
     * )
     */
    public function createCommune(CommunesRequest $request)
    {

        try {
            $communes = Communes::create($request->all());
            return response()->json(['message' => 'Communes created successfully', 'region' => $communes, 'Succes' => True]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong while creating region', "Succes" => False]);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/communes/{id}",
     *     tags={"communes"},
     *     summary="Delete communes",
     *     description="Delete communes",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unsuccessful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Registro no existe",
     *     ),
     * )
     */
    public function deleteCommune(string $id)
    {

        $regionExists = Communes::where('id_com', $id)->exists();
        if (!$regionExists) {
            return response()->json(['Succes' => False]);
        }

        Communes::where('id_com', $id)->whereNot('trash', 'A')->delete();

        return response()->json(['Succes' => True]);
    }
}
