<?php
class CustomMailComponent extends Component {
    function sendMail($arr,$subject,$message) {
        if(!is_array($arr)) {
            $emails = array($arr);
        } else {
            $emails = $arr;
        }
        $headers = "From: Charlie\'s Chopsticks <charlieschopsticks@gmail.com>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        foreach($emails as $to) {
            //$to = $e;
            mail($to, $subject, $message, $headers);
        }
    }
}