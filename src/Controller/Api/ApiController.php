<?php
/**
* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
* @link      http://cakephp.org CakePHP(tm) Project
* @since     0.2.9
* @license   http://www.opensource.org/licenses/mit-license.php MIT License
*/
namespace App\Controller\Api;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Network\Request;
use Cake\Log\Log;
use Cake\Cache\Cache;
use Cake\Network\Exception\UnauthorizedException;

/**
* Application Controller
*
* Add your application-wide methods in the class below, your controllers
* will inherit them.
*
* @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
*/
class ApiController extends Controller
{
	

	const BEARER_LABEL='bearer';

    private $_errorVal = array();

	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');
    $this->loadComponent('Auth', [
    'storage' => 'Memory',
    'authenticate' => [
                          'ADmad/JwtAuth.Jwt' => [
                              'parameter' => 'token',
                              'userModel' => 'ResellerPrograms',
                              'fields' => [
                                  'username' => 'id'
                              ],
                              'queryDatasource' => true
                          ]
                      ],
                      'unauthorizedRedirect' => false,
                      'checkAuthIn' => 'Controller.initialize'
                  ]);
	}
  
}