@extends('users.master')
@section('pageTitle','Update Vehicle')
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
            <h4 class="m-b-0 text-white">Update Vehicle</h4>
         </div>
         <div class="card-body">
            @if(Session::has('status'))
            <div class="alert alert-{{ Session::get('status') }}">
               <i class="ti-user"></i> {{ Session::get('message') }}
               <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            @endif
            <?php $userId = $userData['value']['id'];?>
            <form class="edit-form" method="POST" action='{{ url("/user/assets-management/".$userId."/update") }}' enctype="multipart/form-data">
               {{ csrf_field() }}
               <div class="form-body">
                  <div class="row p-t-20">
                     <div class="col-md-6">
                        <div class="form-group @error('tracker_id') has-danger @enderror">
                           <label>Assets</label>
                           <select class="form-control @error('tracker_id') form-control-danger @enderror" id="tracker_id" placeholder="tracker_id" name="tracker_id">
                              <option value="nullTracker">Select Assets</option>
                              @foreach($trackerData['list'] as $list)
                              <option value="{{$list['id']}}" {{ ( $list['id'] == $userData['value']['tracker_id']) ? 'selected' : '' }}>{{$list['label']}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group  @error('label') has-danger @enderror ">
                           <label class="control-label">Label</label>
                           <spam class="important"> *</spam>
                           <p class="req">This is required field</p>
                           <input
                              type="text"
                              class="form-control @error('label') form-control-danger @enderror"
                              id="label"
                              name="label"
                              placeholder="label"
                              value="{{ old('label',(isset($userData['value']) && !empty($userData['value']['label'])) ? $userData['value']['label'] : '' ) }}"
                              />
                           @error('label')
                           <small class="form-control-feedback">{{ $errors->first('label') }}</small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group  @error('max_speed') has-danger @enderror">
                           <label class="control-label">Max Speed</label>
                           <spam class="important"> *</spam>
                           <p class="req">This is required field</p>
                           <input
                              type="text"
                              class="form-control @error('max_speed') form-control-danger @enderror"
                              id="max_speed"
                              name="max_speed"
                              placeholder="max speed"
                              value="{{ old('max_speed',(isset($userData['value']) && !empty($userData['value']['max_speed'])) ? $userData['value']['max_speed'] : '' ) }}"
                              />
                           @error('max_speed')
                           <small class="form-control-feedback">{{ $errors->first('max_speed') }}</small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group  @error('model') has-danger @enderror ">
                           <label class="control-label">model</label>
                           <spam class="important"> *</spam>
                           <p class="req">This is required field</p>
                           <input
                              type="text"
                              class="form-control @error('model') form-control-danger @enderror"
                              id="model"
                              name="model"
                              placeholder="model"
                              value="{{ old('model',(isset($userData['value']) && !empty($userData['value']['model'])) ? $userData['value']['model'] : '' ) }}"
                              />
                           @error('model')
                           <small class="form-control-feedback">{{ $errors->first('model') }}</small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group  @error('type') has-danger @enderror">
                           <label class="control-label">Type</label>
                           <spam class="important"> *</spam>
                           <p class="req">This is required field</p>
                           <select class="form-control @error('type') form-control-danger @enderror" id="type" placeholder="type" name="type">
                              <option value="nullTracker">Select Vehicle Type</option>
                              @foreach($vehicleData as $list)
                              	<option value="{{$list['vehicles_type']}}" {{ ( $list['vehicles_type'] == $userData['value']['type']) ? 'selected' : '' }}>{{$list['vehicles_type']}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group  @error('subtype') has-danger @enderror">
                           <label class="control-label">Sub Type </label>
                           <input
                              type="text"
                              class="form-control @error('subtype') form-control-danger @enderror"
                              id="subtype"
                              name="subtype"
                              placeholder="Subtype"
                              value="{{ old('subtype',(isset($userData['value']) && !empty($userData['value']['subtype'])) ? $userData['value']['subtype'] : '' ) }}"
                              />
                           @error('subtype')
                           <small class="form-control-feedback">{{ $errors->first('subtype') }}</small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group  @error('trailer') has-danger @enderror">
                           <label class="control-label">Trailer</label>
                           <input
                              type="text"
                              class="form-control @error('trailer') form-control-danger @enderror"
                              id="trailer"
                              name="trailer"
                              placeholder="trailer"
                              value="{{ old('trailer',(isset($userData['value']) && !empty($userData['value']['trailer'])) ? $userData['value']['trailer'] : '' ) }}"
                              />
                           @error('trailer')
                           <small class="form-control-feedback">{{ $errors->first('trailer') }}</small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group @error('manufacture_year') has-danger @enderror">
                           <label>Manufacture Year</label>
                           <input
                              type="text"
                              class="form-control @error('manufacture_year') form-control-danger @enderror"
                              id="manufacture_year"
                              name="manufacture_year"
                              placeholder="manufacture_year"
                              value="{{ old('manufacture_year',(isset($userData['value']) && !empty($userData['value']['manufacture_year'])) ? $userData['value']['manufacture_year'] : '' ) }}"
                              />
                           @error('manufacture_year')
                           <small class="form-control-feedback">{{ $errors->first('manufacture_year') }}</small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group  @error('color') has-danger @enderror">
                           <label class="control-label">Color</label>
                           <input
                              type="text"
                              class="form-control @error('color') form-control-danger @enderror"
                              id="color"
                              name="color"
                              placeholder="color"
                              value="{{ old('color',(isset($userData['value']) && !empty($userData['value']['color'])) ? $userData['value']['color'] : '' ) }}"
                              />
                           @error('color')
                           <small class="form-control-feedback">{{ $errors->first('color') }}</small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group @error('additional_info') has-danger @enderror">
                           <label>Additional Info</label>
                           <input
                              type="text"
                              class="form-control @error('additional_info') form-control-danger @enderror"
                              id="additional_info"
                              name="additional_info"
                              placeholder="additional info"
                              value="{{ old('additional_info',(isset($userData['value']) && !empty($userData['value']['additional_info'])) ? $userData['value']['additional_info'] : '' ) }}"
                              />
                           @error('additional_info')
                           <small class="form-control-feedback">{{ $errors->first('additional_info') }}</small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group  @error('reg_number') has-danger @enderror">
                           <label class="control-label">Reg Number</label>
                           <input
                              type="text"
                              class="form-control @error('reg_number') form-control-danger @enderror"
                              id="reg_number"
                              name="reg_number"
                              placeholder="reg number"
                              value="{{ old('reg_number',(isset($userData['value']) && !empty($userData['value']['reg_number'])) ? $userData['value']['reg_number'] : '' ) }}"
                              />
                           @error('reg_number')
                           <small class="form-control-feedback">{{ $errors->first('reg_number') }}</small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group  @error('chassis_number') has-danger @enderror">
                           <label class="control-label">Chassis Number</label>
                           <input
                              type="text"
                              class="form-control @error('chassis_number') form-control-danger @enderror "
                              id="chassis_number"
                              name="chassis_number"
                              placeholder="chassis_number"
                              value="{{ old('chassis_number',(isset($userData['value']) && !empty($userData['value']['chassis_number'])) ? $userData['value']['chassis_number'] : '' ) }}"
                              />
                           @error('chassis_number')
                           <small class="form-control-feedback">{{ $errors->first('chassis_number') }}</small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group @error('passengers') has-danger @enderror">
                           <label>Passengers</label>
                           <spam class="important"> *</spam>
                           <p class="req">This is required field</p>
                           <input
                              type="text"
                              class="form-control @error('passengers') form-control-danger @enderror"
                              id="passengers"
                              name="passengers"
                              placeholder="passengers"
                              value="{{ old('passengers',(isset($userData['value']) && !empty($userData['value']['passengers'])) ? $userData['value']['passengers'] : '' ) }}"
                              />
                           @error('passengers')
                           <small class="form-control-feedback">{{ $errors->first('passengers') }}</small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group @error('fuel_type') has-danger @enderror">
                           <label>Fuels Type</label>
                           <spam class="important"> *</spam>
                           <p class="req">This is required field</p>
                           <select class="form-control @error('fuel_type') form-control-danger @enderror" id="fuel_type" placeholder="fuel_type" name="fuel_type">
                              <option value="nullTracker">Select fuel</option>
                              @foreach($fuelData as $list)
                              <option value="{{$list['fuels_type']}}" {{ ( $list['fuels_type'] == $userData['value']['fuel_type']) ? 'selected' : '' }}>{{$list['fuels_type']}}</option>
                              @endforeach
                           </select>
                           @error('fuel_type')
                           <small class="form-control-feedback">{{ $errors->first('fuel_type') }}</small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group @error('fuel_grade') has-danger @enderror">
                           <label>Fuel Grade</label>
                           <input
                              type="text"
                              class="form-control @error('fuel_grade') form-control-danger @enderror"
                              id="fuel_grade"
                              name="fuel_grade"
                              placeholder="fuel_grade"
                              value="{{ old('fuel_grade',(isset($userData['value']) && !empty($userData['value']['fuel_grade'])) ? $userData['value']['fuel_grade'] : '' ) }}"
                              />
                           @error('fuel_grade')
                           <small class="form-control-feedback">{{ $errors->first('fuel_grade') }}</small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group @error('fuel_tank_volume') has-danger @enderror">
                           <label>Fuel Tank Volume</label>
                           <spam class="important"> *</spam>
                           <p class="req">This is required field</p>
                           <input
                              type="text"
                              class="form-control @error('fuel_tank_volume') form-control-danger @enderror"
                              id="fuel_tank_volume"
                              name="fuel_tank_volume"
                              placeholder="fuel_tank_volume"
                              value="{{ old('fuel_tank_volume',(isset($userData['value']) && !empty($userData['value']['fuel_tank_volume'])) ? $userData['value']['fuel_tank_volume'] : '' ) }}"
                           />
                           @error('fuel_tank_volume')
                           <small class="form-control-feedback">{{ $errors->first('fuel_tank_volume') }}</small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group  @error('liability_insurance_policy_number') has-danger @enderror">
                           <label class="control-label">Liability Insurance Policy Number</label>
                           <spam class="important"> *</spam>
                           <p class="req">This is required field</p>
                           <input
                              type="text"
                              class="form-control @error('liability_insurance_policy_number') form-control-danger @enderror "
                              id="liability_insurance_policy_number"
                              name="liability_insurance_policy_number"
                              placeholder="Liability Insurance Policy Number"
                              value="{{ old('liability_insurance_policy_number',(isset($userData['value']) && !empty($userData['value']['liability_insurance_policy_number'])) ? $userData['value']['liability_insurance_policy_number'] : '' ) }}"
                              />
                           @error('liability_insurance_policy_number')
                           <small class="form-control-feedback">{{ $errors->first('liability_insurance_policy_number') }}</small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group  @error('liability_insurance_valid_till') has-danger @enderror">
                           <label class="control-label">Liability Insurance Valid Till</label>
                           <spam class="important"> *</spam>
                           <p class="req">This is required field</p>
                           <input
                              type="date"
                              class="form-control @error('liability_insurance_valid_till') form-control-danger @enderror"
                              id="liability_insurance_valid_till"
                              name="liability_insurance_valid_till"
                              placeholder="liability_insurance_valid_till"
                              value="{{ old('liability_insurance_valid_till',(isset($userData['value']) && !empty($userData['value']['liability_insurance_valid_till'])) ? $userData['value']['liability_insurance_valid_till'] : '' ) }}"
                              />
                           @error('liability_insurance_valid_till')
                           <small class="form-control-feedback">{{ $errors->first('liability_insurance_valid_till') }}</small>
                           @enderror
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-actions">
                  <button type="submit" class="btn btn-info waves-effect waves-light cus-submit save-btn"><i class="fa fa-save" aria-hidden="true"></i>Save</button>
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