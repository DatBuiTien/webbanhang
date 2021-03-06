<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 12-Apr-17
 * Time: 7:42 PM
 */
require_once '../configs/config.php';
require_once '../models/db.php';
class ProductTypeModel extends DB {

    public function getAllProductsByProductType($data){
        $query = 'Select p.id, p.p_name, p.p_tenkhongdau, p.tomtat, p.description, p.image, p.price, p.id_producttype, pt.pt_name from product p 
                  INNER JOIN producttype pt ON p.id_producttype = pt.id
                  WHERE pt.id = '.$data['id'];
        $result  = $this->executeQuery($query);
        return $result;
    }

    public function getAllProductsByCateName($data){
        $query = 'Select p.id, p.p_name, p.p_tenkhongdau, p.tomtat, p.description, p.image, p.price, p.id_producttype from product p 
                  INNER JOIN producttype pt ON p.id_producttype = pt.id
                  INNER JOIN categories c ON pt.id_categories = c.id
                  WHERE c.cate_tenkhongdau LIKE "'.$data['cate_name'].'"';
        $result  = $this->executeQuery($query);
        return $result;
    }

    public function getAllProductTypeByCateName($data){
        $query='select pt.id, pt.id_categories, pt.pt_name, pt.pt_tenkhongdau, c.cate_name, c.cate_tenkhongdau from producttype pt
                INNER JOIN categories c ON pt.id_categories = c.id 
                WHERE  c.cate_tenkhongdau LIKE "'.$data['cate_name'].'"';
        $result  = $this->executeQuery($query);
        return $result;
    }
}
