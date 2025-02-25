<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    protected $session;
    protected $db;
    protected $mailer;

    protected $validation;
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['form'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        //Database
        $this->db = \Config\Database::connect();
    }

    public function cargar_vista($vista, $datos)
    {
        if (gettype($vista) === 'string') {
            return view('templates/header')
                . view($vista, $datos)
                . view('templates/footer');
        }

        if (gettype($vista) === 'array') {
            $views = view('templates/header');
            foreach ($vista as $v) {
                $views .= view($v, $datos);
            }
            $views .= view('templates/footer');
            return $views;
        }
    }

    public function autentificar($level) {
        if($level === 0) {
            if(!isset($_SESSION["admin"])) {
                return false;
            }
        }

        if($level === 1) {
            if(!isset($_SESSION["vendedor"])) {
                return false;
            }
        }

        return true;
    }
}
