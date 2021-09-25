<?php

function format_response($status, $code, $message, $data) {
    return response()->json([
        'meta' => [
            'status' => $status,
            'code' => $code,
            'message' => $message
        ],
        'data' => $data
    ], $code);
}

?>
