<?php
    include_once("subpages/api.php");
    $restaurantID = get("rest", 0);
    if (!isset($restaurants[$restaurantID])){$restaurantID=0;}
    $thisrest = $restaurants[$restaurantID]["Restaurants"];


    //$test =$this->requestAction('/pages/getLocations');
?>

<div class="row centerall">
    <div class="col-xs-12">
        <div style="transform:skew(-20deg); background:#007FC5;padding:15px 45px;display: inline-block;">
            <h1 class="center" style="color:white;margin:0px;transform:skew(20deg); "><span class="light">Contact</span>
                <?= $thisrest["name"]; ?></h1>
        </div>
    </div>
</div>
<STYLE>
    .tdto{
        width:20px;
        align:center;
    }
</STYLE>

<div class="container  push-down-30" style=" padding:20px; opacity: 1;
    filter: alpha(opacity=9);">
    <div class="row">
        <div class="col-xs-12">


            <div class="text-shrink">
                <p class="text-highlight">We want to hear from you! Feel free to provide us with suggestions and
                    feedback.</p>
            </div>
            <hr class="divider  divider-about">
            <div class="push-down-30"></div>


            <div class="col-sm-3  push-down-30">
                <div class="row">


                    <img alt="Logo" src="<?php echo $this->webroot; ?>images/logo.png" style="">

                    <div class="clearfix"><p></p></div>
                    <span class="glyphicon glyphicon-earphone"></span>
                    <span class="text-dark">(905) 388-9888</span><br>
                    <span class="glyphicon  glyphicon-envelope"></span>
                    <a class="secondary-link" href="mailto:<?= $thisrest["publicemail"]; ?>"><strong><?= $thisrest["publicemail"]; ?></strong></a>

                    <h2 class=""><span class="light">Hours</span></h2>
                    <?php
                        $hours = array('Restaurant' => $thisrest); //$this->requestAction('/pages/getHours');
                    ?>
                    <TABLE>
                    <TR><TD>Sunday : </TD><TD><strong><strong><?php get_formated_date2($hours['Restaurant']['sunday_from']); ?>
                            </strong></TD><TD class="tdto" align="center"><strong>to</strong></TD><TD><strong><?php get_formated_date2($hours['Restaurant']['sunday_to']); ?></strong></TR>

                    <TD>Monday : <TD><strong><?php get_formated_date2($hours['Restaurant']['monday_from']); ?>
                            </strong></TD><TD class="tdto" align="center"><strong>to</strong></TD><TD><strong><?php get_formated_date2($hours['Restaurant']['monday_to']); ?></strong></strong></TD></TR>

                    <TD>Tuesday : <TD><strong><strong><?php get_formated_date2($hours['Restaurant']['tuesday_from']); ?>
                            </strong></TD><TD class="tdto" align="center"><strong>to</strong></TD><TD><strong><?php get_formated_date2($hours['Restaurant']['tuesday_to']); ?></strong></strong></TD></TR>

                    <TD>Wednesday : <TD><strong><strong><?php get_formated_date2($hours['Restaurant']['wednesday_from']); ?>
                            </strong></TD><TD class="tdto" align="center"><strong>to</strong></TD><TD><strong><?php get_formated_date2($hours['Restaurant']['wednesday_to']); ?></strong></strong></TD></TR>

                    <TD>Thursday : <TD><strong><strong><?php get_formated_date2($hours['Restaurant']['thursday_from']); ?>
                            </strong></TD><TD class="tdto" align="center"><strong>to</strong></TD><TD><strong><?php get_formated_date2($hours['Restaurant']['thursday_to']); ?></strong></strong></TD></TR>

                    <TD>Friday : <TD><strong><strong><?php get_formated_date2($hours['Restaurant']['friday_from']); ?>
                            </strong></TD><TD class="tdto" align="center"><strong>to</strong></TD><TD><strong><?php get_formated_date2($hours['Restaurant']['friday_to']); ?></strong></strong></TD></TR>

                    <TD>Saturday : <TD><strong><strong><?php get_formated_date2($hours['Restaurant']['saturday_from']); ?>
                            </strong></TD><TD class="tdto" align="center"><strong>to</strong></TD><TD><strong><?php get_formated_date2($hours['Restaurant']['saturday_to']); ?></strong></strong></TD></TR>
                    </TABLE>
                </div>
            </div>


            <div class=" col-sm-9" style="border: 1px solid #f8f8f8;padding-top:15px;">
                <form method="post" action="" validate>
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <div class="form-group">
                                <label class="text-dark" for="name">Name <span class="warning">*</span></label>
                                <input name="name" type="text" id="name" class="form-control  form-control--contact"
                                       required>
                            </div>
                            <div class="form-group">
                                <label class="text-dark" for="email">E-mail <span class="warning">*</span></label>
                                <input name="email" type="text" id="email"
                                       class="form-control  form-control--contact" required>
                            </div>
                            <div class="form-group">
                                <label class="text-dark" for="subject">Subject <span
                                        class="warning">*</span></label>
                                <input name="subject" type="text" id="subject"
                                       class="form-control  form-control--contact" required>
                            </div>
                                <span class="hidden-xs">Fields marked with <span
                                        class="warning">*</span> are required</span>
                        </div>
                        <div class="col-xs-12  col-sm-8">
                            <div class="form-group">
                                <label class="text-dark" for="message">Message <span
                                        class="warning">*</span></label>
                                    <textarea name="message"
                                              class="form-control  form-control--contact  form-control--big"
                                              id="message" rows="12" style="height:100%;" required></textarea>
                            </div>
                            <div class="right">
                                <button type="submit" class="btn blue">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>

                <hr class="divider divider-about"><center>
                <h2 class="no-margin">Locations</h2><br/>
                </center>
<?php
    foreach($locations as $location){
        $location = $location['Locations'];
        $restaurant = findrestuarant($restaurants, $location['restaurant_id']);
?>
                <div class="col-md-6 ">
                    <!-- BEGIN SAMPLE TABLE PORTLET-->
                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-spoon"></i><?= $restaurant["name"] . " " . $location["name"]; ?>
                            </div>
                            <div class="tools">

                            </div>
                        </div>
                        <div class="portlet-body">
                            <address>
                                <?= $location["address"] . "<BR>" . $location["city"] . ", " . $location["province"] . " " . $location["postal"] . "<BR>" . $location["phone"]; ?>
                            </address>

                        </div>
                    </div>
                    <!-- END SAMPLE TABLE PORTLET-->
                </div>
<?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
    function get_formated_date2($to_format) {
        $arr_hours = explode(':', $to_format);
        if ($arr_hours[0] > 11) {
            if ($arr_hours[0] == 12) {
                echo $arr_hours[0] . ':' . $arr_hours[1] . ' PM';
            } else {
                if ($arr_hours[0] < 22) {echo "0";}
                echo ($arr_hours[0] - 12) . ':' . $arr_hours[1] . ' PM';
            }
        } else {
            if ($arr_hours[0] == 00) {
                echo '12' . ':' . $arr_hours[1] . ' AM';
            } else {
                echo $arr_hours[0] . ':' . $arr_hours[1] . ' AM';
            }
        }
    }

?>
