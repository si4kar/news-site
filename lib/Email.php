<?php

class Email
{
    public static function sendMail()
    {
        $adminEmail = 'order@test.com';
        $message = 'http://interShop/admin/orders';
        $subject = 'New order';
        mail($adminEmail, $subject, $message);

    }
}