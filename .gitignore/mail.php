
<?php 

// mail 1 

$message = 'hello mic testing 1..2..3';
       
       $user_name = "velu";
       
       $user_email = "murugavelm@cognitidigital.in";
   
       $data = array('name'=>$user_name, 'messages'=>$message, 'email'=>"murugavelm@cognitidigital.in");

       Mail::send('mail', $data, function($message) use($user_email, $user_name) {

            $message->to("murugavelm@cognitidigital.in", $user_name)->subject('test');
            $message->from('murugavelm@cognitidigital.in','test');
        
        });



// Mail 2 


        $to = $email;
        $subject = 'Good Spot';
        $headers .= 'From: Good Spot '.'info@goodspot.com'. "\r\n"; 
    
        mail($to, $subject, $msg, $headers);
 

?>