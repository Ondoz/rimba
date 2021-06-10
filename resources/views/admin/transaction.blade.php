@extends('layouts.admin_layouts')
@section('content')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Order Page</h3>
	</div>
	<div class="box-header">
		<button type="button" class="btn btn-default mb-3" data-toggle="modal" data-target="#modal-default">
			Add Order
		</button>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Number Order</th>
					<th>Name</th>
					<th>Email</th>
					<th>Products</th>
					<th>Total</th>
					<th>Action	</th>
				</tr>
			</thead>
			<tbody>
				@foreach($transactions as $key => $transaction)
				<tr data-entry-id="{{ $transaction->id }}">
					<td>
						{{$transaction->order_number}}
					</td>
					<td>
						{{ $transaction->user->name ?? '' }}
					</td>
					<td>
						{{ $transaction->user->email ?? '' }}
					</td>
					<td>
						<ul>
						@foreach($transaction->transaction_item as $key => $item)
							<li>{{ $item->product->name }} ({{ $item->qty }} x {{ $item->product->after_price_regular_format }})</li>
						@endforeach
						</ul>
					</td>
					<td>
						{{'Rp ' . number_format($transaction->total)}}
					</td>
					<td>
						<a href="#" type="button" class="btn btn-warning btn-xs deletetransaksi" data-uuid="">Edit</a>
						
						<form action="#" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="submit" class="btn btn-xs btn-danger" value="{{ 'Delete' }}">
						</form>
					</td>
				</tr>
			@endforeach
		</table>
	</div>
	<!-- /.box-body -->
</div>

<div class="modal fade" id="modal-default">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add Customer</h4>
			</div>

			<form action="{{route('order.store')}}" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					@csrf

					@foreach (old('users', ['']) as $index => $oldUser)
					<div class="form-group">
						<label for="">Customer</label>
						<select name="users" class="form-control">
							<option value="">-- choose cutomer --</option>
							@foreach ($users as $user)
								@if ($user->id != auth()->id())
									<option value="{{ $user->id }}"{{ $oldUser == $user->id ? ' selected' : '' }}>
										{{ $user->name }}
									</option>
								@endif
							@endforeach
						</select>
					</div>
					@endforeach
				
					<div class="card">
		
						<div class="card-body">
							<table class="table" id="products_table">
								<thead>
									<tr>
										<th>Product <br> <span style=" font-weight: normal;">Harga Di Product Sudah Termasuk Potongan Discount</span> </th>
										<th>Quantity</th>
									</tr>
								</thead>
								<tbody>
									@foreach (old('products', ['']) as $index => $oldProduct)
										<tr id="product{{ $index }}" class="tester" data-index="{{$index}}">
											<td>
												<select name="products[]" class="form-control selectProduct" data-index="">
													<option value="">-- choose product--</option>
													@foreach ($products as $product)
														<option value="{{ $product->uuid }}" {{ $oldProduct == $product->id ? ' selected' : '' }}>
															{{ $product->name }} ({{($product->after_price_regular_format)}})
														</option>
													@endforeach
												</select>
											</td>
											<td>
												<input type="number" name="qty[]" class="form-control" value="{{ old('qty.' . $index) ?? '1' }}" />
											</td>
										</tr>
									@endforeach
									<tr id="product{{ count(old('products', [''])) }}" class="tester" data-index="{{ count(old('products', [''])) }}"></tr>
								</tbody>
							</table>
		
							<div class="row">
								<div class="col-md-12">
									<button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
									<button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					
					<div>
						<input class="btn btn-primary" type="submit" value="Save">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('js')

<script>
	$(function() {
		$('#example1').DataTable({
			'paging': true,
			'lengthChange': false,
			'searching': true,
			'ordering': true,
			'info': true,
			'autoWidth': false
		})
	})

	$(document).ready(function(){
    	let row_number = 1;
		$("#add_row").click(function(e){
			e.preventDefault();
			let new_row_number = row_number - 1;
			$('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
			$('#products_table').append('<tr id="product' + (row_number + 1) + '" class="tester" data-index="' + (row_number + 1) + '"></tr>');		
			row_number++;
		});

		$("#delete_row").click(function(e){
			e.preventDefault();
			if(row_number > 1){
				$("#product" + (row_number - 1)).html('');
				row_number--;
			}
		});

	});
</script>
@endsection