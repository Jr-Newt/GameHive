<html>
<head></head>
<body>
<?php
            
            
        if(isset($_POST['apply']))
        {
              if(isset($_POST['minprice']))
              {
                if($_POST['minprice']=='range1')
                {
                  $low = 500;
                }
                elseif($_POST['minprice']=='range2')
                {
                  $low = 1000;
                }
                elseif($_POST['minprice']=='range3')
                {
                  $low = 5000;
                }
                elseif($_POST['minprice']=='range4')
                {
                  $low = 10000;
                }
                elseif($_POST['minprice']=='range5')
                {
                  $low = 15000;
                }
              }
              if(isset($_POST['maxprice']))
              {
                if($_POST['maxprice']=='range1')
                {
                  $high = 1000;
                }
                elseif($_POST['maxprice']=='range2')
                {
                  $high = 15000;
                }
                elseif($_POST['maxprice']=='range3')
                {
                  $high = 20000;
                }
                elseif($_POST['maxprice']=='range4')
                {
                  $high = 40000;
                }
                elseif($_POST['maxprice']=='range5')
                {
                  $high= 100000;
                }
              }
              if($high<$low)
              {
                //filter_err();
                echo "try agian";
              }

              $cat = $_POST['category'];
              $out = $_POST['out_of_stock'];
              echo $_POST['category'];
        }
            
            require_once "config.php";
            if(isset($_POST['minprice'])&&isset($_POST['maxprice'])&&isset($_POST['category'])&&isset($_POST['out_of_stock']))
            {
              $sql = "SELECT * FROM product WHERE price BETWEEN :low AND :high AND gearcat = :cat AND no_of_stock = :out";
              if($result = $pdo->prepare($sql))
              {
                $result->bindParam(":low",$low);
                $result->bindParam(":high",$high);
                $result->bindParam(":cat",$cat);
                $result->bindParam(":out",$out);
                
              }
              //$result->execute(array(':low' , $low, ':high', $high, ':cat',$cat, ':out',$out));
            }
            while($row = $result->fetch()) 
            {
              $name = $row['name'];
              $price = $row['price'];
              $image = $row['gearimage'];
              $category = $row['gearcat'];
          
            ?>
              <div class="each-product">
                <div class="image"><img src="..\..\images\<?php echo $image;?>" alt="" style="width:100%"></div>
                <div class="name"><?php echo $name;?></div>
                <div class="details"><?php echo $price;?></div>
              </div>
              <?php
            }
            ?>
          </div>
        <div>
    </div>
    
          </body>
          </html>