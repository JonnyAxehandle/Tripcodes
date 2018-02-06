<?php
/**
 * Created by PhpStorm.
 * User: Jonny
 * Date: 2/6/2018
 * Time: 4:39 AM
 */

namespace AxehandleUnlimited\Tripcodes\Tests;

use AxehandleUnlimited\Tripcodes\TripcodeEncryptor;
use PHPUnit\Framework\TestCase;

class TripcodeEncryptorTest extends TestCase
{

    const DEMO_SALT = "axehandleunlimited.org";

    public function testNothingToEncrypt()
    {
        $input = "Username";
        $encryptor = new TripcodeEncryptor(self::DEMO_SALT, 10);
        $this->assertEquals($input, $encryptor->encrypt($input));
    }

    public function testEncrypt()
    {
        $input = "Username#Password";
        $encryptor = new TripcodeEncryptor(self::DEMO_SALT, 10);
        $this->assertEquals("Username!daa25590f2", $encryptor->encrypt($input));
    }

}
