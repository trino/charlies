<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <nav>
          <ol class="breadcrumb">
            
            <li><a href="index.html">Home</a></li>
            <li><a href="index.html">Restaurants</a></li>
            <li class="active"><?php echo $res['Restaurant']['name'];?></li>
            
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <!-- Big banner -->
  <div class="row">
    <div class="col-xs-12 col-sm-4 profilepic">
        <p class="">
            <strong><?php echo $res['Restaurant']['name'];?></strong>
            <hr class="shop__divider" />
            <img src="<?php echo $this->webroot?>images/restaurants/<?php echo $res['Restaurant']['picture'];?>" />
            <input type="hidden" id="address" value="<?php if($res['Restaurant']['street'])echo $res['Restaurant']['street'].', ';echo $res['Restaurant']['city'];if($res['Restaurant']['prov_state'])echo ', '.$res['Restaurant']['prov_state'];?>" />    
        </p>
    </div>
    <div class="col-xs-12 col-sm-4">
        <p>
            <strong>Restaurant's Info</strong>
            
            <hr class="shop__divider" />
            <div class="infolist"><?php echo ucfirst($res['Restaurant']['style']);?>, <?php echo $res['Restaurant']['cuisine']?> cuisine.</div> 
            <div class="infolist"><strong>Location: &nbsp; </strong> <?php echo $res['Restaurant']['street'];?>, <?php echo $res['Restaurant']['city'].', '.$res['Restaurant']['prov_state'];?></div>
            <div class="infolist"><strong>Hours of operation: &nbsp; </strong><br /><br />
            <strong>Sunday: &nbsp; </strong><?php echo $res['Restaurant']['sunday'];?><br />
            <strong>Monday: &nbsp; </strong><?php echo $res['Restaurant']['monday'];?><br />
            <strong>Tuesday: &nbsp; </strong><?php echo $res['Restaurant']['tuesday'];?><br />
            <strong>Wednesday: &nbsp; </strong><?php echo $res['Restaurant']['wednesday'];?><br />
            <strong>Thursday: &nbsp; </strong><?php echo $res['Restaurant']['thursday'];?><br />
            <strong>Friday: &nbsp; </strong><?php echo $res['Restaurant']['friday'];?><br />
            <strong>Saturday: &nbsp; </strong><?php echo $res['Restaurant']['saturday'];?><br />
            </div>
            <div class="infolist"><strong>Contact: &nbsp; </strong>  <?php echo $res['Restaurant']['phone'];?>, <?php echo $res['Restaurant']['email'];?></div>
            <div class="infolist"><strong>Lunch Till: &nbsp; </strong>  <?php echo $res['Restaurant']['lunchtill'];?></div>
            <div class="infolist"><strong>Dinner Till: &nbsp; </strong>  <?php echo $res['Restaurant']['dinnertill'];?></div>
        </p>
    </div>
    <div class="col-xs-12 col-sm-4">
    <strong>Detail</strong>
    <hr class="shop__divider" />
        <p>
        
        <div class="infolist"><strong>Description: &nbsp; </strong> <?php echo $res['Restaurant']['description'];?></div>
        <iframe
  width="100%"
  height="200"
  frameborder="0" style="border:0"
  src="https://www.google.com/maps/embed/v1/place?key=<?php if($_SERVER['SERVER_NAME']=='localhost'){?>AIzaSyAcCefWxk_hh9-YO5p31ay2vQE-1_kJK5I<?php }else{echo 'AIzaSyDoBmY11-CrGRIhbo1_bGNfKjYUV36YL0E';}?>&q=<?php if($res['Restaurant']['street'])echo str_replace(' ','+',$res['Restaurant']['street']).',';echo str_replace(' ','+',$res['Restaurant']['city']);if($res['Restaurant']['prov_state'])echo ','.str_replace(' ','+',$res['Restaurant']['prov_state']);?>">
</iframe>        
        <?php /*<div class="infolist">
        <strong>70 Reviews: </strong>
            <span class="glyphicon glyphicon-star star-on"></span>
            <span class="glyphicon glyphicon-star star-on"></span>
            <span class="glyphicon glyphicon-star star-on"></span>
            <span class="glyphicon glyphicon-star star-on"></span>
            <span class="glyphicon glyphicon-star star-off"></span>
        </div>
        <a href="#" class="btn btn-primary--transition">View Reviews</a>*/?>
</div>
        </p>
    </div>
    <hr class="shop__divider" />
  
  <div class="row">
    <div class="col-xs-12  col-sm-2 sidecat">
      <aside class="sidebar  sidebar--shop  scr-fixed">
        
        
        <div class="shop-filter">

          <h5 class="sidebar__subtitle">Categories</h5>
          <ul class="nav  nav--filter">
          <?php
          if($res['MenuCategory'])
          {
            foreach($res['MenuCategory'] as $mc)
            {
                
            ?>
            <li><a href="#category<?php echo $mc['id'];?>" class="scrolly"><?php echo $mc['title'];?></a></li>
          
            
          
            
            <?php
            }
          }
          ?>
          
          </ul>

          <?php /*<hr class="divider">

          <h5 class="sidebar__subtitle">Price</h5>
          <div class="shop__filter__slider">
            <div class="js--jqueryui-price-filter"></div>
          </div>

          <hr class="divider">
          <nav>
            <h5 class="sidebar__subtitle">Country</h5>
            <ul class="nav  nav--filter">
              <li><a href="#">Croatia</a></li>
              <li><a href="#">Ireland</a></li>
              <li><a href="#">Slovenia</a></li>
              <li><a href="#">United Kingdom</a></li>
              <li><a href="#">USA</a></li>
            </ul>
          </nav>
          <hr class="divider"><?php */?>
        </div>
      </aside>
    </div>
    <div class="col-xs-12  col-sm-10">
      <div class="grid">
        
        <div class="row menulisting">
        <div class="col-xs-12 col-sm-8">
        <h3 class="mytit">Menu Item</h3>
        <?php
        foreach($rescat as $cat)
        {
            ?>
            <h5 class="sidebar__subtitle" id="category<?php echo $cat['MenuCategory']['id'];?>"><?php echo $cat['MenuCategory']['title'];?></h5>
            <?php
            foreach($cat['Menu'] as $me)
            {
            ?>
             <div class="infolist">
             <?php if($me['image']){
                ?>
                
                <div class="menucl img-circle col-xs-12 col-sm-4">
                    <a href="#Modal<?php echo $me['id'];?>" role="button" data-toggle="modal">
                    
                    <img src="<?php echo $this->webroot;?>images/menus/<?php echo $me['image'];?>" style="max-width: 100%;"/>
                    
                    </a>
                    
                </div>
                <div class="modal  fade" id="Modal<?php echo $me['id'];?>" tabindex="-1" role="dialog" aria-labelledby="Modal<?php echo $me['id'];?>Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content  center">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                        <h3><?php echo $me['menu_item'];?></h3>
                        <hr class="divider">
                      </div>
                      <div class="modal-body">
                        <img src="<?php echo $this->webroot;?>images/menus/<?php echo $me['image'];?>" style="max-width: 500px;"/>
                      </div>
                    </div>
                 </div>
                 </div>
                <?php
             }?>
                <div class="menucl menu-title col-xs-12 <?php if($me['image']){?>col-sm-4<?php }else{?>col-sm-6<?php }?>">
                    <strong><?php echo $me['menu_item'];?></strong>: $<span class="profileprice<?php echo $me['id'];?>"><?php echo number_format(str_replace('$','',$me['price']),2);?></span><br />
                    <?php echo $me['description'];?>
                </div>
                
                <div class="menucl menu-act col-xs-12 alignr <?php if($me['image']){?>col-sm-4<?php }else{?>col-sm-6<?php }?>">
                    <a href="javascript:void(0)" class="btn btn-primary--transition add_menu_profile" id="profilemenu<?php echo $me['id'];?>">Add</a>
                </div>
                <div class="clearfix"></div>
                <div class="subitems_<?php echo $me['id'];?>">
                    <input type="checkbox" value="" title="<?php echo $me['id']."_".$me['menu_item']."_".$me['price']."_"."";?>" checked="checked" style="display: none;" />
                    <?php $submenuscat = $this->requestAction('restaurants/getMenucat/'.$me['id']);
                    //var_dump($submenuscat);
                        foreach($submenuscat as $subm)
                        {?>
                        <div class="infolist whiteround" >
                            <a href="javascript:void(0);" onclick="$($(this).parent().children('div:eq(0)')).toggle(); $('.extra-<?php echo $subm['MenuCategory']['id'];?>').each(function(){$(this).removeAttr('checked');}) " >&nbsp;<strong><?php echo $subm['MenuCategory']['title'];?></strong></a>
                              <input type="checkbox" checked="checked" style="display: none;" id="<?php echo $subm['MenuCategory']['id'];?>" title="___" value="<?php echo $subm['MenuCategory']['title'];?>" />
                              <div  style="display: none;">
                                <?php
                                $k=0; 
                                foreach($subm['Menu'] as $k=>$m)
                                    {
                                    if($k%3 == 0 ){?>
                                      <div class="subin">
                                <?php }?>
                                       <div class="col-xs-12 col-sm-4">
                                            <input type="checkbox" value="" name="extra" class="extra-<?php echo $subm['MenuCategory']['id'];?>" title="<?php echo $m['id']."_".$m['menu_item']."_".$m['price']."_".$subm['MenuCategory']['title'];?>" id="extra_<?php echo $m['id'];?>" />&nbsp;&nbsp;<?php echo $m['menu_item']."  (+ $".number_format(str_replace('$','',$m['price']),2).")";?>
                                       
                                       </div> 
                                 <?php
                                        if(($k+1)%3==0)
                                        {?>
                                         <div class="clearfix"></div>   
                                        </div> 
                                     <?php
                                        }
                                    }
                                    if($k%3==0)
                                    {
                                        ?>
                                        <div class="col-xs-12 col-sm-4"></div>
                                        <div class="col-xs-12 col-sm-4"></div>
                                        <div class="clearfix"></div>   
                                        </div> 
                                        <?php
                                    }
                                    if($k%3==1)
                                    {
                                        ?>
                                        
                                        <div class="col-xs-12 col-sm-4"></div>
                                        <div class="clearfix"></div>   
                                        </div> 
                                        <?php
                                    }
                                ?>
                                
                                
                           </div>     
                         </div>    
                    <?php 
                        }
                    ?>
                                        
                </div>
             <div class="clearfix"></div>      
             </div>
             
        
            <?php
            }
        }
        ?> 
        <hr class="shop__divider">
         
        </div>
        
        <div class="col-xs-12 col-sm-4">
        <div class="scr-fixed">
        <form action="<?php echo $this->webroot;?>restaurants/order/<?php echo $res['Restaurant']['id'];?><?php if($order){?>/<?php echo $order['Reservation']['id']; }?>" method="post">
        <h5 class="sidebar__subtitle">Order Receipt</h5>
            <ul class="listnone">
                <li class="active">
                <input type="radio" name="order_type" value="delivery" checked="" onchange="if($(this).is(':checked')){$('#df').show();$('.df').val('<?php echo str_replace('$','',$res['Restaurant']['delivery_fee']);?>');}"/> For Delivery
                </li>
                <li class="">
                <input type="radio" name="order_type" value="Pickup" onchange="if($(this).is(':checked')){$('.df').val('0');$('#df').hide();}"/> Pickup
                </li>                
            </ul>  
            <div class="tab-content">
                <div id="" class="">
                
                <p class="tab-text">
                
                    <div class="orders">
                        <?php
                        if($order)
                        {
                            $menu_ids = $order['Reservation']['menu_ids'];
                            $qtys = $order['Reservation']['qtys'];
                            $arr_m = explode(',',$menu_ids);
                            $arr_qty = explode(',',$qtys);
                            $arr_extras = explode(',',$order['Reservation']['extras']);
                            $list_ids = explode(',',$order['Reservation']['listid']);
                            $prices = explode(',',$order['Reservation']['prs']);
                            foreach($arr_m as $k=>$me)
                            {
                                $menu = $menus->findById($me);
                                ?>
                                <div id="list<?php echo $list_ids[$k];?>" class="infolist">
                                <strong class="namemenu"><?php echo $menu['Menu']['menu_item']." ".$arr_extras[$k];?></strong>
                                <div class="left">
                                <a id="dec<?php echo $list_ids[$k];?>" class="decrease small btn btn-danger" href="javascript:void(0);">
                                <strong>-</strong>
                                </a>
                                <span class="count"><?php echo $arr_qty[$k];?></span>
                                <input type="hidden" class="count" name="qtys[]" value="<?php echo $arr_qty[$k];?>" />
                                <input type="hidden" class="menu_ids" name="menu_ids[]" value="<?php echo $menu['Menu']['id'];?>" />
                                <input type="hidden" class="prs" name="prs[]" value="<?php echo str_replace('$','',$prices[$k]);?>" />
                                X $
                                <span class="amount"><?php echo number_format(str_replace('$','',$prices[$k]),2);?></span>
                                </div>
                                <div class="right">
                                <strong>
                                $
                                <span class="total"><?php echo number_format((str_replace('$','',$prices[$k])*$arr_qty[$k]),2);?></span>
                                </strong>
                                <a id="inc<?php echo $list_ids[$k];?>" class="increase btn btn-success small " href="javascript:void(0);">
                                <strong>+</strong>
                                </a>
                                </div>
                                <div class="clearfix"></div>
                                </div>
                                <?php
                            }
                            
                        }
                        ?>
                        
                    </div>
                   
                </p>
                <hr class="shop__divider" />
                        <strong>Subtotal </strong> : $<span class="subtotal"><?php if($order){echo $order['Reservation']['subtotal'];}else{?>0.00<?php }?></span>
                        <input type="hidden" value="0.00" class="subtotal" name="subtotal" />
                        <span id="df">
                        <hr class="shop__divider" />
                        <strong>Delivery Fee </strong> : $<?php echo number_format(str_replace('$','',$res['Restaurant']['delivery_fee']),2);?>
                        <input type="hidden" name="delivery_fee" class="df" value="<?php echo str_replace('$','',$res['Restaurant']['delivery_fee']);?>" />
                        </span>
                        <hr class="shop__divider" />
                        <strong>Tax </strong> : $<span class="tax"><?php if($order){echo $order['Reservation']['tax'];}else{?>0.00<?php }?></span> (<span id="tax"><?php echo str_replace('$','',$res['Restaurant']['tax']);?></span>%)
                        <input type="hidden" class="tax" name="tax" value="<?php if($order){echo $order['Reservation']['tax'];}else{?>0.00<?php }?>" />
                        <hr class="shop__divider" />
                        <strong>Total</strong> : $<span class="grandtotal"><?php if($order){echo $order['Reservation']['g_total'];}else{echo number_format(str_replace('$','',$res['Restaurant']['delivery_fee']),2); }?></span>
                        <input type="hidden" value="<?php if($order){echo $order['Reservation']['g_total'];}else{echo number_format(str_replace('$','',$res['Restaurant']['delivery_fee']),2); }?>" class="grandtotal" name="g_total" />
                        <hr class="shop__divider" />
                        <input type="submit" value="Submit Order" class="btn btn-success" />
                </div>
                
                
            </div>  
            </form>         
        </div>
        </div>   
        </div>
        
      </div>
    </div>
  </div>
</div>