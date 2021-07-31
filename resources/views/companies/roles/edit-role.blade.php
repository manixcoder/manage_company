@extends('admin.master')
@section('title', 'Edit Role')
@section('content')	      
<div class="row">
	<div class="col-lg-12">
		<div class="card card-outline-info">
			<div class="card-header">
				<h4 class="m-b-0 text-white">Edit Role : {{ $role->name }} </h4>
			</div>
			<div class="card-body">
	      		@if(Session::has('status'))
			     	<div class="alert alert-{{ Session::get('status') }} clearfix">{{ Session::get('message') }}</div>
				@endif 
		   		 
					<form class="edit-form" method="POST" action="{{ url('/admin/role-management/'.$role->id.'/save-edit-role') }}" enctype="multipart/form-data">
						{{ csrf_field() }}

						<div class="form-body"> 
							<div class="row p-t-20">
								
								<div class="col-md-6">
									<div class="form-group  @error('display_name') has-danger @enderror ">
										<label class="control-label">Role Name</label>
										<div class="copy-input"> {{ old('name',$role->name) }}</div>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group  @error('display_name') has-danger @enderror ">
										<label class="control-label">Display Name</label>
										<input type="text" class="form-control @error('display_name') form-control-danger @enderror form-control-danger" id="display_name" name="display_name" value="{{ old('display_name',$role->display_name) }}">
										@error('display_name')
											<small class="form-control-feedback">{{ $errors->first('display_name') }}</small> 
										@enderror
									</div>
								</div>	

								<div class="col-md-12">
									<div class="form-group  @error('description') has-danger @enderror ">
										<label class="control-label">Description</label>
										<textarea name="description" class="form-control   @error('description') form-control-danger @enderror  ">{{ old('description',$role->description) }}</textarea>
										@error('description')
											<small class="form-control-feedback">{{ $errors->first('description') }}</small> 
										@enderror
									</div>
								</div>	
							 
								 
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-info waves-effect waves-light  cus-submit save-btn"><i class="fa fa-upload" aria-hidden="true"></i> Update</button>
						</div>

					</form>
				</div>
	      	</div>
	    </div>
    </div>
</div>

@stop
