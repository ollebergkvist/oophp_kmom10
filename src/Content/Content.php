<?php

namespace Olbe19\Content;

/**
 * A Content class
 *
 */
class Content
{

    /** @var object $db    Anax Database object */
    protected $db;

    /**
     * Constructor to create a database..
     * @param obj   $db A database object
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Verifies login attempt
     *
     * @param string $str username to verify
     *
     * @param string $str password to verify
     *
     * @return bool true or false depending on outcome
     */

    public function login($username, $password)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "SELECT * FROM users WHERE username = ? AND password = ?;";

        // Executes SQL statement and fetches data from db
        $result = $this->db->executeFetch($sql, [$username, $password]);

        // Verifies result
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * Registers new user
     *
     * @param string $str username to verify
     *
     * @param string $str password to verify
     *
     * @return bool true or false depending on outcome
     */

    public function register($username, $firstname, $lastname, $password, $email)
    {
        // Connects to db
        $this->db->connect();

        // Checks database if user exists already
        $sql = "SELECT * FROM users WHERE username = ?;";
        $result = $this->db->executeFetchAll($sql, [$username]);

        // If user exists returns false
        if (count($result) > 0) {
            // Returns bool
            return false;
        }
        // If user don't exists registers user and returns true
        else {
            // SQL statement
            $sql = "INSERT INTO users (`username`, `firstname`, `lastname`, `password`, `email`) VALUES (?, ?, ?, ?, ?)";

            // Executes SQL statement and fetches data from db
            $result = $this->db->executeFetch($sql, [$username, $firstname, $lastname, $password, $email]);

            // Returns bool
            return true;
        }
    }

    public function permission($username)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "SELECT * FROM users WHERE username = ? AND rights = ?;";

        // Executes SQL statement and fetches data from db
        $result = $this->db->executeFetch($sql, [$username, "admin"]);

        // Verifies result
        if ($result) {
            return true;
        }
        return false;
    }
}
