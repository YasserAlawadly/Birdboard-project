<?php

function gravatar_ulr($email)
{
    $email =md5($email);

    return "http://gravatar.com/avatar/{$email}?" .  http_build_query([
        's' => 60,
        'd' => 'https://s3.amazonaws.com/laracasts/images/default-square-avatar.jpg'
    ]);
}
