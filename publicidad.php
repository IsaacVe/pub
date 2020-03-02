<?php
/**
* 2007-2020 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2020 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

if (!defined('_PS_VERSION_')) {
    exit;
}

class Publicidad extends Module implements WidgetInterface
{

    private $templateFile;
    public function __construct()
    {
        $this->name = 'publicidad';
        $this->version = '1.0.0';
        $this->author = 'Javier Isaac Velasquez Venegas';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('publicidad');
        $this->description = $this->l('Publicidad abajo del slidder ');

        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
        $this->templateFile = 'module:publicidad/views/templates/front/publicidad.tpl';
    }

    public function install()
    {
        $this->_clearCache('*');
        return parent::install() &&
            $this->registerHook('displayHome');
    }

    public function uninstall()
    {
        $this->_clearCache('*');
        return parent::uninstall();
    }

    public function getWidgetVariables($hookName, array $configuration)
    {
        $url = $this->context->link->getMediaLink(_MODULE_DIR_.'publicidad/images/nohay.jpg');
        return array(
            'image_baseurl' => $url
        );
    }

    public function renderWidget($hookName, array $configuration)
    {
        if (!$this->isCached($this->templateFile, $this->getCacheId('publicidad'))) {
            $this->context->smarty->assign($this->getWidgetVariables($hookName, $configuration));
        }
        return $this->fetch($this->templateFile, $this->getCacheId('publicidad'));
    }

    public function _clearCache($template, $cache_id = null, $compile_id = null)
    {
        parent::_clearCache($this->templateFile);
    }

 
    

}
