<?php

namespace Olbe19\Content;

/**
 * A Admin class
 *
 */
class Admin
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
     * Retrieves item
     *
     * @param string $slug with product fo fetch
     *
     * @return obj $result
     */

    public function getItem($searchTitle)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "SELECT * FROM content WHERE title LIKE ?;";

        // Executes SQL statement and fetches data from db
        $result = $this->db->executeFetchAll($sql, [$searchTitle]);

        // Returns result
        return $result;
    }

    /**
     * Retrieves max number of items
     *
     * @return obj $result
     */

    public function getMaxNumberOfItems()
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "SELECT COUNT(id) AS max FROM content;";

        // Executes SQL statement and fetches data from db
        $result = $this->db->executeFetchAll($sql);

        // Returns result
        return $result;
    }

    /**
     * Sorts items
     *
     * @return obj $result
     */

    public function sortItems($orderBy, $order, $hits, $offset)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "SELECT * FROM content ORDER BY $orderBy $order LIMIT $hits OFFSET $offset;";

        // Executes SQL statement and fetches data from db
        $result = $this->db->executeFetchAll($sql);

        // Returns result
        return $result;
    }

    /**
     * Creates blogpost
     *
     * @param string $slug with product fo fetch
     *
     * @return obj $result
     */

    public function createBlogpost($title)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "INSERT INTO content (title) VALUES (?);";

        // Executes SQL statement and fetches data from db
        $result = $this->db->execute($sql, [$title]);

        // Returns result
        return $result;
    }

    /**
     * Creates product
     *
     * @param string $slug with product fo fetch
     *
     * @return obj $result
     */

    public function createProduct($name)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "INSERT INTO products (name) VALUES (?);";

        // Executes SQL statement and fetches data from db
        $result = $this->db->execute($sql, [$name]);

        // Returns result
        return $result;
    }

    /**
     * Deletes blogpost
     *
     * @param string $slug with product fo fetch
     *
     * @return obj $result
     */

    public function deleteBlogpost($contentId)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";

        // Executes SQL statement and fetches data from db
        $result = $this->db->execute($sql, [$contentId]);

        // Returns result
        return $result;
    }

    /**
     * Deletes user
     *
     * @param string $slug with product fo fetch
     *
     * @return obj $result
     */

    public function deleteUser($username)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "UPDATE users SET deleted=NOW() WHERE username=?;";

        // Executes SQL statement and fetches data from db
        $result = $this->db->execute($sql, [$username]);

        // Returns result
        return $result;
    }

    /**
     * Deletes product
     *
     * @param string $slug with product fo fetch
     *
     * @return obj $result
     */

    public function deleteProduct($productId)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "UPDATE products SET deleted=NOW() WHERE id=?;";

        // Executes SQL statement and fetches data from db
        $result = $this->db->execute($sql, [$productId]);

        // Returns result
        return $result;
    }

    /**
     * Edits blogpost
     *
     * @param string $slug with product fo fetch
     *
     * @return obj $result
     */

    public function editBlogpost($params)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";

        // Executes SQL statement and fetches data from db
        $result = $this->db->execute($sql, array_values($params));

        // Returns result
        return $result;
    }

    /**
     * Edits blogpost
     *
     * @param string $slug with product fo fetch
     *
     * @return obj $result
     */

    public function editProduct($params)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "UPDATE products SET name=?, category=?, short_description=?, amount=?, price=?, image=? WHERE id = ?;";

        // Executes SQL statement and fetches data from db
        $result = $this->db->execute($sql, array_values($params));

        // Returns result
        return $result;
    }

    /**
     * Edits user
     *
     * @param string $slug with product fo fetch
     *
     * @return obj $result
     */

    public function editUser($params)
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "UPDATE users SET firstname=?, lastname=?, email=?, password=? WHERE username = ?;";

        // Executes SQL statement and fetches data from db
        $result = $this->db->execute($sql, array_values($params));

        // Returns result
        return $result;
    }

    /**
     * Retrieves users from db
     *
     * @return obj $result
     */

    public function getUsers()
    {
        // Connects to db
        $this->db->connect();

        // SQL statement
        $sql = "SELECT * FROM users;";

        // Executes SQL statement and fetches data from db
        $result = $this->db->executeFetchAll($sql);

        // Returns result
        return $result;
    }

    /**
     * Retrieves products from db
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
        $result = $this->db->executeFetchAll($sql);

        // Returns result
        return $result;
    }
}
