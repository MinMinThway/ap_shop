<?php
  include('header.php');
  include 'config/config.php';

  $stmt = $pdo->prepare("SELECT * FROM products WHERE id =".$_GET['id']);
  $stmt->execute();
  $result= $stmt->fetchALL();

 ?>
<!--================Single Product Area =================-->
<div class="product_image_area">
  <div class="container">
    <div class="row s_product_inner">
      <?php foreach ($result as $value) { ?>
      <div class="col-lg-6">
        <div class="s_Product_carousel">
          <div class="single-prd-item">
            <img class="img-fluid"  src="admin/images/<?php echo $value['image']; ?>" alt="" style="border: 1px dotted #944a19 ;">
          </div>
          <div class="single-prd-item">
            <img class="img-fluid" src="admin/images/<?php echo $value['image']; ?>"alt="" style="border: 1px dotted #944a19 ;">
          </div>
          <div class="single-prd-item">
            <img class="img-fluid" src="admin/images/<?php echo $value['image']; ?>" alt="" style="border: 1px dotted #944a19 ;">
          </div>
        </div>
      </div>
      <div class="col-lg-5 offset-lg-1">
       
         <div class="s_product_text">
          <h3><?php echo escape($value['name']); ?></h3>
          <h2><?php echo escape($value['price']); ?></h2>
          <?php 
           $catstmt = $pdo->prepare("SELECT * FROM catagories WHERE id = ".$value['category_id']);
            $catstmt->execute();
            $result = $catstmt->fetchALL();

          ?>
          <ul class="list">
            <li><a class="active" href="#"><span>Category</span> :<?php echo $result['0']['name']; ?> </a></li>
            <li><a href="#"><span>Availibility</span> : In Stock</a></li>
          </ul>
          <p style="font-size: 20px;font-style: italic;"><?php echo escape($value['description']); ?></p>
          <div class="product_count">
            <label for="qty">Quantity:</label>
            <input type="text" name="qty" id="sst" maxlength="12" value="<?php echo escape($value['quantity'] )?>" title="Quantity:" class="input-text qty">
            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
             class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
             class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
          </div>
          <div class="card_area d-flex align-items-center">
            <a class="primary-btn" href="#">Add to Cart</a>
          </div>
        </div>
       
      </div>
      <?php } ?>
    </div>
  </div>
</div><br>
<!--================End Single Product Area =================-->

<!--================End Product Description Area =================-->
<?php include('footer.php');?>
