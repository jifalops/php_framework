<?php
/**
 * A simple helper for encryption/decryption. I make no guarantees on the security of these functions.
 */
class Cipher {
	static function encrypt($string, $extra) {
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($extra), $string, MCRYPT_MODE_CBC, md5($extra)));        
	}

	static function decrypt($string, $extra) {
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($extra), base64_decode($encrypted), MCRYPT_MODE_CBC, md5($extra))), "\0");
	}
}
