<div style="word-wrap:break-word;">
<?php echo $url; ?>
</div>
<hr />
detected: <?php echo $detected; ?><br />
ignored: <?php echo $ignored; ?><br />
newscans: <?php echo $newscans; ?><br />
failed: <?php echo $failed; ?><br />
passed: <?php echo $passed; ?><br />
bot_scan: <?php echo $scanrecord; ?><br />
report_build: <?php echo $reportsOK; ?><br />
<hr />

<?php for($i=96; $i<110; $i++){ ?>
	<a href="?url=<?php echo urlencode('http://wikiwiki.jp/kancolle/?cmd=read&page=%A5%B3%A5%E1%A5%F3%A5%C8%2F%C2%E7%B7%BF%B4%CF%B7%FA%C2%A4%2F%A5%EC%A5%B7%A5%D4%A5%ED%A5%B0'.$i); ?>"><?php echo $i; ?></a>&nbsp;&nbsp;&nbsp;
<?php } ?>

<hr />

<form action="">
<textarea name="url" style="width:500px; height:100px;"></textarea><br />
<input type="submit" />
</form>