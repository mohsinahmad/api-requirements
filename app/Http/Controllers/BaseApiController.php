<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse as JsonResponseAlias;
use Illuminate\Http\Response;

/**
 * Class BaseApiController
 * @package App\Http\Controllers
 */
class BaseApiController extends Controller
{
    /**
     * @param $result
     * @param $message
     * @param int $code
     * @return JsonResponseAlias
     */
    public function sendResponse($result, $message, $code = Response::HTTP_OK)
    {
        return response()->json([
            'success' => true,
            'data'    => $result,
            'message' => $message
        ], $code);
    }

    /**
     * @param array $errors
     * @param string $message
     * @param int $code
     * @param array $data
     * @return JsonResponseAlias
     */
    public function sendError(array $errors = [],  $message = 'Not Found', $code = Response::HTTP_NOT_FOUND, $data = [])
    {
        $dataErrors = [];
        if (!empty($errors)) {
            foreach ($errors as $key => $error) {
                $dataErrors[] = [
                    'label'   => $key,
                    'message' => $error
                ];
            }
        }
        return response()->json($this->makeError($message, $data, $dataErrors), $code);
    }

    /**
     * @param array $errors
     * @param int $code
     * @param array $data
     * @return mixed
     */
    public function sendErrorWithData(array $errors = [], $code = 404, $data = [])
    {
        $dataErrors = [];
        if (!empty($errors)) {
            foreach ($errors as $key => $error) {
                $dataErrors[] = [
                    'label'   => $key,
                    'message' => $error
                ];
            }
        }
        /*if (empty($data)) {
            $data = ['errors' => $error];
        }*/
        return response()->json($this->makeError($dataErrors[0]['message'], $data, $dataErrors), $code);
    }

    /**
     * @param $message
     * @param array $data
     * @param array $errors
     * @return array
     */
    public static function makeError($message, array $data = [], array $errors = [])
    {
        return [
            'success' => false,
            'message' => $message,
            'data'    => $data,
            'errors'  => $errors,
        ];
    }
}
