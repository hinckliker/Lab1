<?php
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Regex;

class Employee{

  var $id;
  var $name;
  var $salary;
  var $date;

  function __construct($id,$name,$salary,$date){

    $validator = Validation::createValidator();


    if ($this->validate($id,$validator,[
                        new NotBlank,
                        new Positive(),
                        ]))
    $this->id = $id;
    

    
    if ($this->validate($name,$validator,[
                        new NotBlank(),
                        ]))
      $this->name = $name;

    if ($this->validate($salary,$validator,[ 
                        new GreaterThanOrEqual(['value' => 140]), 
                        ]))
    $this->salary = $salary;

    if ($this->validate($date,$validator,[ 
                        new Regex([
                          'pattern'=>'/[0-3][0-9]\.[0-1][0-9]\.(1[7-9][0-9][0-9]|2[0-2][0-9][0-9])/',
                          'match' => true
                        ]) ]))
    $this->date = date_create_from_format("d.m.Y",$date);
    else
      $this->date = date_create_from_format("d.m.Y",'01.01.1970');
      
    
  }

  
  function validate($item,$validator,$rules)
  {
    $errors = $validator->validate($item,$rules);

    if (count($errors) == 0)
        {
            return true;
        }
        else
        {
            foreach ($errors as $violation)
            {
                echo $violation->getMessage() . '<br>';
            }
          return false;
        }
    
  }
  

  function getTimeJob($readable = true){
    $currentDate = date_create_from_format("d.m.Y",date("d.m.Y"));
    $interval = $this->date->diff($currentDate);
    if ($readable){
    $interval = "Working for " 
      . $interval->y . " years, "
      . $interval->m . " months, "
      . $interval->d . " days ";
    }
    return $interval;
  }
  
}