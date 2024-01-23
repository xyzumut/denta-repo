<?php 
     class Madde4{

          private PDO $db;
          public $userStatus;

          public function __construct(){
               try {
                    $this->db = new PDO("mysql:host=localhost;dbname=dklist;charset=utf8", "root", "");
               } catch ( PDOException $e ){
                    print $e->getMessage();
               }  
          }

          public function soru1() {
               $query = $this->db->query("SELECT urun_id, grup_adi, urun_adi, birimi, guncel_stok FROM book", PDO::FETCH_ASSOC);
               echo $query->rowCount() ;
               if ( $query->rowCount() ){
                    ?>
                    <table>
                         <thead>
                              <tr>
                                   <th>urun_id</th>
                                   <th>grup_adi</th>
                                   <th>urun_adi</th>
                                   <th>birimi</th>
                                   <th>guncel_stok</th>
                              <tr>
                         </thead>
                         <tbody>
                    <?php
                    
                    foreach( $query as $row ){
                    ?>
                         <tr>
                              <th><?php echo $row['urun_id'] ?></th>
                              <th><?php echo $row['grup_adi'] ?></th>
                              <th><?php echo $row['urun_adi'] ?></th>
                              <th><?php echo $row['birimi'] ?></th>
                              <th><?php echo $row['guncel_stok'] ?></th>
                         </tr>
                    <?php
                    
                    }
                    ?>
                         </tbody>
                    </table>
                    <?php
               }
          }

          public function soru2() : void {
               
               $query = $this->db->query("SELECT
                    u_list.id AS urun_id,
                    u_list.urun_adi AS urun_adi,
                    u_list.urun_birimi AS birimi,
                    k_list.grup_adi AS grup_adi,
                    SUM(g_list.giren_stok - c_list.cikan_stok) AS guncel_stok,
                    FROM u_list, k_list, g_list,c_list WHERE
                    u_list.grup_id = k_list.id AND
                    u_list.id = g_list.urun_id AND
                    u_list.id = c_list.urun_id", 
               PDO::FETCH_ASSOC);
               
          }

          public function soru3() : void {

               if( isset($_POST['kullanici_adi']) && isset($_POST['sifre']) ) {

                    $query = $this->db->query("SELECT * FROM user WHERE username = ".$_POST['kullanici_adi'])->fetch(PDO::FETCH_ASSOC);
                    
                    if( ! $query ) throw new Exception( $_POST['kullanici_adi'].' adlı kullanıcı bulunamadı' );
                    
                    if( $_POST['sifre'] !== $query['sifre'] ) throw new Exception( $_POST['kullanici_adi'].' adlı kullanıcı için girdiğiniz şifre yanlış' );

                    echo 'Giriş Yapıldı';
               }
               
          }

          public function soru4() : void {

               $array1 = [ 'Ankara', 'İstanbul', 'İzmir' ];
               $array1[] = 'Konya';
               
               
               $array2 = [ 'username' => 'ornek_username', 'password' => '123456789' ];
               $array2['token'] = 'RSOv7KUeGTtjsVms7EW6wtQYng5YGc';

          }



          public function soru5() : void {
               session_start();

               $this->userStatus = false;
          
               if(isset($_SESSION['userStatus'])) {
                    $this->userStatus = json_decode($_SESSION['userStatus']);
               }
          
               if( isset($_GET['requestType']) ){
                    $this->userStatus = ! $this->userStatus;
                    $_SESSION['userStatus'] = $this->userStatus;
                    echo $this->userStatus ? 'true' : 'false'; # kontrol amaçlı ekledim
               }
          }

     }
     $madde4 = new Madde4();
     // $madde4->soru1();
     // $madde4->soru2();
     // $madde4->soru3();
     // $madde4->soru4();
     // $madde4->soru5();
?>

<!DOCTYPE html>
<html lang="tr">
     <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Soru 4</title>
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
          <style> #myButton{ margin:150px auto; display:block }</style>
     </head>
     <body>

          <button id="myButton" class="btn <?php echo $madde4->userStatus ? 'btn-danger' : 'btn-success' ?>" status="<?php echo $madde4->userStatus ? '0' : '1' ?>">
               <?php echo $madde4->userStatus ? 'Kullanıcıyı Devre Dışı Bırak' : 'Kullanıcıyı Aktif Et' ?>
          </button>

          <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
          <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
          <script>
               $(document).ready(function () {
                    $('#myButton').click(function () {
                         $.ajax({
                              type: 'GET',
                              url: '.', 
                              data : { requestType:'userStatusRequest' },
                              success: response => {

                                   const currentStatus  = $('#myButton').attr('status') === '1';
                                   const newText        = currentStatus  ? 'Kullanıcıyı Devre Dışı Bırak' : 'Kullanıcıyı Aktif Et'; 
                                   const btnAddClass    = currentStatus  ? 'btn-danger' : 'btn-success';
                                   const btnRemoveClass = !currentStatus ? 'btn-danger' : 'btn-success';
                                   const newStatus      = currentStatus  ? '0' : '1';

                                   $('#myButton').attr('status', newStatus);
                                   $('#myButton').text(newText);
                                   $('#myButton').addClass(btnAddClass)
                                   $('#myButton').removeClass(btnRemoveClass)

                              },
                              error: () => {
                                   alert('Bir hata oluştu. İşlem gerçekleştirilemedi.');
                              }
                         });
                    });
               });
          </script>

     </body>
</html>