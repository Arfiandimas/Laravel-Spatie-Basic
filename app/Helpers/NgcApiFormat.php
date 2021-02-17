<?php

// use Illuminate\Http\Response;

function ngcApiPaginate($data, $message=null, $meta = null)
{
    return [
        'success' => true,
        'status_code' => 200,
        'message'=>$message,
        'data' => [
            'total_data' => $data->total(),
            'per_page' => intval ($data->perPage()),
            'current_page' => $data->currentPage(),
            'last_page' => $data->LastPage(),
            'next_page_url' => urldecode($data->nextPageUrl()),
            'result' => $data->toArray()['data']
        ],
        'meta' => $meta
    ];
}

function ngcApiPaginateMobile($data, $message=null, $meta = null)
{
    return [
        'success' => true,
        'status_code' => 200,
        'message'=>$message,
        'data' => [
            'total_data' => $data->total(),
            'per_page' => intval ($data->perPage()),
            'current_page' => $data->currentPage(),
            'last_page' => $data->LastPage(),
            'next_page_url' => urldecode($data->nextPageUrl()),
            'result' => $data
        ],
        'meta' => $meta
    ];
}

function ngcApiPaginateMobileHistoryCashier($data, $message=null, $meta = null)
{
    return [
        'success' => true,
        'status_code' => 200,
        'message'=>$message,
        'data' => [
            'total_data' => $data['total'],
            'per_page' => intval ($data['per_page']),
            'current_page' => $data['current_page'],
            'last_page' => $data['last_page'],
            'next_page_url' => urldecode($data['next_page_url']),
            'result' => $data
        ],
        'meta' => $meta
    ];
}

function ngcApiPaginateFake($message, $meta = null){
    return [
        'success' => true,
        'status_code' => 200,
        'message'=>$message,
        'data' => [
            'total_data' => null,
            'per_page' => null,
            'current_page' => null,
            'last_page' => null,
            'next_page_url' => null,
            'result' => []
        ],
        'meta' => $meta

    ];
}

function ngcApiReturn($data, $message = null, $meta = null)
{
    return [
        'success' => true,
        'status_code' => 200,
        'message' => $message,
        'data' => $data,
        'meta' => $meta
    ];
}

function ngcApiUnauthorized($message = "asd", $meta = null){
    $data = [
        'success' => false,
        'status_code' => 401,
        'message' => $message,
        'meta' => $meta
    ];

    return Response::json($data, 401); 
}

function ngcApiException($data = null, $message = null, $meta = null)
{
    $format = [
        'success' => false,
        'status_code' => 400,
        'message' => $message,
        'data' => $data,
        'meta' => $meta
    ];

    return Response::json($format, 400);
}

function ngcApiCatch($e, $meta = null)
{
    $format = [
        'success' => false,
        'status_code' => 500,
        'message' => "maaf terjadi kesalahan sistem",
        'meta' => $e
    ];

    Log::critical($e);
    return Response::json($format, 500);
}

function ngcApiValidate($error, $meta = null)
{
    return [
        'success' => false,
        'status_code' => 422,
        'message' => 'The given data was invalid',
        'errors' => $error,
        'meta' => $meta
    ];
}

function ngcApiFailed($data = null, $message = null, $meta = null)
{
    $format = [
        'success' => false,
        'status_code' => 400,
        'status' => 'Failed',
        'message' => $message,
        'data' => $data,
        'meta' => $meta
    ];
    
    return Response::json($format, 400);
}

function ngcApiCreated($data = null, $message = null, $meta = null)
{
    $created_format =  [
        'success' => true,
        'status_code' => 201,
        'status' => 'Created',
        'message' => $message,
        'data' => $data,
        'meta' => $meta
    ];
    return response()->json($created_format, 201);
}
