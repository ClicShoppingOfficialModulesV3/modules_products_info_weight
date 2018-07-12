<?php
  use ClicShopping\OM\CLICSHOPPING;
?>
<div class="<?php echo $text_position; ?> col-md-<?php echo $content_width; ?>">
  <div class="separator"></div>
  <div  style="float: <?php echo MODULE_PRODUCTS_INFO_WEIGHT_POSITION; ?>">
    <div class="modulesproductsInfoWeight">
      <span class="modulesproductsInfoWeight"><h3><?php echo CLICSHOPPING::getDef('text_display_products_weight') . ' ' . $products_weight . ' Kg'; ?></h3></span>
    </div>
  </div>
</div>