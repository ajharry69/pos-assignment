<?php
include "../controller/StaffController.php";
include_once "../Response.php";

$REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
$ALLOWED_REQUEST_METHODS = ['GET', 'POST'];
try {
    $controller = new StaffController();
    if ($REQUEST_METHOD == 'GET') {
        $staffs = $controller->getStaffs();
        $is_error = is_null($staffs);
        if ($is_error) throw new Exception("error retrieving staffs", 204);
        $response = new Response($staffs, count($staffs) <= 0 ? 204 : 200);
    } else if ($REQUEST_METHOD == 'POST') {
        $staff = $controller->createStaff(Staff::fromJsonRequest());
        $is_error = is_null($staff);
        if ($is_error) throw new Exception("error registering staff", 400);
        $response = new Response($staff, 201);
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