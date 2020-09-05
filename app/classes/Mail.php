<?php


namespace App\Classes;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer;
        $this->setup();
    }

    public function setup(){
        $this->mail->isSMTP();

        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'tls';

        $this->mail->Host = getenv('SMTP_HOST');
        $this->mail->Port = getenv('SMTP_PORT');

        $environment = getenv('APP_ENV');
        if($environment === 'local'){

            $this->mail->SMTPOptions   = [
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
                ];
            $this->mail->SMTPDebug = '';
        }

        // Authentication info
        $this->mail->Username = getenv('EMAIL_USERNAME');
        $this->mail->Password = getenv('EMAIL_PASSWORD');

        $this->mail->isHTML(true);

        // Sender information
        $this->mail->setFrom(getenv('ADMIN_EMAIL'), getenv('APP_NAME'));
       // $this->mail->FromName = getenv('APP_NAME');
    }

    public function send($data){
        $this->mail->addAddress($data['to'], $data['name']);
        $this->mail->Subject = $data['subject'];
        $this->mail->Body = make($data['view'], array('data' =>$data['body']));

        return $this->mail->send();
    }
}