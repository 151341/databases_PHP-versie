<?php
$profile_image_name = '20200415_151405.jpg';
$profile_image_ext = explode('.', $profile_image_name);
echo $profile_image_ext;
echo '<br>';
foreach ($profile_image_ext as $value) {
    echo "$value <br>";
}

$profile_image_actualext = strtolower(end($profile_image_ext));
echo $profile_image_actualext;
echo '<br>';

$allowed = array('jpg','jpeg','png','pdf');

if (in_array($profile_image_actualext, $allowed)) {
    echo 'allowed';
}
else {
    echo "not allowed";
}
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';

if(array_key_exists('button1', $_POST)) {
	button1();
}
else if(array_key_exists('button2', $_POST)) {
	button2();
}
function button1() {
	echo "This is Button1 that is selected";
}   
function button2() {
	echo "This is Button2 that is selected";
}
?>

	<form method="post">
		<input type="submit" name="button1"
				class="button" value="Button1" />
		
		<input type="submit" name="button2"
				class="button" value="Button2" />
	</form>
