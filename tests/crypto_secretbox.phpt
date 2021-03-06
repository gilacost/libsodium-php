--TEST--
Check for libsodium secretbox
--SKIPIF--
<?php if (!extension_loaded("libsodium")) print "skip"; ?>
--FILE--
<?php
$nonce = randombytes_buf(CRYPTO_SECRETBOX_NONCEBYTES);
$key = randombytes_buf(CRYPTO_SECRETBOX_KEYBYTES);

$a = crypto_secretbox('test', $nonce, $key);
$x = crypto_secretbox_open($a, $nonce, $key);
var_dump(bin2hex($x));
$y = crypto_secretbox_open("\0" . $a, $nonce, $key);
var_dump($y);

?>
--EXPECT--
string(8) "74657374"
bool(false)
