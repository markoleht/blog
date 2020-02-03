<?php


class User
{
    private $db;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
    }


    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->getOne();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }




    public function rehister($data)
    {
        $this->db->query('INSERT INTO users (name, email, password VALUES :name, :email, :password)');
        $this->db->bind(':name', $name);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


}



