<?php
require_once(__DIR__ . "/../../partials/nav.php");
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function do_bank_action($account1, $account2, $amountChange, $type){
	/*require("config.php");
	$conn_string = "mysql:host=$host;dbname=$database;charset=utf8mb4";
	$db = new PDO($conn_string, $username, $password);*/
	$a1total = 0;//TODO get total of account 1
	$a2total = 0;//TODO get total of account 2
	$query = "INSERT INTO `Transactions` (`AccountSource`, `AccountDest`, `Amount`, `Type`, `Total`) 
	VALUES(:p1a1, :p1a2, :p1change, :type, :a1total), 
			(:p2a1, :p2a2, :p2change, :type, :a2total)";
	
	$stmt = $db->prepare($query);
	$stmt->bindValue(":p1a1", $account1);
	$stmt->bindValue(":p1a2", $account2);
	$stmt->bindValue(":p1change", $amountChange*-1);
	$stmt->bindValue(":type", $type);
	$stmt->bindValue(":a1total", $a1total);
	//flip data for other half of transaction
	$stmt->bindValue(":p2a1", $account2);
	$stmt->bindValue(":p2a2", $account1);
	$stmt->bindValue(":p2change", ($amountChange));
	$stmt->bindValue(":type", $type);
	$stmt->bindValue(":a2total", $a2total);
	$result = $stmt->execute();
	echo var_export($result, true);
	echo var_export($stmt->errorInfo(), true);
	return $result;
}
?>
<h1>Transaction (<?php se($_GET, "type", "Not set"); ?>)</h1>
<form method="POST">
    <select name="user_account">
        <?php foreach ($accounts as $account) : ?>
            <option value="<?php se($account, 'id'); ?>"><?php se($account, "account_number"); ?></option>
        <?php endforeach; ?>
    </select>
    <input type="number" name="change" />
    <input type="submit" value="Save" class="btn btn-info" />
</form>

<?php
require_once(__DIR__ . "/../../partials/flash.php");
?>