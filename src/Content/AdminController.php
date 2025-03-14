<?php

namespace Olbe19\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * A AdminController Class
 *
 * @SuppressWarnings(PHPMD)
 *
 */
class AdminController implements AppInjectableInterface
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
        $this->admin = new Admin($this->app->db);
    }

    /**
     * This method is handler for the route:
     * ANY mountpoint/admin
     *
     * @return object
     *
     */
    public function indexAction(): object
    {
        // Sets webpage title
        $title = "Show all content with sorting and pagination";

        // Sets extended webpage title
        $titleExtended = " | Eshop";

        // Framework variables
        $response = $this->app->response;
        $session = $this->app->session;

        // Verifies if user is logged in
        if (!$session->get("loggedIn")) {
            $response->redirect("eshop/login");
        };

        // Retrieves title
        $searchTitle = getGet("searchTitle") ?? null;

        // Connects to db
        $this->app->db->connect();

        if ($searchTitle) {
            // Fetches data from db and stores in $resultset
            $resultset = $this->admin->getItem($searchTitle);
        } else {
            // Get number of hits per page
            $hits = getGet("hits", 8);
            if (!(is_numeric($hits) && $hits > 0 && $hits <= 8)) {
                die("Not valid for hits.");
            }

            // Get max number of pages
            $max = $this->admin->getMaxNumberOfItems();
            $max = ceil($max[0]->max / $hits);

            // Get current page
            $page = getGet("page", 1);
            if (!(is_numeric($hits) && $page > 0 && $page <= $max)) {
                die("Not valid for page.");
            }

            $offset = $hits * ($page - 1);

            // Only these values are valid
            $columns = ["id", "title", "type", "published", "created", "updated", "deleted"];
            $orders = ["asc", "desc"];

            // Get settings from GET or use defaults
            $orderBy = getGet("orderby") ?: "id";
            $order = getGet("order") ?: "asc";

            // Incoming matches valid value sets
            if (!(in_array($orderBy, $columns) && in_array($order, $orders))) {
                die("Not valid input for sorting.");
            }

            // Calls sortBlogposts method and stores data in $resultset
            $resultset = $this->admin->sortItems($orderBy, $order, $hits, $offset);
        }

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "resultset" => $resultset,
            "max" => $max ?? null,
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
        $titleExtended = " | Eshop";

        // Framework variables
        $response = $this->app->response;
        $session = $this->app->session;

        // Verifies if user is logged in
        if (!$session->get("loggedIn")) {
            $response->redirect("eshop/login");
        };

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

            // Calls createProduct method
            $this->admin->createBlogpost($title);

            // Retrieves id
            $id = $this->app->db->lastInsertId();
        }

        // Redirects
        return $this->app->response->redirect("admin/edit?id=$id");
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
        $titleExtended = " | Eshop";

        // Framework variables
        $response = $this->app->response;
        $session = $this->app->session;

        // Verifies if user is logged in
        if (!$session->get("loggedIn")) {
            $response->redirect("eshop/login");
        };

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

            // Executes SQL statement
            $this->admin->createProduct($name);

            // Retrieves id
            $id = $this->app->db->lastInsertId();
        }

        // Redirects
        return $this->app->response->redirect("admin/editproduct?id=$id");
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/reset
     *
     * @return object
     *
     */
    public function resetActionGet(): object
    {
        // Sets webpage title
        $title = "Reset database";

        // Sets extended webpage title
        $titleExtended = " | Eshop";

        // Framework variables
        $response = $this->app->response;
        $session = $this->app->session;

        // Verifies if user is logged in
        if (!$session->get("loggedIn")) {
            $response->redirect("eshop/login");
        };

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "output" => $output ?? null
        ];

        // Includes admin header
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
        return $this->app->response->redirect("admin/reset", $output);
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
        $titleExtended = " | Eshop";

        // Framework variables
        $response = $this->app->response;
        $session = $this->app->session;

        // Verifies if user is logged in
        if (!$session->get("loggedIn")) {
            $response->redirect("eshop/login");
        };

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

            // Executes SQL statement
            $this->admin->deleteBlogpost($contentId);

            // Redirects
            return $this->app->response->redirect("admin");
        }
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/deleteuser
     *
     * @return object
     *
     */
    public function deleteuserActionGet(): object
    {
        // Sets webpage title
        $title = "Delete user";

        // Sets extended webpage title
        $titleExtended = " | Eshop";

        // Framework variables
        $response = $this->app->response;
        $session = $this->app->session;

        // Verifies if user is logged in
        if (!$session->get("loggedIn")) {
            $response->redirect("eshop/login");
        };

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
     * POST mountpoint/deleteuser
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

            // Calls deleteUser method
            $this->admin->deleteUser($username);

            // Redirects
            return $this->app->response->redirect("admin/users");
        }
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/deleteproduct
     *
     * @return object
     *
     */
    public function deleteproductActionGet(): object
    {
        // Sets webpage title
        $title = "Delete product";

        // Sets extended webpage title
        $titleExtended = " | Eshop";

        // Framework variables
        $response = $this->app->response;
        $session = $this->app->session;

        // Verifies if user is logged in
        if (!$session->get("loggedIn")) {
            $response->redirect("eshop/login");
        };


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
     * POST mountpoint/deleteproduct
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

            // Executes SQL statement
            $this->admin->deleteProduct($productId);

            // Redirects
            return $this->app->response->redirect("admin/products2");
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
        $titleExtended = " | Eshop";

        // Framework variables
        $response = $this->app->response;
        $session = $this->app->session;

        // Verifies if user is logged in
        if (!$session->get("loggedIn")) {
            $response->redirect("eshop/login");
        };

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
            return $this->app->response->redirect("admin/delete&id=$contentId");
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

            // Calls editBlogpost method
            $this->admin->editBlogpost($params);

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
        $titleExtended = " | Eshop";

        // Framework variables
        $response = $this->app->response;
        $session = $this->app->session;

        // Verifies if user is logged in
        if (!$session->get("loggedIn")) {
            $response->redirect("eshop/login");
        };


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
            return $this->app->response->redirect("admin/deleteproduct&id=$productId");
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

            // Calls editProduct method
            $this->admin->editProduct($params);

            // Redirects
            return $this->app->response->redirect("admin/products2");
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
        $titleExtended = " | Eshop";

        // Framework variables
        $response = $this->app->response;
        $session = $this->app->session;

        // Verifies if user is logged in
        if (!$session->get("loggedIn")) {
            $response->redirect("eshop/login");
        };


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
            return $this->app->response->redirect("admin/deleteuser&username=$username");
        }

        if (hasKeyPost("doSave")) {
            $params = getPost([
                "firstname",
                "lastname",
                "email",
                "password",
                "username"
            ]);

            // Calls editUser method
            $this->admin->editUser($params);

            // Redirects
            return $this->app->response->redirect("admin/users");
        }
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
        $titleExtended = " | Eshop";

        // Framework variables
        $response = $this->app->response;
        $session = $this->app->session;

        // Verifies if user is logged in
        if (!$session->get("loggedIn")) {
            $response->redirect("eshop/login");
        };

        // Calls getUsers method and stores data in $resultset
        $resultset = $this->admin->getUsers();

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "resultset" => $resultset
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
     * GET mountpoint/products
     *
     * @return object
     *
     */
    public function products2ActionGet(): object
    {
        // Sets webpage title
        $title = "Products";

        // Sets extended webpage title
        $titleExtended = " | Eshop";

        // Framework variables
        $response = $this->app->response;
        $session = $this->app->session;

        // Verifies if user is logged in
        if (!$session->get("loggedIn")) {
            $response->redirect("eshop/login");
        };

        // Fetches data from db and stores in $resultset
        $resultset = $this->admin->getProducts();

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
}
