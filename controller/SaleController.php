<?php
require_once "../DbConfig.php";
require_once "../model/Sale.php";

class SaleController
{

    public function createSale(Sale $sale)
    {
        $query = "INSERT INTO `sales` (clientname, amount, discount, total) VALUES (:clientname, :amount, :discount, :total);";
        $result = DbConfig::executeQuery($query, [
            'clientname' => $sale->getClientname(),
            'amount' => $sale->getAmount(),
            'discount' => $sale->getDiscount(),
            'total' => $sale->getTotal(),
        ]);
        if ($result->isError()) return null;
        return $this->getLastCreatedSale();
    }

    private function getLastCreatedSale()
    {
        $query = "SELECT * FROM `sales` ORDER BY id DESC LIMIT 1;";
        $result = DbConfig::executeQuery($query);
        return Sale::fromDbResult($result->getPayload()[0]);
    }

    public function getSales()
    {
        $query = "SELECT * FROM `sales`;";
        $result = DbConfig::executeQuery($query);
        return $result->getPayload();
    }
}