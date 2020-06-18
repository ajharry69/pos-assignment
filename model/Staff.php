<?php


class Staff
{
    public $id = -1;
    public $email = null;
    public $fullname = null;
    public $joindate = null;
    public $status = true;

    public function __construct($id, $email, $fullname, $joindate, $status)
    {
        $this->id = $id;
        $this->email = $email;
        $this->fullname = $fullname;
        $this->joindate = $joindate;
        $this->status = $status;
    }

    public static function fromJsonRequest()
    {
        try {
            return self::fromDbResult(json_decode(file_get_contents("php://input")));
        } catch (Exception $exception) {
            return null;
        }
    }

    public static function fromDbResult($object)
    {
        $obj = json_decode(json_encode($object));
        return new Staff(
            isset($obj->id) ? $obj->id : -1,
            isset($obj->email) ? $obj->email : null,
            isset($obj->fullname) ? $obj->fullname : null,
            isset($obj->joindate) ? $obj->joindate : null,
            isset($obj->status) ? $obj->status : 1
        );
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return null
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * @return null
     */
    public function getJoindate()
    {
        return $this->joindate;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }
}