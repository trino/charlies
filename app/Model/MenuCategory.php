<?php
class MenuCategory extends AppModel{
     public $uses = array('Menu','MenuCategory');
    
	 public $hasMany=array('Menu'=>array('className'=>'Menu',
                                 'foreignKey'=>'cat_id',
                                 'dependent'=>true,
                                 'exclusive'=>true,
                                 'order'=>'display_order',
                                 'conditions'=>'menu_item <> ""'
                                )
                                     );
    
}