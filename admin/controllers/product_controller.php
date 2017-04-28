<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require '../../configs/config.php';
require_once '../models/product_model.php';
require_once '../libs/functions.php';

class ProductController {
    public $p_model;
    public $ctr_name = 'product';
    public function __construct()
    {
        $this->p_model = new ProductModel();
        /*if(!isset($_SESSION['cate_info'])){
            $this->loginAction();
        }*/
    }

    function indexAction($data){
        $this->listAction($data);
    }

    function listAction($data){

        $datacate = $this->p_model->getAllCate();
        $_SESSION['cate'] = $datacate;

        if($data['cateid'] == 'all' && $data['ptid'] == 'all'){
            $datapt = $this->p_model->getAllProductType();
            $_SESSION['pt'] = $datapt;
            $datap = $this->p_model->getAllProduct();
            $_SESSION['product'] = $datap;
        }
        if($data['cateid'] != 'all' && $data['ptid'] == 'all'){
            $datapt = $this->p_model->getAllProductTypeByCate($data);
            $_SESSION['pt'] = $datapt;
            $datap = $this->p_model->getAllProductByCate($data);
            $_SESSION['product'] = $datap;
        }
        if($data['cateid'] == 'all' && $data['ptid'] != 'all'){
            $datapt = $this->p_model->getAllProductType();
            $_SESSION['pt'] = $datapt;
            $datap = $this->p_model->getAllProductByProductType($data);
            $_SESSION['product'] = $datap;
        }
        if($data['cateid'] != 'all' && $data['ptid'] != 'all'){
            $datapt = $this->p_model->getAllProductTypeByCate($data);
            $_SESSION['pt'] = $datapt;
            $datap = $this->p_model->getAllProductByProductTypeAndCate($data);
            $_SESSION['product'] = $datap;
        }
        require_once '../views/products/list.php';
    }

    public function viewProduct($data){
        $datacate = $this->p_model->getAllCate();
        $_SESSION['cate'] = $datacate;
        if($data['cateid'] == 'all' && $data['ptid'] == 'all'){
            $datapt = $this->p_model->getAllProductType();
            $_SESSION['pt'] = $datapt;

        }
        if($data['cateid'] != 'all' && $data['ptid'] == 'all'){
            $datapt = $this->p_model->getAllProductTypeByCate($data);
            $_SESSION['pt'] = $datapt;
        }
        if($data['cateid'] == 'all' && $data['ptid'] != 'all'){
            $datapt = $this->p_model->getAllProductType();
            $_SESSION['pt'] = $datapt;

        }
        if($data['cateid'] != 'all' && $data['ptid'] != 'all'){
            $datapt = $this->p_model->getAllProductTypeByCate($data);
            $_SESSION['pt'] = $datapt;

        }
        $product_info = $this->p_model->getProductById($data);
        $_SESSION['product_info'] = $product_info;
        require_once '../views/products/product_info.php';
    }

    public function showEditPageAction($data){
        $data_info = $this->p_model->getProductById($data);
        $data_image = $this->p_model->getImageProduct($data);
        $_SESSION['p_info'] = $data_info;
        $_SESSION['p_image'] = $data_image;
        require_once '../views/products/edit.php';
    }

    public function editAction($data, $obj_file){

        if($obj_file['p-image']['name'][0] != ''){
            $result_manyimage = uploadManyImage(URL_IMAGE_UPLOAD_PART.'/product_images/', $obj_file, 1, 10*1048576, array('jpg', 'gif', 'png', 'jpeg', 'JPG'));
            /*var_dump($result['newNameImage'][0]);*/
            for($i = 0; $i < count($result_manyimage['newNameImage']); $i++){
                $this->p_model->insertProductImage($result_manyimage['newNameImage'][$i],$data['id']);
            }

        }

        if($obj_file['avatar-reg']['name'] != ''){
            $result_avatar = uploadImage(URL_IMAGE_UPLOAD_PART.'/products/', $obj_file, 1, 10*1048576, array('jpg', 'gif', 'png', 'jpeg', 'JPG'));
            $data['avatar'] = $result_avatar['newNameImage'];
            unlink(URL_IMAGE_UPLOAD_PART.'/products/'.$_SESSION['p_info'][0]['image']);
        }else{
            $data['avatar'] = $_SESSION['p_info'][0]['image'];
        }
        $result = $this->p_model->updateProductById($data);
        if($result){
            $_SESSION['messages'] = 'Edit Product success';
            header('Location:product_controller.php?action=listProduct&cateid=all&ptid=all');
        }else{
            $_SESSION['messages'] = 'Edit fail';
            header('Location:product_controller.php?action=editPage&id='.$data['id']);
        }
    }

}

//Created new object cateControllers
$product = new ProductController();


if(isset($_REQUEST['action'])){
    $_SESSION['ctr_name'] = $product->ctr_name;
    $_SESSION['sub_menu'] = $action = $_REQUEST['action'];

}else{
    $action = 'index';
}

//Process controllers
switch ($action){
    case 'index':
        $product->indexAction($_REQUEST);
        break;
    case 'listProduct':
        $product->listAction($_REQUEST);
        break;
    case 'view';
        $product->viewProduct($_REQUEST);
        break;
    case 'editPage':
        $product->showEditPageAction($_REQUEST);
        break;
    case 'edit':
        $product->editAction($_REQUEST, $_FILES);
        break;
}