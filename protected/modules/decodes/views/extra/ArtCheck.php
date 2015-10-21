<style type="text/css">
	tr:hover {
		background:#ccc;
	}
	td {
		padding:2px 0px;
		border:1px solid #ccc;
	}
	.voice-changed { background:#0f0; }
	.voice-same { background:#ffc; }
</style>
<div style="width:730px; font-size:24px; font-weight:bold; text-align:center; margin:10px 0px 20px 0px;">
	CG Updates for <?php echo date("F j, Y", strtotime($checkdate." 12:00:00")); ?>
</div>
<div>
</div>
<div style="font-size:14px; line-height:18px;">
	<?php if(isset($_REQUEST['scannerz'])){ ?>
	<div id="scannow" style="width:300px; height:30px; background:#cfc; border:2px outset #3c3; margin:10px auto 10px; text-align:center; line-height:30px; font-weight:bold; font-size:20px; cursor:hand; cursor:pointer;">Scan now</div>
	<?php } ?>
	<table border="1" cellpadding="0" cellspacing="0">
		<tr style="background:#eee; font-weight:bold; text-align:center;">
			<td style="width:50px;">ID</td>
			<td style="width:130px;">English</td>
			<td style="width:130px;">Japanese</td>
			<td style="width:250px;">Last Modified</td>
		</tr>
		<?php $JSIDs = array(); foreach($ships as $ship){ if($ship->id<500){ $JSIDs[] = $ship->id; ?>
			<tr>
				<td><?php echo $ship->id; ?></td>
				<td><?php echo $ship->english; ?></td>
				<td><?php echo $ship->name; ?></td>
				<?php $status = "voice-same"; if(isset($changes->{"i".$ship->id}->n2)){ $status = "voice-changed"; } ?>
				<td style="text-align:center;" class="<?php echo $status; ?>" id="v_<?php echo $ship->id; ?>" data-file="<?php echo $graphs[$ship->id]; ?>">
					<em>Pending</em>
				</td>
			</tr>
		<?php }} ?>
	</table>
	<textarea id="jsonout" style="width:730px; height:500px; margin:10px 0px 0px 0px;"></textarea>
</div>
<script type="text/javascript">

var server = "<?php echo (isset($_REQUEST['server']))?$_REQUEST['server']:'203.104.209.71'; ?>";
var ids = <?php echo json_encode($JSIDs); ?>;
var id_index = 0;

var md5compile = {};

var vbox = {};

var dateChecking = "<?php echo $checkdate; ?>";

$(document).on("ready", function(){
	
	$("#scannow").on("click", function(){
		$(this).hide();
		scanNext();
	});
	
	function scanNext(){
		var thisId = ids[id_index];
		
		vbox = $("#v_"+thisId);
		$.ajax({
			url: "<?php echo Yii::app()->createUrl('decodes/extra/LastmodCG'); ?>",
			data: {
				server: server,
				graph: vbox.data("file")
			},
			success: function(response){
				vbox.text(response);
				
				if(typeof md5compile[ "i"+thisId ]=="undefined"){
					md5compile[ "i"+thisId ] = {};
				}
				
				if(response==dateChecking){
					vbox.css("background", "#0f0");
					md5compile[ "i"+thisId ] = 1;
				}else{
					vbox.css("background", "#fcc");
				}
				
				$("#jsonout").val(JSON.stringify(md5compile));
				
				id_index++;
				scanNext();
			}
		});
	}
	
});
</script>