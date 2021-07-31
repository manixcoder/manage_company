@extends('admin.master')
@section('pageTitle','Create New Email Template')
@section('content')

@section('pageCss')
<style></style>
@stop
<div class="row">
	<div class="col-lg-12">
		<div class="card card-outline-info">
			<div class="card-header">
				<h4 class="m-b-0 text-white"> <i class="fa fa-plus" aria-hidden="true"></i> Create New Template</h4>
			</div>
			<div class="card-body">
					@if(Session::has('status'))
						<div class="alert alert-{{ Session::get('status') }}"> 
							<i class="ti-user"></i> {{ Session::get('message') }}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
						</div>
					@endif
		   		 
					<form class="edit-form" method="POST" action="{{ url('/admin/email-management/save-template') }}" enctype="multipart/form-data">
						{{ csrf_field() }}

						<div class="form-body"> 
							<div class="row p-t-20">
							
    							<div class="col-md-4">
									<div class="form-group  @error('name') has-danger @enderror ">
										<label class="control-label">Template Name</label>
										<input 
											type="text" 
											class="form-control  @error('name') form-control-danger @enderror " 
											id="name" 
											name="name" 
											value="{{ old('name') }}"
										/>
										@error('name')
											<small class="form-control-feedback">{{ $errors->first('name') }}</small>
										@enderror
									</div>
								</div>	

								 

								<div class="col-md-4">
									<div class="form-group  @error('subject') has-danger @enderror ">
										<label class="control-label">Subject </label>
										<input 
											type="text"
											class="form-control  @error('subject') form-control-danger @enderror" 
											id="subject" 
											name="subject" 
											value="{{ old('subject') }}"
										
										/>
										@error('subject')
											<small class="form-control-feedback">{{ $errors->first('subject') }}</small>
										@enderror
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group  @error('status') has-danger @enderror ">
										<label class="control-label">Status</label>
										<div class="m-b-30">
                                            <input 
												type="checkbox"
												class="js-switch" 
												data-color="#0ca302" 
												data-secondary-color="#f62d51" 
												data-size="large"
												name="status"	
												checked										
											/>
                                             
										</div>
										@error('status')
											<small class="form-control-feedback">{{ $errors->first('status') }}</small>
										@enderror
									</div>
								</div>
 
								<div class="col-md-12">
									<div class="form-group  @error('content') has-danger @enderror ">
										<label class="control-label">Content Template</label>
										<textarea
											class="form-control summernote  @error('content') form-control-danger @enderror  "
											id="content"
											name="content"
										>{{ old('content') }}</textarea>

										@error('content')
											<small class="form-control-feedback">{{ $errors->first('content') }}</small>
										@enderror
									</div>
								</div>
								 
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-info waves-effect waves-light  cus-submit save-btn"><i class="fa fa-save" aria-hidden="true"></i> Create</button>
						</div>

					</form>
				</div>
	      	</div>
	    </div>
    </div>
</div>

@stop

@section('pagejs')
<script type="text/javascript">

$(function() {


	$('.summernote').summernote({
		height: 250, // set editor height
		minHeight: null, // set minimum height of editor
		maxHeight: null, // set maximum height of editor
		focus: true // set focus to editable area after initializing summernote
	});

	 
});

</script>
@stop