<?php 
function encryptCookie($value)
{
    $password = 'youkey';
    $key = hash('sha256', $password);
    $method = 'AES-256-CBC';
    $ivSize = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($ivSize);
    $newvalue = openssl_encrypt($value, $method, $key, OPENSSL_RAW_DATA, $iv);
    // For storage/transmission, we simply concatenate the IV and cipher text
    $newvalue = base64_encode($iv . $newvalue);
    return $newvalue;
}

function decryptCookie($value)
{
    $value = base64_decode($value);
    $password = 'youkey';
    $method = 'AES-256-CBC';
    $key = hash('sha256', $password);
    $ivSize = openssl_cipher_iv_length($method);
    $iv = substr($value, 0, $ivSize);
    $newvalue = openssl_decrypt(substr($value, $ivSize), $method, $key, OPENSSL_RAW_DATA, $iv);

    return $newvalue;
}
?>