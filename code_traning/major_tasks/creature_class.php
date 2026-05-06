<?php

class Person
{
    public string $name;
    public string $surname;
    public int $age;
}

$person = new Person();
$person->name = 'John';
$person->surname = 'Doe';
$person->age = 30;

echo $person->name . ' ' . $person->surname . ' is ' . $person->age . ' years old.';
echo "\n";


class Student extends Person
{
    public string $student_id;
}

$student = new Student();
$student->name = 'Mary';
$student->surname = 'Smith';
$student->age = 20;
$student->student_id = 'S12345';

echo $student->name . ' ' . $student->surname . ' is ' . $student->age . ' years old. Student ID: ' . $student->student_id;
echo "\n"; 


class BankAccount {
    private $account_number;
    private $balance;

    public function get_balance() {
        return $this->balance;
    }

    public function deposit($amount) {
        $this->balance += $amount;
    }

    public function withdraw($amount) {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;
        }
    }
}

$account = new BankAccount();
$account->deposit(1000);
$account->withdraw(200);
echo 'Account Balance: ' . $account->get_balance() . "\n";