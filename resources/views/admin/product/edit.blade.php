@extends('layouts.admin_layouts')
@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Action</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Kategori</h4>
                    </div>
                    <form action="{{route('product.update', [$product->uuid])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="path" value="{{asset($product->image)}}">
                        <div class="modal-body">
                            <div class="modal-body row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Name Product</label>
                                        <input type="text" class="form-control" value="{{$product->name}}" name="name" >
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Regular Price (Rp.)</label>
                                        <input type="number" class="form-control" value="{{$product->regular_price}}" name="regular_price" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Discount Type</label>
                                        <select  name="discount_type" class="form-control">
                                            <option disabled selected>-- Choose Discount --</option>
                                            <option value="amount" @if($product->discount_type == 'amount') selected  @else  @endif>Amount (Rp)</option>
                                            <option value="percentage" @if($product->discount_type == 'percentage') selected  @else  @endif>Percentage (%)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Discount Amount (Rp / %)</label>
                                        <input type="number" class="form-control" value="{{$product->discount}}" name="discount" value="0" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        
                                        <label for="">Unit Type</label>
                                        <select  name="unit_type" class="form-control">
                                            <option disabled selected>-- Choose Unit --</option>
                                            <option value="kg" @if($product->unit_type == 'kg') selected  @else  @endif>Kilogram (Kg)</option>
                                            <option value="pcs" @if($product->unit_type == 'pcs') selected  @else  @endif>Piece (Pcs)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Unit</label>
                                        <input type="number" class="form-control" value="{{$product->unit}}" name="unit" value="0" >
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Stock</label>
                                        <input type="number" class="form-control" value="{{$product->stock}}" name="stock" >
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Image Product</label>
                                        <input type="file" value="{{$product->product_image}}" name="product_image" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <input type="text" class="form-control" value="{{$product->description}}" name="description" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="{{route('product.index')}}" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
</div>


@endsection
