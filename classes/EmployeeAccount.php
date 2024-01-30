<?php

class EmployeeAccount
{
    use Validation;
    /**
     * @var int
     */
    private int $accountNumber;

    /**
     * @var int
     */
    private int $accountBalance;

    /**
     * @param int $accountNumber
     * @param int $accountBalance
     * @throws Exception
     */
    public function __construct(int $accountNumber, int $accountBalance)
    {
        $this->setAccountBalance($accountBalance);
        $this->setAccountNumber($accountNumber);
    }


    /**
     * @param int $value
     * @return void
     * @throws Exception
     */
    public function addMoney(int $value): void
    {
        $balance = $this->getAccountBalance();
        $newBalance = $this->changeBalance($balance, $value);
        $this->setAccountBalance($newBalance);

    }

    /**
     * @param int $value
     * @return void
     * @throws Exception
     */
    public function withdrawMoney(int $value): void
    {
        $balance = $this->getAccountBalance();
        $newBalance = $this->changeBalance($balance, $value, false);
        $this->setAccountBalance($newBalance);
    }

    /**+
     * @return int
     */
    public function showBalance():int
    {
        return $this->getAccountBalance();
    }

    /**
     * @return int
     */
    public function showAccountNumber():int
    {
        return $this->getAccountNumber();
    }

    /**
     * @return int
     */
    private function getAccountBalance(): int
    {
        return $this->accountBalance;
    }

    /**
     * @param int $accountBalance
     * @return void
     * @throws Exception
     */
    private function setAccountBalance(int $accountBalance): void
    {
        $validated = $this->min($accountBalance, 0);
        if (!$validated) {
            throw new Exception('Account balance can not be lower than zero');
        }
        $this->accountBalance = $accountBalance;
    }

    /**
     * @return int
     */
    private function getAccountNumber(): int
    {
        return $this->accountNumber;
    }

    /**
     * @param int $accountNumber
     * @return void
     * @throws Exception
     */
    private function setAccountNumber(int $accountNumber): void
    {
        $length = strlen((string)$accountNumber);
        if (!$this->min($length, 8) || !$this->max($length, 8)) {
            throw new Exception('Account number must contain 8 numeric characters');
        }
        $this->accountNumber = $accountNumber;
    }

    /**
     * @param int $balance
     * @param int $value
     * @param bool $flag
     * @return int
     * @throws Exception
     */
    private function changeBalance(int $balance, int $value, bool $flag = true): int
    {
        if ($flag) {
            $balance += $value;
            return $balance;
        } elseif ($value > $balance) {
            throw new Exception('You don\'t have enough money');
        }
        $balance -= $value;
        return $balance;
    }
}