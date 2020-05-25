<?php

namespace Olbe19\Content;

/**
 * A User class
 *
 */
class User
{
    /**
     * @var object $db a anax database object
     */
    protected $db;

    /**
     * Constructor to create a database
     *
     * @param obj $db a database object
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Retrieves user account data from db
     *
     * @param string $username to fetch accound details for
     *
     * @return bool true or false
     */

    public function getUser($username)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "SELECT * FROM users WHERE username = ?;";

        // Executes SQL statement and fetches data from db
        $result = $this->db->executeFetch($sql, [$username]);

        // Returns result
        return $result;
    }

    /**
     * Updates user account
     *
     * @param array $params to update
     *
     * @return bool true or false
     */

    public function updateUser($params)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "UPDATE users SET firstname = ?, lastname = ?, email = ?, password = ? WHERE username = ?;";

        // Executes SQL statement
        $result = $this->db->execute($sql, array_values($params));

        // Returns result
        return $result;
    }
}
