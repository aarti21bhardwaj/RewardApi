<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

// Router::prefix('plugins', function (RouteBuilder $routes){

//     $routes->connect('/:controller',array('controller'=>':controller', 'action'=>'index',"_method" => "POST"));
// });

Router::prefix('api', function (RouteBuilder $routes) {

    
    $routes->connect('/:controller',array('controller'=>':controller', 'action'=>'add',"_method" => "POST"));


    $routes->connect('/:controller/:id',array('controller'=>':controller', 'action'=>'view',"_method" => "GET"), array('pass' => array('id'), 'id'=>'[\d]+')
        );
    $routes->connect('/:controller/:id',array('controller'=>':controller', 'action'=>'edit',"_method" => "PUT"), array('pass' => array('id'), 'id'=>'[\d]+')
        );
    $routes->connect('/:controller/:id',array('controller'=>':controller', 'action'=>'delete',"_method" => "DELETE"), array('pass' => array('id'), 'id'=>'[\d]+')
        );

    $routes->connect('/resellerPrograms/token/',array('controller'=>'ResellerPrograms', 'action'=>'token',"_method" => "POST"));


    $routes->fallbacks('InflectedRoute');
});

Router::prefix('reseller', function (RouteBuilder $routes) {

    $routes->connect('/staffs/update_password/',array('controller'=>'Staffs', 'action'=>'updatePassword',"_method" => "POST"));
    $routes->connect('/:controller',array('controller'=>':controller', 'action'=>'add',"_method" => "POST"));


    $routes->connect('/:controller/:id',array('controller'=>':controller', 'action'=>'view',"_method" => "GET"), array('pass' => array('id'), 'id'=>'[\d]+')
        );
    $routes->connect('/:controller/:id',array('controller'=>':controller', 'action'=>'edit',"_method" => "PUT"), array('pass' => array('id'), 'id'=>'[\d]+')
        );
    $routes->connect('/:controller/:id',array('controller'=>':controller', 'action'=>'delete',"_method" => "DELETE"), array('pass' => array('id'), 'id'=>'[\d]+')
        );

    $routes->connect('/staffs/update_password/:id',array('controller'=>'Staffs', 'action'=>'updatePassword',"_method" => "PUT"), array('pass' => array('id'), 'id'=>'[\d]+'));


    $routes->fallbacks('InflectedRoute');
});


Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Staffs', 'action' => 'login']);
    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);


    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('DashedRoute');
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();