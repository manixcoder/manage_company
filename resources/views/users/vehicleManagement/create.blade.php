@extends('users.master')
@section('pageTitle','Create New Vehicle')
@section('content')
@section('pageCss')
<style>
spam.important {
    color: red;
}
.form-group p.req {
    width: auto;
    display: inline-block;
    margin: 0 0 0 7px;
    font-size: 12px;
}
</style>

@stop
<div class="row">
   <div class="col-lg-12">
      <div class="card card-outline-info">
         <div class="card-header">
            <h4 class="m-b-0 text-white">Add New Vehicle</h4>
         </div>
         <div class="card-body">
            @if(Session::has('status'))
            <div class="alert alert-{{ Session::get('status') }}"> 
               <i class="ti-user"></i> {{ Session::get('message') }}
               <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            @endif
            <form class="edit-form" method="POST" action="{{ url('/user/assets-management/save-vehicle') }}" enctype="multipart/form-data">
               {{ csrf_field() }}
               <div class="form-body">
                  <div class="row p-t-20">
                     
					 <div class="col-md-6">
                        <div class="form-group @error('tracker_id') has-danger @enderror">
                           <label>Assets</label>
                           <select id="tracker_id" class="form-control @error('tracker_id') form-control-danger @enderror"  placeholder="tracker_id" name="tracker_id">
                              <option value="nullTracker">Select Assets</option>
                              @foreach($trackerData['list'] as $list)
                              <option value="{{$list['id']}}">{{$list['label']}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group  @error('label') has-danger @enderror ">
                           <label class="control-label">Label</label>
                           <spam class="important"> * </spam>
                           <p class="req">This is required field</p>
                           <input 
                              type="text" 
                              class="form-control @error('label') form-control-danger @enderror " 
                              id="label" 
                              name="label" 
                              placeholder="Label" 
                              value="{{ old('label') }}" />
                           @error('label')
                           <small class="form-control-feedback">{{ $errors->first('label') }}</small>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group  @error('max_speed') has-danger @enderror ">
                           <label class="control-label">Max Speed</label>
                           <spam class="important"> * </spam>
                           <p class="req">This is required field</p>
                           <input 
                              type="text" 
                              class="form-control @error('max_speed') form-control-danger @enderror " 
                              id="max_speed" 
                              name="max_speed" 
                              placeholder="Max Speed" 
                              value="{{ old('max_speed') }}" />
                           @error('max_speed')
                           <small class="form-control-feedback">{{ $errors->first('max_speed') }}</small>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group  @error('model') has-danger @enderror ">
                           <label class="control-label">Model</label>
                           <spam class="important"> * </spam>
                           <p class="req">This is required field</p>
                           <input 
                              type="text" 
                              class="form-control @error('model') form-control-danger @enderror " 
                              id="model" 
                              name="model" 
                              placeholder="Model" 
                              value="{{ old('model') }}" />
                           @error('model')
                           <small class="form-control-feedback">{{ $errors->first('model') }}</small>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group  @error('type') has-danger @enderror">
                           <label class="control-label">Type</label> 
                           <spam class="important"> * </spam>
                           <p class="req">This is required field</p>
                           <select class="form-control @error('type') form-control-danger @enderror" id="type" name="type">
                              <option value="">Select Vehicle Type</option>
                              @foreach($vehicleData as $list)
                              <option value="{{$list['vehicles_type']}}">{{$list['vehicles_type']}}</option>
                              @endforeach
                           </select>
                           @error('type')
                              <small class="form-control-feedback">{{ $errors->first('type') }}</small>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group  @error('subtype') has-danger @enderror ">
                           <label class="control-label">Sub Type</label>
                           <input 
                              type="text" 
                              class="form-control @error('subtype') form-control-danger @enderror " 
                              id="subtype" 
                              name="subtype"
                              value="tractor" 
                              placeholder="Sub Type" 
                              value="{{ old('subtype') }}" 
                              />
                           @error('subtype')
                           <small class="form-control-feedback">{{ $errors->first('subtype') }}</small>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group  @error('trailer') has-danger @enderror ">
                           <label class="control-label">Trailer</label>
                           <input 
                              type="text" 
                              class="form-control @error('trailer') form-control-danger @enderror " 
                              id="trailer" 
                              name="trailer" 
                              placeholder="Trailer" 
                              value="{{ old('trailer') }}" 
                              />
                           @error('trailer')
                           <small class="form-control-feedback">{{ $errors->first('trailer') }}</small>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group  @error('manufacture_year') has-danger @enderror ">
                           <label class="control-label">Manufacture Year</label>
                           <spam class="important"> * </spam>
                           <p class="req">This is required field</p>
                           <input 
                              type="text" 
                              class="form-control @error('manufacture_year') form-control-danger @enderror " 
                              id="manufacture_year" 
                              name="manufacture_year" 
                              placeholder="Manufacture Year" 
                              value="{{ old('manufacture_year') }}" 
                              />
                           @error('manufacture_year')
                           <small class="form-control-feedback">{{ $errors->first('manufacture_year') }}</small>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group  @error('color') has-danger @enderror ">
                           <label class="control-label">Color</label>
                           <input 
                              type="text" 
                              class="form-control @error('color') form-control-danger @enderror " 
                              id="color" 
                              name="color" 
                              placeholder="Color" 
                              value="{{ old('color') }}" 
                              />
                           @error('color')
                           <small class="form-control-feedback">{{ $errors->first('color') }}</small>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group  @error('additional_info') has-danger @enderror ">
                           <label class="control-label">Additional Info</label>
                           <input 
                              type="text" 
                              class="form-control @error('additional_info') form-control-danger @enderror " 
                              id="additional_info" 
                              name="additional_info" 
                              placeholder="Additional Info" 
                              value="{{ old('additional_info') }}" 
                              />
                           @error('additional_info')
                           <small class="form-control-feedback">{{ $errors->first('additional_info') }}</small>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group  @error('reg_number') has-danger @enderror ">
                           <label class="control-label">Reg Number</label>
                           <spam class="important"> * </spam>
                           <p class="req">This is required field</p>
                           <input 
                              type="text" 
                              class="form-control @error('reg_number') form-control-danger @enderror " 
                              id="reg_number" 
                              name="reg_number" 
                              placeholder="Reg Number" 
                              value="{{ old('reg_number') }}" 
                              />
                           @error('reg_number')
                           <small class="form-control-feedback">{{ $errors->first('reg_number') }}</small>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group  @error('chassis_number') has-danger @enderror ">
                           <label class="control-label">Chassis Number</label>
                           <input 
                              type="text" 
                              class="form-control @error('chassis_number') form-control-danger @enderror " 
                              id="chassis_number" 
                              name="chassis_number" 
                              placeholder="Chassis Number" 
                              value="{{ old('chassis_number') }}" 
                              />
                           @error('chassis_number')
                           <small class="form-control-feedback">{{ $errors->first('chassis_number') }}</small>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group  @error('passengers') has-danger @enderror ">
                           <label class="control-label">Passengers</label>
                           <spam class="important"> * </spam>
                           <p class="req">This is required field</p>
                           <input 
                              type="text" 
                              class="form-control @error('passengers') form-control-danger @enderror " 
                              id="passengers" 
                              name="passengers" 
                              placeholder="Passengers" 
                              value="{{ old('passengers') }}" 
                              />
                           @error('passengers')
                           <small class="form-control-feedback">{{ $errors->first('passengers') }}</small>
                           @enderror
                        </div>
                     </div>
                     
                     <div class="col-md-6">
                        <div class="form-group  @error('fuel_type') has-danger @enderror ">
                           <label class="control-label">Fuel Type</label>
                           <spam class="important"> * </spam>
                           <p class="req">This is required field</p>
                           <select class="form-control @error('fuel_type') form-control-danger @enderror" id="fuel_type" placeholder="fuel_type" name="fuel_type">
                              <option value="">Select Fuel Type</option>
                              @foreach($fuelData as $list)
                              <option value="{{$list['fuels_type']}}">{{$list['fuels_type']}}</option>
                              @endforeach
                           </select>
                           @error('fuel_type')
                              <small class="form-control-feedback">{{ $errors->first('fuel_type') }}</small>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group  @error('fuel_grade') has-danger @enderror ">
                           <label class="control-label">Fuel Grade</label>
                           <input 
                              type="text" 
                              class="form-control @error('fuel_grade') form-control-danger @enderror " 
                              id="fuel_grade" 
                              name="fuel_grade" 
                              placeholder="Fuel Grade" 
                              value="{{ old('fuel_grade') }}" 
                              />
                           @error('fuel_grade')
                           <small class="form-control-feedback">{{ $errors->first('fuel_grade') }}</small>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group  @error('Fuel_tank_volume') has-danger @enderror ">
                           <label class="control-label">Fuel Tank Volume</label>
                           <spam class="important"> *</spam>
                           <p class="req">This is required field</p>
                           <input 
                              type="text" 
                              class="form-control @error('fuel_tank_volume') form-control-danger @enderror " 
                              id="fuel_tank_volume" 
                              name="fuel_tank_volume" 
                              placeholder="Fuel Tank Volume" 
                              value="{{ old('fuel_tank_volume') }}" 
                              />
                           @error('fuel_tank_volume')
                           <small class="form-control-feedback">{{ $errors->first('fuel_tank_volume') }}</small>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group  @error('liability_insurance_policy_number') has-danger @enderror ">
                           <label class="control-label">Liability Insurance Policy Number</label>
                           <spam class="important"> * </spam>
                           <p class="req">This is required field</p>
                           <input 
                              type="text" 
                              class="form-control @error('liability_insurance_policy_number') form-control-danger @enderror " 
                              id="liability_insurance_policy_number" 
                              name="liability_insurance_policy_number" 
                              placeholder="Liability Insurance Policy Number" 
                              value="{{ old('liability_insurance_policy_number') }}" 
                              />
                           @error('liability_insurance_policy_number')
                           <small class="form-control-feedback">{{ $errors->first('liability_insurance_policy_number') }}</small>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group  @error('liability_insurance_valid_till') has-danger @enderror ">
                           <label class="control-label">Liability Insurance Valid Till</label>
                           <spam class="important"> * </spam>
                           <p class="req">This is required field</p>
                           <input 
                              type="date" 
                              class="form-control @error('liability_insurance_valid_till') form-control-danger @enderror " 
                              id="liability_insurance_valid_till" 
                              name="liability_insurance_valid_till" 
                              placeholder="liability_insurance_valid_till" 
                              value="{{ old('liability_insurance_valid_till') }}" 
                              />
                           @error('liability_insurance_valid_till')
                           <small class="form-control-feedback">{{ $errors->first('liability_insurance_valid_till') }}</small>
                           @enderror
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-actions">
                  <button type="submit" class="btn btn-info waves-effect waves-light  cus-submit save-btn"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
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
  
</script>
@stop