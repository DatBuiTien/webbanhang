<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 12-Apr-17
 * Time: 3:29 PM
 */
require_once '../configs/config.php';
require_once '../models/db.php';
class IndexModel extends DB {
    public function getAllcategories(){
        $query = 'select id, cate_name, cate_tenkhongdau, created_at, update_at from categories';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function getAllProductType(){
        $query='select * from producttype';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function getAllProducts(){
        $query = 'select p.id, p.name, p.price, g.name, g.image
        from products as p 
        INNER JOIN product_images as pi ON p.id=pi.id
        INNER JOIN galleries as g on pi.gall_id = g.id
        WHERE p.status = "'.STATUS_ACTIVE.'"';
        $result=$this->executeQuery($query);
        return $result;
    }

    public function getNewProduct(){
        $query = 'SELECT id, p_name, price, image from product
                  ORDER BY id DESC 
                  LIMIT 4';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function getFeatureProduct(){
        $query = 'select p.id, p.p_name, p.price, p.image, p.id_producttype, pt.id_categories, c.cate_name from product p 
                  INNER JOIN producttype pt ON p.id_producttype = pt.id
                  INNER JOIN categories c ON pt.id_categories = c.id
                  GROUP BY c.id
                  ORDER BY p.id DESC 
                  LIMIT 4';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function searchProduct($data){
        $query = 'SELECT p.id, p.p_name, p.price, p.image, pt.id_categories from product p 
                  INNER JOIN producttype pt ON p.id_producttype = pt.id
                  WHERE p.p_name LIKE "%'.$data['search_data'].'%"';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function getProductInCard($data){
        $query = 'select id, p_name, price, image from product WHERE id IN ('.implode(',',$data).')';
        $result = $this->executeQuery($query);
        return $result;
    }
}