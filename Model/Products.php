<?php

class Products {

    public $products = array();
    public $specialProducts = array();
    public $searchResult = array();

    // mysql connnection params 
    public $user = 'root';
    public $dbname = 'pithaahut';
    public $pass = '';
    public $host = 'localhost';
    public $dsn = '';
    public $pdo = '';
    public $testMode = TRUE;

    public function __construct() {
        
        session_start();
        $this->dsn = sprintf('mysql:dbname=%s;host=%s', $this->dbname, $this->host);
        if($this->testMode) {
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass, 
                                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        }
        else {
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass);
        }
        // Getting All Products
        $sql = 'SELECT * FROM `products`';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->products[] = $row;
        }

        // Getting Special Products
        $sql = 'SELECT * FROM `products` where special = 1';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->specialProducts[] = $row;
        }
    }

    public function generateSearchResult($keyword) {
        unset($searchResult);
        $searchResult = array();

        // Getting Search Result
        //$sql = 'SELECT * FROM `products` where special = 1';
        $sql = 'SELECT * FROM `products` WHERE title LIKE \'%' . $keyword .'%\'';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->searchResult[] = $row;
        }
        
    }


    public function getDetailsById($id) {
        $sql = 'SELECT * FROM `products` WHERE `product_id` = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function addProductToCart($id, $quantity, $price) {
        $details = $this->getDetailsById($id);
        if($details) {
            $details['qty'] = $quantity;
            $details['price'] = $price;
            $_SESSION['cart'][] = $details;
            $result = TRUE;
        }
        else {
            $result = FALSE;
        }
        return $result;
    }

    public function getShoppingCart() {
        if(isset($_SESSION['cart'])) {
            return $_SESSION['cart'];
        }
        else {
            return array();
        }
    }

    public function getProductsFromCsv() {

        // "00000001","F1000","Fudge","Invenire percipitur eum ea, in saepe persequeris has, meis dicta albucius an vix. Utinam nonumes necessitatibus vel ne. Ad mea tacimates temporibus. Duo dicam timeam integre in. Ius an libris latine, ludus inimicus quo te, ridens scripta placerat in pri. Nec ex feugiat abhorreant.","0.10","1","95_2542284"
        $labels = array('id', 'sku', 'title', 'description', 'price', 'special', 'link');
        $fh = fopen('./Model/products.csv', 'r');
        if($fh) {
            while(!feof($fh)) {
                $row = fgetcsv($fh);
                if(isset($row) && is_array($row) && count($row) > 0) {
                    foreach($row as $key => $value) {
                        $tempRow[$labels[$key]] = $value;
                    }
                    $this->products[] = $tempRow;
                }
            }
        }
    }

    public function getProducts() {
        return $this->products;
    }
    public function getSpecialProducts() {
        return $this->specialProducts;
    }
    public function getSearchResult() {
        return $this->searchResult;
    }

    public function getTitles() {
        $tiles = array();
        foreach($this->products as $row) {
            $titles[] = $row['title'];
        }
        return $titles;
    }

    public function getSpecialTitles() {
        $tiles = array();
        foreach($this->specialProducts as $row) {
            $titles[] = $row['title'];
        }
        return $titles;
    }


    public function getSearchResultTitles() {
        $tiles = array();
        foreach($this->searchResult as $row) {
            $titles[] = $row['title'];
        }
        return $titles;
    }
}


?>