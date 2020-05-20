<?php

namespace Olbe19\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;
use Olbe19\TextFilter\MyTextFilter;

/**
 * A ContentController Class
 */
class ContentController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * Initialize method
     * Called before the target method/action
     * Setups internal properties that are commonly used by several methods
     *
     * @return void
     */
    public function initialize(): void
    {
        // Initalise a new content object, with the content-database as argument.
        $this->content = new Content($this->app->db);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/index
     *
     * @return object
     *
     */
    public function indexActionGet(): object
    {
        // Sets webpage title
        $title = "Home";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Connects to db
        $this->app->db->connect();

        // SQL statements
        $sql = "SELECT * FROM content WHERE `type` = 'post' LIMIT 3;";
        $sql2 = "SELECT * FROM products LIMIT 3;";
        $sql3 = "SELECT * FROM products WHERE article_number = '010';";
        $sql4 = "SELECT * FROM products WHERE id = '11' OR id = '5' OR id = 8;";

        // Fetches data from db and stores in $resultset
        $resultset = $this->app->db->executeFetchAll($sql);
        $resultset2 = $this->app->db->executeFetchAll($sql2);
        $resultset3 = $this->app->db->executeFetchAll($sql3);
        $resultset4 = $this->app->db->executeFetchAll($sql4);

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "resultset" => $resultset,
            "resultset2" => $resultset2,
            "resultset3" => $resultset3,
            "resultset4" => $resultset4
        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/index", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/index
     *
     * @return object
     *
     */
    public function overviewActionGet(): object
    {
        // Sets webpage title
        $title = "Show all content";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Connects to db
        $this->app->db->connect();

        // SQL statement
        $sql = "SELECT * FROM content;";

        // Fetches data from db and stores in $resultset
        $resultset = $this->app->db->executeFetchAll($sql);

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "resultset" => $resultset,
        ];

        // Includes admin header
        $this->app->page->add("content/header_admin");

        // Adds route and sends data array to view
        $this->app->page->add("content/show-all", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/products
     *
     * @return object
     *
     */
    public function productsActionGet(): object
    {
        // Sets webpage title
        $title = "Products";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Connects to db
        $this->app->db->connect();

        // SQL statement
        $sql = "SELECT * FROM products;";

        // Fetches data from db and stores in $resultset
        $resultset = $this->app->db->executeFetchAll($sql);

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "resultset" => $resultset,
        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/products", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/admin
     *
     * @return object
     *
     */
    public function adminActionGet(): object
    {
        // Sets webpage title
        $title = "Admin content";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Connects to db
        $this->app->db->connect();

        // Retrieves title
        $searchTitle = getGet("searchTitle") ?? null;
        $viewAll = getGet("viewAll") ?? null;

        if ($searchTitle) {
            // SQL statement
            $sql = "SELECT * FROM content WHERE title LIKE ?;";

            // Fetches data from db and stores in $resultset
            $resultset = $this->app->db->executeFetchAll($sql, [$searchTitle]);
        } else {
            // SQL statement
            $sql = "SELECT * FROM content;";

            // Fetches data from db and stores in $resultset
            $resultset = $this->app->db->executeFetchAll($sql);
        }

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "resultset" => $resultset,
            "searchTitle" => $searchTitle
        ];

        // Includes admin header
        $this->app->page->add("content/header_admin");

        // Adds route and sends data array to view
        $this->app->page->add("content/admin", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/create
     *
     * @return object
     *
     */
    public function createActionGet(): object
    {
        // Sets webpage title
        $title = "Create content";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended
        ];

        // Includes admin header
        $this->app->page->add("content/header_admin");

        // Adds route and sends data array to view
        $this->app->page->add("content/create", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * POST mountpoint/create
     *
     * @return object
     *
     */
    public function createActionPost(): object
    {
        // Connects to db
        $this->app->db->connect();

        if (hasKeyPost("doCreate")) {
            $title = getPost("contentTitle");

            // SQL statement
            $sql = "INSERT INTO content (title) VALUES (?);";

            // Executes SQL statement
            $this->app->db->execute($sql, [$title]);

            // Retrieves id
            $id = $this->app->db->lastInsertId();
        }

        // Redirects
        return $this->app->response->redirect("edit?id=$id");
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/createproduct
     *
     * @return object
     *
     */
    public function createproductActionGet(): object
    {
        // Sets webpage title
        $title = "Create product";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended
        ];

        // Includes admin header
        $this->app->page->add("content/header_admin");

        // Adds route and sends data array to view
        $this->app->page->add("content/create_product", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * POST mountpoint/createproduct
     *
     * @return object
     *
     */
    public function createproductActionPost(): object
    {
        // Connects to db
        $this->app->db->connect();

        if (hasKeyPost("doCreate")) {
            $name = getPost("name");

            // SQL statement
            $sql = "INSERT INTO products (name) VALUES (?);";

            // Executes SQL statement
            $this->app->db->execute($sql, [$name]);

            // Retrieves id
            $id = $this->app->db->lastInsertId();
        }

        // Redirects
        return $this->app->response->redirect("editproduct?id=$id");
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/reset
     *
     * @return object
     *
     */
    public function resetAction(): object
    {
        // Sets webpage title
        $title = "Reset database";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // $output = null ?? getGet(["reset"]);

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
        ];

        // Includes admin header
        $this->app->page->add("content/debug");
        $this->app->page->add("content/header_admin");

        // Adds route and sends data array to view
        $this->app->page->add("content/reset", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * POST mountpoint/reset
     *
     * @return object
     *
     */
    public function resetActionPost(): object
    {
        // Framework variables
        $dbConfig = $this->app->configuration->load("database");
        $request = $this->app->request;

        // Verifies if reset form was submitted
        if ($request->getPost("reset") == "Reset database") {
            $output = $this->content->resetDatabase($dbConfig);
        }

        // Redirects
        return $this->app->response->redirect("reset", $output);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/pages
     *
     * @return object
     *
     */
    public function pagesActionGet(): object
    {
        // Sets webpage title
        $title = "View pages";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Connects to db
        $this->app->db->connect();

        // SQL statement
        $sql = <<<EOD
        SELECT
            *,
            CASE
                WHEN (deleted <= NOW()) THEN "isDeleted"
                WHEN (published <= NOW()) THEN "isPublished"
                ELSE "notPublished"
            END AS status
        FROM content
        WHERE type=?
        ;
        EOD;

        // Executes SQL and fetches data
        $resultset = $this->app->db->executeFetchAll($sql, ["page"]);

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "resultset" => $resultset
        ];

        // Includes admin header
        $this->app->page->add("content/header_admin");

        // Adds route and sends data array to view
        $this->app->page->add("content/pages", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/pages
     *
     * @return object
     *
     */
    public function pageActionGet(): object
    {
        // // Sets webpage title
        $title = "View page";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Retrieves route
        $route = getGet("route", "");

        // Connects to db
        $this->app->db->connect();

        // SQL statement
        $sql = <<<EOD
        SELECT
            *,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
            DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
        FROM content
        WHERE
            path = ?
            AND type = ?
            AND (deleted IS NULL OR deleted > NOW())
            AND published <= NOW()
        ;
        EOD;

        // Executes SQL and fetches data
        $content = $this->app->db->executeFetch($sql, [$route, "page"]);

        // Error handling
        if (!$content) {
            $title = "404";
            return $this->app->response->redirect("content/error");
        }

        // Creates instance of class
        $textFilter = new MyTextFilter();

        // Retrieves filters and stores as comma seperated strings in $filters
        $filters = $content->filter;

        // Creates array of the values from $filters
        $filtersArray = explode(",", $filters);

        // Parses data thru text filters
        $content->data = $textFilter->parse($content->data, $filtersArray);

        // // Sets webpage title
        $title = $content->title;

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "content" => $content
        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/page", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/blog
     *
     * @return object
     *
     */
    public function blogActionGet(): object
    {
        // Sets webpage title
        $title = "View blog";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Connects to db
        $this->app->db->connect();

        // SQL statement
        $sql = <<<EOD
                    SELECT
                        *,
                        DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
                        DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
                    FROM content
                    WHERE type=?
                    ORDER BY published DESC
                    ;
                    EOD;

        // Executes SQL and fetches data
        $resultset = $this->app->db->executeFetchAll($sql, ["post"]);

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "resultset" => $resultset
        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/blog", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/blog
     *
     * @return object
     *
     */
    public function blogpostActionGet(): object
    {
        // Retrieves route
        $route = getGet("route", "");

        // Connects to db
        $this->app->db->connect();


        if (substr($route, 0, 5) === "blog/") {
            //  Matches blog/slug, display content by slug and type post
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

            // Retrieves slug
            $slug = substr($route, 5);

            // Executes SQL and fetches data
            // Saves data in content
            $content = $this->app->db->executeFetch($sql, [$slug, "post"]);

            // Sets title
            $title = $content->title;

            // Error handling
            if (!$content) {
                $title = "404";
                return $this->app->response->redirect("content/error");
            }
        }

        // Creates instance of class
        $textFilter = new MyTextFilter();

        // Retrieves filters and stores as comma seperated strings in $filters
        $filters = $content->filter;

        // Creates array of the values from $filters
        $filtersArray = explode(",", $filters);

        // Parses data thru text filters
        $content->data = $textFilter->parse($content->data, $filtersArray);


        // Data array
        $data = [
            "title" => $title,
            "content" => $content
        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/blogpost", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/product
     *
     * @return object
     *
     */
    public function productActionGet(): object
    {
        // Retrieves route
        $route = getGet("route", "");

        // Connects to db
        $this->app->db->connect();



        if (substr($route, 0, 8) === "product/") {
            $sql = <<<EOD
                    SELECT
                        *
                    FROM products
                    WHERE
                        id = ?
                    ;
                    EOD;

            // Retrieves slug
            $slug = substr($route, 8);

            // Executes SQL and fetches data
            // Saves data in content
            $content = $this->app->db->executeFetch($sql, [$slug]);

            // Sets title
            $title = $content->title;

            // Error handling
            if (!$content) {
                $title = "404";
                return $this->app->response->redirect("error");
            }
        }

        // Data array
        $data = [
            "title" => $title,
            "content" => $content
        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/product", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/delete
     *
     * @return object
     *
     */
    public function deleteActionGet(): object
    {
        // Sets webpage title
        $title = "Delete content";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Connects to db
        $this->app->db->connect();

        // Retrieve content id
        $contentId = getGet("id") ?: null;

        // SQL statement
        $sql = "SELECT id, title FROM content WHERE id = ?;";

        // Fetches data from db and stores in $resultset
        $content = $this->app->db->executeFetch($sql, [$contentId]);

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "content" => $content,
        ];

        // Includes admin header
        $this->app->page->add("content/header_admin");

        // Adds route and sends data array to view
        $this->app->page->add("content/delete", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * POST mountpoint/delete
     *
     * @return object
     *
     */
    public function deleteActionPost(): object
    {
        // Connects to db
        $this->app->db->connect();

        $contentId = getPost("contentId");

        if (!is_numeric($contentId)) {
            return $this->app->response->redirect("admin");
        }

        if (hasKeyPost("doDelete")) {
            $contentId = getPost("contentId");
            // SQL statement
            $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";

            // Executes SQL statement
            $this->app->db->execute($sql, [$contentId]);

            // Redirects
            return $this->app->response->redirect("admin");
        }
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/delete
     *
     * @return object
     *
     */
    public function deleteuserActionGet(): object
    {
        // Sets webpage title
        $title = "Delete user";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Connects to db
        $this->app->db->connect();

        // Retrieve content id
        $username = getGet("username") ?: null;

        // SQL statement
        $sql = "SELECT username FROM users WHERE username = ?;";

        // Fetches data from db and stores in $resultset
        $content = $this->app->db->executeFetch($sql, [$username]);

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "content" => $content,
        ];

        // Includes admin header
        $this->app->page->add("content/header_admin");

        // Adds route and sends data array to view
        $this->app->page->add("content/delete_user", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * POST mountpoint/delete
     *
     * @return object
     *
     */
    public function deleteuserActionPost(): object
    {
        // Connects to db
        $this->app->db->connect();

        if (hasKeyPost("doDelete")) {
            $username = getPost("username");

            // SQL statement
            $sql = "UPDATE users SET deleted=NOW() WHERE username=?;";

            // Executes SQL statement
            $this->app->db->execute($sql, [$username]);

            // Redirects
            return $this->app->response->redirect("users");
        }
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/delete
     *
     * @return object
     *
     */
    public function deleteproductActionGet(): object
    {
        // Sets webpage title
        $title = "Delete product";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Connects to db
        $this->app->db->connect();

        // Retrieve content id
        $productId = getGet("id") ?: null;

        // SQL statement
        $sql = "SELECT id,name FROM products WHERE id = ?;";

        // Fetches data from db and stores in $resultset
        $content = $this->app->db->executeFetch($sql, [$productId]);

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "content" => $content,
        ];

        // Includes admin header
        $this->app->page->add("content/header_admin");

        // Adds route and sends data array to view
        $this->app->page->add("content/delete_product", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * POST mountpoint/delete
     *
     * @return object
     *
     */
    public function deleteproductActionPost(): object
    {
        // Connects to db
        $this->app->db->connect();

        if (hasKeyPost("doDelete")) {
            $productId = getPost("id");

            // SQL statement
            $sql = "UPDATE products SET deleted=NOW() WHERE id=?;";

            // Executes SQL statement
            $this->app->db->execute($sql, [$productId]);

            // Redirects
            return $this->app->response->redirect("products2");
        }
    }

    /**
     * This method is handler for the route:
     * ANY mountpoint/edit
     *
     * @return object
     *
     */
    public function editAction(): object
    {
        // Sets webpage title
        $title = "Edit content";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // // Creates instance of TextFilter
        // $textfilter = new \Olbe19\TextFilter\MyTextFilter();

        // // Calls getFilters method and stores filters in $filters
        // $filters = $textfilter->getFilters();

        // Connects to db
        $this->app->db->connect();

        // Retrieve content id
        $contentId = getGet("id");

        // SQL statement
        $sql = "SELECT * FROM content WHERE id = ?;";

        // Fetches data from db and stores in $resultset
        $content = $this->app->db->executeFetch($sql, [$contentId]);

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "contentId" => $contentId,
            "content" => $content,
            // "filters" => $filters
        ];

        // Includes admin header
        $this->app->page->add("content/header_admin");

        // Adds route and sends data array to view
        $this->app->page->add("content/edit", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * POST mountpoint/edit
     *
     * @return object
     *
     */
    public function editActionPost(): object
    {
        // Connects to db
        $this->app->db->connect();

        // Retrieves contentId
        $contentId = getPost("contentId");

        if (!is_numeric($contentId)) {
            return $this->app->response->redirect("admin");
        }

        if (hasKeyPost("doDelete")) {
            return $this->app->response->redirect("delete&id=$contentId");
        }

        if (hasKeyPost("doSave")) {
            $params = getPost([
                "contentTitle",
                "contentPath",
                "contentSlug",
                "contentData",
                "contentType",
                "contentFilter",
                "contentPublish",
                "contentId"
            ]);

            if (!$params["contentSlug"]) {
                $params["contentSlug"] = slugify($params["contentTitle"]);
            }

            if (!$params["contentPath"]) {
                $params["contentPath"] = null;
            }

            $params["contentFilter"] = implode(",", getPost(["contentFilter"]));

            // SQL statement
            $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";

            // Executes SQL statement
            $this->app->db->execute($sql, array_values($params));

            // Redirects
            return $this->app->response->redirect("admin");
        }
    }

    /**
     * This method is handler for the route:
     * ANY mountpoint/editproduct
     *
     * @return object
     *
     */
    public function editproductAction(): object
    {
        // Sets webpage title
        $title = "Edit product";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Connects to db
        $this->app->db->connect();

        // Retrieve content id
        $productId = getGet("id");

        // SQL statement
        $sql = "SELECT * FROM products WHERE id = ?;";

        // Fetches data from db and stores in $resultset
        $content = $this->app->db->executeFetch($sql, [$productId]);

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "productId" => $productId,
            "content" => $content
        ];

        // Includes admin header
        $this->app->page->add("content/header_admin");

        // Adds route and sends data array to view
        $this->app->page->add("content/edit_product", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * POST mountpoint/editproduct
     *
     * @return object
     *
     */
    public function editproductActionPost(): object
    {
        // Connects to db
        $this->app->db->connect();

        // Retrieves productId
        $productId = getPost("id");

        if (hasKeyPost("doDelete")) {
            return $this->app->response->redirect("deleteproduct&id=$productId");
        }

        if (hasKeyPost("doSave")) {
            $params = getPost([
                "name",
                "category",
                "short_description",
                "amount",
                "price",
                "image",
                "id"
            ]);

            // SQL statement
            $sql = "UPDATE products SET name=?, category=?, short_description=?, amount=?, price=?, image=? WHERE id = ?;";

            // Executes SQL statement
            $this->app->db->execute($sql, array_values($params));

            // Redirects
            return $this->app->response->redirect("products2");
        }
    }

    /**
     * This method is handler for the route:
     * ANY mountpoint/edituser
     *
     * @return object
     *
     */
    public function edituserAction(): object
    {
        // Sets webpage title
        $title = "Edit user";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Connects to db
        $this->app->db->connect();

        // Retrieve content id
        $username = getGet("username");

        // SQL statement
        $sql = "SELECT * FROM users WHERE username = ?;";

        // Fetches data from db and stores in $resultset
        $content = $this->app->db->executeFetch($sql, [$username]);

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "username" => $username,
            "content" => $content
        ];

        // Includes admin header
        $this->app->page->add("content/header_admin");

        // Adds route and sends data array to view
        $this->app->page->add("content/edit_user", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * POST mountpoint/edituser
     *
     * @return object
     *
     */
    public function edituserActionPost(): object
    {
        // Connects to db
        $this->app->db->connect();

        // Retrieves contentId
        $username = getPost("username");

        if (hasKeyPost("doDelete")) {
            return $this->app->response->redirect("deleteuser&username=$username");
        }

        if (hasKeyPost("doSave")) {
            $params = getPost([
                "firstname",
                "lastname",
                "email",
                "password",
                "username"
            ]);

            // SQL statement
            $sql = "UPDATE users SET firstname=?, lastname=?, email=?, password=? WHERE username = ?;";

            // Executes SQL statement
            $this->app->db->execute($sql, array_values($params));

            // Redirects
            return $this->app->response->redirect("users");
        }
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/404
     *
     * @return object
     *
     */
    public function errorActionGet(): object
    {
        // Sets webpage title
        $title = "404";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,

        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/error", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * ANY mountpoint/login
     *
     * @return object
     *
     */
    public function loginAction(): object
    {
        // Framework variables
        $request = $this->app->request;
        $session = $this->app->session;
        $response = $this->app->response;

        // Sets webpage title
        $title = "Login";

        // Verifies login attempt
        if ($request->getPost("login")) {
            $username = $request->getPost("username");
            $password = $request->getPost("password");
            if ($this->content->login($username, $password) && $this->content->permission($username)) {
                $session->set("loggedIn", $username);
                $response->redirect("admin");
            } else if ($this->content->login($username, $password)) {
                $session->set("loggedIn", $username);
                $response->redirect("user");
            } else {
                $message = "Wrong username and or password";
            }
        }

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "message" => $message ?? null
        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/login", $data);

        // Renders page
        return $this->app->page->render($data);
    }


    /**
     * This method is handler for the route:
     * ANY mountpoint/logout
     *
     * @return object
     *
     */
    public function logoutAction(): object
    {
        // Framework variables
        $request = $this->app->request;
        $session = $this->app->session;
        $response = $this->app->response;

        // Retrieve value from session
        $user = $session->get("loggedIn");

        // Sets webpage title
        $title = "Logout";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "user"      => $user

        ];

        if ($request->getPost("logout")) {
            $session->delete("loggedIn");
            $response->redirect("login");
        }

        // Adds route and sends data array to view
        $this->app->page->add("content/logout", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/about
     *
     * @return object
     *
     */
    public function aboutActionGet(): object
    {
        // Sets webpage title
        $title = "About";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,

        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/about");

        // Renders page
        return $this->app->page->render();
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/about
     *
     * @return object
     *
     */
    public function docActionGet(): object
    {
        // Sets webpage title
        $title = "Doc";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,

        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/doc");

        // Renders page
        return $this->app->page->render();
    }

    /**
     * This method is handler for the route:
     * ANY mountpoint/register
     *
     * @return object
     *
     */
    public function registerAction(): object
    {
        // Defines variables
        $request = $this->app->request;
        $response = $this->app->response;

        // Sets webpage title
        $title = "Register";

        // Verifies registration attempt
        if ($request->getPost("register")) {
            $username = $request->getPost("username");
            $firstname = $request->getPost("firstname");
            $lastname = $request->getPost("lastname");
            $email = $request->getPost("email");
            $password = $request->getPost("password");

            // Calls registration method
            $result = $this->content->register($username, $firstname, $lastname, $password, $email);

            // Verifies respone from registration method
            if ($result === true) {
                $response->redirect("login");
            } else {
                $message = "Username is already taken";
            }
        }

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "message" => $message
        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/register", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/users
     *
     * @return object
     *
     */
    public function usersActionGet(): object
    {
        // Sets webpage title
        $title = "Users";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Connects to db
        $this->app->db->connect();

        // SQL statement
        $sql = "SELECT * FROM users;";

        // Fetches data from db and stores in $resultset
        $resultset = $this->app->db->executeFetchAll($sql);

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "resultset" => $resultset,
        ];

        // Includes admin header
        $this->app->page->add("content/header_admin");

        // Adds route and sends data array to view
        $this->app->page->add("content/users", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/users
     *
     * @return object
     *
     */
    public function products2ActionGet(): object
    {
        // Sets webpage title
        $title = "Products";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Connects to db
        $this->app->db->connect();

        // SQL statement
        $sql = "SELECT * FROM products;";

        // Fetches data from db and stores in $resultset
        $resultset = $this->app->db->executeFetchAll($sql);

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "resultset" => $resultset,
        ];

        // Includes admin header
        $this->app->page->add("content/header_admin");

        // Adds route and sends data array to view
        $this->app->page->add("content/products2", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * ANY mountpoint/user
     *
     * @return object
     *
     */
    public function userAction(): object
    {
        // Sets webpage title
        $title = "User";

        // Sets extended webpage title
        $titleExtended = " | My Content Database";

        // Connects to db
        $this->app->db->connect();

        // Retrieve content id
        $userName = $this->app->session->get("loggedIn");

        // SQL statement
        $sql = "SELECT * FROM users WHERE username = ?;";

        // Fetches data from db and stores in $resultset
        $user = $this->app->db->executeFetch($sql, [$userName]);

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "user" => $user
        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/user", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * POST mountpoint/user
     *
     * @return object
     *
     */
    public function userActionPost(): object
    {
        // Connects to db
        $this->app->db->connect();

        if (hasKeyPost("doSave")) {
            $params = getPost([
                "firstname",
                "lastname",
                "email",
                "password",
                "username"
            ]);

            // SQL statement
            $sql = "UPDATE users SET firstname=?, lastname=?, email=?, password=? WHERE username=?;";

            // Executes SQL statement
            $this->app->db->execute($sql, array_values($params));

            // Redirects
            return $this->app->response->redirect("user");
        }
    }
}
