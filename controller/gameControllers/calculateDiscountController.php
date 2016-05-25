<?php
function calculateDiscount($price, $discountPercent) {
	return number_format($price-($price*$discountPercent/100),2);
}
?>