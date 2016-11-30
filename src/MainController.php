<?php
/**
 * The main controller.
 */
namespace Itb;

/**
 * all actions from index come here
 * Class MainController
 * @package Itb
 */
class MainController{

    /**
     *Go to index page
     */
    public function indexAction()
    {
        $isLoggedIn = $this->isLoggedInFromSession();   //add these 3 lines to each page
        $username = $this->usernameFromSession();
        $backgroundColor = $this->getBackgroundColor();
        $indexLinkClass = "current_page";
       //start session

        require_once __DIR__ . '/../templates/index.php';
    }
/**************************** Shop *********************************************/
    /**
     * Go to shop page
     */
    public function shopAction()
    {
        $isLoggedIn = $this->isLoggedInFromSession();   //add these 3 lines to each page
        $username = $this->usernameFromSession();
        $backgroundColor = $this->getBackgroundColor();

        $shopLinkClass = "current_page";

        $productRepository = new ProductRepository();

        $products = $productRepository->getAllProducts();

        require_once __DIR__ . '/../templates/shop.php';
    }


    /**
     * give back the array with the contents of the shopping cart
     * @return array
     */
    public function getShoppingCart()
    {
        if (isset($_SESSION['shoppingCart'])){
            return $_SESSION['shoppingCart'];
        } else {
            return [];
        }
    }

    /**
     * add items to the shopping cart by getting the id
     * add the correct quantity of each item added to the cart
     */
    public function addToCart()
    {
        // get the ID of product to add to cart
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $shoppingCart = $this->getShoppingCart();       // get the cart array

        $oldTotal = 0;    				     // default is old total is zero

        // if quantity found in cart array, then use it as oldTotal
        if(isset($shoppingCart[$id])){
            $oldTotal = $shoppingCart[$id];
        }

        $shoppingCart[$id] = $oldTotal + 1;             // add 1 to the quantity in shopping cart
        $_SESSION['shoppingCart'] = $shoppingCart;      // store new  array into SESSION

        $this->showShoppingCartAction(); 			    // redirect to shopping cart
    }

    /**
     * take everything out of the shopping cart
     */
    public function emptyCartAction(){
        unset($_SESSION['shoppingCart']);
        $this->showShoppingCartAction();
    }

    /**
     * remove an item from the shopping cart using the item id
     */
    public function removeFromCart() {
        // get the ID of product to add to cart
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        // get the cart array
        $shoppingCart = $this->getShoppingCart();

        // remove entry for this ID
        unset($shoppingCart[$id]);

        // store new  array into SESSION
        $_SESSION['shoppingCart'] = $shoppingCart;

        // redirect display page
        $this->shopAction();
    }

    /**
     * go to the shopping cart page
     */
    public function showShoppingCartAction()
    {
        $isLoggedIn = $this->isLoggedInFromSession();   //add these 3 lines to each page
        $username = $this->usernameFromSession();
        $backgroundColor = $this->getBackgroundColor();
        $cartLinkClass = "current_page";

        $shoppingCart = $this->getShoppingCart();


        require_once __DIR__ . '/../templates/cart.php';

    }




/******************************************** Users ************************************/

    /**
     * Go to the page where admin can create, read, update and delete users
     */
    public function crudUsersAction()
    {
        $isLoggedIn = $this->isLoggedInFromSession();   //add these 3 lines to each page
        $username = $this->usernameFromSession();
        $backgroundColor = $this->getBackgroundColor();

        $crudUsersLinkClass= "current_page";

        $userRepository = new UserRepository();

        $users = $userRepository->getAll();

        require_once __DIR__ . '/../templates/users.php';
    }

    /**
     * Go to the profile page of the users logged in
     */
    public function profilePageAction()
    {
        $isLoggedIn = $this->isLoggedInFromSession();   //add these 3 lines to each page
        $username = $this->usernameFromSession();
        $backgroundColor = $this->getBackgroundColor();

        $userId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $userRepository = new UserRepository();

        $user = $userRepository->getOneById($userId);

        $userImageRepository = new UserImageRepository();
        $userImages = $userImageRepository->getImages();

        if(null == $user){
            $message = 'sorry, no user with id = ' . $userId . ' could be retrieved from the database';

            $this->messageAction($message);
        } else {
            require_once __DIR__ . '/../templates/profilePage.php';
        }

    }

    /**
     * update users information
     */
    public function updateUserAction()
    {
        $userRepository = new UserRepository();

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_NUMBER_INT);
        $userImage = filter_input(INPUT_POST, 'userImage', FILTER_SANITIZE_STRING);

        $user = new User();
        $user->setId($id);
        $user->setUsername($username);
        $user->setRole($role);
        $user->setPassword($password);
        if(isset($userImage)){
            $user->setUserImage($userImage);
        }else{
            $userImage="elsa.jpg";
            $user->setUserImage($userImage);
        }

        $success = $userRepository->updateUser($user, $password);
        if($success){
            $message = "SUCCESS - User updated";
        } else {
            $message = 'Sorry, we were not able to update the user, or you didn\'t change any details';
        }
        $this->messageAction($message);
    }

    /**
     * show the page with the form to update users
     */
    public function showUpdateUserFormAction()
    {
        $isLoggedIn = $this->isLoggedInFromSession();   //add these 3 lines to each page
        $username = $this->usernameFromSession();
        $backgroundColor = $this->getBackgroundColor();
        $userRepository = new UserRepository();

        // ID from GET parameters
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        // get array, ready for view to use to populate form
        $user = $userRepository->getOneById($id);

        require_once __DIR__ . '/../templates/updateUserForm.php';
    }


    /**
     * show the page to register a new user
     */
    public function registerAction()
    {
        $isLoggedIn = $this->isLoggedInFromSession();   //add these 3 lines to each page
        $username = $this->usernameFromSession();
        $backgroundColor = $this->getBackgroundColor();
        require_once __DIR__ . '/../templates/register.php';
    }

    /**
     * create a user, add to database
     */
    public function createUserAction()
    {
        $userRepository = new userRepository();

        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_NUMBER_INT);
        $password1 = filter_input(INPUT_POST, 'registerPassword1', FILTER_SANITIZE_STRING);
        $password2 = filter_input(INPUT_POST, 'registerPassword2', FILTER_SANITIZE_STRING);
        $userImage = filter_input(INPUT_POST, 'userImage', FILTER_SANITIZE_STRING);
        if ($password1 == $password2) {
            $password = $password1;

            $user = new User();
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setRole($role);

            if(isset($userImage)){
                $user->setUserImage($userImage);
            }else{
                $userImage="elsa.jpg";
                $user->setUserImage($userImage);
            }

            $success = $userRepository->createNewUser($user, $password);

            if($success){
                $message = "SUCCESS - Profile has been created";
            } else {
                $message = 'sorry, there was a problem creating your profile, try again';
            }
            $this->messageAction($message);

        }else{
            $message = 'You passwords did not match, try again';
            $this->messageAction($message);

        }
    }

    /**
     * delete user with the id received
     */
    public function deleteUserAction()
    {
        $userRepository = new UserRepository();
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $success = $userRepository->deleteUser($id);

        if($success){
            $message = 'SUCCESS - user with id = ' . $id . ' was deleted';
        } else {
            $message = 'sorry, user id = ' . $id . ' could not be deleted';
        }
        $this->messageAction($message);
    }

/************************************ Profile Images **********************************************/

    /**
     * Upload an image from the user
     */
    public function changeProfileImageAction()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        //the directory where the file is going
        $target_dir = "images/";
        //the path to the directory
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);

        $uploadOk = false;

        //holds the file extension
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["picture"]["tmp_name"]);

            if($check !== false) {
                //is an image
                $uploadOk = true;
            } else {
                //is not an image
                $uploadOk = false;
            }
        }

        // Check file size
        if ($_FILES["picture"]["size"] > 500000) {
            //file too large
            $uploadOk = false;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            //not accepted file type
            $uploadOk = false;
        }
        // Check if $uploadOk is set to false by an error
        if ($uploadOk == false) {
            $message = "Sorry, your file was not uploaded. It must be a png, jpeg, jpg or gif file. It cannot be over 500KB. ";
            $this->messageAction($message);
        }

        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            $userImage = $_FILES["picture"]["name"];

            $userRepository = new UserRepository();

            $success = $userRepository->setProfilePicture($id, $userImage);

            if($success){

                $message = "SUCCESS - picture attached to profile";
            } else {
                $message = 'Sorry, we were not able to attach picture to profile';
            }

            $this->messageAction($message);
        }


    }

    /**
     *  If user picks a default image, attach it to users id
     */
    public function pickImageAction()
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $userImage = filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_STRING);


        $userRepository = new UserRepository();

        $success = $userRepository->setProfilePicture($id, $userImage);
        if($success){
            $message = "SUCCESS - picture attached to profile";
        } else {
            $message = 'Sorry, we were not able to attach picture to profile';
        }
        $this->messageAction($message);
    }


/********************************** Products *****************************************/

    /**
     * show an individual product
     */
    public function showOneProductAction()
    {

        $productRepository = new ProductRepository();

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $product = $productRepository->getOneById($id);

        if(null == $product){
            $message = 'product with id = ' . $id . ' could not be retrieved';

            $this->messageAction($message);
        } else {
            $this->detailAction();
        }
    }

    /**
     * delete one product from database
     */
    public function deleteProductAction()
    {
        $productRepository = new ProductRepository();
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        $success = $productRepository->deleteProduct($id);

        if($success){
            $message = 'SUCCESS - product with id = ' . $id . ' was deleted';
        } else {
            $message = 'sorry, product id = ' . $id . ' could not be deleted';
        }
        $this->messageAction($message);
    }

    /**
     * show the form to create a new product
     */
    public function showNewProductFormAction()
    {
        $isLoggedIn = $this->isLoggedInFromSession();   //add these 3 lines to each page
        $username = $this->usernameFromSession();

        $backgroundColor = $this->getBackgroundColor();
        require_once __DIR__ . '/../templates/newProductForm.php';
    }

    /**
     * add the new product to the database
     */
    public function createProductAction()
    {
        $productRepository = new ProductRepository();
        $productName = filter_input(INPUT_POST, 'productName', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT);

        $product = new Product();
        $product->setProductName($productName);
        $product->setDescription($description);
        $product->setPrice($price);
        $product->setRating($rating);

        $success = $productRepository->createNewProduct($product);

        if($success){
            $message = "SUCCESS - new product created";
        } else {
            $message = 'sorry, there was a problem creating new product';
        }
        $this->messageAction($message);
    }

    /**
     * show the form to update a product
     */
    public function showUpdateProductFormAction()
    {
        $isLoggedIn = $this->isLoggedInFromSession();   //add these 3 lines to each page
        $username = $this->usernameFromSession();

        $backgroundColor = $this->getBackgroundColor();
        $productRepository = new ProductRepository();

        // ID from GET parameters
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        // get array, ready for view to use to populate form
        $product = $productRepository->getOneById( $id);

        require_once __DIR__ . '/../templates/updateProductForm.php';
    }

    /**
     * update the database with the updated product information
     */
    public function updateProductAction()
    {
        $productRepository = new ProductRepository();

        $id = filter_input(INPUT_POST, 'productId', FILTER_SANITIZE_NUMBER_INT);
        $productName = filter_input(INPUT_POST, 'productName', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT);


        $product = new Product();
        $product->setProductId($id);
        $product->setProductName($productName);
        $product->setDescription($description);
        $product->setPrice($price);
        $product->setRating($rating);

        $success = $productRepository->updateProduct($product);
        if($success){
            $message = "SUCCESS - product updated";
        } else {
            $message = 'Sorry, we were not able to update the product, or you didn\'t change any details';
        }
        $this->messageAction($message);
    }

    /**
     * show the detail page, with one product per page
     */
    public function detailAction() {
        $isLoggedIn = $this->isLoggedInFromSession();   //add these 3 lines to each page
        $username = $this->usernameFromSession();
        $backgroundColor = $this->getBackgroundColor();

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $productRepository = new ProductRepository();

        $product = $productRepository->getOneById($id);

        if(null == $product){
            $message = 'sorry, no product with id = ' . $id . ' could be retrieved from the database';

            $this->messageAction($message);

        } else {
            // output the detail of product in HTML table
            require_once __DIR__ . '/../templates/detail.php';
        }
    }
    
/********************************************** LogIn ***************************************************/

    /**
     * Show the login page
     */
    public function loginAction()
    {
        $isLoggedIn = $this->isLoggedInFromSession();   //add these 3 lines to each page
        $username = $this->usernameFromSession();
        $backgroundColor = $this->getBackgroundColor();
        require_once __DIR__ . '/../templates/login.php';
    }

    /**
     * process the login,
     */
    public function processLoginAction()
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // search for user with username in repository
        $userRepository = new UserRepository();
        $isLoggedIn = $userRepository->canFindMatchingUsernameAndPassword($username, $password);

       // action dependant on login success
        if ($isLoggedIn) {
            //Store Login Status Session
            $_SESSION['username'] = $username;
            $message = 'Welcome back '. $username.'. You have logged in successfully';
        } else {
            $message = 'Bad username or password, please try again';
        }
        $this->messageAction($message);
    }

/**************************************** Sessions *************************************/
    /**
     * find out if a user is logged in
     * @return bool
     */
    public function isLoggedInFromSession() {
        $isLoggedIn = false;
        // user is logged in if there is a 'user' entry in the SESSION superglobal
        if(isset($_SESSION['username'])){
            $isLoggedIn = true;

        }
        return $isLoggedIn;
    }

    /**
     * return the username from the session
     * @return string
     */
    public function usernameFromSession() {
        $username = '';
	    // extract username from SESSION superglobal
	    if (isset($_SESSION['username'])) {
		    $username = $_SESSION['username'];
	    }
	    return $username;
    }

    /**
     * end session
     */
    public function forgetSession()
    {
        $this->killSession();

        $message = 'You have logged out - all session data deleted';

        $this->messageAction($message);

    }

    /**
     *  end the session, remove all data
     */
    public function killSession()
    {
        //Unset the sessions variables
        $_SESSION = [];

        //delete session cookies
        if (ini_get('session.use_cookies')){
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }
        //destroy the session
        session_destroy();
    }


/*******************************************************Background Colour / Message *************************************/

    /**
     * get the background colour for all pages
     * @return string
     */
    public function getBackgroundColor()
    {
        // default to LIGHT BLUE if not found in $_SESSION
        if (isset($_SESSION['backgroundColor'])){
            return $_SESSION['backgroundColor'];
        } else {
            return '#CAF0FF'; //light blue
        }
    }

    /**
     * change the session background color
     * @param $color string
     */
    public function changeBackgroundColor($color)
    {
        $_SESSION['backgroundColor'] = $color;
        $this->indexAction();
    }

    /**
     * go to the change background colour page
     */
    public function changeBackground(){
        $isLoggedIn = $this->isLoggedInFromSession();   //add these 3 lines to each page
        $username = $this->usernameFromSession();
        $backgroundColor = $this->getBackgroundColor();
        require_once __DIR__ . '/../templates/changeBackground.php';
    }

    /**
     * Shows the message page
     * @param $messageIn string
     */
    public function messageAction($messageIn){
        
        $message = $messageIn;
        $isLoggedIn = $this->isLoggedInFromSession();   //add these 3 lines to each page
        $username = $this->usernameFromSession();
        $backgroundColor = $this->getBackgroundColor();
        require_once __DIR__ . '/../templates/message.php';
    }
    /*********************************************** Contact/SiteMap Page ******************************************/

    /**
     * shows the contact page
     */
    public function contactAction()
    {
        $isLoggedIn = $this->isLoggedInFromSession();   //add these 3 lines to each page
        $username = $this->usernameFromSession();
        $backgroundColor = $this->getBackgroundColor();
        $contactLinkClass = "current_page";

        require_once __DIR__ . '/../templates/contact.php';
    }

    /**
     * shows the sitemap page
     */
    public function sitemapAction()
    {
        $isLoggedIn = $this->isLoggedInFromSession();   //add these 3 lines to each page
        $username = $this->usernameFromSession();
        $backgroundColor = $this->getBackgroundColor();
        $sitemapLinkClass = "current_page";

        require_once __DIR__ . '/../templates/sitemap.php';
    }

}