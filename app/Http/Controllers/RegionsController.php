<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegionsRequest;
use Illuminate\Http\Request;
use App\Models\Region;

/** 
 * @OA\PathItem(path="/api/regions")
 * 
 * @OA\Info(title="API de la Prueba GDA", version="1.0.0", description="Documentación API de la Prueba GDA" )
 * 
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     securityScheme="token",
 *     name="Authorization"
 * )
 * 
 * @OA\Server(url="http://localhost:8000")
 */
class RegionsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/regions",
     *     tags={"regions"},
     *     summary="Returns regions",
     *     description="Returns list of regions",
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
    public function getRegions()
    {
        try {
            $regions = Region::all();
            return response()->json($regions);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong while fetching regions', "Succes" => False]);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/regions",
     *     tags={"regions"},   
     *     summary="Create region",
     *     description="Create region",
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
    public function createRegion(RegionsRequest $request)
    {
        $region = Region::create($request->all());

        if (!$region) {
            return response()->json(['message' => 'Something went wrong while creating region', "Succes" => False]);
        }

        return response()->json(['message' => 'Region created successfully', 'region' => $region, 'Succes' => True]);
    }

    /**
     * @OA\Delete(
     *     path="/api/regions/{id}",
     *     tags={"regions"},
     *     summary="Delete region",
     *     description="Delete region",
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
    public function deleteRegion(string $id)
    {

        $regionExists = Region::where('id_reg', $id)->exists();
        if (!$regionExists) {
            return response()->json(['message' => 'Registro no existe'], 404);
        }

        Region::where('id_reg', $id)->delete();

        return response()->json(['Succes' => True], 200);
    }
}
