<?php
    include_once("subpages/api.php");
    $thisrest = $restaurants[0]["Restaurants"];
?>
<script>


    $(function () {
        $('.modal').on('shown.bs.modal', function () {
            $('input:text:visible:first', this).focus();
        })
        /*
         $('.btnxx').click(function(){

         var id = $(this).children().find('.buttons').attr('id');
         $('#'+id).click();
         });

         $('.inp').change(function(){
         var id = $(this).attr('id').replace('boxes_','');

         var chr = $('.chars_'+id).val();

         var txt = $(this).val().toUpperCase();
         tx = txt.split("");
         ch = chr.split(",");
         nt = txt;
         tx.forEach(function(t)
         {

         if(inArray(t,ch))
         {

         }
         else
         {
         alert('invalid character '+t);
         nt = nt.replace(t,'');
         $('#boxes_'+id).val(nt);

         }
         });

         });*/
        $('.prv_button').hide();
        $('.resetslider').live('click', function () {
            $(this).parent().parent().find('.nxt_button').show();
            $(this).parent().parent().find('.nxt_button').attr('title', '1');
            $(this).parent().parent().find('.prv_button').hide();
            var banner = $(this).parent().parent().parent().find('.bannerz');
            banner.animate({scrollLeft: 0}, 1);
        })
        $('.nxt_button').live('click', function () {

            $(this).attr('disabled', 'disabled');
            var td = Number($(this).attr('title'));
            td++;
            var id = '';
            //var l = $(this).parent().find('.banner'+id+' td').width();
            var banner = $(this).parent().parent().parent().find('.bannerz');
            var l = banner.width();
            var main_width = banner.children('table').width();

            var leftPos = banner.scrollLeft();
            banner.animate({scrollLeft: leftPos + l}, 800, function () {
                $('.nxt_button').removeAttr('disabled');

            });

            var total_td = banner.find('td').length;
            var id = banner.find('td:nth-child(' + td + ')').attr('id').replace('td_', '');
            $('#boxes_' + id).focus();
            $(this).attr('title', td)
            $(this).parent().parent().find('.prv_button').show();
            if (td == total_td) {

                $(this).parent().parent().find('.add_end').show();
                $(this).hide();
            }

        });

        $('.prv_button').click(function () {

            $(this).attr('disabled', 'disabled');
            var thi = $(this);
            var td = Number($(this).parent().find('.nxt_button').attr('title'));
            if (td != 1)
                td = td - 1;
            var id = ''
            var banner = $(this).parent().parent().parent().find('.bannerz');
            var l = banner.width();
            var leftPos = banner.scrollLeft();
            var main_width = banner.children('table').width();
            banner.animate({scrollLeft: leftPos - l}, 800, function () {
                $('.prv_button').removeAttr('disabled');

            });
            var id = banner.find('td:nth-child(' + td + ')').attr('id').replace('td_', '');

            $('#boxes_' + id).focus();
            $(this).parent().find('.nxt_button').attr('title', td);
            if (td == '1')
                $(this).hide();
            $(this).parent().parent().find('.nxt_button').show();

        });
    });
</script>

<style>
    ul {
        list-style: none outside none;
        padding-left: 0;
    }

    .content-slider li {
        background-color: #ed3020;
        text-align: center;
        color: #FFF;
    }

    .content-slider h3 {
        margin: 0;
        padding: 70px 0;
    }

    .demo {
        width: 800px;
    }
</style>
<div class="row">


    <div class="col-md-2 sidehide">


        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <!--i class="fa fa-cogs"--></i>Categories
                </div>
            </div>
            <div class="portlet-body">


                <ul class="ver-inline-menu">

                    <?php

                        if ($res['Combo']) {
                            ?>

                            <li><a href="#combo" class="scrolly"><i class="fa fa-plus"></i> Combo</a></li>
                        <?php
                        }
                    ?>

                    <?php
                        if ($res['MenuCategory']) {
                            foreach ($res['MenuCategory'] as $mc) {

                                ?>
                                <li><a href="#category<?php echo $mc['id']; ?>" class="scrolly">
                                        <i class="fa fa-plus"></i> <?php echo $mc['title']; ?></a></li>

                            <?php
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>


        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <!--i class="fa fa-cogs"--></i>Drop by
                </div>
            </div>
            <div class="portlet-body">
                <div class="row" style=" text-wrap: break-word;padding:10px;">
                    <center>

                        <img style="max-width: 80%;"
                             src="<?php echo $this->webroot; ?>images/logo.png"/>

                        <br> <br>

                        <?php
                        foreach($locations as $location){
                            $location = $location['Locations'];
                            $restaurant = findrestuarant($restaurants, $location['restaurant_id']);
                        ?>

                        <address>
                            <strong><?= $restaurant["name"] . " " . $location["name"]; ?></strong><br>
                            <?= $location["address"] . "<BR>" . $location["city"] . ", " . $location["province"] . " " . $location["postal"] . "<BR>P: " . $location["phone"]; ?>
                        </address>
                        <?php } ?>

                        <address>
                            <strong>Email</strong><br>
                            <a href="mailto:<?= $thisrest["publicemail"]; ?>"><?= $thisrest["publicemail"]; ?></a>
                        </address>
                    </center>

                </div>


            </div>
        </div>


    </div>


    <div class="col-md-7">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box">

            <div class="portlet-title" style="background-color: #D84A38;">
                <div class="caption">
                    Charlie's Online Ordering System
                </div>
            </div>
            <div class="portlet-body" style="background-color:rgba(0,0,0,0.5);">
                <?php
                    if ($closed) {
                        ?>

                        <center><h5 style="color: red;">Sorry we're closed. Please come back <?php echo $back; ?></h5>
                        </center>

                    <?php
                    }
                ?>

                <?php
                    $co_count = 0;
                    if ($res['Combo']) {
                        ?>

                        <h2 style="margin-top:0;">Combos</h2>

                    <?php
                    }

                    foreach ($res['Combo'] as $cat) {
                        $co_count++;
                        $cntr = 0;
                        if ($co_count == 1) {
                            ?>
                            <div class="table-scrollable" style="border:0;">
                            <table class="">
                            <tbody>

                            <tr>
                        <?php } ?>
                        <td>

                            <div class="tiles">
                                <div class="tile image double ">
                                    <div class="tile-body">
                                        <?php
                                            if ($cat['image']) {
                                                ?>

                                                <a role="button" data-toggle="modal"
                                                   href="#Combo<?php echo $cat['id']; ?>"><img
                                                        src="<?php echo $this->webroot; ?>images/menus/<?php echo $cat['image']; ?>"/></a>
                                            <?php
                                            } else {
                                                ?>
                                                <a role="button" data-toggle="modal"
                                                   href="#Combo<?php echo $cat['id']; ?>"><img
                                                        src="<?php echo $this->webroot; ?>profile/assets/admin/pages/media/gallery/image4.jpg"
                                                        alt="" style="width: 100%;height:100%;"></a>
                                            <?php
                                            }

                                        ?>

                                    </div>
                                    <div class="tile-object" id="combo<?php echo $cat['id']; ?>">
                                        <a href="#Combo<?php echo $cat['id']; ?>" role="button" data-toggle="modal"
                                           style="display: block;">
                                            <div class="name">
                                                <?php echo $cat['title']; ?>
                                            </div>
                                            <div class="number">
                                                &nbsp;
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $ks = 0;
                                $combo_counter = 0;
                                $mmm = $mm->find('all', array('conditions' => array('Menu.id in (' . $cat['ids'] . ')')));
                                $qtys = $cat['qtys'];
                                $arr_ids = explode(',', $cat['ids']);
                                $arr_qtys = explode(',', $qtys);
                                foreach ($arr_ids as $k => $v) {
                                    if ($arr_qtys[$k])
                                        $qty[$v] = $arr_qtys[$k];
                                    else {
                                        echo "<h1";
                                        echo $qty[$v] = 1;
                                        echo "</h1>";
                                    }
                                }
                                $menu_count = 0;
                                foreach ($mmm as $kss => $nme) {

                                    for ($ccd = 0; $ccd < $qty[$nme['Menu']['id']]; $ccd++) {

                                        $menu_count++;
                                    }
                                }

                                $cc = 0;
                                foreach ($mmm as $ks => $me) {
                                    $combo_counter++;
                                    $submenuscat = $this->requestAction('restaurants/getMenucat/' . $me['Menu']['id']);
//var_dump($submenuscat);
                                    if ($me['Menu']['price'] == 0 && count($submenuscat) > 0) {

                                        $me['Menu']['price'] = $this->requestAction('restaurants/get_price/' . $me['Menu']['id']);
                                        $me['Menu']['price'] = number_format($me['Menu']['price'], 2);
                                        $pr = $me['Menu']['price'] . "+";
                                    } else {
                                        $pr = number_format($me['Menu']['price'], 2);
                                    }
                                    ?>
                                    <?php
                                    if ($combo_counter == 1) {
                                        ?>

                                        <div class="modal  fade" id="Combo<?php echo $cat['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="Modal<?php echo $me['Menu']['id']; ?>Label" aria-hidden="true">
                                        <input type="hidden" class="combo_price<?php echo $cat['id']; ?>"
                                               value="<?php echo $cat['price']; ?>"/>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                if ($combo_counter == 1)
                                {
                                    ?>
                                    <div class="modal-dialog" style="width: 70%;">
                                    <div class="modal-content ">


                                    <div class="modal-header">
                                        <h3 style="float: left;"><?php echo $cat['title'];?> (<?php echo $cat['price']?>
                                            ) includes :</h3>
                                        <button type="button" class="close close<?php echo $cat['id'];?>"
                                                data-dismiss="modal" aria-hidden="true"
                                                id="clear_<?php echo $cat['id'];?>">x
                                        </button>
                                        <div class="clearfix"></div>
                                        <hr class="divider"/>
                                        <?php
                                            if ($cat['description']) {
                                                ?>

                                                <div class="col-sm-12" style="font-size: 15px;">

                                                    <?php if ($cat['description'] != 'undefined') echo $cat['description']; ?>
                                                </div>
                                                <div class="clearfix"></div>

                                            <?php
                                            }
                                        ?>

                                    </div>
                                <?php
                                }
                                    ?>
                                    <?php
                                if ($combo_counter == 1)
                                {
                                    ?>

                                    <div class="modal-body">
                                    <div class="banner bannerz" style="overflow: hidden;">
                                    <table width="<?php echo 100 * $menu_count;?>%">
                                    <tr class="zxcx">

                                <?php
                                } ?>


                                    <?php
                                    for ($ccd = 0; $ccd < $qty[$me['Menu']['id']]; $ccd++) {
                                        ?>
                                        <td width="<?php echo 100 / $menu_count; ?>%">
                                            <div
                                                style="margin-bottom: 10px;border:1px solid #eee;border-bottom:5px solid #eee;">
                                                <div class="col-sm-6" style="text-align: left;">
                                                    <h3><?php echo $me['Menu']['menu_item']; ?></h3>

                                                    <p><?php if ($me['Menu']['description'] != 'undefined') echo $me['Menu']['description']; ?></p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <!--img src="<?php if ($me['Menu']['image'] && file_exists(APP . "webroot/images/menus/" . $me['Menu']['image'])) {
                                                        echo $this->webroot; ?>images/menus/<?php echo $me['Menu']['image'];
                                                    } else {
                                                        echo $this->webroot . 'images/default.png';
                                                    } ?>"/-->
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="subitems_<?php echo $cat['id']; ?> optionals"
                                                     style="position: static;<?php if (!$submenuscat) { ?>display:none;<?php } ?>border:none;">
                                                    <?php if ($cntr == 0) {
                                                        $cntr++; ?>
                                                        <div style="display:none;"><input type="checkbox" class="chk"
                                                                                          value=""
                                                                                          title="<?php echo $cat['id'] . "_[" . $cat['title'] . "]-_" . $cat['price'] . "_" . ""; ?>"
                                                                                          checked="checked"/></div>
                                                    <?php } ?>
                                                    <div class="clearfix space10"></div>
                                                    <div style="display:none;"><input type="checkbox" class="chk"
                                                                                      value=""
                                                                                      title="<?php echo $me['Menu']['id'] . "_" . $me['Menu']['menu_item'] . "-_0_" . ""; ?>"
                                                                                      checked="checked"
                                                                                      style="display: none;"/></div>
                                                    <?php

                                                        $ch = 0;

                                                        foreach ($submenuscat as $subm) {

                                                            $ch++; ?>

                                                            <div class="infolist col-xs-12"
                                                                 style="border-right: 5px solid #CCC;margin-bottom: 10px;">
                                                                <input type="hidden"
                                                                       class="extra_no_<?php echo $subm['MenuCategory']['id']; ?>"
                                                                       value="<?php echo $subm['MenuCategory']['itemno']; ?>"/>
                                                                <input type="hidden"
                                                                       class="required_<?php echo $subm['MenuCategory']['id']; ?>"
                                                                       value="<?php echo $subm['MenuCategory']['is_required']; ?>"/>
                                                                <input type="hidden"
                                                                       class="multiple_<?php echo $subm['MenuCategory']['id']; ?>"
                                                                       value="<?php echo $subm['MenuCategory']['is_multiple']; ?>"/>
                                                                <input type="hidden"
                                                                       class="upto_<?php echo $subm['MenuCategory']['id']; ?>"
                                                                       value="<?php echo $subm['MenuCategory']['up_to']; ?>"/>

                                                                <div style="display: none;"><input type="checkbox"
                                                                                                   class="chk"
                                                                                                   checked="checked"
                                                                                                   style="display: none;"
                                                                                                   id="<?php echo $subm['MenuCategory']['id']; ?>"
                                                                                                   title="___"
                                                                                                   value="<?php echo $subm['MenuCategory']['title']; ?>"/>
                                                                </div>
                                                                <a href="javascript:void(0);" <?php /*onclick="$($(this).parent().children('div:eq(0)')).toggle('slow'); $('.extra-<?php echo $subm['MenuCategory']['id'];?>').each(function(){$(this).removeAttr('checked');}) "*/
                                                                ?> ><strong><?php echo $subm['MenuCategory']['title']; ?></strong></a> <?php if ($subm['MenuCategory']['description'] && $subm['MenuCategory']['description'] != 'undefined') { ?>:<?php } ?>
                                                                <span><em> <?php echo $subm['MenuCategory']['description']; ?></em></span>
                                                                &nbsp; &nbsp;

<span style="color: #007FC5;">
<?php
    if ($subm['MenuCategory']['up_to'] == 1)
        $upto = "up to ";
    else
        $upto = "exactly ";
    if ($subm['MenuCategory']['is_required'] == '0') {
        if ($subm['MenuCategory']['itemno'] > 0 && $subm['MenuCategory']['is_multiple'] == '1')
            echo "(Select " . $upto . $subm['MenuCategory']['itemno'] . " Items) ";
        echo "(Optional)";

    } elseif ($subm['MenuCategory']['is_required'] == '1') {
        if ($subm['MenuCategory']['itemno'] > 0 && $subm['MenuCategory']['is_multiple'] == '1')
            echo "Select " . $upto . $subm['MenuCategory']['itemno'] . " Items ";

        echo "(Mandatory)";
    }
?></span>
                                                                <br/>
                                                                <span style="color: red; font-weight: bold;"
                                                                      class="error_<?php echo $subm['MenuCategory']['id']; ?>"></span>

                                                                <div>
                                                                    <?php
                                                                        $k = 0;

                                                                        foreach ($subm['Menu'] as $k => $m) {
                                                                            ?>
                                                                            <div class="subin">

                                                                                <?php if ($subm['MenuCategory']['is_multiple'] == '1') { ?>
                                                                                    <div class="col-xs-12 "
                                                                                         style="padding-left:0px;">
                                                                                        <input type="checkbox" value=""
                                                                                               name="extra"
                                                                                               class="extra-<?php echo $subm['MenuCategory']['id']; ?> spanextra_<?php echo $m['id']; ?>"
                                                                                               title="<?php echo $m['id'] . "_" . $m['menu_item'] . "_" . $m['price'] . "_" . $subm['MenuCategory']['title']; ?>"
                                                                                               id="extra_<?php echo $m['id']; ?>"/>&nbsp;&nbsp;<?php if ($m['price']) echo $m['menu_item'] . "  (+ $" . number_format(str_replace('$', '', $m['price']), 2) . ")"; else {
                                                                                            echo $m['menu_item'];
                                                                                        } ?>

                                                                                        <b>
                                                                                            <a href="javascript:void(0);"
                                                                                               class="btn btn-primary"><?php echo $alpha[$k]; ?></a>
                                                                                            &nbsp;&nbsp;&nbsp;&nbsp;<a
                                                                                                href="javascript:;"
                                                                                                class="remspan btn btn-small btn-danger"
                                                                                                id="remspan_<?php echo $m['id']; ?>"
                                                                                                style="padding:0 8px;padding-bottom:3px;text-decoration: none; color: #fff;"
                                                                                                onclick=""><b>-</b></a>
                                            <span
                                                class="span_<?php echo $m['id']; ?> allspan"
                                                id="sprice_<?php echo $m['price']; ?>">&nbsp;1&nbsp;</span>
                                                                                            <a href="javascript:;"
                                                                                               class="addspan btn btn-small btn-info"
                                                                                               id="addspan_<?php echo $m['id']; ?>"
                                                                                               onclick=""
                                                                                               style="padding:0 8px;padding-bottom:3px;text-decoration: none; color: #fff;"><b>+</b></a></b>
                                                                                    </div>
                                                                                <?php } else {
                                                                                    ?>
                                                                                    <div class="col-xs-12 "
                                                                                         style="padding-left:0px;">
                                                                                        <input type="radio" value=""
                                                                                               name="extra_<?php echo $subm['MenuCategory']['id'] . $ccd; ?>"
                                                                                               class="extra-<?php echo $subm['MenuCategory']['id']; ?>"
                                                                                               title="<?php echo $m['id'] . "_" . $m['menu_item'] . "_" . $m['price'] . "_" . $subm['MenuCategory']['title']; ?>"
                                                                                               id="extra_<?php echo $m['id']; ?>"/>&nbsp;&nbsp;<?php if ($m['price']) echo $m['menu_item'] . "  (+ $" . number_format(str_replace('$', '', $m['price']), 2) . ")"; else {
                                                                                            echo $m['menu_item'];
                                                                                        } ?>
                                                                                    </div>
                                                                                <?php
                                                                                } ?>


                                                                                <div class="clearfix"></div>
                                                                            </div>
                                                                        <?php

                                                                        }

                                                                    ?>

                                                                </div>
                                                            </div>
                                                            <?php
                                                            if ($ch % 4 == 0) {
                                                                ?>
                                                                <div class="clearfix"></div>
                                                            <?php
                                                            }
                                                        }
                                                    ?>
                                                    <div class="clearfix"></div>

                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </td>
                                    <?php
                                    }
                                    ?>
                                    <?php

                                if ($combo_counter == count($mmm))
                                {
                                    ?>
                                    </tr>
                                    </table>
                                    </div>

                                    <div class="optionals" style="position: static;">

                                        <div class="col-xs-12" style="line-height:45px;">
                                            <a href="javascript:void(0);"
                                               class="btn btn-info--transition add_combo_profile"
                                               id="profilemenu<?php echo $cat['id'];?>"
                                               style="float: right;margin-left: 10px;">Add</a>&nbsp;
                                            &nbsp;
                                            <a href="javascript:void(0);" class="btn btn-primary--transition  clearall"
                                               id="clear_<?php echo $cat['id'];?>"
                                               style="float: right;margin-left:10px;">Clear</a>&nbsp;
                                            &nbsp;
                                            <button type="button" class="btn btn-danger resetslider"
                                                    id="clear_<?php echo $cat['id'];?>"
                                                    data-dismiss="modal"
                                                    style="opacity: 1; text-shadow:none;margin-left: 10px;float: right;margin-left: 10px;">
                                                Close
                                            </button>
                                            &nbsp;

                                            <?php if ($menu_count > 1) { ?>
                                                <a href="javascript:void(0);" class="nxt_button btn btn-primary"
                                                   title="1" id="<?php echo $me['Menu']['id']; ?>"
                                                   style="float: right;margin-left: 10px;">Next</a>

                                                <a href="javascript:void(0);" class="prv_button btn btn-primary"
                                                   title="1" id="<?php echo $me['Menu']['id']; ?>"
                                                   style="float: right;margin-left: 10px;">Previous</a>


                                            <?php }?>


                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    </div>

                                    </div>

                                    </div>
                                <?php
                                }
                                    ?>
                                    <?php
                                    if ($combo_counter == count($mmm)) {
//echo count($res['Combo']);
                                        ?>



                                        </div>
                                    <?php
                                    }
                                    ?>


                                <?php

                                }
                            ?>
                        </td>

                        <?php if ($co_count == count($res['Combo'])) { ?>
                            </tr>


                            </tbody>
                            </table>
                            </div>
                        <?php }
                    } ?>
                <?php
                    $nco = 0;
                    foreach ($rescat as $cat) {

                        ?>
                        <h1 style="color:white;"
                            id="category<?php echo $cat['MenuCategory']['id']; ?>"><?php echo $cat['MenuCategory']['title']; ?></h1>

                        <div class="table-scrollable" style="border:0;">
                            <table class="">
                                <tbody>
                                <tr>

                                    <?php
                                        $ks = 0;
                                        foreach ($cat['Menu'] as $ks => $me) {
//var_dump($me);
                                            if (!$me['showmenu'])
                                                continue;
                                            $submenuscat = $this->requestAction('restaurants/getMenucat/' . $me['id']);
//var_dump($submenuscat);
                                            if ($me['price'] == 0 && count($submenuscat) > 0) {

                                                $me['price'] = $this->requestAction('restaurants/get_price/' . $me['id']);
                                                $me['price'] = number_format($me['price'], 2);
                                                $pr = $me['price'] . "+";
                                            } else {
                                                $pr = number_format($me['price'], 2);
                                            }
                                            ?>
                                            <td>

                                                <div class="tiles">
                                                    <div class="tile image double ">
                                                        <div class="tile-body">
                                                            <?php if (count($submenuscat) > 0) { ?>
                                                                <a href="#Modal<?php echo $me['id']; ?>" role="button"
                                                                   data-toggle="modal">
                                                                    <img style="width: 100%;height:100%;"
                                                                         class="i menutileimg"
                                                                         src="<?php if ($me['image'] && file_exists(APP . "webroot/images/menus/" . $me['image'])) {
                                                                             echo $this->webroot; ?>images/menus/<?php echo $me['image'];
                                                                         } else {
                                                                             echo $this->webroot . 'profile/assets/admin/pages/media/gallery/image4.jpg';
                                                                         } ?>"/>
                                                                </a>
                                                            <?php } else {
                                                                ?>
                                                                <a href="#Modal<?php echo $me['id']; ?>" role="button"
                                                                   data-toggle="modal">
                                                                    <center><img style="width: 100%;height:100%;"
                                                                                 class="i menutileimg"
                                                                                 src="<?php if ($me['image'] && file_exists(APP . "webroot/images/menus/" . $me['image'])) {
                                                                                     echo $this->webroot; ?>images/menus/<?php echo $me['image'];
                                                                                 } else {
                                                                                     echo $this->webroot . 'profile/assets/admin/pages/media/gallery/image4.jpg';
                                                                                 } ?>"/></center>
                                                                </a>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="tile-object">
                                                            <a href="#Modal<?php echo $me['id']; ?>" role="button"
                                                               data-toggle="modal" style="display: block;">
                                                                <div class="name">
                                                                    <?php echo $me['menu_item'] ?>
                                                                </div>
                                                                <div class="number">
                                                                    $<?php echo $pr; ?>
                                                                </div>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="modal  fade" id="Modal<?php echo $me['id']; ?>"
                                                     tabindex="-1"
                                                     role="dialog" aria-labelledby="Modal<?php echo $me['id']; ?>Label"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog" style="width: 70%;">
                                                        <div class="modal-content ">
                                                            <div class="modal-header">
                                                                <button type="button"
                                                                        class="close close<?php echo $me['id']; ?>"
                                                                        data-dismiss="modal" aria-hidden="true"
                                                                        id="clear_<?php echo $me['id']; ?>">x
                                                                </button>

                                                            </div>
                                                            <div class="modal-body" style="background:#D84A38; font-family:mainfont;">
                                                                <div class="col-sm-6"
                                                                     style="text-align: left;padding:0px;">
                                                                    <h2 style="color:white;"><?php echo $me['menu_item'] . ": $ " . $pr; ?></h2>

                                                                    <p><?php if ($me['description'] != 'undefined') echo $me['description']; ?></p>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <!--img width="150" src="<?php if ($me['image'] && file_exists(APP . "webroot/images/menus/" . $me['image'])) {
                                                                        echo $this->webroot; ?>images/menus/<?php echo $me['image'];
                                                                    } else {
                                                                        echo $this->webroot . 'images/default.png';
                                                                    } ?>" /-->
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <?php
                                                                    $menu_count = 0;
                                                                    foreach ($submenuscat as $key => $subm) {
                                                                        $menu_count++;
                                                                    }
                                                                ?>

                                                                <div
                                                                    class="subitems_<?php echo $me['id']; ?> optionals">
                                                                    <!--<span class="topright"><a href="javascript:void(0)" onclick="$('#Modal<?php echo $me['id']; ?>').toggle();"><strong class="btn btn-danger">x</strong></a></span>-->

                                                                    <div class="clearfix space10"></div>
                                                                    <div style="display:none;"><input type="checkbox"
                                                                                                      class="chk"
                                                                                                      value=""
                                                                                                      title="<?php echo $me['id'] . "_" . $me['menu_item'] . "-_" . $me['price'] . "_" . ""; ?>"
                                                                                                      checked="checked"
                                                                                                      style="display: none;"/>
                                                                    </div>
                                                                    <div class="banner bannerz"
                                                                         style="overflow: hidden;">
                                                                        <table
                                                                            width="<?php echo 100 * $menu_count; ?>%">
                                                                            <tr class="zxcx">
                                                                                <?php
                                                                                    //var_dump($submenuscat);
                                                                                    $ch = 0;
                                                                                    foreach ($submenuscat as $key => $subm) {
                                                                                        $ch++; ?>
                                                                                        <td style="vertical-align: top;" width="<?php echo 100 / $menu_count; ?>%"
                                                                                            id="td_<?php echo $subm['MenuCategory']['id']; ?>">
                                                                                            <input type="hidden"
                                                                                                   id="extra_no_<?php echo $subm['MenuCategory']['id']; ?>"
                                                                                                   value="<?php echo $subm['MenuCategory']['itemno']; ?>"/>
                                                                                            <input type="hidden"
                                                                                                   id="required_<?php echo $subm['MenuCategory']['id']; ?>"
                                                                                                   value="<?php echo $subm['MenuCategory']['is_required']; ?>"/>
                                                                                            <input type="hidden"
                                                                                                   id="multiple_<?php echo $subm['MenuCategory']['id']; ?>"
                                                                                                   value="<?php echo $subm['MenuCategory']['is_multiple']; ?>"/>
                                                                                            <input type="hidden"
                                                                                                   id="upto_<?php echo $subm['MenuCategory']['id']; ?>"
                                                                                                   value="<?php echo $subm['MenuCategory']['up_to']; ?>"/>

                                                                                            <div
                                                                                                class="infolist col-xs-12"
                                                                                                style="">
                                                                                                <h5>Enter the Letter of
                                                                                                    the Item you Wish to
                                                                                                    Order.</h5>
                                                                                                <input type="text"
                                                                                                       value=""
                                                                                                       class="inp"
                                                                                                       id="boxes_<?php echo $subm['MenuCategory']['id']; ?>"
                                                                                                       maxlength="<?php echo ($subm['MenuCategory']['itemno']) ? $subm['MenuCategory']['itemno'] : '1'; ?>"
                                                                                                       style="margin-bottom:20px;text-transform: uppercase; width:200px;PADDING:10PX;font-size: 18px;FONT-WEIGHT:BOLD;border:1px solid #dadada;"/><br/>

                                                                                                <div
                                                                                                    style="display: none;">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="chk"
                                                                                                        checked="checked"
                                                                                                        style="display: none;"
                                                                                                        id="<?php echo $subm['MenuCategory']['id']; ?>"
                                                                                                        title="___"
                                                                                                        value="<?php echo ($key != 0) ? "<br/> " . $subm['MenuCategory']['title'] : $subm['MenuCategory']['title']; ?>"/>
                                                                                                </div>
                                                                                                <a href="javascript:void(0);" <?php /*onclick="$($(this).parent().children('div:eq(0)')).toggle('slow'); $('.extra-<?php echo $subm['MenuCategory']['id'];?>').each(function(){$(this).removeAttr('checked');}) "*/
                                                                                                ?> ><strong><?php echo $subm['MenuCategory']['title']; ?></strong></a> <?php if ($subm['MenuCategory']['description'] && $subm['MenuCategory']['description'] != 'undefined') { ?>:<?php } ?>
                                                                                                <span><em> <?php echo $subm['MenuCategory']['description']; ?></em></span>

                                                                                                <br/>
                                                                                                <span
                                                                                                    style="float: left;">
                                                                                                <?php
                                                                                                    if ($subm['MenuCategory']['up_to'] == 1)
                                                                                                        $upto = "up to ";
                                                                                                    else
                                                                                                        $upto = "exactly ";
                                                                                                    if ($subm['MenuCategory']['is_required'] == '0') {
                                                                                                        if ($subm['MenuCategory']['itemno'] > 0 && $subm['MenuCategory']['is_multiple'] == '1')
                                                                                                            echo "Select " . $upto . $subm['MenuCategory']['itemno'] . " Items ";
                                                                                                        echo "(Optional)";

                                                                                                    } elseif ($subm['MenuCategory']['is_required'] == '1') {
                                                                                                        if ($subm['MenuCategory']['itemno'] > 0 && $subm['MenuCategory']['is_multiple'] == '1')
                                                                                                            echo "Select " . $upto . $subm['MenuCategory']['itemno'] . " Items ";

                                                                                                        echo "(Mandatory)";
                                                                                                    }
                                                                                                ?></span>

                                                                                                <div
                                                                                                    class="clearfix"></div>
                                                                                                <span
                                                                                                    style="color: red; font-weight: bold;"
                                                                                                    class="error_<?php echo $subm['MenuCategory']['id']; ?>"></span>

                                                                                                <div>
                                                                                                    <?php
                                                                                                        $k = 0;
                                                                                                        $char = "";
                                                                                                        $alpha = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
                                                                                                        foreach ($subm['Menu'] as $k => $m) {
                                                                                                            $char .= $alpha[$k] . ",";
//if($k%3 == 0 ){
                                                                                                            ?>
                                                                                                            <div
                                                                                                                class="subin btn default btnxx"
                                                                                                                style="padding: 0px;border-radius: 17px 0 0 17px !important;">
                                                                                                                <?php //}
                                                                                                                ?>
                                                                                                                <?php if ($subm['MenuCategory']['is_multiple'] == '1') { ?>
                                                                                                                    <div
                                                                                                                        class="col-xs-12 "
                                                                                                                        style="padding:0px; ">

                                                                                                                        <a href="javascript:void(0);"
                                                                                                                           class="buttons"
                                                                                                                           id="buttons_<?php echo $m['id']; ?>"
                                                                                                                           title="<?php echo $alpha[$k]; ?>"
                                                                                                                           style="text-decoration: none; display:inline-block; padding-right: 15px;">
                                                                                                                            <button
                                                                                                                                class="btn btn-primary" style="border-radius: 17px!important;"><?php echo $alpha[$k]; ?></button>
                                                                                                                            <input
                                                                                                                                type="checkbox"
                                                                                                                                value=""
                                                                                                                                name="extra"
                                                                                                                                style="display:none;"
                                                                                                                                class="extra-<?php echo $subm['MenuCategory']['id']; ?> spanextra_<?php echo $m['id']; ?>"
                                                                                                                                title="<?php echo $m['id'] . "_<br/>(" . $alpha[$k] . ") " . $m['menu_item'] ."_" . $m['price'] . "_" . $subm['MenuCategory']['title']; ?>"
                                                                                                                                id="extra_<?php echo $m['id']; ?>"/>
                                                                                                                            &nbsp;&nbsp;<?php if ($m['price']) echo $m['menu_item'] . "  (+ $" . number_format(str_replace('$', '', $m['price']), 2) . ")"; else {
                                                                                                                                echo $m['menu_item'];
                                                                                                                            } ?>

                                                                                                                            <b style="display:none;">
                                                                                                                                <a href="javascript:;"
                                                                                                                                   class="remspan"
                                                                                                                                   id="remspan_<?php echo $m['id']; ?>"
                                                                                                                                   style="text-decoration: none; color: #000;"
                                                                                                                                   onclick=""><b>
                                                                                                                                        &nbsp;&nbsp;-&nbsp;&nbsp;</b></a>
                                                                                                                                <span
                                                                                                                                    class="span_<?php echo $m['id']; ?> allspan"
                                                                                                                                    id="sprice_<?php echo $m['price']; ?>">&nbsp;&nbsp;1&nbsp;&nbsp;</span>
                                                                                                                                <a href="javascript:;"
                                                                                                                                   class="addspan"
                                                                                                                                   id="addspan_<?php echo $m['id']; ?>"
                                                                                                                                   onclick=""
                                                                                                                                   style="text-decoration: none; color: #000;"><b>
                                                                                                                                        &nbsp;&nbsp;+&nbsp;&nbsp;</b></a>
                                                                                                                            </b></a>
                                                                                                                    </div>
                                                                                                                <?php } else {
                                                                                                                    ?>
                                                                                                                    <div
                                                                                                                        class="col-xs-12 "
                                                                                                                        style="padding:0px;border-radius: 17px 0 0 17px !important;">
                                                                                                                        <a href="javascript:void(0);"
                                                                                                                           class="buttons "
                                                                                                                           id="buttons_<?php echo $m['id']; ?>"
                                                                                                                           title="<?php echo $alpha[$k]; ?>"
                                                                                                                           style="text-decoration: none;display:inline-block; padding-right: 15px;">
                                                                                                                            <button
                                                                                                                                class="btn btn-primary" style="border-radius: 17px!important;"><?php echo $alpha[$k]; ?></button>
                                                                                                                            <input
                                                                                                                                type="radio"
                                                                                                                                style="display: none;"
                                                                                                                                value=""
                                                                                                                                name="extra_<?php echo $subm['MenuCategory']['id']; ?>"
                                                                                                                                class="extra-<?php echo $subm['MenuCategory']['id']; ?>"
                                                                                                                                title="<?php echo $m['id'] . "_<br/>(" . $alpha[$k] . ") ". $m['menu_item'] ."_" . $m['price'] . "_" . $subm['MenuCategory']['title']; ?>"
                                                                                                                                id="extra_<?php echo $m['id']; ?>"/>
                                                                                                                            &nbsp;&nbsp;<?php if ($m['price']) echo $m['menu_item'] . "  (+ $" . number_format(str_replace('$', '', $m['price']), 2) . ")"; else {
                                                                                                                                echo $m['menu_item'];
                                                                                                                            } ?>
                                                                                                                            <b style="display:none;">
                                                                                                                                <a href="javascript:;"
                                                                                                                                   class="remspan"
                                                                                                                                   id="remspan_<?php echo $m['id']; ?>"
                                                                                                                                   style="text-decoration: none; color: #000;"
                                                                                                                                   onclick=""><b>
                                                                                                                                        &nbsp;&nbsp;-&nbsp;&nbsp;</b></a>
                                                                                                                                <span
                                                                                                                                    class="span_<?php echo $m['id']; ?> allspan"
                                                                                                                                    id="sprice_<?php echo $m['price']; ?>">&nbsp;&nbsp;1&nbsp;&nbsp;</span>
                                                                                                                                <a href="javascript:;"
                                                                                                                                   class="addspan"
                                                                                                                                   id="addspan_<?php echo $m['id']; ?>"
                                                                                                                                   onclick=""
                                                                                                                                   style="text-decoration: none; color: #000;"><b>
                                                                                                                                        &nbsp;&nbsp;+&nbsp;&nbsp;</b></a>
                                                                                                                            </b>
                                                                                                                        </a>
                                                                                                                    </div>
                                                                                                                <?php
                                                                                                                } ?>
                                                                                                                <div
                                                                                                                    class="clearfix"></div>
                                                                                                            </div>
                                                                                                        <?php
                                                                                                        }
                                                                                                    ?>
                                                                                                    <input type="hidden"
                                                                                                           class="chars_<?php echo $subm['MenuCategory']['id']; ?>"
                                                                                                           value="<?php echo $char; ?>"/>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                    <?php

                                                                                    }
                                                                                ?>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="col-xs-12" style="line-height:45px;">


                                                                        <a href="javascript:void(0);"
                                                                           class="btn btn-primary add_menu_profile add_end"
                                                                           id="profilemenu<?php echo $me['id']; ?>"
                                                                           style="float: right;margin-left: 10px; <?php if ($menu_count > 1) echo "display:none"; ?>">SUBMIT</a>

                                                                        <?php if (count($submenuscat) > 0) { ?>&nbsp;<a
                                                                            href="javascript:void(0);"
                                                                            class="btn btn-warning  clearall"
                                                                            id="clear_<?php echo $me['id']; ?>"
                                                                            style="float: right;margin-left:10px;">Clear</a>&nbsp;<?php } ?>
                                                                        &nbsp;
                                                                        <button type="button"
                                                                                class="btn btn-danger resetslider"
                                                                                data-dismiss="modal"
                                                                                style="opacity: 1; text-shadow:none;margin-left: 10px;float: right;margin-left: 10px;">
                                                                            Close
                                                                        </button>
                                                                        &nbsp;



                                                                        <?php if ($menu_count > 1) { ?>

                                                                            <a style="float: right;"
                                                                               href="javascript:void(0);"
                                                                               class="nxt_button btn btn-primary"
                                                                               title="1">Next</a>
                                                                            <a style="float: right;margin-right:10px;"
                                                                               href="javascript:void(0);"
                                                                               class="prv_button btn btn-primary"
                                                                               title="1">Previous</a>
                                                                        <?php } ?>
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                            </td>

                                        <?php } ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    Receipt
                </div>

            </div>
            <div class="portlet-body">
                <form
                    action="<?php echo $this->webroot; ?>restaurants/order/<?php echo $res['Restaurant']['id']; ?><?php if ($order) { ?>/<?php echo $order['Reservation']['id'];
                    } ?>" method="post"
                    onsubmit="if($('input.subtotal').val()=='0.00'){$('.error_order').show(function(){$('.error_order').fadeOut(5000);});return false;}else if( (Number($('input.subtotal').val()) < Number(<?php echo $res['Restaurant']['min_delivery']; ?>) ) && $('input[name=order_type]:checked').val()== 'delivery' ){ $('.error_delivery').show(function(){$('.error_delivery').fadeOut(5000);});return false;}">
                    <?php
                        if ($order) {
                            $menu_ids = $order['Reservation']['menu_ids'];
                            $qtys = $order['Reservation']['qtys'];
                            $arr_m = explode(',', $menu_ids);
                            $arr_qty = explode(',', $qtys);
                            $arr_extras = explode(',', $order['Reservation']['extras']);
                            $list_ids = explode(',', $order['Reservation']['listid']);
                            $prices = explode(',', $order['Reservation']['prs']);
                            $order_type = $order['Reservation']['order_type'];
                            $city = $order['Reservation']['city_receipt'];
                        } else{
                            $city = 'Hamilton';
                            $order_type = 'Pickup';
                            }
                        //var_dump($list_ids);
                    ?>

                    <div class="table-scrollable" style="border:0;">

                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 55%;">
                                    Item/Qty/Price
                                </th>
                                <th>

                                </th>
                                <th>

                                </th>
                            </tr>
                            </thead>
                        </table>
                        <table id="clearorder" class="orders table">
                            <?php
                                if ($order) {

                                    foreach ($arr_m as $k => $me) {
                                        $menu = $menus->findById($me);
                                        $x = str_replace(array("% ", ':'), array(" ", ': '), $arr_extras[$k]);
                                        $x = str_replace("%", ",", $x);
                                        if (is_numeric($me)) {
                                            $m = $menus->findById($me);
                                            $tt = $m['Menu']['menu_item'];
                                        } else {
                                            $m = $combo1->findById(str_replace("C_", " ", $me));
                                            $tt = $m['Combo']['title'];
                                        }
                                        ?>
                                        <tr id="list<?php echo $list_ids[$k]; ?>" class="infolist" style="padding: 0;">
                                            <td style="padding: 0;"><strong
                                                    class="namemenu"><?php echo str_replace(":", ": ", $tt) . " " . $x; ?></strong>
                                            </td>
                                            <td>


                                                <a id="dec<?php echo $list_ids[$k]; ?>"
                                                   class="decrease small btn btn-danger" href="javascript:void(0);"
                                                   style="padding: 6px;height: 20px;line-height: 6px">
                                                    <strong>-</strong></a><span
                                                    class="count"><?php echo $arr_qty[$k]; ?></span><a
                                                    id="inc<?php echo $list_ids[$k]; ?>"
                                                    class="increase btn btn-blue small " href="javascript:void(0);"
                                                    style="padding: 6px;height: 20px;line-height: 6px"><strong>+</strong></a>


                                                <input type="hidden" class="count" name="qtys[]"
                                                       value="<?php echo $arr_qty[$k]; ?>"/>
                                                <input type="hidden" class="menu_ids" name="menu_ids[]"
                                                       value="<?php echo $me; ?>"/>
                                                <input type="hidden" name="extras[]"
                                                       value="<?php echo $arr_extras[$k]; ?>"/>
                                                <input type="hidden" name="listid[]"
                                                       value="<?php echo $list_ids[$k]; ?>"/>
                                                <input type="hidden" class="prs" name="prs[]"
                                                       value="<?php echo str_replace('$', '', $prices[$k]); ?>"/>
                                                x $<span
                                                    class="amount"><?php echo number_format(str_replace('$', '', $prices[$k]), 2); ?></span>
                                            </td>
                                            <td>
                                                <strong>
                                                    $                                                    <span
                                                        class="total"><?php echo number_format((str_replace('$', '', $prices[$k]) * $arr_qty[$k]), 2); ?></span>
                                                </strong>

                                            </td>

                                        </tr>
                                    <?php
                                    }
                                }
                            ?>


                        </table>
                    </div>


                    <ul class="listnone">
                        <li class="active">
                            <LABEL>
                            <input type="radio"
                                   name="order_type" <?php if ($order_type == 'Pickup') echo "checked='checked'"; ?>
                                   value="Pickup"
                                   onchange="if($(this).is(':checked')){$('.df').val('0');$('#df').hide(); var tax = $('.tax').text();var grandtotal = 0; var subtotal = $('.subtotal').text(); grandtotal = Number(grandtotal)+Number(tax)+Number(subtotal);  $('.grandtotal').text(grandtotal.toFixed(2));$('.grandtotal').val(grandtotal.toFixed(2)); }"/>
                            Pickup
                            </LABEL>
                        </li>
                        <li class="">
                            <LABEL>
                            <input type="radio" <?php if ($order_type == 'delivery') echo "checked='checked'"; ?>
                                   name="order_type" value="delivery"
                                   onchange="if($(this).is(':checked')){$('#df').show(); var df ='<?php echo number_format(str_replace('$', '', $res['Restaurant']['delivery_fee']), '2'); ?>'; var tax = $('.tax').text(); var grandtotal = 0;var subtotal = $('.subtotal').text();  grandtotal = Number(grandtotal)+Number(df)+Number(subtotal)+Number(tax);  $('.df').val(df);$('.grandtotal').text(grandtotal.toFixed(2));$('.grandtotal').val(grandtotal.toFixed(2)); }"/>
                            For Delivery
                            </LABEL>
                        </li>

                    </ul>
                    
                    <ul class="listnone">

                        <?php
                        $class="active";
                        foreach($locations as $location){
                            $location = $location['Locations'];
                            $restaurant = findrestuarant($restaurants, $location['restaurant_id']);
                        ?>
                            <li class="<?= $class; ?>">
                                <LABEL>
                                    <input type="radio"
                                           name="city_receipt" <?php if ($city == $location["city"]) echo "checked='checked'"; ?>
                                           value="<?= $location["city"]; ?>"/>
                                    <?= $location["name"]; ?>
                                </LABEL>
                            </li>
                        <?php
                            $class="";
                        } ?>

                    </ul>

                    <div class="invoice-block">
                        <div class="totals">
                            <TABLE>
                                <TR>
                                    <TD><strong>Subtotal&nbsp;</strong>:</TD><TD>&nbsp;$<span class="subtotal"><?php if ($order) {
                                            echo $order['Reservation']['subtotal'];
                                        } else { ?>0.00<?php } ?></span>
                                    <input type="hidden" value="<?php if ($order) {
                                        echo $order['Reservation']['subtotal'];
                                    } else { ?>0.00<?php } ?>" class="subtotal" name="subtotal"/></TD>
                                </TR>
                                <TR>
                                    <TD><strong>Tax&nbsp;</strong>:</TD><TD>&nbsp;$<span class="tax"><?php if ($order) {
                                            echo $order['Reservation']['tax'];
                                        } else { ?>0.00<?php } ?></span>&nbsp;(<span
                                        id="tax"><?php echo str_replace('$', '', $res['Restaurant']['tax']); ?></span>%)
                                    <input type="hidden" class="tax" name="tax" value="<?php if ($order) {
                                        echo $order['Reservation']['tax'];
                                    } else { ?>0.00<?php } ?>"/></TD>
                                </TR>

                                <TR id="df" style="display: none;">
                                    <TD><strong>Delivery
                                        Fee&nbsp;</strong>:</TD><TD>&nbsp;$<?php echo number_format(str_replace('$', '', $res['Restaurant']['delivery_fee']), 2); ?>
                                    <input type="hidden" name="delivery_fee" class="df"
                                           value="<?php if ($order) echo str_replace('$', '', $res['Restaurant']['delivery_fee']); else echo "0.00"; ?>"/>
                                    </TD>
                                </TR>
                                <TR>
                                    <TD><strong>Total</strong>&nbsp;:</TD><TD>&nbsp;$<span class="grandtotal"><?php if ($order) {
                                            echo $order['Reservation']['g_total'];
                                        } else {
                                            echo "0.00";
                                        } ?></span>
                                    <input type="hidden" value="<?php if ($order) {
                                        echo $order['Reservation']['g_total'];
                                    } else {
                                        echo '0.00';
                                    } ?>" class="grandtotal" name="g_total"/></TD>
                                </TR>
                            </TABLE>
                        </div>
                        <div class="submits" align="center">


                            <input <?php if ($closed){ ?>disabled="disabled"<?php } ?> type="submit" style="width: 48%"
                                   value="Order" class="btn btn-lg red  hidden-print margin-bottom-5"/>

                            <a class="btn btn-sm grey hidden-print margin-bottom-5" style="width: 48%" href="" onclick="return confirm('Are you sure you want to erase your order?');">
                                Restart
                            </a>


                        </div>
                        <div class="clearfix"></div>
                        <div class="error_order" style="display: none;margin-top:5px;color:red;">Order can't be blank
                        </div>
                        <div class="error_delivery" style="display: none;margin-top:5px;color:red;">Minimum amount for
                            delivery is $<?php echo $res['Restaurant']['min_delivery']; ?> </div>
                    </div>
            </div>


            <!-- END BORDERED TABLE PORTLET-->
        </div>


        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Share with love
                </div>

            </div>
            <div class="portlet-body">

                <span class='st_googleplus_large' displayText='GooglePlus'></span>
                <span class='st_whatsapp_large' displayText='WhatsApp'></span>
                <span class='st_facebook_large' displayText='Facebook'></span>
                <span class='st_twitter_large' displayText='Tweet'></span>
                <span class='st_linkedin_large' displayText='LinkedIn'></span>
                <span class='st_blogger_large' displayText='Blogger'></span>
                <span class='st_delicious_large' displayText='Delicious'></span>
                <span class='st_pinterest_large' displayText='Pinterest'></span>
                <span class='st_email_large' displayText='Email'></span>


            </div>
        </div>


        <!-- END PAGE CONTENT-->
    </div>
</div>
