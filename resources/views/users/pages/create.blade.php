@extends('admin.master')
@section('pageTitle',' Create Page')
@section('content')

@section('pageCss')
<style></style>
@stop
<div class="row">
	<div class="col-lg-12">
		<div class="card card-outline-info">
			<div class="card-header">
				<h4 class="m-b-0 text-white"> <i class="fa fa-plus" aria-hidden="true"></i> Create New Page</h4>
			</div>
			<div class="card-body">
					@if(Session::has('status'))
						<div class="alert alert-{{ Session::get('status') }}"> 
							<i class="ti-user"></i> {{ Session::get('message') }}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
						</div>
					@endif
		   		 
					<form class="edit-form" method="POST" action="{{ url('/admin/page-management/save-page') }}" enctype="multipart/form-data">
						{{ csrf_field() }}

						<div class="form-body"> 
							<div class="row p-t-20">
							
    							<div class="col-md-4">
									<div class="form-group  @error('name') has-danger @enderror ">
										<label class="control-label">Page Name</label>
										<input 
											type="text" 
											class="form-control slug_maker @error('name') form-control-danger @enderror " 
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
									<div class="form-group  @error('page_slug') has-danger @enderror ">
										<label class="control-label">Slug </label>
										<input 
											type="text"
											class="form-control slug_maker @error('page_slug') form-control-danger @enderror" 
											id="page_slug" 
											name="page_slug" 
											value="{{ old('page_slug') }}"
										
										/>
										@error('page_slug')
											<small class="form-control-feedback">{{ $errors->first('page_slug') }}</small>
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
										<label class="control-label">Content</label>
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

$(document).ready(function() { 
	$('.summernote').summernote({
		height: 250, // set editor height
		minHeight: null, // set minimum height of editor
		maxHeight: null, // set maximum height of editor
		focus: true // set focus to editable area after initializing summernote
	});

	/* 
	|----------------
	|	Description	:	Code for Auto Key Slug in Add New Page
	|	Date		:	28/June/2019
	|----------------
	*/		
	$(".slug_maker").keyup(function(){
			var Text = $(this).val();    
			Text = Text.toLowerCase();   
			var regExp = /\s+/g;    
			Text = Text.replace(regExp,'-');

			$('#page_slug').val(Text);   
		}); 
	
 });


</script>
@stop