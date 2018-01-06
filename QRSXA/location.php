<?php
require_once("connection.php");
if(!empty($_POST["keyword"])) {
$query ="SELECT * FROM country WHERE country_name like '" . $_POST["keyword"] . "%' ORDER BY country_name LIMIT 0,6";
$result =mysqli_query($query);
if(!empty($result)) {
?>
<ul id="country-list">
<?php
foreach($result as $country) {
?>
<li onClick="selectCountry('<?php echo $country["country_name"]; ?>');"><?php echo $country["country_name"]; ?></li>
<?php } ?>
</ul>
<?php } } ?>