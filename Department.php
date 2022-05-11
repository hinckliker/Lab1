<?php

require_once(__DIR__ . "/Employee.php");

class Deparment
{
    public $staff;
    public $name;

    public function __construct($name, $staff)
    {
        $this->staff = $staff;
        $this->name = $name;
    }

    public function staffCount()
    {
        return count($this->staff);
    }


    public function sumSalary()
    {
        $sum = 0;
        foreach ($this->staff as $item) {
            $sum += $item->salary;
        }
        return $sum;
    }

    public function toString()
    {
        $str = 'Deparment "' . $this->name .  '"<br>';

        foreach ($this->staff as $item) {
            $str .= 'Name:' . $item->name
        .' Salary:' . $item->salary
        .' Expirence:'. $item->getTimeJob() . '<br>';
        }
        $str .= 'Total salary:' . $this->sumSalary();
        return $str;
    }
}