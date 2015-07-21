<?php
    include_once("/subpages/api.php");
?>

<!--<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <nav>
          <ol class="breadcrumb">
            
             <li><a href="<?php echo $this->webroot;?>/restaurants/dashboard">Dashboard</a></li>
            
            <li><a href="">Restaurant info</a></li>
            
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>-->

<div class="container ">
    <!-- Big banner -->
    <div class="row " style="padding-top: 20px;">
        <div class="col-xs-12">
            <div class="">
                <!--div class="banners--big">
Welcome, <?php echo $this->Session->read('name');?>
</div-->
            </div>
        </div>
    </div>
  <div class="row">
    <?php include('subpages/admin_menu.php')?>
    <div class="col-xs-12  col-sm-9">
      <div class="grid">
        <!--<ul class="pagination  shop__amount-filter">
          <li>
            <a class="shop__amount-filter__link  hidden-xs" href="shop.html"><span class="glyphicon glyphicon-th"></span></a>
          </li>
          <li>
              <a class="shop__amount-filter__link  hidden-xs" href="shop-list-view.html"><span class="glyphicon glyphicon-th-list"></span></a>
          </li>
        </ul>-->
        <?php /*
        <div class="shop__sort-filter">
          <select class="js--isotope-sorting  btn  btn-shop">
              <option value='{"sortBy":"price", "sortAscending":"true"}'>By Price (Low to High) &uarr;</option>
              <option value='{"sortBy":"price", "sortAscending":"false"}'>By Price (High to Low) &darr;</option>
              <option value='{"sortBy":"name", "sortAscending":"true"}'>By Name (Low to High) &uarr;</option>
              <option value='{"sortBy":"name", "sortAscending":"false"}'>By Name (High to Low) &darr;</option>
              <option value='{"sortBy":"rating", "sortAscending":"true"}'>By Rating (Low to High) &uarr;</option>
              <option value='{"sortBy":"rating", "sortAscending":"false"}'>By Rating (High to Low) &darr;</option>
          </select>
        </div>
        <?php */?>
        <h3 class="sidebar__title">Restaurant Detail Manager</h3>
        <hr class="shop__divider">
        <div class="dashboard">
          
           <form action="" method="post">
           <div class="row">
                <div class="col-xs-12 col-sm-4 profilepic">
                <p>
                    <?php
                    if($res['Restaurant']['picture'])
                    $pic = $res['Restaurant']['picture'];
                    else
                    $pic = 'default.png';
                     
                    ?>
                    <strong>Restaurant Image</strong><br /><br />
                    <img id="picture" src="<?= restimage($this->webroot, $res); ?>" title="<?php echo $this->webroot;?>images/restaurants/<?php echo $pic;?>" /><br />
                    <input type="hidden" class="picture" name="picture" value="<?php echo $res['Restaurant']['picture'];?>" />
                    <a href="javascript:void(0);" id="uploadbtn" class="btn btn-success">Change Image</a>
                </p>
                </div>
                <div class="col-xs-12 col-sm-4">
                <strong>Restaurant Info</strong><br /><br />
                <p class="inputs">
                
                    <input type="text" name="name" placeholder="Restaurant Name" title=="Restaurant Name" value="<?php echo $res['Restaurant']['name'];?>" />
                    <input type="text" name="email" placeholder="Restaurant Email" title="Restaurant Email" value="<?php echo $res['Restaurant']['email'];?>" />
                    <input type="text" name="street" placeholder="Street Address" title="Street Address" value="<?php echo $res['Restaurant']['street'];?>" />
                    <input type="text" name="city" placeholder="City" title=="City" value="<?php echo $res['Restaurant']['city'];?>" />
                    <input type="text" name="prov_state" placeholder="State/Province" title="State/Province" value="<?php echo $res['Restaurant']['prov_state'];?>" />
                    <input type="text" name="pos_zip" placeholder="Postal Code" title="Postal Code" value="<?php echo $res['Restaurant']['pos_zip'];?>" />
                    <input type="text" name="phone" placeholder="Phone" title="Phone" value="<?php echo $res['Restaurant']['phone'];?>" />
                    
                    
                </p>
                </div>
                <div class="col-xs-12 col-sm-4">
                <p class="inputs">
                <strong>&nbsp;</strong><br /><br />
                    <!--input type="text" name="cuisine" placeholder="Cuisine" value="<?php echo $res['Restaurant']['cuisine'];?>" /-->
                    <textarea name="description" placeholder="Description" title="Description"><?php echo $res['Restaurant']['description'];?></textarea>
                </p>
                
                </div>
                <div class="clearfix"></div>
                <?php /*<div class="col-xs-12">
                    
                    <div class="divider"></div>
                    <a href="javascript:void(0);" class="btn btn-info left" id="image_more">Additional Images</a>
                    <div class="clearfix"></div>
                    <div class="image_more">
                    <?php
                    if($res['ResImage'])
                    {
                        foreach($res['ResImage'] as $ri)
                        {
                            ?>
                            <div class="col-xs-12 col-sm-3">
                            <img src="<?php echo $this->webroot;?>images/restaurants/<?php echo $ri['images'];?>" /><input type="hidden" name="imgs[]" value="<?php echo $ri['images'];?>" />
                            <center><a href="javascript:void(0)" class="btn btn-danger removemore">X</a></center>
                            </div>
                            <?php
                        }
                    } 
                    ?>
                        <div class="clearfix"></div>
                    </div>
                    
                </div> */?>
                </div>
                
                <hr class="divider" />
                
                <div class="row">
		
					
				<div class="col-xs-12 col-sm-12"><h5 class="sidebar__subtitle" style="width: 100%;">Hours of Operation</h5></div>
                <div class="clearfix"></div>	
                <div class="col-xs-12 col-sm-6 opening">
                
                     
            
                    <table class="table days">
                        <tr><td>Sunday</td><td><input value="<?php $date = new DateTime($res['Restaurant']['sunday_from']);echo $date->format('h:i A');?>" type="text" class="timepicker" name="sunday_from" placeholder="From" style="width: 48%;" />  <input value="<?php $date = new DateTime($res['Restaurant']['sunday_to']);echo $date->format('h:i A');?>" style="width: 48%;" type="text" class="timepicker" name="sunday_to" placeholder="To" /></td></tr>
                        <tr><td>Monday</td><td><input value="<?php $date = new DateTime($res['Restaurant']['monday_from']);echo $date->format('h:i A');?>" type="text" class="timepicker" name="monday_from" placeholder="From" style="width: 48%;" />  <input value="<?php $date = new DateTime($res['Restaurant']['monday_to']);echo $date->format('h:i A');?>" style="width: 48%;" type="text" class="timepicker" name="monday_to" placeholder="To" /></tr>
                        <tr><td>Tuesday</td><td><input value="<?php $date = new DateTime($res['Restaurant']['tuesday_from']);echo $date->format('h:i A');?>" type="text" class="timepicker" name="tuesday_from" placeholder="From" style="width: 48%;" />  <input value="<?php $date = new DateTime($res['Restaurant']['tuesday_to']);echo $date->format('h:i A');?>" style="width: 48%;" type="text" class="timepicker" name="tuesday_to" placeholder="To" /></td></tr>
                        <tr><td>Wednesday</td><td><input value="<?php $date = new DateTime($res['Restaurant']['wednesday_from']);echo $date->format('h:i A');?>" type="text" class="timepicker" name="wednesday_from" placeholder="From" style="width: 48%;" />  <input value="<?php $date = new DateTime($res['Restaurant']['wednesday_to']);echo $date->format('h:i A');?>" style="width: 48%;" type="text" class="timepicker" name="wednesday_to" placeholder="To" /></td></tr>
                    </table>
                
                </div>
                <div class="col-xs-12 col-sm-6 opening">
                
                    
                    <table class="table days">
                        <tr><td>Thursday</td><td><input value="<?php $date = new DateTime($res['Restaurant']['thursday_from']);echo $date->format('h:i A');?>" type="text" class="timepicker" name="thursday_from" placeholder="From" style="width: 48%;" />  <input value="<?php $date = new DateTime($res['Restaurant']['thursday_to']);echo $date->format('h:i A');?>" style="width: 48%;" type="text" class="timepicker" name="thursday_to" placeholder="To" /></td></tr>
                        <tr><td>Friday</td><td><input value="<?php $date = new DateTime($res['Restaurant']['friday_from']);echo $date->format('h:i A');?>" type="text" class="timepicker" name="friday_from" placeholder="From" style="width: 48%;" />  <input value="<?php $date = new DateTime($res['Restaurant']['friday_to']);echo $date->format('h:i A');?>" style="width: 48%;" type="text" class="timepicker" name="friday_to" placeholder="To" /></td></tr>
                        <tr><td>Saturday</td><td><input value="<?php $date = new DateTime($res['Restaurant']['saturday_from']);echo $date->format('h:i A');?>" type="text" class="timepicker" name="saturday_from" placeholder="From" style="width: 48%;" />  <input value="<?php $date = new DateTime($res['Restaurant']['saturday_to']);echo $date->format('h:i A');?>" style="width: 48%;" type="text" class="timepicker" name="saturday_to" placeholder="To" /></td></tr>
                    </table>
                
                </div>
                
                
                </div>
                <div class="divider"></div>
                    <div class="inputs col-xs-12 col-sm-6 opening">
                     <h5 class="sidebar__subtitle">Delivery Fee</h5>
                        <input type="text" name="delivery_fee" value="$<?php echo number_format($res['Restaurant']['delivery_fee'],2);?>" placeholder="Delivery Fee" />
                    </div>
                    <div class="inputs col-xs-12 col-sm-6 opening">
                     <h5 class="sidebar__subtitle">Minimum sub total for delivery</h5>
                        <input type="text" name="min_delivery" value="$<?php echo number_format($res['Restaurant']['min_delivery'],2);?>" placeholder="Delivery Fee" />
                    </div>
                    
                    
                    <div class="clearfix"></div>
                <div class="divider"></div>
                <input type="submit" class="btn btn-primary" value="Save Changes" />
            </form>
            
            
              
        </div>
            
          
          <div class="clearfix  hidden-xs"></div>
        </div>
        <hr class="shop__divider">
        <?php /*<div class="shop__pagination">
          <ul class="pagination">
            <li><a class="pagination--nav" href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
            <li><a href="#">1</a></li>
            <li><a class="active" href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a class="pagination--nav" href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
          </ul>
        </div><?php */?>
      </div>
    </div>
  </div>
</div>