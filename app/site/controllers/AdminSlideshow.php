<?php
/*
* 2007-2012 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2012 PrestaShop SA
*  @version  Release: $Revision: 14002 $
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

include_once(dirname(__FILE__).'/AdminThemes.php');

class AdminSlideshow extends AdminTab
{
	public function __construct()
	{
		global $cookie;

                $id_lang = $cookie->id_lang ;

                $this->noAdd = true;
                
                $this->table = 'slideshow';
	 	$this->className = 'AdminSlideshow';
		$this->colorOnBackground = true;
		$this->_select = ' sl.title, sl.sub_text, sl.head_text, sl.button ';
		$this->_where = ' AND sl.id_lang = ' . $id_lang ;
		$this->_join = ' LEFT JOIN '._DB_PREFIX_.'slideshow_lang sl ON (a.`id_slideshow` = sl.`id_slideshow`) ';
                
                $this->edit = 'edit';
                $this->delete = 'delete';
                
                
 		$this->fieldsDisplay = array(
                                            'id_slideshow' => array('title' => $this->l('ID'), 'width' => 30, 'type' => 'text', 'align' => 'left'),
                                            'sort_order' => array('title' => $this->l('Sort order'), 'width' => 15, 'type' => 'text', 'align' => 'left'),
                                            'image' => array('title' => $this->l('image'), 'width' => 100, 'align' => 'center'),
                                            'title' => array('title' => $this->l('Title'), 'width' => 50, 'align' => 'center'),
                                            'head_text' => array('title' => $this->l('Subtitle'), 'width' => 50, 'align' => 'center'),
                                            'sub_text' => array('title' => $this->l('Description'), 'width' => 150, 'align' => 'center'),
                                            'button' => array('title' => $this->l('Button Label'), 'width' => 40, 'align' => 'center'),
                                            'link' => array('title' => $this->l('Button Link'), 'width' => 150, 'align' => 'center'),
                                        );
		
		$this->optionTitle = $this->l('Select products:');
		$this->_fieldsOptions = array(
                                            'image' => array('title' => $this->l('Image:'), 'desc' => $this->l('Image of the slideshow'), 'cast' => '', 'type' => 'file', 'size' => '60'),
                                            'title' => array('title' => $this->l('Title:'), 'desc' => $this->l('Title of the slideshow'), 'cast' => '', 'type' => 'textLang', 'rows' => '1', 'cols' => '60', 'size' => ''),
                                            'head_text' => array('title' => $this->l('Head text:'), 'desc' => $this->l('Text that appears under the title'), 'cast' => '', 'type' => 'textLang', 'rows' => '1', 'cols' => '60', 'size' => ''),
                                            'sub_text' => array('title' => $this->l('Short description:'), 'desc' => $this->l('Short description of the slide'), 'cast' => '', 'type' => 'textareaLang', 'rows' => '4', 'cols' => '60', 'size' => ''),
                                            'button' => array('title' => $this->l('Button Text:'), 'desc' => $this->l('Label of the button'), 'cast' => '', 'type' => 'textLang', 'rows' => '1', 'cols' => '60', 'size' => ''),
                                            'link' => array('title' => $this->l('Button Link:'), 'desc' => '', 'cast' => '', 'type' => 'text', 'size' => '60'),
                                            'sort_order' => array('title' => $this->l('Sort order:'), 'desc' => $this->l('Order of the slides'), 'cast' => 'intval', 'type' => 'text', 'size' => '1'),
		);
		
		parent::__construct();
	}
	
	public function postProcess()
	{   
    	global $currentIndex, $cookie;
        if (Tools::isSubmit('submitOptionsslideshow'))
		{
            
            
            if($image = $this->postImage() ){
                    $sql = "INSERT INTO ". _DB_PREFIX_ ."slideshow set image = '" . $image . "', link = '" . Tools::getValue('link') . "', sort_order = '". Tools::getValue('sort_order') ."' ";
                    $last_id = Db::getInstance()->ExecuteS($sql);
                    $last_id = Db::getInstance()->Insert_ID($sql);
                    $this->_langs = Language::getLanguages(false);
                    
                    foreach ($this->_langs as $language){
                        if(Tools::getValue('head_text_'.$language['id_lang']) != '' || Tools::getValue('sub_text_'.$language['id_lang']) != ''){
                                $sql = "INSERT INTO ". _DB_PREFIX_ ."slideshow_lang SET id_slideshow = '". $last_id ."', id_lang = '". $language['id_lang'] ."', title = '". Tools::getValue('title_'.$language['id_lang']) ."', button = '". Tools::getValue('button_'.$language['id_lang']) ."', head_text = '". Tools::getValue('head_text_'.$language['id_lang']) ."', sub_text = '". Tools::getValue('sub_text_'.$language['id_lang']) ."' ";
                                Db::getInstance()->ExecuteS($sql);
                        }
                    }
                    Tools::redirectAdmin($currentIndex.'&conf=4&token='.$this->token);
            }else{
                Tools::redirectAdmin($currentIndex.'&conf=26&token='.$this->token);
            }

		
		}
		elseif(Tools::isSubmit('submitOptionsslideshow_edit'))
		{
			$sql = "UPDATE slideshow SET link = ".Tools::getValue('link').", sort_order = ".Tools::getValue('sort_order')." WHERE id_slideshow = ".Tools::getValue('id_slideshow').";";
			$sql1 = "UPDATE slideshow_lang SET head_text = ".Tools::getValue('head_text_1').", sub_text = ".Tools::getValue('sub_text_1').", title = ".Tools::getValue('title_1').", button = ".Tools::getValue('button').";";
			Db::getInstance()->ExecuteS($sql);
			Db::getInstance()->ExecuteS($sql1);
		}
        if(isset($_GET['deleteslideshow']) && Tools::getValue('id_slideshow') != ''){
            $slide_id = Tools::getValue('id_slideshow');
            $sql = "DELETE FROM ". _DB_PREFIX_ ."slideshow WHERE id_slideshow = '". $slide_id ."' ";
            Db::getInstance()->ExecuteS($sql);
            Tools::redirectAdmin($currentIndex.'&conf=4&token='.$this->token);
        }
//		parent::postProcess();
	}
        
        protected function postImage()
	{
                //print_r($_FILES);

		if (isset($_FILES) AND sizeof($_FILES) AND $_FILES['image']['name'] != NULL )
		{
                       $result = $this->uploadImage('image', _PS_IMG_DIR_ . 'slideshow/');
		}
                if($result){
                        return $result;
                }else{
                    return false;
                }
	}
        protected function uploadImage($name, $path ){
                $name = explode(".", $_FILES["image"]["name"]);
                $name = $name[0];
                $extension = end(explode(".", $_FILES["image"]["name"]));
                $extension = strtolower($extension);
                if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
                {
                    return false;
                }else{
                    if($extension=="jpg" || $extension=="jpeg" )
                    {
                        $uploadedfile = $_FILES['image']['tmp_name'];
                        $src = imagecreatefromjpeg($uploadedfile);
                    }
                    else if($extension=="png")
                    {
                        $uploadedfile = $_FILES['image']['tmp_name'];
                        $src = imagecreatefrompng($uploadedfile);
                    }
                    else 
                    {
                        $src = imagecreatefromgif($uploadedfile);
                    }
                    
                    list($width,$height)=getimagesize($uploadedfile);

                    $newwidth=763;
                    $newheight=356;
                    $tmp=imagecreatetruecolor($newwidth,$newheight);

                    imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

                    $filename = $path . $name.'.'.$extension;
                    imagejpeg($tmp,$filename,100);
                   
                    imagedestroy($src);
                    imagedestroy($tmp);
                    return $name.'.'.$extension;
                    
                }

        }
	
	public function display()
	{
            
		global $currentIndex, $cookie;
		// Include current tab
		if (isset($_GET['update'.$this->table]))
		{
			if ($this->tabAccess['edit'] === '1')
			{
				$this->editSlidwshow();
				echo '<br /><br /><a href="'.$currentIndex.'&token='.$this->token.'"><img src="../img/admin/arrow2.gif" /> '.$this->l('Back to list').'</a><br />';
			}
			else
				echo $this->l('You do not have permission to edit here');
		}
		else
		{
			$this->getList((int)($cookie->id_lang), !Tools::getValue($this->table.'Orderby') ? 'sort_order' : NULL, !Tools::getValue($this->table.'Orderway') ? 'ASC' : NULL);
			$this->displayList();
                        
			$this->displayOptionsList();
                        
			$this->includeSubTab('display');
		}
	}

	
	public function displayListContent($token = NULL)
	{
		global $currentIndex, $cookie;
		$irow = 0;
                if ($this->_list)
			foreach ($this->_list AS $tr)
			{
                                $id = $tr['id_'.$this->table];
				$tr['id_slideshow'] = $this->l('#').sprintf('%06d', $tr['id_slideshow']);
				
				echo '<tr'.($irow++ % 2 ? ' class="alt_row"' : '').' '.((isset($state->color) AND $this->colorOnBackground) ? 'style="background-color: '.$state->color.'"' : '').'><td></td>';
				foreach ($this->fieldsDisplay AS $key => $params){  
                                        if($key == 'image'){ 
                                            echo '<td class="pointer"><img src="'. _PS_IMG_ . 'slideshow/' . $tr[$key].'" alt="'. $tr[$key] .'" width="110" /></td>';
                                        }else{
                                            echo '<td class="pointer">'.$tr[$key].'</td>';
                                        }
                                }
                                if($this->delete = 'delete' && $this->edit = 'edit'){
                                    
                                    echo '<td class="center" style="white-space: nowrap;">';
					
					if ($this->delete AND (!isset($this->_listSkipDelete) OR !in_array($id, $this->_listSkipDelete)) && $this->edit) {
						$this->_displayDeleteLink($token, $id);
						$this->_displayEditLink($token, $id);
					}
					echo '</td>';
                                }
                                
                                $this->delete = false;
								$this->edit = false;
				echo '</tr>';
			}
	}

	public function editSlidwshow()
	{
		$id = $_GET['id_slideshow'];
		$query = "SELECT * FROM slideshow LEFT JOIN slideshow_lang ON slideshow_lang.id_slideshow = $id";
		$slideshow = Db::getInstance()->ExecuteS($query);
		$sshow = $slideshow[0];
?>
<form method="post" name="Slideshow_edit" id="Slideshow" action="/prestashop_kevin/admin_/index.php?tab=AdminSlideshow" enctype="multipart/form-data">
			<fieldset><legend>
					<img src="../img/t/AdminSlideshow.gif">Edit slideshow</legend><label>Image: </label>
			<div class="margin-form"><input type="file" size="60" value="" name="image"><p>Image of the slideshow</p></div><label>Title: </label>
			<div class="margin-form">
						<div style="display: block; float: left;" id="title_1">
							<input type="text" value="<?php echo $sshow['title']; ?>" name="title_1" size="">
						</div>
		<div class="displayed_flag">
			<img alt="" onclick="toggleLanguageFlags(this);" id="language_current_title" class="pointer" src="../img/l/1.jpg">
		</div>
		<div class="language_flags" id="languages_title">
			Choose language:<br><br><img onclick="changeLanguage('title', 'title', 1, 'en');" title="English (English)" alt="English (English)" class="pointer" src="../img/l/1.jpg"> <img onclick="changeLanguage('title', 'title', 2, 'fr');" title="Français (French)" alt="Français (French)" class="pointer" src="../img/l/2.jpg"> <img onclick="changeLanguage('title', 'title', 3, 'es');" title="Español (Spanish)" alt="Español (Spanish)" class="pointer" src="../img/l/3.jpg"> <img onclick="changeLanguage('title', 'title', 4, 'de');" title="Deutsch (German)" alt="Deutsch (German)" class="pointer" src="../img/l/4.jpg"> <img onclick="changeLanguage('title', 'title', 5, 'it');" title="Italiano (Italian)" alt="Italiano (Italian)" class="pointer" src="../img/l/5.jpg"> <img onclick="changeLanguage('title', 'title', 6, 'nl');" title="Dutch" alt="Dutch" class="pointer" src="../img/l/6.jpg"> </div><br style="clear:both"><p>Title of the slideshow</p></div><label>Head text: </label>
			<div class="margin-form">
						<div style="display: block; float: left;" id="head_text_1">
							<input type="text" value="<?php echo $sshow['head_text'] ?>" name="head_text_1" size="">
						</div>
		<div class="displayed_flag">
			<img alt="" onclick="toggleLanguageFlags(this);" id="language_current_head_text" class="pointer" src="../img/l/1.jpg">
		</div>
		<div class="language_flags" id="languages_head_text">
			Choose language:<br><br><img onclick="changeLanguage('head_text', 'head_text', 1, 'en');" title="English (English)" alt="English (English)" class="pointer" src="../img/l/1.jpg"> <img onclick="changeLanguage('head_text', 'head_text', 2, 'fr');" title="Français (French)" alt="Français (French)" class="pointer" src="../img/l/2.jpg"> <img onclick="changeLanguage('head_text', 'head_text', 3, 'es');" title="Español (Spanish)" alt="Español (Spanish)" class="pointer" src="../img/l/3.jpg"> <img onclick="changeLanguage('head_text', 'head_text', 4, 'de');" title="Deutsch (German)" alt="Deutsch (German)" class="pointer" src="../img/l/4.jpg"> <img onclick="changeLanguage('head_text', 'head_text', 5, 'it');" title="Italiano (Italian)" alt="Italiano (Italian)" class="pointer" src="../img/l/5.jpg"> <img onclick="changeLanguage('head_text', 'head_text', 6, 'nl');" title="Dutch" alt="Dutch" class="pointer" src="../img/l/6.jpg"> </div><br style="clear:both"><p>Text that appears under the title</p></div>
			<label>Short description: </label>
			<div class="margin-form">
				<div style="display: block; float: left;" id="sub_text_1">
					<textarea name="sub_text_1" cols="60" rows="4"><?php echo $sshow['sub_text'] ?></textarea>
				</div>
		<div class="displayed_flag">
			<img alt="" onclick="toggleLanguageFlags(this);" id="language_current_sub_text" class="pointer" src="../img/l/1.jpg">
		</div>
			<div class="language_flags" id="languages_sub_text">
			Choose language:<br><br><img onclick="changeLanguage('sub_text', 'sub_text', 1, 'en');" title="English (English)" alt="English (English)" class="pointer" src="../img/l/1.jpg"> <img onclick="changeLanguage('sub_text', 'sub_text', 2, 'fr');" title="Français (French)" alt="Français (French)" class="pointer" src="../img/l/2.jpg"> <img onclick="changeLanguage('sub_text', 'sub_text', 3, 'es');" title="Español (Spanish)" alt="Español (Spanish)" class="pointer" src="../img/l/3.jpg"> <img onclick="changeLanguage('sub_text', 'sub_text', 4, 'de');" title="Deutsch (German)" alt="Deutsch (German)" class="pointer" src="../img/l/4.jpg"> <img onclick="changeLanguage('sub_text', 'sub_text', 5, 'it');" title="Italiano (Italian)" alt="Italiano (Italian)" class="pointer" src="../img/l/5.jpg"> <img onclick="changeLanguage('sub_text', 'sub_text', 6, 'nl');" title="Dutch" alt="Dutch" class="pointer" src="../img/l/6.jpg">
			</div>
			<br style="clear:both">
			<p>Short description of the slide</p></div>
			<label>Button Text: </label>
			<div class="margin-form">
						<div style="display: block; float: left;" id="button_1">
							<input type="text" value="<?php echo $sshow['button']; ?>" name="button_1" size="">
						</div>
			<div class="displayed_flag">
				<img alt="" onclick="toggleLanguageFlags(this);" id="language_current_button" class="pointer" src="../img/l/1.jpg">
			</div>
		<div class="language_flags" id="languages_button">
			Choose language:<br><br><img onclick="changeLanguage('button', 'button', 1, 'en');" title="English (English)" alt="English (English)" class="pointer" src="../img/l/1.jpg"> <img onclick="changeLanguage('button', 'button', 2, 'fr');" title="Français (French)" alt="Français (French)" class="pointer" src="../img/l/2.jpg"> <img onclick="changeLanguage('button', 'button', 3, 'es');" title="Español (Spanish)" alt="Español (Spanish)" class="pointer" src="../img/l/3.jpg"> <img onclick="changeLanguage('button', 'button', 4, 'de');" title="Deutsch (German)" alt="Deutsch (German)" class="pointer" src="../img/l/4.jpg"> <img onclick="changeLanguage('button', 'button', 5, 'it');" title="Italiano (Italian)" alt="Italiano (Italian)" class="pointer" src="../img/l/5.jpg"> <img onclick="changeLanguage('button', 'button', 6, 'nl');" title="Dutch" alt="Dutch" class="pointer" src="../img/l/6.jpg"> </div><br style="clear:both"><p>Label of the button</p></div>
			<label>Button Link: </label>
			<div class="margin-form"><input type="text" size="60" value="<?php echo $sshow['link']; ?>" name="link"><p></p></div><label>Sort order: </label>
			<div class="margin-form"><input type="text" size="1" value="<?php echo $sshow['sort_order']; ?>" name="sort_order"><p>Order of the slides</p></div><div class="margin-form">
					<input type="submit" class="button" name="submitOptionsslideshow_edit" value="   Save   ">
				</div>
			</fieldset>
			<input type="hidden" value="<?php echo $_GET['token']; ?>" name="token">
			<input type="hidden" value="<?php echo $sshow['id_slideshow']; ?>" name="slideshow_id" />
		</form>
<?php
	}
	
	public function displayForm($isMainTab = true)
	{
		global $currentIndex, $cookie;
		parent::displayForm();
		
		if (!($obj = $this->loadObject(true)))
			return;	
		echo '
		<form action="'.$currentIndex.'&submitAdd'.$this->table.'=1&token='.$this->token.'" method="post" enctype="multipart/form-data">
		'.($obj->id ? '<input type="hidden" name="id_'.$this->table.'" value="'.$obj->id.'" />' : '').'
			<input type="hidden" name="id_order" value="'.$obj->id_order.'" />
			<input type="hidden" name="id_customer" value="'.$obj->id_customer.'" />
			<fieldset><legend><img src="../img/admin/return.gif" />'.$this->l('Return Merchandise Authorization (RMA)').'</legend>
				<label>'.$this->l('Customer:').' </label>';
				$customer = new Customer((int)($obj->id_customer));
		echo '
				<div class="margin-form">'.$customer->firstname.' '.$customer->lastname.'
				<p style="clear: both"><a href="index.php?tab=AdminCustomers&id_customer='.$customer->id.'&viewcustomer&token='.Tools::getAdminToken('AdminCustomers'.(int)(Tab::getIdFromClassName('AdminCustomers')).(int)($cookie->id_employee)).'">'.$this->l('View details on customer page').'</a></p>
				</div>
				<label>'.$this->l('Order:').' </label>';
				$order = new Order((int)($obj->id_order));
		echo '		<div class="margin-form">'.$this->l('Order #').sprintf('%06d', $order->id).' '.$this->l('from').' '.Tools::displayDate($order->date_upd, $order->id_lang).'
				<p style="clear: both"><a href="index.php?tab=AdminOrders&id_order='.$order->id.'&vieworder&token='.Tools::getAdminToken('AdminOrders'.(int)(Tab::getIdFromClassName('AdminOrders')).(int)($cookie->id_employee)).'">'.$this->l('View details on order page').'</a></p>
				</div>
				<label>'.$this->l('Customer explanation:').' </label>
				<div class="margin-form">'.nl2br2($obj->question).'</div>

				<label>'.$this->l('Status:').' </label>
				<div class="margin-form">
				<select name=\'state\'>';
				$states = OrderReturnState::getOrderReturnStates($cookie->id_lang);
				foreach ($states as $state)
					echo '<option value="'.$state['id_order_return_state'].'"'.($obj->state == $state['id_order_return_state'] ? ' selected="selected"' : '').'>'.$state['name'].'</option>';
		echo '	</select>
				<p style="clear: both">'.$this->l('Merchandise return (RMA) status').'</p>
				</div>';
		if ($obj->state >= 3)
			echo '	<label>'.$this->l('Slip:').' </label>
				<div class="margin-form">'.$this->l('Generate a new slip from the customer order').'
				<p style="clear: both"><a href="index.php?tab=AdminOrders&id_order='.$order->id.'&vieworder&token='.Tools::getAdminToken('AdminOrders'.(int)(Tab::getIdFromClassName('AdminOrders')).(int)($cookie->id_employee)).'#products">'.$this->l('More information on order page').'</a></p>
				</div>';
		echo '	<label>'.$this->l('Products:').' </label>
				<div class="margin-form">';
			echo '<table cellpadding="0" cellspacing="0">
					<tr>
						<td class="col-left">&nbsp;</td>
						<td>
							<table cellspacing="0" cellpadding="0" class="table">
							<tr>
								<th style="width: 100px;">'.$this->l('Reference').'</th>
								<th>'.$this->l('Product name').'</th>
								<th>'.$this->l('Quantity').'</th>
								<th>'.$this->l('Action').'</th>
							</tr>';

			$order = new Order((int)($obj->id_order));
			$quantityDisplayed = array();
			/* Customized products */
			if ($returnedCustomizations = OrderReturn::getReturnedCustomizedProducts((int)($obj->id_order)))
			{
				$allCustomizedDatas = Product::getAllCustomizedDatas((int)($order->id_cart));
				foreach ($returnedCustomizations AS $returnedCustomization)
				{
					echo '
					<tr>
						<td>'.$returnedCustomization['reference'].'</td>
						<td class="center">'.$returnedCustomization['name'].'</td>
						<td class="center">'.(int)($returnedCustomization['product_quantity']).'</td>
						<td class="center"><a href="'.$currentIndex.'&deleteorder_return_detail&id_order_detail='.$returnedCustomization['id_order_detail'].'&id_customization='.$returnedCustomization['id_customization'].'&id_order_return='.$obj->id.'&token='.$this->token.'"><img src="../img/admin/delete.gif"></a></td>
					</tr>';
					$customizationDatas = &$allCustomizedDatas[(int)($returnedCustomization['product_id'])][(int)($returnedCustomization['product_attribute_id'])][(int)($returnedCustomization['id_customization'])]['datas'];
					foreach ($customizationDatas AS $type => $datas)
					{
						echo '<tr>
						<td colspan="4">';
						if ($type == _CUSTOMIZE_FILE_)
						{
							$i = 0;
							echo '<ul style="margin: 4px 0px 4px 0px; padding: 0px; list-style-type: none;">';
							foreach ($datas AS $data)
								echo '<li style="display: inline; margin: 2px;">
										<a href="displayImage.php?img='.$data['value'].'&name='.(int)($order->id).'-file'.++$i.'" target="_blank"><img src="'._THEME_PROD_PIC_DIR_.$data['value'].'_small" alt="" /></a>
									</li>';
							echo '</ul>';
						}
						elseif ($type == _CUSTOMIZE_TEXTFIELD_)
						{
							$i = 0;
							echo '<ul style="margin: 0px 0px 4px 0px; padding: 0px 0px 0px 6px; list-style-type: none;">';
							foreach ($datas AS $data)
								echo '<li>'.($data['name'] ? $data['name'] : $this->l('Text #').++$i).$this->l(':').' '.$data['value'].'</li>';
							echo '</ul>';
						}
						echo '</td>
						</tr>';
					}
					$quantityDisplayed[(int)($returnedCustomization['id_order_detail'])] = isset($quantityDisplayed[(int)($returnedCustomization['id_order_detail'])]) ? $quantityDisplayed[(int)($returnedCustomization['id_order_detail'])] + (int)($returnedCustomization['product_quantity']) : (int)($returnedCustomization['product_quantity']);
				}
			}

			/* Classic products */
			$products = OrderReturn::getOrdersReturnProducts($obj->id, $order);
			foreach ($products AS $k => $product)
				if (!isset($quantityDisplayed[(int)($product['id_order_detail'])]) OR (int)($product['product_quantity']) > (int)($quantityDisplayed[(int)($product['id_order_detail'])]))
					echo '
					<tr>
						<td>'.$product['product_reference'].'</td>
						<td class="center">'.$product['product_name'].'</td>
						<td class="center">'.$product['product_quantity'].'</td>
						<td class="center"><a href="'.$currentIndex.'&deleteorder_return_detail&id_order_detail='.$product['id_order_detail'].'&id_order_return='.$obj->id.'&token='.$this->token.'"><img src="../img/admin/delete.gif"></a>
						<a href="'.$currentIndex.'&deleteorder_return_detail&id_order_detail='.$product['id_order_detail'].'&id_order_return='.$obj->id.'&token='.$this->token.'"><img src="../img/admin/delete.gif"></a>
						</td>
					</tr>';

			echo '
							</table>
						</td>
					</tr>
				</table>
				<p>'.$this->l('List of products in return package').'</p>
				</div>
				<div class="margin-form">
					<input type="submit" value="'.$this->l('   Save   ').'" name="submitAdd'.$this->table.'" class="button" style="margin-right:120px;"/>
				</div>
			</fieldset>
		</form>';
	}
}


