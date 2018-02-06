<?php
/**
 * Created by PhpStorm.
 * User: Jonny
 * Date: 2/6/2018
 * Time: 4:29 AM
 */

namespace AxehandleUnlimited\Tripcodes;

class TripcodeEncryptor
{

    /**
     * @var string Salt for encrypting codes
     */
    private $salt;

    /**
     * @var int Encryption strength
     */
    private $strength;

    /**
     * TripcodeEncryptor constructor.
     * @param string $salt Salt for encrypting codes
     * @param int $strength Encryption strength
     */
    public function __construct($salt, $strength)
    {
        $this->salt = $salt;
        $this->strength = $strength;
    }

    /**
     * @param string $input
     * @return string
     */
    public function encrypt(string $input): string
    {
        if (stripos($input, "#") === false) {
            return $input;
        }

        list($username, $password) = explode("#", $input, 2);

        $tripCode = password_hash(
            $password,
            PASSWORD_BCRYPT,
            [
                'salt' => $this->salt,
                'cost' => $this->strength
            ]
        );

        $tripCode = md5($tripCode);
        $tripCode = substr($tripCode, -10, 10);

        return "{$username}!{$tripCode}";
    }

}
