<label>Please select Permission for {{$tr_id}}</label>
  <ul  class="icheck-list">
  @foreach($result as $policy)
    <li>
      <input type="checkbox" name="permission[{{$tr_id}}][]" value="{{$policy->req_id}}" class="check"  {{ $policy->accept_status=='1'  ? 'checked':'' }}   id="minimal-checkbox-{{$policy->req_id}}{{$tr_id}}">
      <label for="minimal-checkbox-{{$policy->req_id}}{{$tr_id}}"> &nbsp; &nbsp; {{$policy->permissions_name}}</label>
    </li>
  @endforeach
<hr/>
</ul>
