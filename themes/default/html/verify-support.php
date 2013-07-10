<?php
	
	$this->load_template('header.php');
	
?>
	<style>
	#ok{
	background: #38E050;
	font-size: 17px;
	font-weight:bold;
	text-align:center;
	color:#FFFFFF;
	border: solid 2px #388E28;
	-moz-border-radius: 5px;
-webkit-border-radius: 5px;
width:95%;
margin:0px auto;
	}
	

	
	#ok button{
	padding:3px;
	
	cursor:pointer;
	}
	
	
	
	
	#bad{
	background: #FF524E;
	font-size: 17px;
	font-weight:bold;
	text-align:center;
	color:#FFFFFF;
	border: solid 2px #C21F1B;
	-moz-border-radius: 5px;
-webkit-border-radius: 5px;
width:95%;
margin:0px auto;
	}
	

	
	#bad button{
	padding:3px;
	
	cursor:pointer;
	}
	
	</style>
<div class="ttl" style="margin-bottom:8px;">
<div class="ttl2"><h3>نتیجه تراکنش</h3></div></div>
	<?if($D->submit){?>
<div id="ok">
پرداخت موفقیت آمیز بود! <br><br> مبلغ <?= $D->amount ?> واریز شد<br><br>تشکر از حمایت شما
<form action="<?= $C->SITE_URL?>dashboard" method="post">
<br>
<button>پرش به صفحه اصلی</button>
</form>
</div>	
<? }else{ ?>
<div id="bad">
خطا روی داده <br><br> مبلغ <?= $D->amount ?> واریز نشد<br><br>با فشردن دکمه زیر به ما اطلاع دهید.
<form action="<?= $C->SITE_URL?>contacts" method="post">
<br>
<button>تماس با ما</button>
</form>
</div>	

	<? } ?>
	
<?php
	
	$this->load_template('footer.php');
	
?>