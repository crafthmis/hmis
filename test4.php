<?php
			$expirydate = '03/2013';
			$expirymonth = substr($expirydate, 0, 2);
			$expiryyear = substr($expirydate, 3, 4);
			$expiryday = '01';
			$expirydate = $expiryyear.'-'.$expirymonth.'-'.$expiryday;

			echo $expirydate;
?>