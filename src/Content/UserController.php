<?php

namespace Olbe19\Content;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

/**
 * A UserController Class
 */
class UserController implements AppInjectableInterface
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
        $this->user = new User($this->app->db);
    }

    /**
     * This method is handler for the route:
     * GET mountpoint/user
     *
     * @return object
     *
     */
    public function indexActionGet(): object
    {
        // Sets webpage title
        $title = "User";

        // Sets extended webpage title
        $titleExtended = " | Eshop";

        // Framework variables
        $response = $this->app->response;
        $session = $this->app->session;

        // Verifies if user is logged in
        if (!$session->get("loggedIn")) {
            $response->redirect("eshop/login");
        };

        // Retrieve content id
        $userName = $this->app->session->get("loggedIn");

        // Calls user method
        $user = $this->user->getUser($userName);

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
    public function indexActionPost(): object
    {
        if (hasKeyPost("doSave")) {
            $params = getPost([
                "firstname",
                "lastname",
                "email",
                "password",
                "username"
            ]);

            // Calls user method
            $this->user->updateUser($params);

            // Redirects
            return $this->app->response->redirect("user");
        }
    }
}
