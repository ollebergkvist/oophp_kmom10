<?php

/**
* This method is handler for the route:
* ANY mountpoint/login
*
* @return object
*
*/
public function loginAction(): object
{
// Defines variables
// $page = $this->app->page;
$request = $this->app->request;
$session = $this->app->session;
$response = $this->app->response;

// Sets webpage title
$title = "Login";

// Verifies login attempt
if ($request->getPost("login")) {
$username = $request->getPost("username");
$password = $request->getPost("password");
if ($this->content->login($username, $password)) {
$session->set("loggedin", $username);
$response->redirect("admin");
} else {
$message = "Wrong username and or password";
}

// else if ($this->content->login($username, $password)) {
// $session->set("loggedin", $username);
// $response->redirect("user");
// }
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
* GET mountpoint/logout
*
* @return object
*
*/
public function logoutAction(): object
{
// Sets webpage title
$title = "Logout";

// Sets extended webpage title
$titleExtended = " | My Content Database";

// Data array
$data = [
"title" => $title,
"titleExtended" => $titleExtended,

];

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
* ANY mountpoint/edit
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
$userName = getGet("username");

// SQL statement
$sql = "SELECT * FROM user WHERE username = ?;";

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
* POST mountpoint/edit
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
return $this->app->response->redirect("content/user");
}
}
}