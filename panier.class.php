<?php
class panier
{

	public function __construct()
	{

		if (!isset($_SESSION["panier"])) {
			$_SESSION["panier"] = array();
		}
	}

	public function add($product_id)
	{
		if (isset($_SESSION["panier"][$product_id])) {
			$_SESSION["panier"][$product_id] += 1;
		} else {
			$_SESSION["panier"][$product_id] = 1;
		}
	}
	public function del($product_id)
	{
		unset($_SESSION["panier"][$product_id]);
	}
	public function remove($product_id)
	{
		if ($_SESSION["panier"][$product_id] === 1) {
			unset($_SESSION["panier"][$product_id]);
		} else {
			$_SESSION["panier"][$product_id]--;
		}

	}
}

?>