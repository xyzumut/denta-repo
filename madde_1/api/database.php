<?php

    class Database{

        private PDO $db;

        public function __construct() {
            $this->connection();
            $this->init();
        }

        private function connection() : void {
            try {
                $this->db = new PDO('mysql:host=localhost;dbname=denta_db','root','');
            } catch (PDOException  $th) {
                die('Veritabanina Baglanilamadi, hata : '.$th->getMessage());
            }
        }

        private function init() : void {

            try {

                $this->db->exec("CREATE TABLE IF NOT EXISTS category (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    category_name VARCHAR(255) NOT NULL
                )");
        
                $this->db->exec("CREATE TABLE IF NOT EXISTS book (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    book_name VARCHAR(255) NOT NULL,
                    page_count INT NOT NULL,
                    release_date DATE NOT NULL,
                    category_id INT
                )");

            } 
            catch (\Throwable $th) {
                echo json_encode( 'init işleminde hata olustu : '.$th->getMessage() );
            }
           
        }

        public function getAllBooksWithCategory() : array {

            $query = $this->db->query("SELECT book.id, book_name, page_count, release_date, category_name FROM book, category WHERE category.id = book.category_id", PDO::FETCH_ASSOC);
            if ( $query->rowCount() ){
                return $query->fetchAll();    
            }

            return [];
        }

    } 
?>