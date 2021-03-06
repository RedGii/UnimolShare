<?php
/**
 * Created by PhpStorm.
 * User: Andrea
 * Date: 30/05/18
 * Time: 21:57
 */

class EmailHelperAltervista
{
    /**
     * EmailHelperAltervista constructor.
     */
    public function __construct()
    {
    }

    //Funzione per inviare un'email con la nuova password
    function sendResetPasswordEmail($email, $password){

        $urlRest = "http://petrelladev.eu/projects/UnimolShare/public/recuperositeground";

        //Reinderizza all'host sitegrounf
        $data = array(
            'email' => $email,
            'password' => $password
        );

        $options = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $response = file_get_contents($urlRest, false, $context);

        if((json_decode($response))->{'error'}){
            $response = "Si è verificato un errore durante l'aggiornamento del DB!";
            return true;
        } else {
            $response = (json_decode($response))->{'message'};
            return false;
        }

        /*

        $messaggio = "Usa questa password temporanea";

        $linkLogin = 'https://www.unimolshare.it/login.php';
        $emailTo = $email;
        $subject = "UnimolShare - Conferma registrazione";
        $message   = '<html><body><h1>UnimolShare</h1><div>';
        $message   .= $messaggio.':<br/><br/><b>'.$password.'</div><br/><div>Vai su '.$linkLogin.' per entrare.</div></body></html>';
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        try {
            mail($emailTo, $subject, $message, $headers);
            return true;
        } catch (Exception $e){
            return false;
        }

        */

    }

    //Funzione per inviare un'email di conferma dell'account
    function sendConfermaAccount($email, $link){

        $urlRest = "http://petrelladev.eu/projects/UnimolShare/public/confermaaccount";

        //Reinderizza all'host sitegrounf
        $data = array(
            'email' => $email,
            'link' => $link
        );

        $options = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $response = file_get_contents($urlRest, false, $context);

        if((json_decode($response))->{'error'}){
            $response = "Si è verificato un errore durante l'aggiornamento del DB!";
            return $response;
        } else {
            $response = (json_decode($response))->{'message'};
            return $response;
        }

        /*

        $messaggio = 'Hai appena richiesto di iscriverti ad UnimolShare!<br>Conferma la tua iscrizione col seguente link:';
        $linkLogin = 'https://www.unimolshare.it/login.php';
        $emailTo = "andrea_cb_94@hotmail.it";
        $subject = "UnimolShare - Conferma registrazione";
        $message   = '<html><body><h1>UnimolShare</h1><div>';
        $message   .= $messaggio.'<br/><br/>'.$link.'</div><br/><div>Vai su '.$linkLogin.' per entrare.</div></body></html>';
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        try {
            return mail($emailTo, $subject, $message, $headers);
        } catch (Exception $e){
            return false;
        }
*/
    }

    //Funzione per inviare email di segnalazione
    function sendSegnalazione($nome, $cognome, $motivo, $contatto, $email){

        $emailTo = "unimolshare@gmail.com";
        $subject = "UnimolShare - Seg";
        $message   = '<html><body><h1>UnimolShare - Segnalazione Profilo</h1><div>';
        $message   .= $nome.', '.$cognome.'</div><br/><div>Motivo segnalazione: '.$motivo.'<br/>Contatti studente segnalato: '.$contatto.' '.$email.'.<br/><br/></div></body></html>';
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        try {
            mail($emailTo, $subject, $message, $headers);
            return true;
        } catch (Exception $e){
            return false;
        }

    }

}