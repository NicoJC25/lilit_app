<?php

require_once '../../vendor/autoload.php'; // Asegúrate de que esta línea apunte a Composer
use Twilio\Rest\Client;

$name = $_POST['name'];
$phone = $_POST['phone'];
$date = $_POST['date'];

function enviar_cita($name, $phone, $date) {
    try {
        require 'database.php';

        // Inserción de la cita en la base de datos
        $sql = "INSERT INTO citas (nombreCliente, celularCliente, fechaCita) VALUES ('$name', '$phone', '$date')";
        $query = mysqli_query($db, $sql);

        if ($query) {
            echo 'Cita guardada exitosamente';

            // Aquí llamamos a la función para enviar el SMS
            enviar_sms($name, $phone, $date);
        } else {
            echo 'Error al guardar la cita';
        }

    } catch(\Throwable $th) {
        var_dump($th);
    }
}

function enviar_sms($name, $phone, $date) {


    // Credenciales de Twilio
    $account_sid = 'AC499672be32beb5ed259ceedfeaf595e8'; 
    $auth_token = '130263b23a865124d2bc7ba09a06e35e'; 
    $twilio_number = "+18654087161"; // Número de Twilio

    // Mensaje personalizado
    $message_body = "Hola, {$name}, este es un mensaje de texto de confirmación de tu cita el día {$date}";

    // Inicializa el cliente de Twilio
    $client = new Client($account_sid, $auth_token);

    $to_number = "+57" . $phone; // Donde $phone es el número ingresado por el usuario sin el prefijo
    try {
        // Enviar el mensaje
        $message = $client->messages->create(
            $to_number,
            array(
                'from' => $twilio_number,
                'body' => $message_body
            )
        );
        echo "Mensaje enviado exitosamente. SID: " . $message->sid;
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: " . $e->getMessage();
    }
}

// Ejecutamos la función enviar_cita que a su vez enviará el SMS
enviar_cita($name, $phone, $date);
