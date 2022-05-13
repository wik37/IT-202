<?php

function add_to_cart($item_id, $user_id, $quantity, $price)
{
    error_log("add_item() Item ID: $item_id, User_id: $user_id, Quantity $quantity");
    //I'm using negative values for predefined items so I can't validate >= 0 for item_id
    if (/*$item_id <= 0 ||*/$user_id <= 0 || $quantity === 0) {
        
        return;
    }
    $db = getDB();

    $stmt = $db->prepare("INSERT INTO Cart (product_id, user_id, desired_quantity, unit_cost) VALUES (:iid, :uid, :q, :cost) ON DUPLICATE KEY UPDATE desired_quantity = desired_quantity + :q");
    try {
        //if using bindValue, all must be bind value, can't split between this an execute assoc array
        $stmt->bindValue(":q", $quantity, PDO::PARAM_INT);
        $stmt->bindValue(":iid", $item_id, PDO::PARAM_INT);
        $stmt->bindValue(":uid", $user_id, PDO::PARAM_INT);
        $stmt->bindValue(":cost", $price, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log("Error adding $quantity of $item_id to user $user_id: " . var_export($e->errorInfo, true));
    }
    return false;
}