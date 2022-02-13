<div> 
	<button type="button" class="filter_user_comments btn btn-primary" id="filter_user_comments">Filter</button>
	<table class="all_comments table">
		<?php 
		if( !empty( $comment) ) {
			foreach($comment as $key => $value ) {
				echo'<tr class="user_comments_'.$value['user_id'].'"><td class="user_email">'.$value["user_email"].'</td>';
				echo'<td class="user_comments"><textarea class="form-control"  rows="2" id="comment">'.$value['user_comments'].'</textarea> </td></tr>';
			}
		} ?>
	</table>
	<script >
		jQuery(function(){
			var urls = '<?php echo base_url(); ?>';
			
			jQuery("#filter_user_comments").click(function(){
				var _this = jQuery(this);
				jQuery(this).text('processing');
				jQuery.ajax({
					type: "POST",
			        url: urls+"dashboard/user_filter_comments",
			        success:function(data) {
			        	var response = JSON.parse(data);
			        	console.log(response.type);
			        	if( response.type == 'success' ) {
			        		jQuery(_this).text('Filter');
			        		jQuery('table.all_comments tbody tr').each(function(){
			        			jQuery(this).hide();
			        		})
			        		jQuery.each(response.comment,function(k,v){
			        			jQuery(".user_comments_"+v.user_id).show();

			        		})
			        	}
			        }
				});
			});
		});
	</script>
</div>