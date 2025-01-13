<?php

namespace App\Services;
use CodeIgniter\Email\Email;

class EmailService
{
    public function enviarEmail($mail)
    {
        $email = new Email();

        // Configuración del correo
        $email->setTo($mail)
             ->setFrom('admin.ccj@mail.com', 'Concesionario PHP')
             ->setSubject('Confirmacion Compra')
             ->setMessage('Tu compra ha sido aceptada');

        if ($email->send()) {
            echo 'Correo enviado correctamente';
        } else {
            echo 'Error al enviar el correo: ' . $email->printDebugger();
        }
    }
}
