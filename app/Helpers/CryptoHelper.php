<?php



// class CryptoHelper
// {
//     private static $key = "12345678901234567890123456789012"; // 32 chars
//     private static $iv = "1234567890123456"; // 16 chars

//     public static function decryptData($cipherText)
//     {
//         return openssl_decrypt(
//             base64_decode($cipherText),
//             'AES-256-CBC',
//             self::$key,
//             OPENSSL_RAW_DATA,
//             self::$iv
//         );
//     }
// }


namespace App\Helpers;

class CryptoHelper
{
    private static $key = "12345678901234567890123456789012"; // 32 chars
    private static $iv = "1234567890123456"; // 16 chars

    public static function decryptData($cipherHex)
    {
        $cipherRaw = hex2bin($cipherHex); // konversi Hex ke raw binary

        return openssl_decrypt(
            $cipherRaw,
            'AES-256-CBC',
            self::$key,
            OPENSSL_RAW_DATA,
            self::$iv
        );
    }
}

