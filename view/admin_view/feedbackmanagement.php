<div>

	<?php	

	if(isset($arrData) && !empty($arrData)){
	?>
	<table>
		<tr>
			<th>
				id
			</th>
			<th>
				Name
			</th>
			<th>
				Email
			</th>
			<th>
				Description
			</th>
		</tr>
	<?php 	
		$i=0;
		foreach($arrData as $value){
		$i++;
	?>
		<tr>
			<td>
				<?php echo $value['id'];?>
			</td>
			
			<td>
				<?php echo $value['name'];?>
			</td>
				<td>
					<?php echo $value['email'];?>
				</td>
				<td>
					<?php echo $value['description'];?>
				</td>
				<td class="text<?php echo $i; ?>">
						<a href="#" onClick="submit(<?php echo $value['id']; ?>)">Reply</a>
				</td>
				
		</tr>
		
	<?php }?>
	</table>
	<?php }?>
	
	
</div>
<script>
	function submit(id){
		$('.text'+id).html('<input type=text name=feed'+id+' id=feed'+id+' /><input type=button value=send onclick=send('+id+'); />');
	}

	function send(id){
		var body= $('#feed'+id).val();
		$.ajax({ 
				type:"POST",
				url: "<?php echo SITE_PATH;?>admin/adminMailSend",
				data: "id="+id+"&body="+body,
				 success: function(response){
					 if(response){
						 alert("Mail Sent");
					 }
					 else{
						 alert("Mail Not Sent");
					 }
				 }
		});
	}
	
</script>