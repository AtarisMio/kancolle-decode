<div class="lastUpdate" style="font-size:40px; margin:40px 0px 30px 0px; text-align:center;"></div>
<div class="dateNow" style="font-size:12px; text-align:center;">Date now: <?php echo date('Y-m-d');?></div>

<script type="text/javascript">
var dateNow = "<?php echo date('Y-m-d');?>";
setInterval(checkhead, 5000);
checkhead();

function checkhead(){
	$.ajax({
		url: "<?php echo Yii::app()->createUrl('decodes/extra/LastmodCG'); ?>",
		data: {
			graph: "<?php echo $filename; ?>"
		},
		success: function(response){
			$(".lastUpdate").hide();
			$(".lastUpdate").text(response);
			if(dateNow == response){
				$(".lastUpdate").css("background", "#0f0");
			}
			$(".lastUpdate").fadeIn();
		}
	});
}
</script>