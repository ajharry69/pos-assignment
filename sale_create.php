<?php
include "controller/SaleController.php";
include_once "Response.php";

$REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
$ALLOWED_REQUEST_METHODS = ['POST'];
if ($REQUEST_METHOD == 'POST') {
    try {
        $controller = new SaleController();
        $sale = $controller->createSale(Sale::fromJsonRequest());
        $is_error = is_null($sale);
        if ($is_error) throw new Exception("error creating record");
        $response = new Response($sale, 201);
    } catch (Exception $ex) {
        $response = new Response(null, 400, $ex->getMessage(), $ex->getTraceAsString());
    }
} else {
    $response = new Response(
        null,
        405,
        "invalid request method",
        sprintf("expected '%s' got '%s'", implode(',', $ALLOWED_REQUEST_METHODS), $REQUEST_METHOD)
    );
}

$response->printResponse();
exit();