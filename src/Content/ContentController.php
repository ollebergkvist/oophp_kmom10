<?php

namespace Olbe19\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;
use Olbe19\TextFilter\MyTextFilter;

/**
 * A ContentController Class
 *
 * @SuppressWarnings(PHPMD)
 *
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
        $titleExtended = " | Eshop";

        // Calls methods to retrieve data from db
        $resultset = $this->content->get3LatestBlogposts();
        $resultset2 = $this->content->get3LatestProducts();
        $resultset3 = $this->content->getFeaturedBrand();
        $resultset4 = $this->content->getProductsOnSale();

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
        $titleExtended = " | Eshop";

        // Calls
        $resultset = $this->content->getProducts();

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "resultset" => $resultset
        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/products", $data);

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
        $titleExtended = " | Eshop";

        // Executes SQL and fetches data
        $resultset = $this->content->getBlog();

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
     * GET mountpoint/blogpost
     *
     * @return object
     *
     */
    public function blogpostActionGet(): object
    {
        // Retrieves route
        $route = getGet("route", "");

        // Sets extended webpage title
        $titleExtended = " | Eshop";

        // Connects to db
        $this->app->db->connect();


        if (substr($route, 0, 5) === "blog/") {
            // Retrieves slug
            $slug = substr($route, 5);

            // Calls getBlogpost and stores result in $content
            $content = $this->content->getBlogpost($slug);

            // Sets title
            $title = $content->title;

            // Error handling
            if (!$content) {
                $title = "404";
                return $this->app->response->redirect("eshop/error");
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
            "titleExtended" => $titleExtended,
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

        // Sets extended webpage title
        $titleExtended = " | Eshop";

        if (substr($route, 0, 8) === "product/") {
            // Retrieves slug
            $slug = substr($route, 8);

            // Calls getProduct and stores result in $content
            $content = $this->content->getProduct($slug);

            // Sets title
            $title = $content->name;

            // Error handling
            if (!$content) {
                $title = "404";
                return $this->app->response->redirect("eshop/error");
            }
        }

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "content" => $content
        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/product", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/error
     *
     * @return object
     *
     */
    public function errorActionGet(): object
    {
        // Sets webpage title
        $title = "404";

        // Sets extended webpage title
        $titleExtended = " | Eshop";

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
        $titleExtended = " | Eshop";

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
        $titleExtended = " | Eshop";

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "user"      => $user

        ];

        if ($request->getPost("logout")) {
            $session->delete("loggedIn");
            $response->redirect("eshop/login");
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
        $titleExtended = " | Eshop";

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended
        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/about", $data);

        // Renders page
        return $this->app->page->render($data);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/doc
     *
     * @return object
     *
     */
    public function docActionGet(): object
    {
        // Sets webpage title
        $title = "Doc";

        // Sets extended webpage title
        $titleExtended = " | Eshop";

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended
        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/doc", $data);

        // Renders page
        return $this->app->page->render($data);
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
                $response->redirect("eshop/login");
            } else {
                $message = "Username is already taken";
            }
        }

        // Sets extended webpage title
        $titleExtended = " | Eshop";

        // Data array
        $data = [
            "title" => $title,
            "titleExtended" => $titleExtended,
            "message" => $message ?? null
        ];

        // Adds route and sends data array to view
        $this->app->page->add("content/register", $data);

        // Renders page
        return $this->app->page->render($data);
    }
}
