<?php

/*
 * $Id: number.php, v 1.2
 * The Simple Lottery Checker
 * @author Andrzej Kałowski
 * @link http://lotek.kalowski.com
 */

include_once('init.php');
include(DIR_CONF.FILE_DB);

if (isset($_POST['loadNumbers'])){
	$Transfer->setInfo('loadNumb', $_POST['loadNumbers']);
	$AccountSpace->loadNumbers($Transfer->getInfo('loadNumb'));

	$Transfer->setInfo('cNumber1', $AccountSpace->numbersWhenId[0]);
	$Transfer->setInfo('cNumber2', $AccountSpace->numbersWhenId[1]);
	$Transfer->setInfo('cNumber3', $AccountSpace->numbersWhenId[2]);
	$Transfer->setInfo('cNumber4', $AccountSpace->numbersWhenId[3]);
	$Transfer->setInfo('cNumber5', $AccountSpace->numbersWhenId[4]);
	$Transfer->setInfo('cNumber6', $AccountSpace->numbersWhenId[5]);

if (!isset($_SESSION['visibility'])) $_SESSION['visibility'] = '';
	$_SESSION['visibility'] = false;

} else {
	
if (!isset($_SESSION['visibility'])) $_SESSION['visibility'] = '';
	$_SESSION['visibility'] = true;
}

if(isset($_POST['numSubmit'])){

	$Transfer->setInfo('cNumber1', $_POST['chosenNumber1']);
	$Transfer->setInfo('cNumber2', $_POST['chosenNumber2']);
	$Transfer->setInfo('cNumber3', $_POST['chosenNumber3']);
	$Transfer->setInfo('cNumber4', $_POST['chosenNumber4']);
	$Transfer->setInfo('cNumber5', $_POST['chosenNumber5']);
	$Transfer->setInfo('cNumber6', $_POST['chosenNumber6']);

	$Transfer->setInfo('dNumber1', $_POST['drawnNumber1']);
	$Transfer->setInfo('dNumber2', $_POST['drawnNumber2']);
	$Transfer->setInfo('dNumber3', $_POST['drawnNumber3']);
	$Transfer->setInfo('dNumber4', $_POST['drawnNumber4']);
	$Transfer->setInfo('dNumber5', $_POST['drawnNumber5']);
	$Transfer->setInfo('dNumber6', $_POST['drawnNumber6']);

	$Transfer->setInfo('numberId', '');

if($Authorization->logStatus() == TRUE) {
	$Transfer->setInfo('chNumberName', $_POST['chosenNumberName']);
}
if (!isset($userId)) $userId = '';
if (!isset($numberId)) $numberId = '';
if (!isset($devices)) $devices = '';

if($_POST['chosenNumber1'] == '' || $_POST['chosenNumber2'] == '' || $_POST['chosenNumber3'] == '' || $_POST['chosenNumber4'] == '' || $_POST['chosenNumber5'] == '' || $_POST['chosenNumber6'] == ''){
	$Transfer->setColourAlert($Languages->translator('ENTER_ALL_NUMBER'),'redColour');
	$Transfer->loadLink("views/number_v.php");
	 
}else if($_POST['drawnNumber1'] == '' || $_POST['drawnNumber2'] == '' || $_POST['drawnNumber3'] == '' || $_POST['drawnNumber4'] == '' || $_POST['drawnNumber5'] == '' || $_POST['drawnNumber6'] == ''){
	$Transfer->setColourAlert($Languages->translator('ENTER_ALL_NUMBER'),'redColour');
	$Transfer->loadLink("views/number_v.php");

} else if (!preg_match('^[0-9]{1,}$^', $Transfer->getInfo('cNumber1'))){
	$Transfer->setColourAlert($Languages->translator('CORRECT_FIRST_CHOSEN_NUMBER'),'redColour');        
	$Transfer->loadLink("views/number_v.php");

} else if (!preg_match('^[0-9]{1,}$^', $Transfer->getInfo('cNumber2'))){
	$Transfer->setColourAlert($Languages->translator('CORRECT_SECOND_CHOSEN_NUMBER'),'redColour');        
	$Transfer->loadLink("views/number_v.php");
	
} else if (!preg_match('^[0-9]{1,}$^', $Transfer->getInfo('cNumber3'))){
	$Transfer->setColourAlert($Languages->translator('CORRECT_THIRD_CHOSEN_NUMBER'),'redColour');        
	$Transfer->loadLink("views/number_v.php");
	
} else if (!preg_match('^[0-9]{1,}$^', $Transfer->getInfo('cNumber4'))){
	$Transfer->setColourAlert($Languages->translator('CORRECT_FOURTH_CHOSEN_NUMBER'),'redColour');        
	$Transfer->loadLink("views/number_v.php");
	
} else if (!preg_match('^[0-9]{1,}$^', $Transfer->getInfo('cNumber5'))){
	$Transfer->setColourAlert($Languages->translator('CORRECT_FIFTH_CHOSEN_NUMBER'),'redColour');        
	$Transfer->loadLink("views/number_v.php");
	
} else if (!preg_match('^[0-9]{1,}$^', $Transfer->getInfo('cNumber6'))){
	$Transfer->setColourAlert($Languages->translator('CORRECT_SIXTH_CHOSEN_NUMBER'),'redColour');        
	$Transfer->loadLink("views/number_v.php");

} else if (!preg_match('^[0-9]{1,}$^', $Transfer->getInfo('dNumber1'))){
	$Transfer->setColourAlert($Languages->translator('CORRECT_FIRST_DRAWN_NUMBER'),'redColour');        
	$Transfer->loadLink("views/number_v.php");
 
} else if (!preg_match('^[0-9]{1,}$^', $Transfer->getInfo('dNumber2'))){
	$Transfer->setColourAlert($Languages->translator('CORRECT_SECOND_DRAWN_NUMBER'),'redColour');        
	$Transfer->loadLink("views/number_v.php");
	
} else if (!preg_match('^[0-9]{1,}$^', $Transfer->getInfo('dNumber3'))){
	$Transfer->setColourAlert($Languages->translator('CORRECT_THIRD_DRAWN_NUMBER'),'redColour');        
	$Transfer->loadLink("views/number_v.php");
	
} else if (!preg_match('^[0-9]{1,}$^', $Transfer->getInfo('dNumber4'))){
	$Transfer->setColourAlert($Languages->translator('CORRECT_FOURTH_DRAWN_NUMBER'),'redColour');        
	$Transfer->loadLink("views/number_v.php");
	
} else if (!preg_match('^[0-9]{1,}$^', $Transfer->getInfo('dNumber5'))){
	$Transfer->setColourAlert($Languages->translator('CORRECT_FIFTH_DRAWN_NUMBER'),'redColour');        
	$Transfer->loadLink("views/number_v.php");
	
} else if (!preg_match('^[0-9]{1,}$^', $Transfer->getInfo('dNumber6'))){
	$Transfer->setColourAlert($Languages->translator('CORRECT_SIXTH_DRAWN_NUMBER'),'redColour');        
	$Transfer->loadLink("views/number_v.php");

} else if (($Authorization->logStatus() == TRUE) && ($_POST['chosenNumberName'] != '')) {
	$AccountSpace->remember($Transfer->getInfo('numberId'), $Transfer->getInfo('chNumberName'), $Transfer->getInfo('cNumber1'), $Transfer->getInfo('cNumber2'), $Transfer->getInfo('cNumber3'), $Transfer->getInfo('cNumber4'), $Transfer->getInfo('cNumber5'), $Transfer->getInfo('cNumber6'));
	$Transfer->setColourAlert($Languages->translator('NAME_SAVED'),'greenColour');
	$Transfer->setInfo('chNumberName', '');
	$AccountSpace->numbersToUsers($AccountSpace->numberId, $AccountSpace->usersId($userId));
	$Transfer->loadLink("views/number_v.php");	

} else {
					
	$cNumbers = array($Transfer->getInfo('cNumber1'), $Transfer->getInfo('cNumber2'), $Transfer->getInfo('cNumber3'), $Transfer->getInfo('cNumber4'), $Transfer->getInfo('cNumber5'), $Transfer->getInfo('cNumber6'));
	$dNumbers = array($Transfer->getInfo('dNumber1'), $Transfer->getInfo('dNumber2'), $Transfer->getInfo('dNumber3'), $Transfer->getInfo('dNumber4'), $Transfer->getInfo('dNumber5'), $Transfer->getInfo('dNumber6'));

echo '<div class="row">';
	echo '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">';
	echo '</div>';

	echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 tL">';	
		echo '<table><td class="numberGreyText tL">';
			foreach ($cNumbers as $cNumber => $cValue) {
				echo $cNumber+1 . $Languages->translator('CHOSEN_NUMBER') . '&nbsp' . '<span class="numberBrownText">' . $cValue . '</span>' . '<br>';	
			}
		echo '</td></table>';		
	echo '</div>';

	echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 tR">';
		echo '<table><td class="numberGreyText tL">';
			foreach ($dNumbers as $dNumber => $dValue) {
				echo $dNumber+1 . $Languages->translator('DRAWN_NUMBER') . '&nbsp' . '<span class="numberGreenText">' . $dValue . '</span>' . '<br/>';	
			}
		echo '</td></table>';	
	echo '</div>';

	echo '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">';
	echo '</div>';
echo '</div>';

echo '<div class="row">';
	echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-3">';
	echo '</div>';

	echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 tCnt">';	
		$outcome = array();
		$guessFactor = 0;	
		foreach ($cNumbers as $cNumber => $cValue) {
			foreach ($dNumbers as $dNumber => $dValue) {
				if ($cValue == $dValue){
					array_push($outcome, $cValue);
					$guessFactor++;
				}
			}
		}
		echo '<div class="emptySpaceXH"></div><span class="numberGreyText tCnt emptySpaceH">' . $Languages->translator('SORT_LUCKY_NUMBERS') . '</span><div class="emptySpaceH"></div>';
			$sortOutcome = array();
			$sortOutcome = $outcome;
			sort($sortOutcome);
		foreach($sortOutcome as $sortcValue){
			echo '&nbsp' . '<span class="numberRedText tCnt">' . $sortcValue . '</span>' . '&nbsp'; //sorted outcome
		}	
		echo '<div class="emptySpaceH"></div>';
		echo '<p class="numberGreyText tCnt">' . $Languages->translator('YOU_HAVE') . '<span class="numberOrangeText">' . $guessFactor . '</span>' . $Languages->translator('GUESS') . '</p>';
	echo '</div>';

	echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-3">';
	echo '</div>';
echo '</div>';
	}

} else {
	$Transfer->loadLink("views/number_v.php");
}