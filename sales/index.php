<?php
include "../controller/SaleController.php";
include_once "../Response.php";

$REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
$ALLOWED_REQUEST_METHODS = ['GET', 'POST'];
try {
    $controller = new SaleController();
    if ($REQUEST_METHOD == 'GET') {
        $sales = $controller->getSales();
        $is_error = is_null($sales);
        if ($is_error) throw new Exception("error retrieving sales", 204);
        $response = new Response($sales, count($sales) <= 0 ? 204 : 200);
    } else if ($REQUEST_METHOD == 'POST') {
        $sale = $controller->createSale(Sale::fromJsonRequest());
        $is_error = is_null($sale);
        if ($is_error) throw new Exception("error creating record", 400);
        $response = new Response($sale, 201);
    } else {
        $debug_message = sprintf("expected '%s' got '%s'", implode(',', $ALLOWED_REQUEST_METHODS), $REQUEST_METHOD);
        $response = new Response(
            null,
            405,
            "invalid request method",
            $debug_message
        );
    }
} catch (Exception $ex) {
    $code = $ex->getCode();
    $is_http_status_code = !is_string($code) && $code > 199 && $code < 600;
    $response = new Response(
        null,
        $is_http_status_code ? $code : 400,
        $ex->getMessage(),
        $ex->getTraceAsString()
    );
}
$response->printResponse();
exit();