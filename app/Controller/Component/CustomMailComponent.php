<?php
class CustomMailComponent extends Component {
    function sendMail($arr,$subject,$message, $ForwardToVan = false) {
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
        if($ForwardToVan){
            $this->sendSMS("9055315331", $subject);
        }
    }


    //////////////////////////////////////////////SEND SMS CODE//////////////////////////////////////////////////
    function isJson($string) {
        if($string && !is_array($string)){
            json_decode($string);
            return (json_last_error() == JSON_ERROR_NONE);
        }
    }

    function cURL($URL, $data = "", $username = "", $password = ""){
        $session = curl_init($URL);
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);//not in post production
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($session, CURLOPT_POST, true);
        if($data) { curl_setopt ($session, CURLOPT_POSTFIELDS, $data);}

        $datatype = "x-www-form-urlencoded;charset=UTF-8";
        if($this->isJson($data)){$datatype  = "json";}
        $header = array('Content-type: application/' . $datatype, "User-Agent: Charlies");
        if ($username && $password){
            $header[] =	"Authorization: Basic " . base64_encode($username . ":" . $password);
        } else if ($username) {
            $header[] =	"Authorization: Bearer " .  $username;
            $header[] =	"Accept-Encoding: gzip";
        } else if ($password) {
            $header[] =	"Authorization: AccessKey " .  $password;
        }
        curl_setopt($session, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($session);
        if(curl_errno($session)){
            $response = "Error: " . curl_error($session);
        }
        curl_close($session);
        return $response;
    }
    function getrequest($URL, $data){
        $delimeter = "?";
        foreach($data as $Key => $Value){
            $URL .= $delimeter . $Key . "=" . urlencode($Value);
            $delimeter = "&";
        }
        return file_get_contents($URL);
    }

    //3 cents per SMS
    function sendSMS_Clockwork($Phone, $Message){//works
        //www.clockworksms.com/
        $ClockworkKey = "82ef835ac1b60d5aa625b16098c66730ac007116";
        $URL = "https://api.clockworksms.com/http/send.aspx?key=" . $ClockworkKey . "&to=" . $Phone . "&content=" . urlencode($Message);
        return file_get_contents($URL);
    }

    //€ 0.0062 (aprox 1 cent) per SMS
    function sendSMS_messente($Phone, $Message){//works
        //https://messente.com/
        $URL = "http://api2.messente.com/send_sms/";
        $Data = array(
            "username" => "d44513c53a71cd97d7ef0f4a7974c6ad",
            "password" => "5c84de0a7d1ed78f087a71802757226c",
            "text" => $Message,
            "from" => "9055123067",
            "to" => $Phone
        );
        return $this->getrequest($URL, $Data);
    }

    //1.7 cents per message ($25 per month includes 1,500 SMS)
    function sendSMS_smsgateway($Phone, $Message){//works perfectly
        //http://smsgateway.ca/
        $key = "D731eIvNapiJ6t0voF2RBprD888l7KJ4";
        return file_get_contents("http://smsgateway.ca/sendsms.aspx?CellNumber=" . $Phone. "&MessageBody=" . urlencode($Message) . "&AccountKey=" . $key);
    }

    //costs unknown
    function sendSMS_sently($Phone, $Message){// works
        //https://web.sent.ly/
        $key = "1s51yz9kzhsjxq83f6t0mpwh3t6wklpq";
        $secret = "wy24p5t1vad5ve7taa048il8w3c3wh7g";
        $URL = "https://apiserver.sent.ly/oauth/token";
        $OATH = $this->getOATH($URL, $key, $secret);
        $URL = "https://apiserver.sent.ly/api/outboundmessage";
        $data = array("from" => "+19055123067", "to" => $Phone, "text" => $Message);
        return $this->cURL($URL, json_encode($data), $OATH);
    }

    //0.7 cents per sms
    function sendSMS_messagebird($Phone, $Message){//works
        //https://www.messagebird.com
        $key = "live_d37G3JwTyBRkBL2FcMMhxxZHE";
        $data = array(
            "originator" => $this->AppName(),
            "recipients" => $Phone,
            "body" => $Message
        );
        $URL = "https://rest.messagebird.com/messages";
        return $this->cURL($URL, json_encode($data), "", $key);
    }

    //$0.0075 per SMS, + $1 per month
    function sendSMS_Twilio($Phone, $Message, $Call = false){//works if you can get the from number....
        //https://www.twilio.com/
        $sid = 'AC81b73bac3d9c483e856c9b2c8184a5cd';
        $token = "3fd30e06e99b5c9882610a033ec59cbd";
        $fromnumber = "2897685936";
        if($Call){
            $Message = "http://charlieschopsticks.com/pages/call?message=" .  urlencode($Message);
            $URL = "https://api.twilio.com/2010-04-01/Accounts/" . $sid . "/Calls";
            $data = array("From" => $fromnumber, "To" => $Phone, "Url" => $Message);
        } else {
            $URL = "https://api.twilio.com/2010-04-01/Accounts/" . $sid . "/Messages";
            $data = array("From" => $fromnumber, "To" => $Phone, "Body" => $Message);
        }
        return $this->cURL($URL, http_build_query($data), $sid, $token);
    }

    function getOATH($URL, $key, $secret){
        $ret = cURL($URL, "grant_type=client_credentials", $key, $secret);
        $json = json_decode($ret);
        if(json_last_error() == JSON_ERROR_NONE){
            if($json->token_type == "bearer"){
                return $json->access_token;
            }
        }
        return "ERROR: " . $ret;
    }

    function sendSMS($Phone, $Message, $Provider = "Twilio"){
        return $Provider . ": " . call_user_func(array($this, "sendSMS_" . $Provider), $Phone, $Message);
        //return sendSMS_$Provider($Phone, $Message);
    }
}