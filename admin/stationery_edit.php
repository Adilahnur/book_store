<?php include('db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- Table Panel -->
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<b>Stationeries</b>
						<span class="float:right"><a class="btn btn-primary btn-sm col-sm-3 float-right" href="javascript:void(0)" id="new_stationery">
			                    <i class="fa fa-plus"></i> New 
			                </a></span>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<colgroup>
								<col width="5%">
								<col width="15%">
								<col width="30%">
								<col width="20%">
								<col width="15%">
								<col width="15%">
							</colgroup>
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">IMG</th>
									<th class="text-center">Details</th>
									<th class="text-center">Category</th>
									<th class="text-center">Price</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$cname[0] = "Not Set";
								$categories = $conn->query("SELECT * FROM categories ");
								while($row = $categories->fetch_assoc()){
									$cname[$row['id']] = ucwords($row['name']);
								}
								$stationery = $conn->query("SELECT * from stationery order by item asc");
								while($row=$stationery->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="">
										<div class="d-flex w-100">
					    					<div class="img-field mr-4 img-thumbnail rounded">
					    						<img src="assets/uploads/<?php echo $row['image_path'] ?>"  alt="" class="img-fluid rounded">
					    					</div>
										</div>
									</td>
									<td class="">
										<p>item name <b><?php echo $row['item'] ?></b></p>
										<p><small>Id: <b><?php echo $row['id'] ?></b></small></p>
			
									</td>
									<td class="">
										<p>
											<b>
											<?php 
											$cats = '';
											$cat = explode(',', $row['category_ids']);
											foreach ($cat as $key => $value) {
												if(!empty($cats)){
													$cats .=", ";
												}
												if(isset($cname[$value])){
													$cats .= $cname[$value];
												}
											}
											echo $cats;
											?>
											</b>
										</p>
									</td>
									<td class="">
										<p class="text-right"><b><?php echo number_format($row['price'],2) ?></b></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_stationery" type="button" data-id="<?php echo $row['id'] ?>">Edit</button>
										<button class="btn btn-sm btn-danger delete_stationery" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p {
		margin:unset;
	}
	.custom-switch{
		cursor: pointer;
	}
	.custom-switch *{
		cursor: pointer;
	}
	.img-field{
		width: calc(100%);
		height: 15vh;
		overflow: hidden;
		display: flex;
		justify-content: center
	}

	.img-field img{
		max-width: 100%;
		max-height: 100%;
	}
	/*.img img{
		max
	}*/
</style>
<script>
	$('#new_stationery').click(function(){
		uni_modal("New stationery","manage_stationery.php","mid-large")
	})
	$('.edit_stationery').click(function(){
		uni_modal("Manage stationery Data","manage_stationery.php?id="+$(this).attr('data-id'),"mid-large")
	})
	$('#manage-stationery').on('reset',function(){
		$('input:hidden').val('')
		$('.select2').val('').trigger('change')
	})
	
	$('#manage-stationery').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_stationery',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$('.delete_stationery').click(function(){
		_conf("Are you sure to delete this stationery?","delete_stationery",[$(this).attr('data-id')])
	})
	function delete_stationery($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_stationery',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
	$('table').dataTable()
</script>