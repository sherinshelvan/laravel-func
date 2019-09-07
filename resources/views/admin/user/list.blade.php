@extends('admin.layouts.app')

@section('title', 'Users')

@section('header')
@parent;
@endsection

@section('content')
    <h2>{{$page_headding}}</h2>
    @if(Session::has('success'))
        <div class="alert-message success">
        <span class="msg">{{ Session::get('success') }}</span>
        <span class="close"> <i class="material-icons">close</i></span>
        @php
            Session::forget('success');
        @endphp
    	</div>
    @endif
     @if(Session::has('error'))
        <div class="alert-message error">
        <span class="msg">{{ Session::get('error') }}</span>
        <span class="close"> <i class="material-icons">close</i></span>
        @php
            Session::forget('error');
        @endphp
    	</div>
    @endif


	<div class="create-new right-align">
	    <a  href="{{ route('admin.user.create') }}" class="waves-effect waves-light btn"><i class="material-icons left">add</i>Add new user</a>
	</div>
	<div class="search-wrapper">
		<form method="post" action="{{ route('admin.user') }}" accept-charset="UTF-8">
			@csrf
	        <div class="row">
	            <div class="input-field col s3">
	                <input id="search" type="text" value="{{ ( isset($search)) ? $search : '' }}" name="search" class="validate">
	                <label for="search">Search</label>
	            </div>
	            <input type="hidden" name="pass_value" value="{{$pass_value}}" />
	            <div class="input-field col s3"> 
	            	<button type="submit" class="waves-effect waves-light btn"><i class="material-icons left">search</i>Search</a></button> 
	            	<a href="{{ route('admin.user') }}" class="waves-effect waves-light btn"><i class="material-icons left">refresh</i>refresh</a> 
	            </div>
	        </div>
        </form>
    </div>
    <!-- Modal Trigger -->
  	<a class="waves-effect waves-light btn modal-trigger" href="#delete_confirmation">Modal</a>

	<!-- Modal Structure -->
	<div id="delete_confirmation" class="modal delete_confirmation">
	    <div class="modal-content">
	      <h4>Are you sure do want to delete?</h4>
	      <form method="post" action="" accept-charset="UTF-8">
	      	@csrf
	      	<input type="text" name="delete_id" id="delete_id"  />
	      	<input type="hidden" name="pass_value" value="{{$pass_value}}" />
	      	<button class="waves-effect waves-light btn">Yes</button>
	      	<a class="waves-effect waves-light btn modal-close ">No</a>
	      </form>
	    </div>
	    <!-- <div class="modal-footer">
	      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
	    </div> -->
	</div>
    <table class="striped highlight responsive-table" border="">
    	@if ($results->count() > 0)
		<thead>
          <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Action</th>
        	</tr>
        </thead>
        <tbody>
        	@foreach ($results as $row)
		        <tr>
		        	<td>{{$row->first_name}} {{$row->last_name}}</td>
		        	<td>{{$row->email}}</td>
		        	<td>
		        		<a href="{{route('admin.user.edit', $row->id).$pass_value}}" title="Edit"><i class="material-icons">edit</i></a>
		        		@if($row->id > 1)
		        			<a href="javascript:void(0);" onClick="javascript:$('#delete_id').val('<?=$row->id?>');" ><i class="material-icons">delete</i></a>
		        			<!-- <a href="{{route('admin.user.destroy', $row->id).$pass_value}}" title="Delete"><i class="material-icons">delete</i></a> -->
		        		@endif
		        	</td>
		        </tr>
		    @endforeach
		    <tr>
		    	<td colspan="3"> {{ $results->links() }}</td>
		    </tr>
        </tbody>
		@else
			<tbody>
				<tr><td>No Users found.</td></tr>
			</tbody>	
		@endif
      </table>
      
    
@endsection
@section('footer')
@parent
@endsection
@section('page_script')
<script>
	/*$(document).ready(function(){
	 	M.toast({html: 'I am a toast!'})
	});*/
</script>
@endsection