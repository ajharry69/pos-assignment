<?php
require_once "DbConfig.php";
require_once "model/Staff.php";

class StaffController
{

    public function createStaff(Staff $staff)
    {
        $query = "INSERT INTO `staff` (email, fullname, status) VALUES (:email, :fullname, :status);";
        $result = DbConfig::executeQuery($query, [
            'email' => $staff->getEmail(),
            'fullname' => $staff->getFullname(),
            'status' => $staff->isStatus(),
        ]);
        if ($result->isError()) return null;
        return $this->getLastCreatedStaff();
    }

    public function getStaffs()
    {
        $query = "SELECT * FROM `staff`;";
        $result = DbConfig::executeQuery($query);
        return $result->getPayload();
    }

    private function getLastCreatedStaff()
    {
        $query = "SELECT * FROM `staff` ORDER BY id DESC LIMIT 1;";
        $result = DbConfig::executeQuery($query);
        return Staff::fromDbResult($result->getPayload()[0]);
    }

}