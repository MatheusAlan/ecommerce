<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;
use \Hcode\Mailer;

class Products extends Model{

    public static function listAll(){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_products ORDER BY desproduct");

    }

    public static function checkList($list)
    {

        foreach ($list as &$row) {
            
            $p = new Products();
            $p->setData($row);
            $row = $p->getValues();

        }

        return $list;

    }

    public function save(){

        $sql = new Sql();

        $teste[] = $sql->select("SELECT * FROM `tb_products` WHERE `idproduct`");


        $mais = end($teste[0]);
        $ultimo = 1 + ($mais["idproduct"]);
        $desproduct = $this->getdesproduct();
        $price = $this->getvlprice();
        $width = $this->getvlwidth();
        $height = $this->getvlheight();
        $length = $this->getvllength();
        $weight = $this->getvlweight();
        $URL = $this->getdesurl();

        $sql->select("INSERT INTO `tb_products`(`idproduct`,`desproduct`, `vlprice`, `vlwidth`, `vlheight`, `vllength`, `vlweight`, `desurl`) VALUES (" . $ultimo . " , '" . $desproduct . "'," . $price .",". $width . "," . $height . "," . $length . "," . $weight . ",'" . $URL . "')");


    }

    public function update(){


        $sql = new Sql();

        $idproduct = $this->getidproduct();
        $desproduct = $this->getdesproduct();
        $price = $this->getvlprice();
        $width = $this->getvlwidth();
        $height = $this->getvlheight();
        $length = $this->getvllength();
        $weight = $this->getvlweight();
        $URL = $this->getdesurl();

        $results[]= $sql->select("UPDATE `tb_products` SET `desproduct` = '". $desproduct . "', `vlprice` = '" . $price . "', `vlwidth` = '" . $width . "', `vlheight` = '" . $height . "', `vllength` = '" . $length . "', `vlweight` = '" . $weight . "', `desurl` = '" . $URL . "' WHERE `idproduct` = ". $idproduct . ";");


        $this->setData($results[0]);
    }

    public function get($idproduct){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_products WHERE idproduct = :idproduct;",[
            ":idproduct"=>$idproduct
        ]);

        $this->setData($results[0]);

    }

    public function delete(){

        $sql = new Sql();

        $sql->query("DELETE FROM tb_products WHERE idproduct = :idproduct;",[
            ":idproduct"=>$this->getidproduct()
        ]);
    }

    public function checkPhoto(){

        if(file_exists($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "res" . DIRECTORY_SEPARATOR . "site" . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "products" . DIRECTORY_SEPARATOR . $this->getidproduct() . ".jpg")) {

            $url = "/res/site/img/products/" . $this->getidproduct() . ".jpg";

        }else{

            $url = "/res/site/img/product.jpg";
        }

        return $this->setdesphoto($url);

    }

    public function getValues(){

        $this->checkPhoto();

        $values = parent::getValues();

        return $values;

    }

    public function setPhoto($file){

        $extension = explode('.', $file['name']);
        $extension = end($extension);

        switch ($extension) {
            case "jpg":
            case "jpeg":
            $image = imagecreatefromjpeg($file["tmp_name"]);
            break;
            
            case "gif":
            $image = imagecreatefromgif($file["tmp_name"]);
            break;

            case "png":
            $image = imagecreatefrompng($file["tmp_name"]);
            break;

        }

        $dist = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "res" . DIRECTORY_SEPARATOR . "site" . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "products" . DIRECTORY_SEPARATOR . $this->getidproduct() . ".jpg";

        imagejpeg($image, $dist);

        imagedestroy($image);

        $this->checkPhoto();

    }
}

?>