<?php
class Mproduct extends CI_Model{

/* 
	Product Functions:
		- Get SKU: getSKU($productID) 
		- Get ProductID: getProductID($productSKU)
		- Get ProductList: getProductList($searchText, $categoryID)
*/

	public function __construct(){
		parent::__construct();				
		$this->db = $this->load->database('default', TRUE);
	}
	
	/*
		Function to get SKU of a products
	*/
	public function getProductSKU($productID){
		$this->db->select("product_sku");
		$this->db->where("id", $this->_dbJoomla->escape_str($productID));

		$result = $this->db->get('products')->row_array();
		if($result)
			return $result['product_sku'];
		else
			return '';
	}

	/*
		Function to get ProductID of a productSKU
	*/
	public function getProductID($productSKU){
		$this->db->select("id");
		$this->db->where("product_sku", $this->db->escape_str($productSKU));
		$result = $this->db->get('products')->row_array();
		if($result)
			return $result['id'];
		else
			return 0;
	}

    /*
        Function to get Product Info of a product
    */
    public function getProductInfo($productID){
        $this->db->select("*");
        $this->db->where("id", $this->db->escape_str($productID));
        return $this->db->get('products')->row_array();
    }


    /**
     * Function to get ProductList
     *
     */
	public function getProductList($searchText = '', $categoryID = 0, $orderBy = '', $orderAD = 'ASC'){
        $this->db->select("p.id");
		$this->db->select("p.product_sku");
		$this->db->select("p.title AS product_name");
		$this->db->select("CONCAT(product_sku, ' - ' , p.title ) AS title", FALSE);
		$this->db->select("p_c.category_id");
		$this->db->select("c.title AS category_name");

		$this->db->from("products AS p");
		$this->db->join("product_categories AS p_c", "p.id = p_c.product_id", "left");
		$this->db->join("productcategories AS c", "c.id = p_c.category_id", "left");

		$this->db->where("p.published", 1);

		if($searchText != ""){
			$strSearchTextLike = $this->db->escape_like_str($searchText);
			$this->db->like("product_name", "%".$strSearchTextLike."%");
			$this->db->or_like("product_sku", "%".$strSearchTextLike."%");
		}

		if($categoryID > 0){
			$this->db->where("category_id", $this->db->escape_str($categoryID));
		}

		if($orderBy != ""){
			$this->db->order_by($this->db->escape_str($orderBy), $orderAD);
		}

		$result = $this->db->get()->result_array();
		if($result)
			return $result;
		else
			return null;
	}



    /**
     * Function to get Product ID, Store ID From a Store's Product Name (Map Product - Store)
     *
     */
    public function getProductMap($strProductName){
        /*
        $strProductNamePreg = preg_replace("/[^A-Za-z0-9]/", "", str_replace('&quot;','"', $strProductName));
        switch($strProductNamePreg){
            case 'DoublePocketRunningBelt2wideRedCWIBZ' ://Single: 718, SKU: Combo 714 CWIB -> PYEG
                $result = array(
                    'product_id' => 718,
                    'store_id' => 2,
                    'type' => 'Amazon'
                );
                return $result;
            case 'DoublePocketRunningBelt2widePinkFPKUZ' ://Single: 717, SKU: Combo 713 FPKU -> KWNW
                $result = array(
                    'product_id' => 717,
                    'store_id' => 2,
                    'type' => 'Amazon'
                );
                return $result;
            case 'DoublePocketRunningBelt2wideBlueKFBCZ' ://Single: 719, SKU: Combo 715 KFBC -> AKGL
                $result = array(
                    'product_id' => 719,
                    'store_id' => 2,
                    'type' => 'Amazon'
                );
                return $result;
            case 'DoublePocketRunningBelt2wideBlackEVDEZ' : //Single: 716, SKU: Combo 712 EVDE -> HVJP
                $result = array(
                    'product_id' => 716,
                    'store_id' => 2,
                    'type' => 'Amazon'
                );
                return $result;
        }*/
        $chrIndentify = chr(178);
        $posIndentifyChar = strpos($strProductName, $chrIndentify);
        if($posIndentifyChar){
            $strProductCode = trim(substr($strProductName, $posIndentifyChar + 1, 5));
            if(strlen($strProductCode) == 5){
                $productID = $this->getProductID(substr($strProductCode, 0, 4));
                $this->load->model('stores/Mstores','Stores_model');
                $storeInfo = $this->Stores_model->getStoreByCode(substr($strProductCode, -1));
                if($storeInfo)
                    $result = array(
                        'product_id' => $productID,
                        'store_id' => $storeInfo['id'],
                        'type' => $storeInfo['type']
                    );
                else
                    $result = array(
                        'product_id' => $productID,
                        'store_id' => 0,
                        'type' => ''
                    );
                //p($result);
                return $result;
            }
        }else{
            $this->load->model('product_stores/Mproduct_stores','Product_Stores_model');
            return $this->Product_Stores_model->getProduct_Stores($strProductName);
        }

    }

    /**
     *
     * ************************* Function for get Data from Joomla DB *************************
     *
     */
/*
    public function getAllJoomlaProductList(){
		$this->_dbJoomla->select("p.*");
		$this->_dbJoomla->select("p_en.product_name AS product_name");
		$this->_dbJoomla->select("p_en.product_desc AS product_desc");

		$this->_dbJoomla->from("j25_virtuemart_products AS p");
		$this->_dbJoomla->join("j25_virtuemart_products_en_gb AS p_en", "p.virtuemart_product_id = p_en.virtuemart_product_id", "left");

		$result = $this->_dbJoomla->get()->result_array();
		if($result)
			return $result;
		else
			return null;
	}

    public function getAllJoomlaProductMap(){
        $this->_dbJoomla->select("*");

        $this->_dbJoomla->from("j25_y4a_store_product");
        $result = $this->_dbJoomla->get()->result_array();
        if($result)
            return $result;
        else
            return null;
    }

    public function getAllJoomlaProductCombo(){
        $this->_dbJoomla->select("*");

        $this->_dbJoomla->from("j25_y4a_warehouse_productgroup");
        $result = $this->_dbJoomla->get()->result_array();
        if($result)
            return $result;
        else
            return null;
    }

	public function getAllJoomlaProductCategoryList(){
		$this->_dbJoomla->select("c.*");
		$this->_dbJoomla->select("c_en.category_name AS category_name");
		$this->_dbJoomla->select("c_en.category_description	 AS category_desc");

		$this->_dbJoomla->from("j25_virtuemart_categories AS c");
		$this->_dbJoomla->join("j25_virtuemart_categories_en_gb AS c_en", "c.virtuemart_category_id = c_en.virtuemart_category_id", "left");

		$result = $this->_dbJoomla->get()->result_array();
		if($result)
			return $result;
		else
			return null;
	}

    public function moveProductCategoryToCI(){
        $this->load->database('joomla', TRUE);
        $this->_dbJoomla->select("*");

        $this->_dbJoomla->from("j25_virtuemart_product_categories");
        $result = $this->_dbJoomla->get()->result_array();
        $this->load->database('default', TRUE);
        if($result)
            foreach($result as $map){
                $data = array(
                    "id" => null,
                    "product_id" => $map["virtuemart_product_id"],
                    "category_id" => $map["virtuemart_category_id"],
                );
                $this->db->insert("product_categories", $data);
            }
        else
            return null;
    }

    public function moveCategoryCategoryToCI(){
        $this->load->database('joomla', TRUE);
        $this->_dbJoomla->select("*");

        $this->_dbJoomla->from("j25_virtuemart_category_categories");
        $result = $this->_dbJoomla->get()->result_array();
        $this->load->database('default', TRUE);
        if($result)
            foreach($result as $map){
                $data = array(
                    "id" => null,
                    "parent_category_id" => $map["category_parent_id"],
                    "child_category_id" => $map["category_child_id"],
                );
                $this->db->insert("productcategory_categories", $data);
            }
        else
            return null;
    }

    public function moveProductQuantityToCI(){
        $this->load->database('joomla', TRUE);
        $this->_dbJoomla->select("*");

        $this->_dbJoomla->from("j25_y4a_warehouse_product");
        $result = $this->_dbJoomla->get()->result_array();
        $this->load->database('default', TRUE);
        if($result)
            foreach($result as $rs){
                $data = array(
                    "id" => null,
                    "product_id" => $rs["product_id"],
                    "warehouse_id" => $rs["warehouse_id"],
                    "quantity" => $rs["quantity"],
                    "locked_quantity" => $rs["locked_quantity"],
                    "lastupdated" => $rs["modifydate"],
                );
                $this->db->insert("productinventory", $data);
            }
        else
            return null;
    }

	public function moveJoomlaProductToCI(){
		$this->load->database('joomla', TRUE);
		$productList = $this->getAllJoomlaProductList();
		//p($productList);
		$this->load->database('default', TRUE);
		foreach($productList as $product){
			$data = array(
				"id" => $product["virtuemart_product_id"],
				"title" => $product["product_name"],
				"description" => $product["product_desc"],
				"product_sku" => $product["product_sku"],
				"weight" => $product["product_weight"],
				"lenght" => $product["product_length"],
				"width" => $product["product_width"],
				"height" => $product["product_height"],
				"ordered" => $product["virtuemart_product_id"],
				"published" => $product["published"],
			);
			$this->db->insert("products", $data);
		}
	}
	
	public function moveJoomlaProductCategoryToCI(){
		$this->load->database('joomla', TRUE);
		$productCategoryList = $this->getAllJoomlaProductCategoryList();
		$this->load->database('default', TRUE);
		foreach($productCategoryList as $category){
			$data = array(
				"id" => $category["virtuemart_category_id"],
				"title" => $category["category_name"],
				"description" => $category["category_desc"],
				"ordered" => $category["virtuemart_category_id"],
				"published" => $category["published"],
			);
			$this->db->insert("productcategories", $data);
		}
	}

    public function moveJoomlaProductGroupToCI(){
        $this->load->database('joomla', TRUE);
        $productGroup = $this->getAllJoomlaProductCombo();
        $this->load->database('default', TRUE);
        foreach($productGroup as $product){
            $data = array(
                "id" => null,
                "product_id" => $product["product_id"],
                "child_id" => $product["child_id"],
                "quantity" => $product["quantity"],
                "published" => 1,
            );
            $this->db->insert("productcombo", $data);
        }
    }

    public function moveJoomlaProductMapToCI(){
        $this->load->database('joomla', TRUE);
        $productMap = $this->getAllJoomlaProductMap();
        $this->load->database('default', TRUE);
        foreach($productMap as $product){
            $data = array(
                "id" => null,
                "product_id" => $product["product_id"],
                "store_id" => $product["store_id"],
                "product_name" => $product["product_name"],
                "compare_name" => $product["compare_name"],
                "createdate" => $product["createdate"],
                "modifydate" => $product["modifydate"],
                "note" => $product["note"],
                "published" => 1,
            );
            $this->db->insert("product_stores", $data);
        }
    }*/
}