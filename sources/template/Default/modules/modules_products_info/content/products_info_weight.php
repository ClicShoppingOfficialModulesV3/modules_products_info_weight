<?php
/**
 *
 *  @copyright 2008 - https://www.clicshopping.org
 *  @Brand : ClicShopping(Tm) at Inpi all right Reserved
 *  @Licence GPL 2 & MIT
 *  @licence MIT - Portion of osCommerce 2.4
 *  @Info : https://www.clicshopping.org/forum/trademark/
 *
 */

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