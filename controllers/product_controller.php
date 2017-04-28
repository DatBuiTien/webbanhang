<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 12-Apr-17
 * Time: 7:41 PM
 */
session_start();
require_once '../configs/config.php';
require_once '../models/product_model.php';
require_once '../admin/libs/functions.php';

class ProductController{
    public $product_model;
    public $ctr_name = 'index';
    public function __construct()
    {
        $this->product_model = new ProductModel();
        $_SESSION['menu'] = $this->product_model->getAllCate();
        $sub_menu = $this->product_model->getAllProductType();
        $_SESSION['sub-menu'] = $sub_menu;
    }

    function indexAction($data){

        $products  = $this->product_model->getInfoProduct($data);
        $_SESSION['product'] = $products;
        $product_image = $this->product_model->getImageProduct($data);
        $_SESSION['product_image'] = $product_image;
        $product_related = $this->product_model->getProductRelated($_SESSION['product']);
        $_SESSION['product_related'] = $product_related;

        require_once '../views/products/index.php';

    }

    public function addToCardAction($data){
        if(!isset($_SESSION)){
            $_SESSION['card'] = array(
                'id_products' => [$data['id']],
                'card_count' => 1
            );
        }else{
            $_SESSION['card']['id_products'][] = $data['id'];
            $_SESSION['card']['card_count'] ++;
        }
        header('Location:index_controller.php');
    }
}

$product_ctrl = new ProductController();
if(isset($_REQUEST['action'])){
    $_SESSION['ctr_name'] = $product_ctrl->ctr_name;
    $_SESSION['sub_menu'] = $action = $_REQUEST['action'];
    $action = $_REQUEST['action'];
}else{
    $action = 'index';
}
switch ($action){
    case 'index':
        $product_ctrl->indexAction($_REQUEST);
        break;
    case 'addtocard':
        $product_ctrl->addToCardAction($_REQUEST);
    default:
        $product_ctrl->indexAction($_REQUEST);
        break;
}
