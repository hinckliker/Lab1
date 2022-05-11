<?php

require_once __DIR__.'/Employee.php';
require_once __DIR__.'/Department.php';
require_once __DIR__.'/vendor/autoload.php';

function minMax($departments, $max)
{
    $sort = $departments;
    for ($i = 0; $i < count($departments); ++$i) {
        for ($j = $i; $j < count($departments); ++$j) {
            if ($sort[$i]->sumSalary() > $sort[$j]->sumSalary()) {
                $swap = $sort[$i];
                $sort[$i] = $sort[$j];
                $sort[$j] = $swap;
            }
        }
    }

    for ($i = 0; $i < count($sort); ++$i) {
        for ($j = $i; $sort[$i]->sumSalary() == $sort[$j]->sumSalary(); ++$j) {
            if ($sort[$i]->staffCount() > $sort[$j]->staffCount()) {
                $swap = $sort[$i];
                $sort[$i] = $sort[$j];
                $sort[$j] = $swap;
            }
            if ($j + 1 == count($sort)) {
                break;
            }
        }
    }
    $ind = 0;
    $step = 1;
    if ($max) {
        $ind = count($sort) - 1;
        $step = -1;
    }
    $i = 0;
    $res[$i] = $sort[$ind];
    while ($sort[$ind]->sumSalary() == $sort[$ind + $step]->sumSalary() &&
       $sort[$ind]->staffCount() == $sort[$ind + $step]->staffCount()) {
        $ind += $step;
        $res[$i] = $sort[$ind];
        ++$i;
    }

    return $res;
}

  $emp = new Employee(1, 'jhon', 50, '12.02.1998');
  $emp2 = new Employee(2, 'ivan', 200, '14.12.2002');

  $depMax = rand(2,5);
  for ($j = 0; $j < $depMax; ++$j) {
      for ($i = 0; $i < rand(1,10); ++$i) {
          $emp1[$i] = new Employee($i + $j*10,
                             'jhon the '.$j * 10 + $i,
                             rand(150, 2000),
                             '12.02.1998');
      }
      $dep[$j] = new Deparment($j, $emp1);
  }

echo 'All <br>';
foreach ($dep as $item) {
    echo $item->toString().'<br>';
}

echo 'Max <br>';
foreach (minMax($dep, true) as $item) {
    echo $item->toString().'<br>';
}

echo 'Min <br>';
foreach (minMax($dep, false) as $item) {
    echo $item->toString().'<br>';
}

// echo $emp->getTimeJob();
