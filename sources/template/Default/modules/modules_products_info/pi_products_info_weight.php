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

  use ClicShopping\OM\Registry;
  use ClicShopping\OM\CLICSHOPPING;

  class pi_products_info_weight {
    public $code;
    public $group;
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    public function __construct() {
      $this->code = get_class($this);
      $this->group = basename(__DIR__);

      $this->title = CLICSHOPPING::getDef('module_products_info_weight');
      $this->description = CLICSHOPPING::getDef('module_products_info_weight_description');

      if (defined('MODULE_PRODUCTS_INFO_WEIGHT_STATUS')) {
        $this->sort_order = MODULE_PRODUCTS_INFO_WEIGHT_SORT_ORDER;
        $this->enabled = (MODULE_PRODUCTS_INFO_WEIGHT_STATUS == 'True');
      }
    }

    public function execute() {

      if (isset($_GET['products_id']) && isset($_GET['Products']) ) {

        $content_width = (int)MODULE_PRODUCTS_INFO_WEIGHT_CONTENT_WIDTH;
        $text_position = MODULE_PRODUCTS_INFO_WEIGHT_POSITION;

        $CLICSHOPPING_ProductsCommon = Registry::get('ProductsCommon');
        $CLICSHOPPING_Template = Registry::get('Template');

        $products_weight = $CLICSHOPPING_ProductsCommon->getProductsWeight();

        if (!empty($products_weight) ) {
          $products_weight_content = '<!-- Start products_weight -->' . "\n";

          ob_start();
          require($CLICSHOPPING_Template->getTemplateModules($this->group . '/content/products_info_weight'));
          $products_weight_content .= ob_get_clean();

          $products_weight_content .= '<!-- products_weight -->' . "\n";

          $CLICSHOPPING_Template->addBlock($products_weight_content, $this->group);
        }
      }
    } // public function execute

    public function isEnabled() {
      return $this->enabled;
    }

    public function check() {
      return defined('MODULE_PRODUCTS_INFO_WEIGHT_STATUS');
    }

    public function install() {
      $CLICSHOPPING_Db = Registry::get('Db');

      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Souhaitez-vous activer ce module ?',
          'configuration_key' => 'MODULE_PRODUCTS_INFO_WEIGHT_STATUS',
          'configuration_value' => 'True',
          'configuration_description' => 'Souhaitez vous activer ce module à votre boutique ?',
          'configuration_group_id' => '6',
          'sort_order' => '1',
          'set_function' => 'clic_cfg_set_boolean_value(array(\'True\', \'False\'))',
          'date_added' => 'now()'
        ]
      );

      $CLICSHOPPING_Db->save('configuration', [
                                        'configuration_title' => 'Veuillez selectionner la largeur de l\'affichage?',
                                        'configuration_key' => 'MODULE_PRODUCTS_INFO_WEIGHT_CONTENT_WIDTH',
                                        'configuration_value' => '12',
                                        'configuration_description' => 'Veuillez indiquer un nombre compris entre 1 et 12',
                                        'configuration_group_id' => '6',
                                        'sort_order' => '1',
                                        'set_function' => 'clic_cfg_set_content_module_width_pull_down',
                                        'date_added' => 'now()'
                                      ]
      );

      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'A quel endroit souhaitez-vous afficher le code barre ?',
          'configuration_key' => 'MODULE_PRODUCTS_INFO_WEIGHT_POSITION',
          'configuration_value' => 'float-md-none',
          'configuration_description' => 'Affiche le code barre du produit à gauche ou à droite<br><br><i>(Valeur Left = Gauche <br>Valeur Right = Droite <br>Valeur None = Aucun)</i>',
          'configuration_group_id' => '6',
          'sort_order' => '2',
          'set_function' => 'clic_cfg_set_boolean_value(array(\'float-md-right\', \'float-md-left\', \'float-md-none\'),',
          'date_added' => 'now()'
        ]
      );

      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Ordre de tri d\'affichage',
          'configuration_key' => 'MODULE_PRODUCTS_INFO_WEIGHT_SORT_ORDER',
          'configuration_value' => '100',
          'configuration_description' => 'Ordre de tri pour l\'affichage (Le plus petit nombre est montré en premier)',
          'configuration_group_id' => '6',
          'sort_order' => '3',
          'set_function' => '',
          'date_added' => 'now()'
        ]
      );

      return $CLICSHOPPING_Db->save('configuration', ['configuration_value' => '1'],
                                              ['configuration_key' => 'WEBSITE_MODULE_INSTALLED']
                            );
    }

    public function remove() {
      return Registry::get('Db')->exec('delete from :table_configuration where configuration_key in ("' . implode('", "', $this->keys()) . '")');
    }

    public function keys() {
      return array (
        'MODULE_PRODUCTS_INFO_WEIGHT_STATUS',
        'MODULE_PRODUCTS_INFO_WEIGHT_CONTENT_WIDTH',
        'MODULE_PRODUCTS_INFO_WEIGHT_POSITION',
        'MODULE_PRODUCTS_INFO_WEIGHT_SORT_ORDER'
      );
    }
  }
