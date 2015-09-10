define(['jquery','jqueryui/core'], function (jQuery) {


var path = window.location.pathname;
if(path.replace('ordering_system','')!=path)
var base_url = 'http://localhost/ordering_system/';
else
var base_url = 'http://' + window.location.host + '/';




//Script for order submission page
if(path.replace('orders/report','')!=path)
{
    $('.datepicker').datepicker({
            dateFormat:'yy-mm-dd'
        });
}
if(path.replace('restaurants/order/','')!=path)
{
        $('#ordered_on_date').datepicker({
            dateFormat:'yy-mm-dd'
        });
        $('#ordered_on_time').timepicker({
            minutes: { interval: 15 },
            
        });
        $('.ui-timepicker-title').each(function(){
           if($(this).text()=='Minute')
           $(this).text('Min'); 
        });
        
        
}
if(path.replace('restaurants/dashboard','') !=path || path.replace('restaurants/menuManager','') !=path || path.replace('orders/history','') !=path || path.replace('orders/pending','') !=path  || path.replace('orders/view','') !=path)
{
    $('.uploadimg').each(function(){
       var id = $(this).attr('id');
       initiate_ajax_upload3(id); 
    });
    $.ajax({
            url: base_url+'orders/get_pending',
            success:function(response)
            {
                
                if(response>0)
                $('.notification').html(response);
                else
                $('.notific').html('0');
            }
        });
    setInterval(function(){
        $.ajax({
            

            url: base_url+'orders/get_pending',

            success:function(response)
            {
                
                if(response>0)
                $('.notification').html(response);
                else
                $('.notific').html('0');
            }
        })
    },5000);
}            

// script for menu manager
if(path.replace('menuManager','')!=path)
            {
                
                /*Delete Category*/
                $('.deletecat').live('click',function(){
                    if(confirm('Are you sure?')){ 
                   var del_id = $(this).attr('id').replace('deletecat','');
                   $(this).parent().parent().remove();
                   $.ajax({
                    url:base_url+'restaurants/removeCat/'+del_id
                   }); 
                   }
                });
                
                /*Delete Menu*/
                $('.deletemenu').live('click',function(){
                   if(confirm('Are you sure?')){ 
                   var del_id = $(this).attr('id').replace('deletemenu','');
                   $(this).parent().parent().remove();
                   $.ajax({
                    url:base_url+'restaurants/removeMenu/'+del_id
                   }); 
                   }
                });
                /*Change Category Title*/
                $('.changeme').live('click',function(){
                   var change_id = $(this).attr('id').replace('change','');
                   var change_title = $('.catetitle'+change_id).val();
                   $.ajax({
                    url:base_url+'restaurants/changeCat/'+change_id+'/'+change_title,
                    success:function(res){
                        $('.cattitle'+change_id).html(res);
                    }
                   }); 
                });
                
                /*Change Category Title ENDS*/
                
               $('.parentinfo').sortable({
                     items: "li:not(.ui-state-disabled)",
                     update : function (event,ui) {
                        var order='';// array to hold the id of all the child li of the selected parent
                        $('.parentinfo li.infolistwhite').each(function(index) {
                                var val=$(this).attr('id').replace('catid','');
                                //var val=item[1];
                                if(order=='')
                                order=val;
                                else
                                order=order+','+val;
                            });
                       $.ajax({
                        url:base_url+'restaurants/orderCat/',
                        data:'ids='+order,
                        type:'post',
                        success:function(){
                            //
                        }
                       });   
                         
                     }
                });
              //$( ".parentinfo" ).on( "sortupdate", function( event, ui ) {alert('test')} );  
               $('.parentinfo2').sortable({
                     items: "li:not(.ui-state-disabled)",
                     update : function (event,ui) {
                        
                        var order='';// array to hold the id of all the child li of the selected parent
                        
                        $('#'+ui.item.attr('id')).closest('.parentinfo2').find('li').each(function(index) {
                                var val=$(this).attr('id').replace('menu_list_','');
                                //var val=item[1];
                                if(order=='')
                                order=val;
                                else
                                order=order+','+val;
                            });
                       $.ajax({
                        url:base_url+'restaurants/orderMenu/',
                        data:'ids='+order,
                        type:'post',
                        success:function(){
                            //
                        }
                       });   
                         
                     }
                });
               
               $('.up_to').live('change',function(){
                //alert('test');
                var $this = $(this); 
                $this.parent().find('.up_to').each(function(){
                    //alert($(this).val());
                    if($(this).is(':checked'))
                    {
                        $(this).addClass('up_to_selected');
                    }
                    else
                    $(this).removeClass('up_to_selected');
                });
                
               }); 
               
               $('.addmenubtn').click(function(){
                var cat_id = $(this).attr('id');
                cat_id = cat_id.replace('itemadd','');
                var menu_item = $('#item'+cat_id+' .menu_item_name').val();
                $('#item'+cat_id+' .menu_item_name').val('');
                var price = $('#item'+cat_id+' .price').val();
                $('#item'+cat_id+' .price').val('');
                var description = $('#item'+cat_id+' .description').val();
                $('#item'+cat_id+' .description').val('');
                if(menu_item == '')
                {
                    alert('Item name can\'t be blank');
                    $('#item'+cat_id+' .menu_item_name').focus();
                    return false;
                }
                
                
                
                
                $.ajax({
                   url:base_url+'restaurants/addMenu',
                   type:'post',
                   data:'cat_id='+cat_id+'&menu_item='+menu_item+'&price='+price+'&description='+description,
                   success:function(res){
                    $('.parent'+cat_id).append('<li id="menu_list_'+res+'" class="infolist infolist2 row"></li>');
                      var bug = 0;          
                    if($('.hasopt'+cat_id).val() == 1)
                    {
                        //alert('test');
                        var y = 0;
                        var len = $('#addopt'+cat_id+' .addopt').length;
                        $('.additems').each(function(){
                                //alert($(this).val());
                                if($(this).val() == '')
                                {
                                    alert('Item name cannot be blank');
                                    $(this).focus();
                                    $.ajax({
                                       url:base_url+'restaurants/removeMenu/'+res 
                                    });
                                    bug = 1;
                                    return false;
                                }
                               
                            });
                            if(bug)
                            return false;
                            
                        $('#addopt'+cat_id+' .addopt').each(function(){
                            y++;
                            var opt_id = $(this).attr('id').replace('addopt_','');
                            var subcat = $('.addsubcat',this).val();
                            var subdes = $('.scd',this).val();
                            var is_required = $('.is_req',this).val();
                            var is_multiple = $('.multi',this).val();
                            var up_to = $('.up_to_selected',this).val();
                            var itemno = $('.itemno',this).val();
                            if(is_required == '1' && is_multiple=='1')
                            {
                                if(itemno=='' || itemno=='0' || isNaN(itemno))
                                {
                                    alert('Invalid number');
                                    $('.itemno',this).focus();
                                    $.ajax({
                                       url:base_url+'restaurants/removeMenu/'+res 
                                    });
                                    return false;
                                    
                                }
                            }
                            
                            var u = 0;
                            var si = '';
                            var sp = '';
                            $this = $(this);
                            
                            $('.additems',$this).each(function(){
                                //alert($(this).val());
                                
                                u++;
                                if(u==1){
                                si = $(this).val();
                                }
                                else{
                                    
                                si = si+','+$(this).val();
                                }
                            });
                           
                            itemno = parseFloat(itemno);
                            if(is_required == '1' && is_multiple=='1')
                            {
                            if(u < Number(itemno))
                            {
                                    alert('Number of items can\'t be smaller than "Exact Number of items"');
                                    $('.itemno',this).focus();
                                    $.ajax({
                                       url:base_url+'restaurants/removeMenu/'+res 
                                    });
                                    return false;
                            }
                            }
                            var v = 0;
                            //opt_id = $(this).attr('id').replace('addopt_','');
                            $('.addprice',$this).each(function(){
                                v++;
                                if(v==1){
                                sp = $(this).val();
                                }
                                else{
                                   
                                sp = sp+','+$(this).val();
                                }
                            });
                           // alert(si);
                            $.ajax({
                               url:base_url+'restaurants/addSubCat',
                               data:'menu='+res+'&subcat='+subcat+'&subdes='+subdes+'&si='+si+'&sp='+sp+'&is_required='+is_required+'&is_multiple='+is_multiple+'&itemno='+itemno+'&up_to='+up_to,
                               type:'post',
                               success:function()
                               {
                                    if(y==len)
                                    {
                                        $('.parent'+cat_id+' li').each(function(){
                                           if($(this).html()=='')
                                           {
                                            
                                            $(this).load(base_url+'restaurants/loadMenu/'+res+'/'+cat_id,function(){
                                                initiate_ajax_upload3('uploadimage'+res);
                                            });    
                                            $('.addmenu').hide();
                                            
                                            
                                           } 
                                        });
                                    }
                               } 
                            });
                            
                        });
                    }
                    else
                    {
                       $('.parent'+cat_id+' li').each(function(){
                                           if($(this).html()=='')
                                           {
                                            
                                            $(this).load(base_url+'restaurants/loadMenu/'+res+'/'+cat_id,function(){
                                                initiate_ajax_upload3('uploadimage'+res);
                                            });    
                                            $('.addmenu').hide();
                                            
                                            
                                           } 
                                        }); 
                    }
                    if(bug==0)
                    alert('Item added successfully!');
                    
                        
            
                   } 
                });
                
                
               });  
                
               $('.addmore').live('click',function(){
                    var id = $(this).attr('id').replace('addmore','');
                    $(this).closest('.addopt').find('.radios').remove();
                    $(this).parent().remove();
                    
                    if($(this).attr('class')=='addmore editmore'){
                    var rand1 = Math.random();
                    var rand2 = Math.random();    
                    var toappend = '<div>'+
                                        '<div class="col-xs-12 col-sm-7"><strong>Item Name</strong><input class="additems" type="text" name="option[]" placeholder="" /></div>'+
                                        '<div class="col-xs-12 col-sm-3"><strong>Price</strong><input class="addprice" type="text" name="option[]" placeholder="" /></div>'+
                                        '<div class="col-xs-12 col-sm-2"><a onclick="$(this).parent().parent().remove();" href="javascript:void(0)" class="addmore btn btn-danger" style="padding: 2px 7px;" >x</a></div>'+
                                        '<div class="clearfix"></div>'+
                                        '</div>'+
                                        '<span id ="action'+id+'"><a href="javascript:void(0)" class="addmore editmore btn btn-warning" id ="addmore'+id+'" >+ Add More</a></span>'+
                                        '<div class="radios">'+
                                            '<strong>These items are:</strong>'+
                                            '<div class="infolist"><input checked="checked" type="radio" name="r2_'+id+'" value="0" class="is_required required_selected" /> <strong>Optional</strong>&nbsp; &nbsp; OR&nbsp; &nbsp; <input type="radio" name="r2_'+id+'" class="is_required" value="1" /> <strong>Required</strong></div>'+
                                            '<strong>Customer can select:</strong>'+
                                            '<div class="infolist"><input checked="checked" type="radio" name="r1_'+id+'" value="0" class="is_multiple multiple_selected" /> <strong>Single</strong>&nbsp; &nbsp; OR&nbsp; &nbsp; <input type="radio" name="r1_'+id+'" class="is_multiple" value="1" /> <strong>Multiple</strong></div>'+                                            
                                            '<div class="infolist exact" style="display: none;"><div><div class="col-xs-12 col-sm-6" style="padding-left:0;"><strong>Enter # of items</strong></div><div class="col-xs-12 col-sm-6"><input name="'+rand1+'" type="radio" value="1" class="up_to up_to_selected" checked="checked"/> Up to &nbsp; <input name="'+rand1+'" type="radio" value="0" class="up_to"/> Exactly</div><div style="clear:both;"></div></div><input type="text" class="itemno"  id="itemno'+id+'" /></div>'+
                                            '<input type="hidden" name="is_multiple" value="0" class="multi" />'+
                                            '<input type="hidden" name="is_required" value="0" class="is_req" />'+
                                        '</div>'; }
                    else
                    var toappend = '<div class="infolist">'+
                                        '<div class="col-xs-12 col-sm-7"><strong>Item Name</strong><input class="additems" type="text" name="option[]" placeholder="" /></div>'+
                                        '<div class="col-xs-12 col-sm-3"><strong>Price</strong><input class="addprice" type="text" name="option[]" placeholder="" /></div>'+
                                        '<div class="col-xs-12 col-sm-2"><a onclick="$(this).parent().parent().remove();" href="javascript:void(0)" class="addmore btn btn-danger" style="padding: 2px 7px;" >x</a></div>'+
                                        '<div class="clearfix"></div>'+
                                        '</div>'+
                                        '<span id ="action'+id+'"><a href="javascript:void(0)" class="addmore btn btn-warning" id ="addmore'+id+'" >+ Add More</a></span>'+
                                        '<div class="radios">'+
                                            '<strong>These items are:</strong>'+
                                            '<div class="infolist"><input checked="checked" type="radio" name="r2_'+id+'" value="0" class="is_required required_selected" /> <strong>Optional</strong>&nbsp; &nbsp; OR&nbsp; &nbsp; <input type="radio" name="r2_'+id+'" class="is_required" value="1" /> <strong>Required</strong></div>'+
                                            '<strong>Customer can select:</strong>'+
                                            '<div class="infolist"><input checked="checked" type="radio" name="r1_'+id+'" value="0" class="is_multiple multiple_selected" /> <strong>Single</strong>&nbsp; &nbsp; OR&nbsp; &nbsp; <input type="radio" name="r1_'+id+'" class="is_multiple" value="1" /> <strong>Multiple</strong></div>'+
                                            '<div class="infolist exact" style="display: none;"><div><div class="col-xs-12 col-sm-6" style="padding-left:0;"><strong>Enter # of items</strong></div><div class="col-xs-12 col-sm-6"><input type="radio" value="1" class="up_to up_to_selected" checked="checked" name="'+rand2+'"/> Up to &nbsp; <input name="'+rand2+'" type="radio" value="0" class="up_to"/> Exactly</div><div style="clear:both;"></div></div><input type="text"  class="itemno" id="itemno'+id+'" /></div>'+
                                            '<input type="hidden" name="is_multiple" value="0" class="multi" />'+
                                            '<input type="hidden" name="is_required" value="0" class="is_req" />'+
                                        '</div>';                                                                                
                    $('#addopt_'+id).append(toappend); 
                    
                        
                
                   
                
               });  
              $('.addmoresub').live('click',function(){
                var id = $(this).attr('id').replace('sub','');
                $(this).remove();
                //alert('test');
                $.ajax({
                    url:base_url+'restaurants/optional/'+id,
                    success:function(res){
                        $('#addopt'+id).append(res);
                        var k =0;
                        
                    }
                })
              });   
                      
            }

            
            
//Script for login
$('.loginbtn').click(function(){
	     
	   var username = $('#username').val();
       var password = $('#password').val();
       if(!username||!password){
       if(username=='')
       {
        $('#usererror').show();
         $('#usererror').text('Username can not be blank');
       }
       if(password=='')
       {
        $('#passerror').show();
        $('#passerror').text('Password can not be blank');
       }}
       else
       {
        $.ajax({
           url:base_url+'restaurants/validate_user/'+username+'/'+password,
           success:function(res)
           {
            if(res=='1')
            $('#loginform').submit();
            else
           {
            $('#formerror').show();
            $('#formerror').text('Invalid Username or Password');
            $('#passerror').hide();
            $('#usererror').hide();
           } 
           }
           
        });
       }
       
       
	});   
    
$('.order_now').change(function(){
    //alert('test');
    if($(this).is(':checked')){
   $('#ordered_on_date').removeAttr('required');
   $('#ordered_on_time').removeAttr('required');
   }
   else
   {
   $('#ordered_on_date').attr('required','');
   $('#ordered_on_time').attr('required','');
   } 
    
});
                
//Script for profile page          
if(path.replace('profile','')!=path){            
         //for google map
          
           
        
        var hashTagActive = "";
        //To reach to the category heading from sidebar
        $(".scrolly").click(function (event) {
            if(hashTagActive != this.hash) { //this will prevent if the user click several times the same link to freeze the scroll.
                event.preventDefault();
                //calculate destination place
                var dest = 0;
                if ($(this.hash).offset().top > $(document).height() - $(window).height()) {
                    dest = $(document).height() - $(window).height();
                } else {
                    dest = $(this.hash).offset().top;
                }
                //go to destination
                $('html,body').animate({
                    scrollTop: dest
                }, 1000, 'swing');
                hashTagActive = this.hash;
            }
        });
                    
            // To make sidebars fixed         
            var $sidebar   = $(".scr-fixed"), 
            $window    = $(window),
            offset     = $sidebar.offset(),
            topPadding = 15,
            $footer = $(".js--page-footer"),
            offset2 = $footer.offset()
            ;
            if($window.width()>600)
            {
                $('.modal-body img').attr('style','max-width:500px;');
            }
            else
            {
                $('.modal-body img').attr('style','max-width:100%;');
            }
        $(window).scroll(function() {
            //alert();
            //alert($window.scrollTop());
            if ($window.scrollTop() > offset.top && $window.width() >= 754) {
                //alert($window.scrollTop());
                $sidebar.css({'position':'fixed','top':'15px','width':$('.sidebar--shop').parent().width()});
                var m=0;
                $('.scr-fixed').each(function(){
                    m++; 
                    if(m==1)
                    $(this).css({'position':'fixed','top':'15px','width':$(this).parent().width()});
                    else
                    $(this).css({'position':'fixed','top':'15px','width':$(this).parent().width()});
                });
                if($window.scrollTop() > (offset2.top - 350))
                $sidebar.removeAttr('style');
            } else {
                $sidebar.removeAttr('style');
            }
        });
        
        //To add items to order list
        var counter_item = 0;
        $('.add_menu_profile').live('click',function(){
            var menu_id = $(this).attr('id').replace('profilemenu','');
            var ids = "";
            var app_title = "";
            var price = "";
            var extratitle="";
            var dbtitle = "";
            var err = 0;
            var catarray = [];
            $('.subitems_'+menu_id).find('input:checkbox, input:radio').each(function(index){
            if($(this).is(':checked') && $(this).attr('title')!="")
            {
                var tit = $(this).attr('title');
                var title = tit.split("_");
                if(index!=0){
                    extratitle =extratitle+","+title[1];
                }
                var su = "";
                
                if($(this).val()!="")
                {
                    var cnn =0;
                    var catid = $(this).attr('id');
                    catarray.push(catid);
                    var is_required = $('#required_'+catid).val();
                    var extra_no = $('#extra_no_'+catid).val();
                    if(extra_no == 0)
                        extra_no = 1;
                    var multiples = $('#multiple_'+catid).val();
                    var upto = $('#upto_'+catid).val();
                    $('.extra-'+catid).each(function(){
                        if($(this).is(":checked"))
                        {
                            cnn++;
                        }
                    });
                    
                    if(is_required=='1')
                    {
                      if(upto == 1)
                        {
                            if(cnn == 0)
                            {   
                                err++;
                                $('#error_'+catid).html("Options are Mandatory");
                            }
                            else
                            if(multiples ==1 && cnn > extra_no)
                            {
    
                                err++;
                                $('#error_'+catid).html("Select up to "+extra_no+" Options");
                            }
                            else
                            {
                                $('#error_'+catid).html("");
                            }
                        }
                     else
                      {
                          if(cnn == 0)
                            {   
                                err++;
                                $('#error_'+catid).html("Options are Mandatory");
                            }
                            else
                            if(multiples ==1 && cnn!= extra_no)
                            {
    
                                err++;
                                $('#error_'+catid).html("Select "+extra_no+" Options");
                            }
                            else
                            {
                                $('#error_'+catid).html("");
                            }
                        }
                    }
                    else
                    {
                        if(upto == 1)
                        {
                            if(multiples ==1 && cnn >0 && cnn > extra_no)
                            {
                                err++;
                                $('#error_'+catid).html("Select up to "+extra_no+" Options");
                            }
                            else
                            {
                               $('#error_'+catid).html(""); 
                            }
                        }
                        else
                        {
                            if(multiples ==1 && cnn >0 && cnn!= extra_no)
                            {
                                err++;
                                $('#error_'+catid).html("Select "+extra_no+" Options");
                            }
                            else
                            {
                               $('#error_'+catid).html(""); 
                            }
                        }
                        
                    }
                    if(cnn>0)
                    {
                        su = $(this).val();
                        extratitle =extratitle+" "+su+":";
                        app_title = app_title+" "+su+":";
                    }                    
                }
                var x = index;
                if(title[0]!="")
                ids = ids+"_"+title[0];
                //if(app_title!="")
                    app_title = app_title+","+title[1];

                //else
                    //app_title = title[1];
                price = Number(price)+Number(title[2]);
                
            }
            });
            ids = ids.replace("__","_");
            
            //app_title =app_title.replace(",,"," ");
            app_title = app_title.split(",,").join("");
            app_title = app_title.substring(1, app_title.length);
            var last = app_title.substring(app_title.length, app_title.length-1);
            if(last == ",")
                app_title = app_title.substring(0, app_title.length-1);
            var last = app_title.substring(app_title.length, app_title.length-1);
            if(last == "-")
                app_title = app_title.substring(0, app_title.length-1);
            app_title = app_title.split("-").join(" -");
            app_title = app_title.split("-,").join("-");
            app_title = app_title.split(",").join(", ");
            app_title = app_title.split(":").join(": ");
            extratitle = extratitle.split(":,").join(":");
            extratitle = extratitle.substring(1, extratitle.length);
            var last1 = extratitle.substring(extratitle.length, extratitle.length-1);
            if(last1 == ",")
                extratitle = extratitle.substring(0, extratitle.length-1);
            var last1 = extratitle.substring(extratitle.length, extratitle.length-1);
            if(last1 == "-")
                extratitle = extratitle.substring(0, extratitle.length-1);
            dbtitle = extratitle.split(",").join("%");
            
            if(err>0)
                return false;
            else
            {
                catarray.forEach(function(catid){
                    $('#error_'+catid).html("");
                })
            }
            
           //alert(ids);
        /*$(this).text('Added');
        $(this).attr('style','background:#DDD');
        $(this).attr('disabled','disabled');
        $(this).removeClass('add_menu_profile');*/
        
      
           
          
        
        //alert("price:"+price+"title:"+app_title);
        var pre_cnt = $('#list'+ids).find('.count').text();
            if(pre_cnt != "")
                pre_cnt = Number(pre_cnt)+Number(1);
            else
                pre_cnt = 1;
            $('#list'+ids).remove();
            $('.orders').prepend('<div id="list'+ids+'" class="infolist" ></div>');
            $('#list'+ids).html('<strong class="namemenu">'+app_title+'</strong>'+
            '<div class="left"><a id="dec'+ids+'" class="decrease small btn btn-danger" href="javascript:void(0);">'+
            '<strong>-</strong></a> &nbsp;<span class="count">'+pre_cnt+'</span><input type="hidden" class="count" name="qtys[]" value="'+pre_cnt+'" />'+
            '<input type="hidden" class="menu_ids" name="menu_ids[]" value="'+menu_id+'" />'+
            '<input type="hidden" name="extras[]" value="'+dbtitle+'"/><input type="hidden" name="listid[]" value="'+ids+'" />'+
            '<input type="hidden" class="prs" name="prs[]" value="'+price.toFixed(2)+'" />X $'+
            '<span class="amount">'+price.toFixed(2)+'</span></div>'+
            '<div class="right">'+
            '<strong>$<span class="total">'+(pre_cnt*price).toFixed(2)+'</span>'+
            '</strong> &nbsp;<a id="inc'+ids+'" class="increase btn btn-blue small " href="javascript:void(0);">'+
            '<strong>+</strong></a></div><div class="clearfix"></div>');
        //$('#list'+menu_id).load(base_url+'restaurants/orderlist/'+menu_id);
        //var price = $('.profileprice'+menu_id).text();
        
        price = parseFloat(price);
        var subtotal= "";
        var ccc =0;
        $('.total').each(function(){
            ccc++;
            subtotal = Number(subtotal)+Number($(this).text());
        })
      if(ccc>3)
         $('.orders').attr('style','display:block;height:260px;overflow-x:hidden;overflow-y:scroll;');
      subtotal = parseFloat(subtotal);
      //subtotal = Number(subtotal)+Number(price);
      subtotal = subtotal.toFixed(2);
      $('span.subtotal').text(subtotal);
      $('input.subtotal').val(subtotal);
      
      var tax = $('#tax').text();
      tax = parseFloat(tax);
      tax = (tax/100)*subtotal;
      tax = tax.toFixed(2);
      $('span.tax').text(tax);
      $('input.tax').val(tax);
      
      var del_fee = $('.df').val();
          del_fee = parseFloat(del_fee);
          
          
          var gtotal = Number(subtotal)+Number(tax)+Number(del_fee);
          gtotal = gtotal.toFixed(2);
 
      $('span.grandtotal').text(gtotal);
      $('input.grandtotal').val(gtotal);
      $('.subitems_'+menu_id).find('input:checkbox, input:radio').each(function(){
        if(!$(this).hasClass('chk'))
            $(this).removeAttr("checked");
      });
     
      $('.close'+menu_id).click();
      
      //$('.subitems_'+menu_id).hide(); 
    });
    
    $('.clearall , .close').click(function(){
        
        var menu = $(this).attr('id');
        menu = menu.replace('clear_','');
        //alert(menu);
        $('.subitems_'+menu).find('input:checkbox, input:radio').each(function(){
            if(!$(this).hasClass('chk'))
                $(this).removeAttr("checked");
      });
        
    });
    $('.decrease').live('click',function(){
	       //alert('test');
	      var menuid = $(this).attr('id');
          var numid = menuid.replace('dec','');
          
          var quant = $('#list'+numid+' span.count').text();
          
          var amount = $('#list'+numid+' .amount').text();
          amount = parseFloat(amount);
          
          var subtotal = "";
          $('.total').each(function(){
            subtotal = Number(subtotal)+Number($(this).text());
        })
          subtotal = parseFloat(subtotal);
          subtotal = Number(subtotal)-Number(amount);
          subtotal = subtotal.toFixed(2);
          $('span.subtotal').text(subtotal);
          $('input.subtotal').val(subtotal);
          
          var tax = $('#tax').text();
          tax = parseFloat(tax);
          tax = (tax/100)*subtotal;
          tax = tax.toFixed(2);
          $('span.tax').text(tax);
          $('input.tax').val(tax);
         
          var del_fee = $('.df').val();
          del_fee = parseFloat(del_fee);
          
          
          var gtotal = Number(subtotal)+Number(tax)+Number(del_fee);
          gtotal = gtotal.toFixed(2);
          $('span.grandtotal').text(gtotal);
          $('input.grandtotal').val(gtotal);
          
          var total = $('#list'+numid+' .total').text();
          total = parseFloat(total);
          total = Number(total) - Number(amount);
          total = total.toFixed(2);
          $('#list'+numid+' .total').text(total);
          
          quant = parseFloat(quant);
          //alert(quant);
          if(quant==1)
          {
            $('#list'+numid).remove();
            $('#profilemenu'+numid).text('Add');
        $('#profilemenu'+numid).attr('style','');
        $('#profilemenu'+numid).addClass('add_menu_profile'); 
        $('#profilemenu'+numid).removeAttr('disabled');
         var ccc=0;
         $('.total').each(function(){
            ccc++;
         });
         if(ccc<4)
           $('.orders').removeAttr('style');
           $('.orders').show();  
          }
          else{
            quant--;
           $('#list'+numid+' span.count').text(quant);
            $('#list'+numid+' input.count').val(quant);
           //$('#list'+numid+' .count').val(quant-1);
           }
	   });
        
    $('.increase').live('click',function(){
            var menuid = $(this).attr('id');
            var numid = menuid.replace('inc','');
            var quant = '';
            quant = $('#list'+numid+' span.count').text();          
            quant = parseFloat(quant);
            var amount = $('#list'+numid+' .amount').text();
            amount = parseFloat(amount);
            var subtotal = $('.subtotal').text();
            subtotal = parseFloat(subtotal);
            subtotal = Number(subtotal)+Number(amount);
            subtotal = subtotal.toFixed(2);
            $('span.subtotal').text(subtotal);
            $('input.subtotal').val(subtotal);
            var tax = $('#tax').text();
            tax = parseFloat(tax);
            tax = (tax/100)*subtotal;
            tax = tax.toFixed(2);
            $('span.tax').text(tax);
            $('input.tax').val(tax);
            var del_fee = $('.df').val();
            del_fee = parseFloat(del_fee);
            var gtotal = Number(subtotal)+Number(tax)+Number(del_fee);          
            gtotal = gtotal.toFixed(2);
            $('span.grandtotal').text(gtotal);
            $('input.grandtotal').val(gtotal);          
            var total = $('#list'+numid+' .total').text();
            total = parseFloat(total);
            total = Number(total)+Number(amount);
            total = total.toFixed(2);
            $('#list'+numid+' .total').text(total);
            quant++;
            $('#list'+numid+' span.count').text(quant);           
            $('#list'+numid+' input.count').val(quant);          
	   });       
}
if(path.replace('dashboard','')!=path){
            $('.removemore').live('click',function(){
                $(this).parent().parent().remove();
               });
            initiate_ajax_upload('uploadbtn');
            initiate_ajax_upload2('image_more');
            $('.timepicker').timepicker();            
            }
            function initiate_ajax_upload(button_id){
                var button = $('#'+button_id), interval;
                new AjaxUpload(button,{
                    action: base_url+"restaurants/upload_img",                      
                    name: 'myfile',
                    onSubmit : function(file, ext){
                        button.text('Uploading');
                        this.disable();
                        interval = window.setInterval(function(){
                            var text = button.text();
                            if (text.length < 13){
                                button.text(text + '.');					
                            } else {
                                button.text('Uploading');				
                            }
                        }, 200);
                    },
                    onComplete: function(file, response){
                        button.text('Change Image');
                            window.clearInterval(interval);
                            this.enable();
                            $("#picture").attr("src",base_url+'images/restaurants/'+response);
                            $(".picture").val(response);
                            }                        		
                    });                
            }
            function initiate_ajax_upload2(button_id){                
                var button = $('#'+button_id), interval;
                new AjaxUpload(button,{
                    action: base_url+"restaurants/upload_img",                      
                    name: 'myfile',
                    onSubmit : function(file, ext){
                        button.text('Uploading');
                        this.disable();
                        interval = window.setInterval(function(){
                            var text = button.text();
                            if (text.length < 13){
                                button.text(text + '.');					
                            } else {
                                button.text('Uploading');				
                            }
                        }, 200);
                    },
                    onComplete: function(file, response){
                        button.text('Add More Images');
                        window.clearInterval(interval);
                        this.enable();
                        $(".image_more").prepend('<div class="col-xs-12 col-sm-3"><img src="'+base_url+'images/restaurants/'+response+'" /><input type="hidden" name="imgs[]" value="'+response+'" /><center><a href="javascript:void(0)" class="btn btn-danger removemore">X</a></center></div>');
                        }                        		
                    });                
            }            
            function initiate_ajax_upload3(button_id){                
                var button = $('#'+button_id), interval;
                var id = button_id.replace('uploadimage','');
                new AjaxUpload(button,{
                    action: base_url+"restaurants/upload_menu_img/"+id,                      
                    name: 'myfile',
                    onSubmit : function(file, ext){
                        button.text('Uploading');
                        this.disable();
                        interval = window.setInterval(function(){
                            var text = button.text();
                            if (text.length < 13){
                                button.text(text + '.');					
                            } else {
                                button.text('Uploading');				
                            }
                        }, 200);
                    },
                    onComplete: function(file, response){
                            //alert(response);
                            button.text('Add Image');
                            window.clearInterval(interval);
                            this.enable();
                            //alert("#img"+id);
                            //$("#img"+id).html('<img src="'+base_url+'images/menus/'+response+'" />');
                            $('#'+button_id).parent().parent().load(base_url+'restaurants/loadMenu/'+id,function(){
                            initiate_ajax_upload3('uploadimage'+id);
                        });
                            }                        		
                    });                
            }
$('.menulisting .tab-content .tab-text').click(function(){
    $('.menulisting .orders').slideToggle();
});
});