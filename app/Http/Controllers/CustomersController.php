<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;

/** 
 * @OA\PathItem(path="/api/customers")
 * 
 * 
 * @OA\Server(url="http://localhost:8000")
 */
class CustomersController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/customers/{id}",
     *     tags={"customers"},
     *     security={ {"bearer": {} }},
     *     summary="Return customer",
     *     description="Return details of customer",
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
     * )
     */
    public function getCustomer(Request $request, string $id)
    {

        //if (!$request->user()->tokens) {
        //   $response = ['message' => 'Unauthenticated', 'Succes' =>  false];
        //}
        try {
            $customer = Customer::where('dni', $id)->firstOrFail();
            $response = [
                'message' => 'Customer found',
                'customer' => $customer,
                'Succes' =>  true
            ];
        } catch (\Exception $e) {
            $response = ['message' => 'Customer not found', 'Succes' =>  false];
        }

        return response()->json($response);
    }

    /**
     * @OA\Post(
     *     path="/api/customers",
     *     tags={"customers"},   
     *     security={ {"bearer": {} }},
     *     summary="Create customer",
     *     description="Create customer",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string"), 
     *             @OA\Property(property="dni", type="string"),
     *             @OA\Property(property="address", type="string"),
     *             @OA\Property(property="phone", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="id_reg", type="string"),
     *             @OA\Property(property="id_com", type="string"),
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
    public function createCustomer(Request $request)
    {
        try {
            $region = Customer::create($request->all());
            return response()->json(['message' => 'Customer created successfully', 'region' => $region, 'Succes' => True]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong while creating customer', "Succes" => False]);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/customers/{id}",
     *     tags={"customers"},
     *     security={ {"bearer": {} }},
     *     summary="Delete customer",
     *     description="Delete customer",
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
    public function deleteCustomer(string $id)
    {

        $regionExists = Customer::where('dni', $id)->exists();
        if (!$regionExists) {
            return response()->json(['message' => 'Registro no existe'], 404);
        }

        Customer::where('dni', $id)->whereNot('trash', 'A')->delete();

        return response()->json(['Succes' => True], 200);
    }
}
