<?php
include "controller/StaffController.php";
include_once "Response.php";

$REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
$ALLOWED_REQUEST_METHODS = ['GET'];
if ($REQUEST_METHOD == 'GET') {
    try {
        $controller = new StaffController();
        $staffs = $controller->getStaffs();
        $is_error = is_null($staffs);
        if ($is_error) throw new Exception("error retrieving staffs");
        $response = new Response($staffs, count($staffs) <= 0 ? 204 : 200);
    } catch (Exception $ex) {
        $response = new Response(null, 400, $ex->getMessage(), $ex->getTraceAsString());
    }
} else {
    $response = new Response(
        null,
        405,
        "invalid request method",
        sprintf("expected '%s' got '%s'", implode(',', $ALLOWED_REQUEST_METHODS), $REQUEST_METHOD));
}

$response->printResponse();
exit();