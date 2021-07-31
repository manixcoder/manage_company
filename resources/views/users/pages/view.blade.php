@extends('admin.master')
@section('pageTitle',' View Page')
@section('content')

@section('pageCss')
<style></style>
@stop
<div class="row">
	<div class="col-lg-12">
		<div class="card card-outline-info">
			<div class="card-header">
				<h4 class="m-b-0 text-white"> <i class="fa fa-eye" aria-hidden="true"></i> View  Page :  {{ $pageData->name  }} </h4>
				<a href ="<?php echo  env('APP_URL');?>admin/page-management/<?php echo Crypt::encrypt($pageData->id); ?>/edit"  style="float:right;color:#fff;margin-top: -25px;" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Page</a>
			</div>
			<div class="card-body">
					@if(Session::has('status'))
						<div class="alert alert-{{ Session::get('status') }}"> 
							<i class="ti-user"></i> {{ Session::get('message') }}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
						</div>
					@endif

				   <div class="row">
						<div class="col-md-4">
							<div class="form-group row">
								<label class="control-label text-right col-md-3"><b>Name :</b></label>
								<div class="col-md-9">
									<p class="form-control-static">  {{ $pageData->name  }}  </p>
								</div>
							</div>
						</div>
						<!--/span-->
						<div class="col-md-4">
							<div class="form-group row">
								<label class="control-label text-right col-md-3"><b>Slug :</b></label>
								<div class="col-md-9">
									<p class="form-control-static">  {{ $pageData->page_slug  }}  </p>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group row">
								<label class="control-label text-right col-md-3"><b>Status :</b></label>
								<div class="col-md-9">
								<p class="form-control-static">
										@if ($pageData->status == 'Active') 
											<span class="label label-success"> Active </span>
										@else	
											<span class="label label-danger"> Disable </span> 
										@endif	
								 	</p>
								</div>
							</div>
						</div>
						<!--/span-->

						<div class="col-md-12">
							<div class="form-group  @error('content') has-danger @enderror ">
								<label class="control-label"><b>Content :</b></label>
								<textarea
									class="form-control summernote  @error('content') form-control-danger @enderror  "
									id="content"
									name="content"
								>{{ old('content',(isset($pageData) && !empty($pageData->content)) ? $pageData->content : '' ) }}</textarea>

								@error('content')
									<small class="form-control-feedback">{{ $errors->first('content') }}</small>
								@enderror
							</div>
						</div>
					</div>

					 
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
		height: 350, // set editor height
		minHeight: null, // set minimum height of editor
		maxHeight: null, // set maximum height of editor
		focus: false // set focus to editable area after initializing summernote
	});

	
 
});

</script>
@stop