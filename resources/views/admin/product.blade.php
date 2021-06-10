@extends('layouts.admin_layouts')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Action</h3>
			</div>
			<div class="box-header">
				<button type="button" class="btn btn-default mb-3" data-toggle="modal" data-target="#modal-default">
					Add Product
				</button>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Image</th>
							<th>Nama</th>
							<th>Discount</th>
							<th>Unit</th>
							<th>Stock</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($products as $product)
							<tr>
								<td>{{$product->id}}</td>
								<td>
									<img src="{{asset($product->image)}}" alt="" height="50" width="50" srcset="">	
								</td>
								<td>{{$product->name}}</td>
								<td>{{$product->discount_format}}</td>
								<td>{{$product->unit_format}}</td>
								<td>{{$product->stock}}</td>
								<td>
									<a href="{{route('product.edit', [$product->uuid])}}" type="button" class="btn btn-warning btn-xs deletetransaksi" data-uuid="">Edit</a>
									<form action="{{ route('product.destroy', $product->uuid) }}" method="POST" onsubmit="return confirm('{{'Yakin mau di hapus'}}');" style="display: inline-block;">
                            
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('Delete') }}">
                                    </form>
								</td>
							</tr>
						@empty
							<tr>
								<td class="text-center" colspan="4">
									tidak ada data
								</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
</div>

<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add Kategori</h4>
			</div>
			<form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="modal-body">
					<div class="modal-body row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">Name Product</label>
								<input type="text" class="form-control" name="name" >
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">Regular Price (Rp.)</label>
								<input type="number" class="form-control" name="regular_price" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Discount Type</label>
								<select name="discount_type" class="form-control">
									<option disabled selected>-- Choose Discount --</option>
									<option value="amount">Amount (Rp)</option>
									<option value="percentage">Percentage (%)</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Discount Amount (Rp / %)</label>
								<input type="number" class="form-control" name="discount" value="0" >
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Unit Type</label>
								<select name="unit_type" class="form-control">
									<option disabled selected>-- Choose Unit --</option>
									<option value="kg">Kilogram (Kg)</option>
									<option value="pcs">Piece (Pcs)</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">Unit</label>
								<input type="number" class="form-control" name="unit" value="0" >
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">Stock</label>
								<input type="number" class="form-control" name="stock" >
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">Image Product</label>
								<input type="file" name="product_image" class="form-control">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">Description</label>
								<input type="text" class="form-control" name="description" >
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('js')
<script>
	$(function () {
	  $('#example1').DataTable({
		'paging'      : true,
		'lengthChange': false,
		'searching'   : true,
		'ordering'    : true,
		'info'        : true,
		'autoWidth'   : false
	  })
	})
  </script>
@endsection