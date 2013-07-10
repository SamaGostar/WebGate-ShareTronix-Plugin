<?php
	
	$this->load_template('header.php');
	
?>
<? if(!empty($D->err)){
			
			echo errorbox("خطا", "مبلغ صحیح نیست یا کمتر از 1000 تومان است", TRUE, 'margin-top:5px;margin-bottom:5px;') ;
			 
			 
			 }
			 ?>
			
<div style="margin:0px auto; font-size:15px; font-weight:bold;color: red; text-align:center;">
<br><br>

برای حمایت از <?= $C->SITE_TITLE ?> به صورت آنلاین میتوانید مبلغ مورد نظر را پرداخت تا اتوماتیک در لیست حامیان قرار گیرید

<br><br><br>
<form action="<?= $C->SITE_URL?>support-zarin" method="post" >
<small style="color:#777777">مبلغ</small> <input type="text" name="amount" style="width:120px"  /><small style="color:#777777"> تومان</small><br>
<small style="color:#777777">ایمیل</small> <input type="text" name="email" style="width:120px"  /><br>
<small style="color:#777777">تلفن تماس</small> <input type="text" name="tel" style="width:120px"  /><br>
<input type="submit" name="zp_on" style="cursor:pointer;padding:4px" value="پرداخت آنلاین زرین پال" />

</form>
</div>



<?php
	
	$this->load_template('footer.php');
	
?>