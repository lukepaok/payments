<?php
session_start();

function f_CheckAFM($AFM) {
  extract($GLOBALS);
  $Validation='';
  $a=substr($AFM,0,1);
  $b=substr($AFM,1,1);
  $c=substr($AFM,2,1);
  $d=substr($AFM,3,1);
  $e=substr($AFM,4,1);
  $f=substr($AFM,5,1);
  $g=substr($AFM,6,1);
  $h=substr($AFM,7,1);
  $i=substr($AFM,8,1);
  if (strlen($AFM)<>9) { $Validation="� ��� ��� ���� 9 �����"; }
  elseif (ord($a)<48 || ord($a)>57) { $Validation="To 1� ����� ��� ����� �������"; }
  elseif (ord($b)<48 || ord($b)>57) { $Validation="To 2� ����� ��� ����� �������"; }
  elseif (ord($c)<48 || ord($c)>57) { $Validation="To 3� ����� ��� ����� �������"; }
  elseif (ord($d)<48 || ord($d)>57) { $Validation="To 4� ����� ��� ����� �������"; }
  elseif (ord($e)<48 || ord($e)>57) { $Validation="To 5� ����� ��� ����� �������"; }
  elseif (ord($f)<48 || ord($f)>57) { $Validation="To 6� ����� ��� ����� �������"; }
  elseif (ord($g)<48 || ord($g)>57) { $Validation="To 7� ����� ��� ����� �������"; }
  elseif (ord($h)<48 || ord($h)>57) { $Validation="To 8� ����� ��� ����� �������"; }
  elseif (ord($i)<48 || ord($i)>57) { $Validation="To 9� ����� ��� ����� �������"; }
  else {
    $CompAFM=256*$a+128*$b+64*$c+32*$d+16*$e+8*$f+4*$g+2*$h;
    $CheckAFM=$CompAFM % 11;
    if ($CheckAFM==10){ if ($i<>0){ $Validation="�� ������ ���"; } }
    else { if ($i<>$CheckAFM){ $Validation="�� ������ ���"; } }
  }
  return $Validation;
}

?>