<?php

namespace App\Http\Traits;

use Illuminate\Pagination\LengthAwarePaginator; // استيراد LengthAwarePaginator بشكل صحيح

trait ApiResponseTrait
{
    // response with token (for login - register in auth)
    public function apiResponse($data, $token, $message, $status)
    {

        $array = [
            'data' => $data,
            'message' => trans($message),
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];

        return response()->json($array, $status);
    }


    /**
     * Return a succeful JSON Response
     *
     * @param mixed $data the data to return in the response
     * @param string $message the succses message
     * @param int $status the HTTP Status Code
     * @return \Illuminate\Http\JsonResponse the Json Response
     *
     *
     */
    // custome response for all request
    public function customeResponse($data, $message, $status)
    {
        $array = [
            'data' => $data,
            'message' => trans($message)
        ];

        return response()->json($array, $status);
    }



    /**
     * Return a paginated JSON response.
     *
     * @param \Illuminate\Pagination\LengthAwarePaginator $paginator The paginator instance.
     * @param string $message The success message.
     * @param int $status The HTTP status code.
     * @return \Illuminate\Http\JsonResponse The JSON response.
     */

    public static function paginated(LengthAwarePaginator $paginator, $message = 'Operation successful', $status = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => trans($message),
            'data' => $paginator->items(),
            'pagination' => [
                'total' => $paginator->total(),
                'count' => $paginator->count(),
                'per_page' => $paginator->perPage(),
                'current_page' => $paginator->currentPage(),
                'total_pages' => $paginator->lastPage(),
            ],
        ], $status);
    }
}
