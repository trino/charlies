<?php

class RestaurantsController extends AppController
{
    var $components = array('CustomMail');
    function test($slug, $order = 0)
    {
        // 	date_default_timezone_set('Canada/Eastern');

        //$this->layout = 'order';
        $time = date('His');
        $day = date('l');
        $day = strtolower($day);
        $day_arr = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'Sunday');

        $q = $this->Restaurant->findBySlug($slug);


        $datetime = new DateTime('tomorrow');
        $tomorrow = $datetime->format('Y-m-d');
        $current = date('YmdHis');

        $from1 = $q['Restaurant'][$day . '_from'];
        $from = str_replace(':', '', $from1);
        $to1 = $q['Restaurant'][$day . '_to'];
        $to = str_replace(':', '', $to1);
        if ($from > $to) {
            $to_check = $tomorrow . ' ' . $q['Restaurant'][$day . '_to'];
        } else {
            $to_check = date('Y-m-d') . ' ' . $q['Restaurant'][$day . '_to'];
        }
        $from_check = date('Y-m-d') . ' ' . $q['Restaurant'][$day . '_from'];
        $to_check = str_replace(array(':',' ', '-'), array('', '',''), $to_check);


        $from_check = str_replace(array(':', ' ', '-'), array('', '',''), $from_check);

        if ($current >= $from_check && $current <= $to_check) {
            $this->set('closed', 0);
        } else {
            $this->set('closed', 1);
            if ($from >= $time) {
                $date_format_from = new DateTime($from1);
                $from1 = $date_format_from->format('h:i A');
                $date_format_to = new DateTime($to1);
                $to1 = $date_format_to->format('h:i A');
                $this->set('back', 'tomorrow during ' . $from1 . ' - ' . $to1);
                $this->set('back', 'during ' . $from1 . ' - ' . $to1);
            } else {
                $index = array_search($day, $day_arr);
                $index = strtolower($index);
                $index++;
                $to1 = $q['Restaurant'][$day_arr[$index] . '_to'];
                $from1 = $q['Restaurant'][$day_arr[$index] . '_from'];
                $date_format_from = new DateTime($from1);
                $from1 = $date_format_from->format('h:i A');
                $date_format_to = new DateTime($to1);
                $to1 = $date_format_to->format('h:i A');
                $this->set('back', 'tomorrow during ' . $from1 . ' - ' . $to1);
            }
        }
        /*if($from<=$time && $to >= $time)
        {
            $this->set('closed',0);
        }
        else
        {
            $this->set('closed',1);
            if($from>=$time)
            {
                $date_format_from = new DateTime($from1);
                $from1= $date_format_from->format('h:i A');
                $date_format_to = new DateTime($to1);
                $to1= $date_format_to->format('h:i A');
                $this->set('back','tomorrow during '.$from1.' - '.$to1);
                $this->set('back','during '.$from1.' - '.$to1);
            }
            else
            {
                $index = array_search($day,$day_arr);
                $index = strtolower($index);
                $index++;
                $to1 = $q['Restaurant'][$day_arr[$index].'_to'];
                $from1 = $q['Restaurant'][$day_arr[$index].'_from'];
                $date_format_from = new DateTime($from1);
                $from1= $date_format_from->format('h:i A');
                $date_format_to = new DateTime($to1);
                $to1= $date_format_to->format('h:i A');
                $this->set('back','tomorrow during '.$from1.' - '.$to1);
            }
        }*/
        $this->loadModel('MenuCategory');
        $this->loadModel('Reservation');
        $this->loadModel('Menu');

        $this->set('title', $q['Restaurant']['name']);
        $this->set('description', $q['Restaurant']['description']);
        $this->set('keyword', $q['Restaurant']['name'] . ' , ' . $q['Restaurant']['street'] . ' , ' . $q['Restaurant']['city'] . ' , ' . $q['Restaurant']['prov_state'] . ' , ' . $q['Restaurant']['cuisine'] . ' , ' . $q['Restaurant']['phone'] . ' , Charlies Chopsticks, Food Ordering , Online Food , Order Food , Restaurant');
        $q2 = $this->MenuCategory->find('all', array('conditions' => array('res_id' => $q['Restaurant']['id'], 'menu_parent' => 0), 'order' => 'order ASC'));
        if ($order) {
            $this->loadModel("Combo");
            $this->set("combo1", $this->Combo);
            $this->set('order', $this->Reservation->findById($order));
            $this->set('menus', $this->Menu);
        } else
            $this->set('order', false);
        $this->set('mm', $this->Menu);
        $this->set('res', $q);
        $this->set('rescat', $q2);
        $this->set('displaybackground', '1');

        $this->loadMOdel('Locations');
        $this->loadMOdel('Restaurants');
        $this->set('locations', $this->Locations->find('all'));
        $this->set('restaurants', $this->Restaurants->find('all'));
    }

    function profile($slug, $order = 0)
    {
        // 	date_default_timezone_set('Canada/Eastern');


        $time = date('His');
        $day = date('l');
        $day = strtolower($day);
        $day_arr = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'Sunday');

        $q = $this->Restaurant->findBySlug($slug);


        $datetime = new DateTime('tomorrow');
        $tomorrow = $datetime->format('Y-m-d');
        $current = date('YmdHis');

        $from1 = $q['Restaurant'][$day . '_from'];
        $from = str_replace(':', '', $from1);
        $to1 = $q['Restaurant'][$day . '_to'];
        $to = str_replace(':', '', $to1);
        if ($from > $to) {
            $to_check = $tomorrow . ' ' . $q['Restaurant'][$day . '_to'];
        } else {
            $to_check = date('Y-m-d') . ' ' . $q['Restaurant'][$day . '_to'];
        }
        $from_check = date('Y-m-d') . ' ' . $q['Restaurant'][$day . '_from'];
        $to_check = str_replace(array(':',' ', '-'), array('', '',''), $to_check);


        $from_check = str_replace(array(':', ' ', '-'), array('', '',''), $from_check);

        if ($current >= $from_check && $current <= $to_check) {
            $this->set('closed', 0);
        } else {
            $this->set('closed', 1);
            if ($from >= $time) {
                $date_format_from = new DateTime($from1);
                $from1 = $date_format_from->format('h:i A');
                $date_format_to = new DateTime($to1);
                $to1 = $date_format_to->format('h:i A');
                $this->set('back', 'tomorrow during ' . $from1 . ' - ' . $to1);
                $this->set('back', 'during ' . $from1 . ' - ' . $to1);
            } else {
                $index = array_search($day, $day_arr);
                $index = strtolower($index);
                $index++;
                $to1 = $q['Restaurant'][$day_arr[$index] . '_to'];
                $from1 = $q['Restaurant'][$day_arr[$index] . '_from'];
                $date_format_from = new DateTime($from1);
                $from1 = $date_format_from->format('h:i A');
                $date_format_to = new DateTime($to1);
                $to1 = $date_format_to->format('h:i A');
                $this->set('back', 'tomorrow during ' . $from1 . ' - ' . $to1);
            }
        }
        /*if($from<=$time && $to >= $time)
        {
            $this->set('closed',0);
        }
        else
        {
            $this->set('closed',1);
            if($from>=$time)
            {
                $date_format_from = new DateTime($from1);
                $from1= $date_format_from->format('h:i A');
                $date_format_to = new DateTime($to1);
                $to1= $date_format_to->format('h:i A');
                $this->set('back','tomorrow during '.$from1.' - '.$to1);
                $this->set('back','during '.$from1.' - '.$to1);
            }
            else
            {
                $index = array_search($day,$day_arr);
                $index = strtolower($index);
                $index++;
                $to1 = $q['Restaurant'][$day_arr[$index].'_to'];
                $from1 = $q['Restaurant'][$day_arr[$index].'_from'];
                $date_format_from = new DateTime($from1);
                $from1= $date_format_from->format('h:i A');
                $date_format_to = new DateTime($to1);
                $to1= $date_format_to->format('h:i A');
                $this->set('back','tomorrow during '.$from1.' - '.$to1);
            }
        }*/
        $this->loadModel('MenuCategory');
        $this->loadModel('Reservation');
        $this->loadModel('Menu');

        $this->set('title', $q['Restaurant']['name']);
        $this->set('description', $q['Restaurant']['description']);
        $this->set('keyword', $q['Restaurant']['name'] . ' , ' . $q['Restaurant']['street'] . ' , ' . $q['Restaurant']['city'] . ' , ' . $q['Restaurant']['prov_state'] . ' , ' . $q['Restaurant']['cuisine'] . ' , ' . $q['Restaurant']['phone'] . ' , Charlies Chopsticks, Food Ordering , Online Food , Order Food , Restaurant');
        $q2 = $this->MenuCategory->find('all', array('conditions' => array('res_id' => $q['Restaurant']['id'], 'menu_parent' => 0), 'order' => 'order ASC'));
        if ($order) {
            $this->loadModel("Combo");
            $this->set("combo1", $this->Combo);
            $this->set('order', $this->Reservation->findById($order));
            $this->set('menus', $this->Menu);
        } else
            $this->set('order', false);
        $this->set('mm', $this->Menu);
        $this->set('res', $q);
        $this->set('rescat', $q2);
        $this->set('displaybackground', '1');
    }

    function getslug()
    {
        $res = $this->Restaurant->find('first');
        return $res['Restaurant']['slug'];
    }

    function getMenucat($id)
    {
        $this->loadMOdel('MenuCategory');
        return $this->MenuCategory->find('all', array('conditions' => array('menu_parent' => $id), 'order' => 'order ASC'));
    }

    function search()
    {
        $s = $_GET['s'];
        $s2 = str_replace(',', ' ', $s);
        $s2 = trim($s2);
        $s_arr = explode(' ', $s2);

        $cond = "(name Like '%" . $s . "%' OR street LIKE '%" . $s . "%' OR city LIKE '%" . $s . "%' OR prov_state LIKE '%" . $s . "%'";
        if (count($s_arr) > 1) {
            foreach ($s_arr as $s) {
                $cond = $cond . "OR street LIKE '%" . $s . "%' OR name Like '%" . $s . "%' OR city LIKE '%" . $s . "%' OR prov_state LIKE '%" . $s . "%'";
            }
        }
        $cond = $cond . ')';

        $q = $this->Restaurant->find('all', array('conditions' => array($cond), 'order' => 'id DESC'));
        $this->set('search', $q);

    }

    public function upload_img()
    {
        $exp = explode('.', $_FILES['myfile']['name']);
        $ext = end($exp);
        $rand = rand(100000, 999999) . '_' . rand(100000, 999999);
        $file = $rand . '.' . $ext;
        $path = APP . 'webroot/images/restaurants/' . $file;

        move_uploaded_file($_FILES['myfile']['tmp_name'], $path);

        echo $file;
        die();
    }

    function validate_user($user, $pass)
    {

        $q = $this->Restaurant->find('first', array('conditions' => array('email' => $user, 'password' => $pass)));
        if ($q)
            echo '1';
        else
            echo '0';
        die();
    }

    function login()
    {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        if($q = $this->Restaurant->find('first', array('conditions' => array('email' => $user, 'password' => $pass))))
        {
            $this->Session->write('restaurant', $user);
            $this->Session->write('name', $q['Restaurant']['name']);
            $this->Session->write('id', $q['Restaurant']['id']);
            $this->redirect('dashboard');
        }
        else
        {

        }
    }

    function checkSess()
    {
        if (!$this->Session->read('restaurant'))
            $this->redirect('/');
    }

    function dashboard()
    {
        $this->checkSess();
        if (isset($_POST['imgs']) && $_POST['imgs']) {
            $this->loadModel('ResImage');
            $this->ResImage->deleteAll(array('res_id' => $this->Session->read('id')));
            foreach ($_POST['imgs'] as $img) {

                $this->ResImage->create();
                $arr['res_id'] = $this->Session->read('id');
                $arr['images'] = $img;
                $this->ResImage->save($arr);

            }
        }
        if (isset($_POST['name']) && $_POST['name']) {
            $this->Restaurant->id = $this->Session->read('id');
            if ($_POST['delivery_fee'] && str_replace('$', '', $_POST['delivery_fee']) == $_POST['delivery_fee'])
                $_POST['delivery_fee'] = number_format($_POST['delivery_fee'], 2);
            else
                $_POST['delivery_fee'] = number_format(str_replace('$', '', $_POST['delivery_fee']), 2);

            if ($_POST['min_delivery'] && str_replace('$', '', $_POST['min_delivery']) == $_POST['min_delivery'])
                $_POST['min_delivery'] = number_format($_POST['min_delivery'], 2);
            else
                $_POST['min_delivery'] = number_format(str_replace('$', '', $_POST['min_delivery']), 2);


            if (!$_POST['picture'])
                $_POST['picture'] = 'default.png';
            $days = array('sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday');
            foreach ($days as $d) {
                $day_from = $_POST[$d . '_from'];
                $day_to = $_POST[$d . '_to'];
                if ($day_from) {
                    $day_from_arr = explode(' ', $day_from);
                    if ($day_from_arr[1] == 'AM') {
                        $day_from_arr_arr = explode(':', $day_from_arr[0]);
                        if ($day_from_arr_arr[0] == '12') {
                            $_POST[$d . '_from'] = '00:' . $day_from_arr_arr[1] . ':' . '00';
                        } else
                            $_POST[$d . '_from'] = $day_from_arr_arr[0] . ':' . $day_from_arr_arr[1] . ':' . '00';
                    } else {
                        $day_from_arr_arr = explode(':', $day_from_arr[0]);
                        if ($day_from_arr_arr[0] == '12') {
                            $_POST[$d . '_from'] = $day_from_arr_arr[0] . ':' . $day_from_arr_arr[1] . ':' . '00';
                        } else
                            $_POST[$d . '_from'] = ($day_from_arr_arr[0] + 12) . ':' . $day_from_arr_arr[1] . ':' . '00';
                    }
                }
                if ($day_to) {
                    $day_to_arr = explode(' ', $day_to);
                    if ($day_to_arr[1] == 'AM') {
                        $day_to_arr_arr = explode(':', $day_to_arr[0]);
                        if ($day_to_arr_arr[0] == '12') {
                            $_POST[$d . '_to'] = '00:' . $day_to_arr_arr[1] . ':' . '00';
                        } else
                            $_POST[$d . '_to'] = $day_to_arr_arr[0] . ':' . $day_to_arr_arr[1] . ':' . '00';
                    } else {
                        $day_to_arr_arr = explode(':', $day_to_arr[0]);
                        if ($day_to_arr_arr[0] == '12') {
                            $_POST[$d . '_to'] = $day_to_arr_arr[0] . ':' . $day_to_arr_arr[1] . ':' . '00';
                        } else
                            $_POST[$d . '_to'] = ($day_to_arr_arr[0] + 12) . ':' . $day_to_arr_arr[1] . ':' . '00';
                    }
                }
            }
            $this->Restaurant->save($_POST);

            $this->Session->setFlash('Restaurant Info saved successfully');
        }
        $q = $this->Restaurant->findById($this->Session->read('id'));


        $this->set('res', $q);
    }

    function menuManager()
    {
        $this->checkSess();
        $this->loadModel('MenuCategory');
        $this->loadModel('Menu');
        $this->loadModel('Combo');
        if (isset($_POST['cattitle'])) {
            $arr['res_id'] = $this->Session->read('id');
            $arr['title'] = $_POST['cattitle'];
            $arr['cattype'] = 1;
            $arr['menu_parent'] = 0;
            $q1 = $this->MenuCategory->find('first', array('order' => 'order ASC'));
            if ($q1)
                $arr['order'] = $q1['MenuCategory']['order'] + 1;
            else
                $arr['order'] = 1;
            $this->MenuCategory->create();
            $this->MenuCategory->save($arr);
            $this->Session->setFlash('Category Added Successfully!');
            $this->redirect('menuManager');
        }
        $q = $this->MenuCategory->find('all', array('conditions' => array('res_id' => $this->Session->read('id'), 'menu_parent' => 0), 'order' => 'order ASC'));
        $this->set('combo', $this->Combo->find('all', array('conditions' => array('res_id' => $this->Session->read('id')))));
        $this->set('menu_s', $this->Menu);
        $this->set('cat', $q);

    }

    function addSubCat($cat_id = null, $menu_id = null)
    {
        if (isset($_POST['subcat'])) {
            $arr['res_id'] = $this->Session->read('id');
            $arr['title'] = $_POST['subcat'];
            $arr['cattype'] = 1;
            $arr['description'] = trim($_POST['subdes']);
            $arr['menu_parent'] = $_POST['menu'];

            if (isset($_POST['is_required']))
                $arr['is_required'] = $_POST['is_required'];
            else
                $arr['is_required'] = 0;

            if (isset($_POST['up_to']))
                $arr['up_to'] = $_POST['up_to'];
            else
                $arr['up_to'] = 0;

            if (isset($_POST['is_multiple']))
                $arr['is_multiple'] = $_POST['is_multiple'];
            else
                $arr['is_multiple'] = 0;

            if (isset($_POST['itemno']))
                $arr['itemno'] = $_POST['itemno'];
            else
                $arr['itemno'] = 0;

            $this->loadModel('MenuCategory');
            if (!$cat_id) {
                $this->MenuCategory->create();
                $this->MenuCategory->save($arr);
                $cat_id = $this->MenuCategory->id;
            } else {
                $this->MenuCategory->id = $cat_id;
                $this->MenuCategory->save($arr);
                $cat_id = $this->MenuCategory->id;
            }


            $sp = $_POST['sp'];
            $si = $_POST['si'];

            $sp_a = explode(',', $sp);
            $si_a = explode(',', $si);
            $this->loadModel('Menu');
            $this->Menu->deleteAll(array('cat_id' => $cat_id));
            echo $cat_id;
            foreach ($sp_a as $k => $p) {
                $this->Menu->create();
                $m['menu_item'] = $si_a[$k];


                $whiteSpace = '';
                $pattern = '/[^0-9.' . $whiteSpace . ']/u';
                $cleared = preg_replace($pattern, '', (string)$p);
                $m['price'] = number_format($cleared, 2);

                $m['cat_id'] = $cat_id;
                $this->Menu->save($m);
            }

        }
        die();
    }

    function logout()
    {
        $this->Session->delete('restaurant');
        $this->Session->delete('name');
        $this->redirect('/');
    }

    function addMenu($id = '')
    {
        $this->checkSess();
        if (isset($_POST['menu_item']) && $_POST['menu_item']) {
            if ($id == '') {
                $this->loadModel('Menu');
                $q1 = $this->Menu->find('first', array('order' => 'display_order ASC'));
                if ($q1)
                    $_POST['display_order'] = $q1['Menu']['display_order'] + 1;
                else
                    $_POST['display_order'] = 1;

                $_POST['price'] = str_replace('$', '', $_POST['price']);
                $_POST['price'] = trim($_POST['price']);

                $whiteSpace = '';
                $pattern = '/[^0-9.' . $whiteSpace . ']/u';
                $cleared = preg_replace($pattern, '', (string)$_POST['price']);
                if (!$cleared)
                    $cleared = 0;
                $_POST['price'] = number_format($cleared, 2);

                $this->Menu->create();
                $this->Menu->save($_POST);
                echo $this->Menu->id;
            } else {

                $this->loadModel('Menu');
                $this->Menu->id = $id;
                $_POST['price'] = str_replace('$', '', $_POST['price']);
                $_POST['price'] = trim($_POST['price']);
                $whiteSpace = '';
                $pattern = '/[^0-9.' . $whiteSpace . ']/u';
                $cleared = preg_replace($pattern, '', (string)$_POST['price']);
                //$conditions = $this->postConditions(array('slug'=>$cleared));
                //$_POST['price'] = $this->Restaurant->find('all',array('conditions'=>array('slug'=>$cleared)));
                $_POST['price'] = number_format($cleared, 2);
                $this->Menu->save($_POST);
                echo $id;
            }
        }
        die();
    }

    function loadMenu($mid, $cid = '')
    {
        $this->layout = 'blank';
        $this->checkSess();
        $this->loadModel('Menu');
        $this->loadModel('MenuCategory');
        $m = $this->Menu->findById($mid);
        if (!$cid)
            $cid = $m['Menu']['cat_id'];
        $c = $this->MenuCategory->findById($cid);
        $this->set('menu', $m);
        $this->set('menu_s', $this->Menu);
        $this->set('cat', $c);
    }

    function changeCat($id, $title)
    {
        $this->loadModel('MenuCategory');
        $this->MenuCategory->id = $id;
        $this->MenuCategory->saveField('title', $title);
        echo $title;
        die();
    }

    function removeCat($id)
    {
        $this->loadModel('Menu');
        $this->loadModel('MenuCategory');
        $this->MenuCategory->delete($id);
        $this->Menu->deleteAll(array('cat_id' => $id));
        die();
    }

    function removeMenu($id)
    {
        $this->loadModel('Menu');

        $this->Menu->delete($id);
        //$this->Menu->deleteAll(array('cat_id'=>$id));
        die();
    }


    function orderlist($id)
    {
        $this->loadModel('Menu');
        $this->set('menu', $this->Menu->findById($id));
        $this->layout = 'blank';
    }

    function register()
    {
        $this->Restaurant->create();
        $whiteSpace = '';
        $pattern = '/[^a-zA-Z0-9-' . $whiteSpace . ']/u';
        $cleared = preg_replace($pattern, '-', (string)$_POST['name']);
        //$conditions = $this->postConditions(array('slug'=>$cleared));
        $ch = $this->Restaurant->find('all', array('conditions' => array('slug' => $cleared)));

        if (empty($ch)) {
            $_POST['slug'] = $cleared;
        }
        $_POST['picture'] = 'default.png';

        $this->Restaurant->save($_POST);

        $this->Session->write('id', $this->Restaurant->id);
        if (!empty($ch)) {
            $this->Restaurant->id = $this->Session->read('id');
            $this->Restaurant->saveField('slug', $cleared . $this->Restaurant->id);
        }
        $this->Session->write('restaurant', $_POST['email']);
        $this->Session->write('name', $_POST['name']);

        $generic = $this->requestAction('/pages/getGeneric');
        $this->Session->setFlash('<center>Welcome ' . $_POST['name'] . ', to ' . $generic ["title"] . '</center>');
        $this->redirect('dashboard');
    }

    function validateEmail()
    {
        $email = $_POST['email'];
        $q = $this->Restaurant->findByEmail($email);
        if ($q)
            echo '0';
        else
            echo '1';
        die();
    }

    function order($res_id, $order = 0)
    {
        //$this->layout = 'default_';
        $this->loadModel('Reservation');
        $free = $this->Reservation->find('count', array('conditions' => array('ordered_by <>' => '')));
        $this->loadModel('Country');
        $this->loadModel("Combo");
        $this->set("combo", $this->Combo);
        $this->set('country', $this->Country->find('all', array('order' => 'id')));

        if (isset($_POST['menu_ids']) && $_POST['menu_ids']) {
            if ($free >= 31) {
                if (($free + 1) % 32 == 0)
                    $arr['is_free'] = 1;

            }
            $i = 0;
            foreach ($_POST['menu_ids'] as $menu_ids) {
                $i++;
                if ($i == 1) {
                    $arr['menu_ids'] = $menu_ids;
                } else
                    $arr['menu_ids'] = $arr['menu_ids'] . ',' . $menu_ids;
            }
            $i = 0;
            foreach ($_POST['prs'] as $prs) {
                //echo $prs;
                $i++;
                if ($i == 1) {
                    $arr['prs'] = $prs;
                } else
                    $arr['prs'] = $arr['prs'] . ',' . $prs;
            }
            $i = 0;
            foreach ($_POST['qtys'] as $qtys) {
                //echo $prs;
                $i++;
                if ($i == 1) {
                    $arr['qtys'] = $qtys;
                } else
                    $arr['qtys'] = $arr['qtys'] . ',' . $qtys;
            }
            $i = 0;
            foreach ($_POST['extras'] as $extra) {
                $extra = trim($extra);
                $i++;
                if ($i == 1) {
                    $arr['extras'] = $extra;
                } else
                    $arr['extras'] = $arr['extras'] . ',' . $extra;
            }
            $i = 0;
            foreach ($_POST['listid'] as $lst) {
                $lst = trim($lst);
                $i++;
                if ($i == 1) {
                    $arr['listid'] = $lst;
                } else
                    $arr['listid'] = $arr['listid'] . ',' . $lst;
            }
            if ($_POST['order_type'] == 'Pickup')
                $arr['delivery_fee'] = 0.00;
            else
                $arr['delivery_fee'] = $_POST['delivery_fee'];
            $arr['res_id'] = $res_id;
            $arr['subtotal'] = $_POST['subtotal'];
            $arr['g_total'] = $_POST['g_total'];
            $arr['tax'] = $_POST['tax'];
            $arr['order_type'] = $_POST['order_type'];
            $arr['city_receipt'] = $_POST['city_receipt'];

            date_default_timezone_set('Canada/Eastern');
            if (!$order) {
                $this->Reservation->create();
                $arr['order_time'] = date('Y-m-d H:i:s');
                $this->Reservation->save($arr);
            } else {
                $this->Reservation->id = $order;
                $arr['order_time'] = date('Y-m-d H:i:s');
                $this->Reservation->save($arr);
            }
            if (isset($free) && (($free + 1) % 32 == 0))
                $this->redirect('order/' . $res_id . '/' . $this->Reservation->id . '?free');
            else
                $this->redirect('order/' . $res_id . '/' . $this->Reservation->id);
        }

        $this->set('res', $this->Restaurant->findById($res_id));
        $this->set('order', $this->Reservation->findById($order));

        $this->loadModel('Menu');
        $this->set('menu', $this->Menu);
    }

    function confirm_order($id)
    {
        $this->loadModel('Reservation');
        $q = $this->Reservation->findById($id);
        App::uses('CakeEmail', 'Network/Email');

        //$_POST['order_time'] = date('Y-m-d H:i:s');
        //$_POST['order_till'] = $_POST['ordered_on_date'].' '.$_POST['ordered_on_time'];
        date_default_timezone_set('Canada/Eastern');
        if (strlen($_POST['ordered_on_time']) > 0) {
            $date_arr = explode(' ', $_POST['ordered_on_time']);
            if ($date_arr[1] == 'AM') {
                $time_arr = explode(':', $date_arr[0]);
                if ($time_arr[0] == '12') {
                    $_POST['order_till'] = date('Y-m-d') . ' 00:' . $time_arr[1] . ':00';
                } else
                    $_POST['order_till'] = date('Y-m-d') . ' ' . $time_arr[0] . ':' . $time_arr[1] . ':00';


            } else {
                $time_arr = explode(':', $date_arr[0]);
                if ($time_arr[0] == '12') {
                    $_POST['order_till'] = date('Y-m-d') . ' 12:' . $time_arr[1] . ':00';
                } else
                    $_POST['order_till'] = date('Y-m-d') . ' ' . ($time_arr[0] + 12) . ':' . $time_arr[1] . ':00';
            }

        }

        if ($this->Session->read('restaurant') && $q['Reservation']['order_type'] != 'delivery') {
            $_POST['approved'] = 1;
            $_POST['cancelled'] = 0;
            $_POST['order_now'] = 1;
            //die('here');
        }
        //var_dump($_POST);die();
        $this->Reservation->id = $id;
        $this->Reservation->save($_POST);

        $whole = Router::url(null, true);
        $base_url_arr = explode('/restaurants', $whole);
        $base_url = $base_url_arr['0'];


        $q2 = $this->Restaurant->findById($q['Reservation']['res_id']);
        if ($this->Session->read('restaurant') && $q['Reservation']['order_type'] != 'delivery') {

        } else {

           /* $emails = new CakeEmail();
            $emails->from(array('charlieschopsticks@gmail.com' => 'Charlie\'s Chopsticks'));
            $emails->emailFormat('html');
            $emails->subject('Ordered Placed Successfully');*/

            $message = file_get_contents($base_url . '/orders/email2/' . $id);
            //$emails->to($_POST['email']);
            //$emails->send($message);
            //$this->Session->setFlash('Message sent successfully');
            //unset($emails);
            $this->CustomMail->sendMail($_POST['email'],'Ordered Placed Successfully',$message);
        }


        /*$emails = new CakeEmail();
        $emails->from(array('charlieschopsticks@gmail.com' => 'Charlie\'s Chopsticks'));
        $emails->emailFormat('html');
        $emails->subject('New Order Placed');
*/
        $message = file_get_contents($base_url . '/orders/email1/' . $id);
        /*if($q['Reservation']['city_receipt'] == 'Hamilton')
        $emails->to($q2['Restaurant']['email']);
        else
        $emails->to('charlieswelland@gmail.com');
        $emails->send($message);*/
        if($q['Reservation']['city_receipt'] == 'Hamilton')
        {
            $this->CustomMail->sendMail($q2['Restaurant']['email'],'New Order Placed',$message);
        }
        else
        $this->CustomMail->sendMail('charlieswelland@gmail.com','New Order Placed',$message);
	        $this->CustomMail->sendMail('info@trinoweb.com','New Order Placed',$message);
        $this->redirect('success_order/' . $id);
        //die('here');

    }

    function success_order($id)
    {
        $this->loadModel('Reservation');
        //$this->set('res',$this->Restaurant->findById($res_id));
        $this->set('order', $this->Reservation->findById($id));
        $this->loadModel('Menu');
        $this->set('menu', $this->Menu);
        if (isset($_POST['donation'])) {
            $this->Reservation->id = $id;
            $this->Reservation->saveField('donation', $_POST['donation']);
            $this->Reservation->saveField('country', $_POST['country']);
            $this->Session->setFlash('Donation added successfully');
        }
    }

    function upload_menu_img($id)
    {
        $exp = explode('.', $_FILES['myfile']['name']);
        $ext = end($exp);
        $rand = rand(100000, 999999) . '_' . rand(100000, 999999);
        $file = $rand . '.' . $ext;
        $path = APP . 'webroot/images/menus/' . $file;

        move_uploaded_file($_FILES['myfile']['tmp_name'], $path);

        echo $file;
        $this->loadModel('Menu');
        $this->Menu->id = $id;
        $this->Menu->saveField('image', $file);
        die();

    }

    function addOpt($id)
    {
        $this->loadModel('Menu');

        $item = explode(',', $_POST['item']);
        $price = explode(',', $_POST['price']);
        foreach ($item as $k => $i) {
            $this->Menu->create();
            $arr['parent'] = $id;
            $arr['menu_item'] = $i;
            $arr['price'] = $price[$k];
            $whiteSpace = '';
            $pattern = '/[^0-9.' . $whiteSpace . ']/u';
            $cleared = preg_replace($pattern, '', (string)$arr['price']);
            if (!$cleared)
                $cleared = 0;
            $arr['price'] = number_format($cleared, 2);

            $this->Menu->save($arr);
        }
        die();

    }

    function optional($id)
    {
        $this->loadModel('MenuCategory');
        $cats = $this->MenuCategory->findById($id);
        $this->layout = '';
        $this->set('cats', $cats);
    }

    function optionalM($id)
    {
        $this->loadModel('Menu');
        $cats = $this->Menu->findById($id);
        $this->layout = '';
        $this->set('menus', $cats);
    }

    function optional_in($cat_id)
    {
        $this->layout = '';
        $this->loadModel('Menu');
        $this->loadModel('MenuCategory');
        $this->set('cats_in', $this->MenuCategory->findById($cat_id));
        return $this->render('optional_in');
    }

    function getName($id)
    {
        $q = $this->Restaurant->findById($id);
        return $q['Restaurant']['name'];
    }

    function getEmail($id)
    {
        $q = $this->Restaurant->findById($id);
        return $q['Restaurant']['email'];
    }

    function getContact($id)
    {
        $q = $this->Restaurant->findById($id);
        return $q['Restaurant']['phone'];
    }

    function orderCat()
    {
        $ids = $_POST['ids'];
        $arr = explode(',', $ids);
        $this->loadModel('MenuCategory');
        foreach ($arr as $k => $a) {
            $this->MenuCategory->id = $a;
            $key = $k + 1;
            $this->MenuCategory->saveField('order', $key);
        }
        die();
    }

    function orderMenu()
    {
        $ids = $_POST['ids'];
        $arr = explode(',', $ids);
        $this->loadModel('Menu');
        foreach ($arr as $k => $a) {
            $this->Menu->id = $a;
            $key = $k + 1;
            $this->Menu->saveField('display_order', $key);
        }
        die();
    }

    function get_price($id)
    {
        $submenuscat = $this->getMenucat($id);
        $p = 1000;
        //var_dump($submenuscat);
        foreach ($submenuscat as $subm) {
            foreach ($subm['Menu'] as $k => $m) {
                if ($p >= $m['price'])
                    $p = $m['price'];
                else
                    $p = $p;
            }
        }
        return $p;

    }

    function instore($id)
    {
        $this->loadModel('Reservation');
        $this->Reservation->id = $id;
        $this->Reservation->saveField('ordered_by', 'In-store Purchase');
        $this->Reservation->saveField('approved', 1);
        $this->Reservation->saveField('cancelled', 0);
        $this->Reservation->saveField('order_now', 1);
        die();

    }

    function upload_cat_img($id = '')
    {
        $exp = explode('.', $_FILES['myfile']['name']);
        $ext = end($exp);
        $rand = rand(100000, 999999) . '_' . rand(100000, 999999);
        $file = $rand . '.' . $ext;
        $path = APP . 'webroot/images/category/' . $file;

        move_uploaded_file($_FILES['myfile']['tmp_name'], $path);

        echo $file;
        $this->loadModel('MenuCategory');
        $this->MenuCategory->id = $id;
        $this->MenuCategory->saveField('cat_image', $file);
        die();
    }

    function combo($id = 0)
    {
        $this->loadModel('Combo');
        $this->loadModel('MenuCategory');
        $this->loadModel('Menu');
        $q = $this->MenuCategory->find('all', array('conditions' => array('res_id' => $this->Session->read('id'), 'menu_parent' => 0), 'order' => 'order ASC'));
        $this->set('menu_s', $this->Menu);
        $this->set('cat', $q);
        $combos = $this->Combo->find('all', array('order' => 'id DESC'));
        $this->set('combos', $combos);
        if ($id) {
            $this->set('combo', $this->Combo->findById($id));
            //$c = $this->Combo->findById($id)
            //$this->set('selected',$this->Menu->find('all',array('conditions'=>array('id IN ('.$c['Combo']['ids'].')'))));
        }
    }

    function upload_combo_img()
    {
        $exp = explode('.', $_FILES['myfile']['name']);
        $ext = end($exp);
        $rand = rand(100000, 999999) . '_' . rand(100000, 999999);
        $file = $rand . '.' . $ext;
        $path = APP . 'webroot/images/menus/' . $file;

        move_uploaded_file($_FILES['myfile']['tmp_name'], $path);

        echo $file;
        die();

    }

    function save_combo($id = 0)
    {
        if ($id == 'undefined') {
            $id = 0;
        }
        $this->loadModel('Combo');
        $arr['title'] = $_POST['title'];
        $arr['price'] = $_POST['price'];


        $arr['price'] = $_POST['price'];
        $whiteSpace = '';
        $pattern = '/[^0-9.' . $whiteSpace . ']/u';
        $cleared = preg_replace($pattern, '', (string)$arr['price']);
        if (!$cleared)
            $cleared = 0;
        $arr['price'] = number_format($cleared, 2);


        $arr['description'] = trim($_POST['description']);
        $arr['image'] = $_POST['image'];
        $arr['ids'] = $_POST['ids'];
        $arr['qtys'] = $_POST['qtys'];
        $arr['res_id'] = $this->Session->read('id');

        $order = $this->Combo->find('first', array('order' => 'display_order DESC'));
        if ($order) {
            if (!$order['Combo']['display_order'])
                $arr['display_order'] = 1;
            else
                $arr['display_order'] = $order['Combo']['display_order'] + 1;
        } else
            $arr['display_order'] = 1;

        if ($id) {
            $this->Combo->id = $id;
            $this->Session->setFlash('Combo updated successfully');
        } else {
            $this->Combo->create();
            $this->Session->setFlash('Combo added successfully');
        }
        $this->Combo->save($arr);
        die();
    }

    function removeComboMenu($combo_id, $id)
    {
        $this->loadModel('Combo');
        $q = $this->Combo->findById($combo_id);
        $ids = $q['Combo']['ids'];
        $arr = explode(',', $ids);
        $new_arr = '';
        foreach ($arr as $a) {
            if ($a != $id) {
                if ($new_arr == '')
                    $new_arr = $a;
                else
                    $new_arr = $new_arr . ',' . $a;
            }
        }
        $this->Combo->id = $combo_id;
        $this->Combo->saveField('ids', $new_arr);
        $this->Session->setFlash('Item deleted successfully from combo');
        $this->redirect('combo/' . $combo_id);
    }

    function delete_combo($id)
    {
        $this->loadModel('Combo');
        $this->Combo->delete($id);
        $this->Session->setFlash('Combo deleted successfully!');
        $this->redirect('combo');
    }
    function showmenu($id,$show)
    {
        $this->loadModel('Menu');
        $this->Menu->id = $id;
        $this->Menu->saveField('showmenu',$show);
        die();
    }
    function deleteAdditional($id)
    {
        $this->loadModel('MenuCategory');
        $this->MenuCategory->delete($id);
        die();
    }
    function charlie()
    {
        //$this->layout ="blank";
    }
}

?>