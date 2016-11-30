<?php
session_start();

define('DB_HOST', 'localhost');
define('DB_NAME', 'frozen');
define('DB_USER', 'fred');
define('DB_PASS', 'smith');

require_once __DIR__.'/../vendor/autoload.php';

use Itb\MainController;

// get value from ‘action’ parameter and filter

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);



$mainController = new MainController();
//to choose what view to display

switch($action){


    case 'shop':
        $mainController->shopAction();
        break;

    case 'addToCart':
        $mainController->addToCart();
        break;

    case 'removeFromCart':
        $mainController->removeFromCart();
        break;

    case 'emptyCart':
        $mainController->emptyCartAction();
        break;

    case 'showShoppingCart':
        $mainController->showShoppingCartAction();
        break;

    case 'show':
        $mainController->showOneProductAction();
        break;

    case 'delete':
        $mainController->deleteProductAction();
        break;

    case 'showNewProductForm':
        $mainController->showNewProductFormAction();
        break;

    case 'createNewProduct':
        $mainController->createProductAction();
        break;

    case 'showUpdateProductForm':
        $mainController->showUpdateProductFormAction();
        break;

    case 'updateProduct':
        $mainController->updateProductAction();
        break;

    case 'detail':
       $mainController->detailAction();
        break;

    case 'contact':
        $mainController->contactAction();
        break;

     case 'sitemap' :
         $mainController->sitemapAction();
         break;

    case 'logout':
        $mainController->forgetSession();
        break;

    case 'login' :
        $mainController->loginAction();
        break;

    case 'processLogin' :
        $mainController->processLoginAction();
        break;

    case 'register' :
        $mainController->registerAction();
        break;

    case 'crudUsers':
        $mainController->crudUsersAction();
        break;

    case 'profilePage':
        $mainController->profilePageAction();
        break;

    case 'createNewUser':
        $mainController->createUserAction();
        break;

    case 'showUpdateUserForm' :
        $mainController->showUpdateUserFormAction();
        break;

    case 'updateUser' :
        $mainController->UpdateUserAction();
        break;
    case 'deleteUser':
        $mainController->deleteUserAction();
        break;
    case 'changeProfileImage':
        $mainController->changeProfileImageAction();
        break;
    case 'pickImage':
        $mainController->pickImageAction();
        break;

    case 'setBackgroundColorPink':
        $mainController->changeBackgroundColor('pink');
        break;

    case 'setBackgroundColorYellow':
        $mainController->changeBackgroundColor('#FFF294');
        break;
    case 'setBackgroundColorGreen':
        $mainController->changeBackgroundColor('#2EFFB8');
        break;
    case 'changeBackground':
        $mainController->changeBackground();
        break;
    //-------------------------------------
    // ELSE show home page
    //-------------------------------------
    case 'index':
        default:

    $mainController->indexAction();

 }
