<?php

namespace Olbe19\Content;

/**
 * A Content class
 *
 */
class Content
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
     * Retrieves 3 newest blogposts
     *
     * @return obj $result
     */

    public function get3LatestBlogposts()
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "SELECT * FROM content WHERE `type` = 'post' LIMIT 3;";

        // Executes SQL statement and fetches data from db
        // Fetches data from db and stores in $resultset
        $result = $this->db->executeFetchAll($sql);

        // Returns result
        return $result;
    }

    /**
     * Retrieves 3 latest products
     *
     * @return obj $result
     */

    public function get3LatestProducts()
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "SELECT * FROM products LIMIT 3;";

        // Executes SQL statement and fetches data from db
        // Fetches data from db and stores in $resultset
        $result = $this->db->executeFetchAll($sql);

        // Returns result
        return $result;
    }

    /**
     * Retrieves featured brand
     *
     * @return obj $result
     */

    public function getFeaturedBrand()
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "SELECT * FROM products WHERE article_number = '010';";

        // Executes SQL statement and fetches data from db
        // Fetches data from db and stores in $resultset
        $result = $this->db->executeFetchAll($sql);

        // Returns result
        return $result;
    }

    /**
     * Retrieves featured brand
     *
     * @return obj $result
     */

    public function getProductsOnSale()
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "SELECT * FROM products WHERE article_number = '11' OR article_number = '5' OR article_number = 8;";

        // Executes SQL statement and fetches data from db
        // Fetches data from db and stores in $resultset
        $result = $this->db->executeFetchAll($sql);

        // Returns result
        return $result;
    }

    /**
     * Retrieves all products
     *
     * @return obj $result
     */

    public function getProducts()
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "SELECT * FROM products;";

        // Executes SQL statement and fetches data from db
        // Fetches data from db and stores in $resultset
        $result = $this->db->executeFetchAll($sql);

        // Returns result
        return $result;
    }

    /**
     * Retrieves all blogposts
     *
     * @return obj $result
     */

    public function getBlog()
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = <<<EOD
                    SELECT
                        *,
                        DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
                        DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
                    FROM content
                    WHERE type=?
                    AND deleted IS NULL
                    ORDER BY published DESC
                    ;
EOD;

        // Executes SQL statement and fetches data from db
        $result = $this->db->executeFetchAll($sql, ["post"]);

        // Returns result
        return $result;
    }

    /**
     * Retrieves blogpost
     *
     * @param string $slug with product fo fetch
     *
     * @return obj $result
     */

    public function getBlogpost($slug)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = <<<EOD
        SELECT
            *,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
        FROM content
        WHERE
            slug = ?
            AND type = ?
            AND (deleted IS NULL OR deleted > NOW())
            AND published <= NOW()
        ORDER BY published DESC
        ;
EOD;

        // Executes SQL statement and fetches data from db
        $result = $this->db->executeFetch($sql, [$slug, "post"]);

        // Returns result
        return $result;
    }

    /**
     * Retrieves product
     *
     * @param string $slug with product fo fetch
     *
     * @return obj $result
     */

    public function getProduct($slug)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = <<<EOD
        SELECT
            *
        FROM products
        WHERE
            article_number = ?
        ;
EOD;

        // Executes SQL statement and fetches data from db
        $result = $this->db->executeFetch($sql, [$slug]);

        // Returns result
        return $result;
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
     * @param string $username to register
     *
     * @param string $password to register
     *
     * @param string $firstname to register
     *
     * @param string $password to register
     *
     * @param string $email to register
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
        } else {
            // If user don't exists registers user and returns true
            // SQL statement
            $sql = "INSERT INTO users (`username`, `firstname`, `lastname`, `password`, `email`) VALUES (?, ?, ?, ?, ?)";

            // Executes SQL statement and fetches data from db
            $result = $this->db->executeFetch($sql, [$username, $firstname, $lastname, $password, $email]);

            // Returns bool
            return true;
        }
    }

    /**
     * Verifies permission
     *
     * @param string $username username to verify
     *
     * @return bool true or false depending on outcome
     */

    public function permission($username)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "SELECT * FROM users WHERE username = ? AND rights = 'admin'";

        // Executes SQL statement and fetches data from db
        $result = $this->db->executeFetch($sql, [$username]);

        // Verifies result
        if ($result) {
            return true;
        }

        return false;
    }

    /**
     * Resets database
     *
     * @param string $dbConfig database to reset
     *
     * @return void
     */
    public function resetDatabase($dbConfig)
    {
        $file   = "../sql/content/setup.sql";
        $mysql  = "/usr/bin/mysql";
        $dsnDetail = [];
        preg_match("/mysql:host=(.+);dbname=([^;.]+)/", $dbConfig["config"]["dsn"], $dsnDetail);
        $host = $dsnDetail[1];
        $database = $dsnDetail[2];

        if ($database == "olbe19") {
            $mysql = "mysql";
        }

        $login = $dbConfig["config"]["username"];
        $password = $dbConfig["config"]["password"];
        $command = "$mysql -h{$host} -u{$login} -p{$password} $database < $file 2>&1";
        $commandclean = "$mysql -h{$host} -u{$login} -pxxxxxx $database < $file 2>&1";
        $output = [];
        $status = null;
        exec($command, $output, $status);
        $output = "<p>The command was: <code>$commandclean</code>.<br>The command exit status was $status."
            . "<br>The output from the command was:</p><pre>"
            . print_r($output, 1);

        return $database;
    }
}
