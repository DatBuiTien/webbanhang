<?php
session_start();
require_once '../configs/config.php';
require_once '../models/index_model.php';
require_once '../admin/libs/functions.php';
class IndexController{
    public $index_model;
    public $ctr_name = 'index';
    public function __construct()
    {
        $this->index_model = new IndexModel();
        $_SESSION['menu'] = $this->index_model->getAllcategories();
        $sub_menu = $this->index_model->getAllProductType();
        $_SESSION['sub-menu'] = $sub_menu;

    }
    public function indexAction(){
        //get categories menu
        $new_data = $this->index_model->getNewProduct();
        $_SESSION['newdata'] = $new_data;
        $feature_data = $this->index_model->getFeatureProduct();
        $_SESSION['feature_data'] = $feature_data;

        require_once '../views/index.php';
    }

    public function searchAction($data){
        $result = $this->index_model->searchProduct($data);
        $_SESSION['product'] = $result;
        require_once '../views/index/search.php';
    }

    public function showCardAction(){
        if(isset($_SESSION['card']['id_products'])){
            $_SESSION['data'] = $this->index_model->getProductInCard($_SESSION['card']['id_products']);
            sort($_SESSION['card']['id_products']);
            $countdata['count'] = array_count_values($_SESSION['card']['id_products']);
            $count=0;
            $_SESSION['total'] = 0;
            foreach ($countdata['count'] as $item => $value){
                $_SESSION['data'][$count]['quantity'] = $value;
                $_SESSION['data'][$count]['total'] = $value*$_SESSION['data'][$count]['price'];
                $_SESSION['total'] = $_SESSION['total'] + $_SESSION['data'][$count]['total'];
                $count++;
            }
        }

        require_once '../views/showcard.php';
    }
}

//Create new object index_ctr
$index_ctr  = new IndexController();
if(isset($_REQUEST['action'])){
    $_SESSION['ctr_name'] = $index_ctr->ctr_name;
    $_SESSION['sub_menu'] = $action = $_REQUEST['action'];
    $action = $_REQUEST['action'];
}else{
    $action = 'index';
}

//Process controller
switch ($action){
    case 'index':
        $index_ctr->indexAction();
        break;
    case 'allProduct':
        $index_ctr->getAllProduct();
        break;
    case 'search':
        $index_ctr->searchAction($_REQUEST);
        break;
    case 'showCard':
        $index_ctr->showCardAction();
        break;
    default:
        $index_ctr->indexAction();
        break;
}