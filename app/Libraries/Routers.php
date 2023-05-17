<?php

namespace App\Libraries;

use CoffeeCode\Router\Router;

class Routers
{
  public function __construct()
  {
    $router = new Router(URL);

    $router->namespace("App\Controllers");
    $router->group(null);
    $router->get("/", handler:"Home:index");
    $router->get("/{id}", handler:"Home:index");
    $router->get("/about", handler:"Home:about");



    $router->group("error");
    $router->get("/{errcode}", handler:"Error:index");
    /**
     * This method executes the routes
     */
    $router->dispatch();


    /*
 * Redirect all errors
 */
    if ($router->error()) {
      $router->redirect("/error/{$router->error()}");
    }
  }
}
