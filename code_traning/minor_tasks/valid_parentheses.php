<?php

class Solution {

    /**
     * @param String $s
     * @return Boolean
     */
    function isValid($s) {
        for ($i = 0; $i < strlen($s) - 1; $i++) {
            if (
                ($s[$i] === '(' && $s[$i + 1] === ')') ||
                ($s[$i] === '{' && $s[$i + 1] === '}') ||
                ($s[$i] === '[' && $s[$i + 1] === ']')
            ) {
                $s = substr_replace($s, '', $i, 2);
                $i -= 2;
            }
        }
        return empty($s);
    }
}

echo (new Solution())->isValid('()') ? 'true' : 'false';
echo "\n";

class Solution2 extends Solution
{

}

interface PayInterface
{
    /**
     * @param int $cash денежные средства для отправки
     */
    public function send(int $cash);
}

abstract class Pay implements PayInterface
{
    private string $connect;
    // public function send(int $cash)
    // {
    //     echo "Apple Pay: $cash\n";
    // }
}

class ApplePay extends Pay
{
    public function send(int $cash)
    {
        echo "Apple Pay: $cash\n";
    }
}

interface GooglePayInterface extends PayInterface
{
    public function send(int $cash);

    /**
     * @param string $text сообщение для отправки
     */
    public function message(string $text);
}


class GooglePay extends Pay implements GooglePayInterface
{
    public function send(int $cash)
    {
        $this->connect();
        echo "Google Pay: $cash\n";
    }

    public function message(string $text)
    {
        echo "Google Pay Message: $text\n";
    }
    
    private function connect()
    {
        echo "Google Pay: Connect\n";
    }

}

$googlePay = new GooglePay();
$googlePay->send(100);
$googlePay->message('Hello, Google Pay!');
// $googlePay->connect(); // Ошибка: метод connect() недоступен, так как он объявлен как private

class Gpay extends GooglePay
{
    public function send(int $cash)
    {
        $this->connect(); // Ошибка: метод connect() недоступен, так как он объявлен как private в классе GooglePay
        echo "Gpay: $cash\n";
    }
}
