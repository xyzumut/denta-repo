<?php 
     class Madde2{

          private PDO $db;

          public function soru1() : string {
               $array[] = 'Pie';
               $array[] = 'Banana';
               $array[] = 'Apple';
               $array[] = 'Strawberry';
               return $array[2];
          }

          public function soru2() : void {
               try {
                    $this->db = new PDO("mysql:host=localhost;dbname=dklist;charset=utf8", "root", "");
               } catch ( PDOException $e ){
                    print $e->getMessage();
               } 
          }

          public function soru3() : string {
              
               $agent = $_SERVER['HTTP_USER_AGENT'];

               $os = 'unkown';

               if( ! empty($agent) ){
                    if(preg_match('/Linux/',$agent)) $os = 'Linux';
                    elseif(preg_match('/Win/',$agent)) $os = 'Windows';
                    elseif(preg_match('/Mac/',$agent)) $os = 'Mac';
               }

               return 'İşletim Sistemi : '.$os;
          }

          public function soru4() : void {
               if( session_status() === PHP_SESSION_NONE ) session_start();
               session_destroy();
          }

          public function soru5($kelime='Lorem Ipsum Dolor Sit Amet') : string {

               $cevap1 = substr($kelime, 0, 3);
               $cevap2 = '';

               for( $i = 0; $i < 3 ; $i ++){
                    $cevap2.=$kelime[$i];
               }

               return 'Cevap 1 :'.$cevap1.'<br> Cevap 2 :'.$cevap2;
          }

          public function soru6() : void {
               header('Location: //youtube.com');
               header('Location: //facebook.com');
          }

          public function soru7() : void {

               if( empty($this->db) ) $this->soru2();

               $query = $this->db->query("SELECT * FROM book WHERE date BETWEEN '2020-01-01' AND '2022-01-01'", PDO::FETCH_ASSOC);
               if ( $query->rowCount() ){
                    foreach( $query as $row ){
                         echo $row['name']."<br>";
                    }
               }
          }

          public function soru8() : void {

               $var = 0;
               if(empty($var)):
                    echo 'doğru';
               endif;
               # Cevap doğrudur
          }

          public function soru9() : void {
               phpinfo();
          }

          public function soru10(){

               if( ! isset($_FILES['myFile']) ) return false;

               if ( ! $_FILES['myFile']['error'] ) {

                    if (is_uploaded_file($_FILES['myFile']['tmp_name'])) {
                         
                         $allowed_extention = [ 'image/jpeg', 'image/png' ];
          
                         if (in_array($_FILES['myFile']['type'], $allowed_extention)) {

                              if (move_uploaded_file($_FILES['myFile']['tmp_name'], $_FILES['myFile']['name'])) {
                                   return true;
                              }

                              throw new Exception('Bir sorun oluştu');

                         }

                         throw new Exception('Dosya sadece jpeg veya png olabilir');
                    }
               }

               throw new Exception('Dosya Yüklenemedi');
          }

     }

     $madde2 = new Madde2();
?>
<form action="." method="post" enctype="multipart/form-data">
     <input type="file" name="myFile" >
     <button type="submit"> Gönder </button>
</form>