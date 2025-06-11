<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function sendResponse($message, $status, $data = null)
    {
        if ($data) {
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ], $status);
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $status);
    }

    public function sendError($message, $status, $errors = [])
    {
        if (empty($errors)) {
            return response()->json([
                'status' => $status,
                'message' => $message,
            ], $status);
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}
