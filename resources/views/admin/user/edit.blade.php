@extends('admin.layouts.app')

@section('title', 'Users')

@section('header')
@parent;
@endsection

@section('content')
    <h2>{{$page_headding}}</h2>
        <div class="card">
    
    <div class="row">
    <form class="col s12" method="post" action="{{ route($action, $edit) }}" accept-charset="UTF-8">
      @csrf
      <!-- @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                  </div><br />
            @endif -->
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" name="first_name" value="{{ old('first_name', isset($existing_data->first_name) ? $existing_data->first_name : ''  ) }}" type="text" class="validate  ">
          <label for="first_name">First Name</label>
          @error('first_name')
          <span class="helper-text red-text text-darken-3" >{{ $message }}</span>
          @enderror          
        </div>
        <div class="input-field col s6">
          <input id="last_name" name="last_name" type="text" value="{{ old('last_name', isset($existing_data->last_name) ? $existing_data->last_name : '') }}" class="validate">
          <label for="last_name">Last Name</label>
          @error('last_name')
          <span class="helper-text red-text text-darken-3">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="email" name="email" value="{{ old('email', isset($existing_data->email) ? $existing_data->email : '') }}" type="text" class="validate  ">
          <label for="email">Email</label>
          @error('email')
          <span class="helper-text red-text text-darken-3" >{{ $message }}</span>
          @enderror          
        </div>
        <div class="input-field col s6">
          <input id="phone" name="phone" type="text" value="{{ old('phone', isset($existing_data->phone) ? $existing_data->phone : '') }}" class="validate">
          <label for="phone">Phone</label>
          @error('phone')
          <span class="helper-text red-text text-darken-3">{{ $message }}</span>
          @enderror
        </div>
      </div>
      @if( isset($edit) && empty($edit) )
      <div class="row">
        <div class="input-field col s6">
          <input id="password" name="password" value="{{ old('password') }}"  type="password" class="validate  ">
          <label for="password">Password</label>
          @error('password')
          <span class="helper-text red-text text-darken-3" >{{ $message }}</span>
          @enderror          
        </div>
        <div class="input-field col s6">
          <input  id="password_confirmation" name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" class="validate">
          <label for="password_confirmation">Confirm Password</label>
          @error('password_confirmation')
          <span class="helper-text red-text text-darken-3">{{ $message }}</span>
          @enderror
        </div> 
      </div>
      @endif
      <div class="row">
        <div class="input-field col s12">
          	<select name="role_id" value="">
		      <option value="" disabled selected>Choose your option</option>
		      <option value="1" {{ ( '1' == old('role_id', isset($existing_data->role_id) ? $existing_data->role_id : '' )) ? 'selected' : '' }} >Admin</option>
		      <option value="2" {{ ( '2' == old('role_id', isset($existing_data->role_id) ? $existing_data->role_id : '' )) ? 'selected' : '' }}>Editor</option>
		    </select>
		    <label>User Role</label>
		    @error('role_id')
	          <span class="helper-text red-text text-darken-3">{{ $message }}</span>
	        @enderror
        </div>
      </div>
	  <div class="row">
        <div class="input-field col s12">
        	<div class="switch">
		    <label>
		      Inactive
		      <input type="checkbox" {{ (old('status', ( (isset($existing_data->status) && $existing_data->status == '1' ) || !isset($existing_data->status) ) ? '1' : '') == '1')? 'checked' : '' }} name="status" value="1">
		      <span class="lever"></span>	
		      Active	      
		    </label>
		  </div>
        </div>
      </div>

      
      <div class="row">
        <div class="input-field col s12">
          @if( isset($edit) && !empty($edit) )
            <input type="hidden" name="page" value="{{ old('page', isset($page) ? $page : '') }}" />
            <input type="hidden" name="search" value="{{ old('search', isset($search) ? $search : '') }}" />
          	<button type="submit" class="waves-effect waves-light btn">
          		<i class="material-icons left">edit</i>Update
          	</button>
          @else
            <button type="submit" class="waves-effect waves-light btn">
              <i class="material-icons left">create</i>Create
            </button>
          @endif
        	<a href="{{ route('admin.user') }}" class="waves-effect waves-light btn"><i class="material-icons left">fast_rewind</i>Back</a>
        </div>
      </div>
      
      
    </form>
  </div>
</div>
@endsection
@section('footer')

@endsection