<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 17-Apr-17
 * Time: 10:13 AM
 */
require_once '../../models/db.php';
class ProductModel extends DB {

    //check username and password for login action
    //get All Categories
    public function getAllCate(){
        $query = 'select id, cate_name, cate_tenkhongdau from categories';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function getAllProductType(){
        $query = 'select pt.id, pt.pt_name, pt.id_categories, pt.pt_tenkhongdau, pt.created_at, pt.updated_at, c.cate_name from producttype pt 
                  INNER JOIN categories c ON c.id = pt.id_categories';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function getAllProduct(){
        $query = 'SELECT id, p_name, p_tenkhongdau, image, price, created_at, updated_at from product';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function getAllProductByCate($data){
        $query = 'SELECT p.id, p.p_name, p.p_tenkhongdau, p.image, p.price, p.created_at, p.updated_at from product p
                  INNER JOIN producttype pt ON p.id_producttype=pt.id
                  WHERE pt.id_categories = '.$data['cateid'];
        $result = $this->executeQuery($query);
        return $result;
    }

    //get All ProductType By Cate id
    public function getAllProductTypeByCate($data){
        $query = 'SELECT pt.id, pt.pt_name, pt.id_categories, pt.pt_tenkhongdau, pt.created_at, pt.updated_at, c.cate_name from producttype pt 
                  INNER JOIN categories c ON c.id = pt.id_categories
                  WHERE pt.id_categories = '.$data['cateid'];
        $result= $this->executeQuery($query);
        return $result;
    }

    public function getInfoProductTypeById($data){
        $query = 'SELECT id, id_categories, pt_name, pt_tenkhongdau, created_at, updated_at from producttype WHERE id = '.$data['id'];
        $result= $this->executeQuery($query);
        return $result[0];
    }

    public function getAllProductByProductType($data){
        $query = 'SELECT p.id, p.p_name, p.p_tenkhongdau, p.image, p.price, p.created_at, p.updated_at from product p 
                  INNER JOIN producttype pt ON pt.id = p.id_producttype
                  WHERE p.id_producttype = '.$data['ptid'];
        $result= $this->executeQuery($query);
        return $result;
    }


    public function getAllProductByProductTypeAndCate($data){
        $query = 'SELECT p.id, p.p_name, p.p_tenkhongdau, p.image, p.price, p.created_at, p.updated_at from product p 
                  INNER JOIN producttype pt ON pt.id = p.id_producttype
                  INNER JOIN categories c ON c.id = pt.id_categories
                  WHERE p.id_producttype = '.$data['ptid'].' and pt.id_categories = '.$data['cateid'];
        $result= $this->executeQuery($query);
        return $result;
    }

    public function getProductById($data){
        $query = 'SELECT p.id,p.p_name, p.p_tenkhongdau, p.tomtat, p.description, p.image, p.price, p.created_at, p.updated_at, pt.id_categories, c.cate_name, pt.pt_name
                  FROM product p 
                  INNER JOIN producttype pt ON p.id_producttype = pt.id
                  INNER JOIN categories c ON pt.id_categories = c.id
                  WHERE p.id = '.$data['id'];
        $result = $this->executeQuery($query);
        return $result;
    }

    public function getImageProduct($data){
        $query = 'SELECT id, pi_name FROM product_image WHERE product_id = '.$data['id'];
        $result  = $this->executeQuery($query);
        return $result;
    }

    public function insertProductImage($data, $id){
        $query = 'INSERT INTO product_image(pi_name, product_id) VALUES ("'.$data.'", '.$id.')';
        $result  = $this->executeQuery($query);
        return $result;
    }

    public function updateProductById($data){
        $query = 'UPDATE product
                  SET p_name = "'.$data['pname'].'", p_tenkhongdau = "'.$data['plink'].'", tomtat = "'.$data['tt-edit'].'", 
                  description = "'.$data['desc-edit'].'", image = "'.$data['avatar'].'", price = '.$data['p-price'].'
                  where id = '.$data['id'];
        $result = $this->updateQuery($query);
        return $result;
    }

}