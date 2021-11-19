@section('title', __('Products'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4>Product Listing </h4>
							<div>
								<form action="{{URL::to('/export')}}" method="post">
									{!! csrf_field() !!}
									<button type="submit" class='btn btn-info'>Export to Excel</button>
								</form>
							</div>
						</div>
				
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Products">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
						<i class="fa fa-plus"></i>  Add Products
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.products.create')
						@include('livewire.products.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Code</th>
								<th>Name</th>
								<th>Description</th>
								<th>Brand</th>
								<th>Price</th>
								<th>Category</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@foreach($products as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->code }}</td>
								<td>{{ $row->name }}</td>
								<td>{{ $row->description }}</td>
								<td>{{ $row->brand }}</td>
								<td>{{ $row->price }}</td>
								<td>{{ $row->Category->name }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>							 
									<a class="dropdown-item" onclick="confirm('Confirm Delete Product id {{$row->id}}? \nDeleted Products cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a>   
									</div>
								
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $products->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>