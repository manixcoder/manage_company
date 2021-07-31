 @foreach($result as $policy)
 <li>
   <input type="checkbox" name="permission[]" value="{{$policy->req_id}}" class="check"  {{ $policy->accept_status=='1'  ? 'checked':'' }}   id="minimal-checkbox-{{$policy->req_id}}">
    <label for="minimal-checkbox-{{$policy->req_id}}"> &nbsp; &nbsp; {{$policy->permissions_name}}</label>
 </li>
@endforeach