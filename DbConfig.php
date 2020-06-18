<?php

require "TaskResult.php";


class DbConfig
{
    /**
     * @param string $query
     * @param array $params
     * @param int $response_format
     * @return TaskResult
     */
    public static function executeQuery($query = "", $params = [], $response_format = PDO::FETCH_OBJ): TaskResult
    {
        $task_result = null;

        try {
            $conn = DbConfig::getDbConnection($response_format);
            $stmt = $conn->prepare($query);

            if (stripos($query, "SELECT") === 0) {
                if ($stmt->execute($params) && $stmt->rowCount() > 0) {
                    $task_result = new TaskResult(false, 'Success', null, $stmt->fetchAll());
                } else {
                    $task_result = new TaskResult(true, "Failed", null, []);
                }
            } else {
                if ($stmt->execute($params)) {
                    $task_result = new TaskResult(false, 'Success');
                } else {
                    $task_result = new TaskResult(true, "Failed", $stmt->errorInfo()[2]);
                }
            }

        } catch (PDOException $ex) {
            $task_result = new TaskResult(true, "Failed", $ex->getMessage());
        } finally {
            // Close connection after executing query
            $stmt = null;
            $conn = null;
        }

        return $task_result;
    }

    /**
     * @param int $fetch_type
     * @return PDO
     */
    private static function getDbConnection($fetch_type = PDO::FETCH_ASSOC)
    {
        $host = getenv('POS_DB_HOST') ?: "localhost";
        $user = getenv('POS_DB_USER') ?: "root";
        $pass = getenv('POS_DB_PASSWORD') ?: "root@localhost";
        $db = getenv('POS_DB_NAME') ?: "pos_db";
        $dns = "mysql:host=$host;dbname=$db";

        $conn = new PDO($dns, $user, $pass, array(PDO::ATTR_PERSISTENT => true));
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $fetch_type);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $conn;
    }

}