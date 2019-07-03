<?php

namespace InvoiceSinger\Support\Encryption;

class Cryptor
{
    const ENC_METHOD = 'AES-256-CBC';

    /**
     * The encryption key to be used in algorithms.
     *
     * @var
     */
    protected $key;

    /**
     * The initialization vector.
     *
     * @var string
     */
    protected $init_vector;

    /**
     * The initial data.
     *
     * @var string|null
     */
    protected $data;

    /**
     * Cryptor constructor.
     *
     * @param string|null $secret
     * @param string|null $init_vector
     */
    function __construct($secret = null, $init_vector = null)
    {
        // If no encryption key is supplied, we can use PHP's php_uname().
        $secret = $secret ?: $this->getDefaultSecret();
        $init_vector = $init_vector ?: $secret . php_uname();

        // Calculate the "secret key" that is used to encrypt and decrypt values.
        $this->key = hash('sha256', $secret);
        $this->init_vector = substr(hash('sha256', $init_vector), 0, 16);
    }

    /**
     * Get the default secret for the application.
     *
     * @return string
     */
    private function getDefaultSecret(): string
    {
        return env('APP_KEY', php_uname());
    }

    /**
     * Encrypt given data.
     *
     * @param string|null $data
     *
     * @return string
     */
    public function encrypt($data = null)
    {
        return base64_encode(
            openssl_encrypt($data, self::ENC_METHOD, $this->key, 0, $this->init_vector)
        );
    }

    /**
     * Decrypt given data.
     *
     * @param string|null $data
     *
     * @return string
     */
    public function decrypt($data = null)
    {
        return openssl_decrypt(
            base64_decode($data), self::ENC_METHOD, $this->key, 0, $this->init_vector
        );
    }
}
