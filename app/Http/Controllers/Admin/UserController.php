<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\AdminUsers;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $table_obj;
    public function __construct()
    {
        parent::__construct();        
        $this->table_obj     = new AdminUsers;
        $this->page_headding = 'Manage Users';
        $this->table_name    = 'admin_users';
        // $this->middleware('guest');
    }
    public function index(Request $request)
    {
        $data          = array();        ;
        $condition = array(
            'where' => array(
            ),
            'orwhere' => array(
                // 0 => array('id', '>',  1),
            )
        );
        $pass_value = array();
        if(array_key_exists('page', $request->input()) && !empty($request->input('page')) ){
            $pass_value['page']   = $request->input('page');
        }
        if( array_key_exists('search', $request->input()) && !empty($request->input('search')) ){
            $condition['orwhere'] = array( 0 => array('first_name', 'LIKE', $request->input('search')."%")
            );
            $data['search']       = $request->input('search');
            $pass_value['search'] = $request->input('search');

        }
       
       
        /*$results = $this->commonFunctionModel->fetchAllResult("*", $this->table_name, null, array('id', 'asc'), $offset, $pagination_limit );*/
        /*echo '<pre/>';
        print_r($request->input());*/
        $results = $this->commonFunctionModel->fetchPaginationResult("*", $this->table_name, $condition, array('id', 'desc'), $this->pagination_limit);
        $results->appends($pass_value);
        $data['pass_value']     = ((count($pass_value) > 0) ? '?' : '').http_build_query($pass_value) . "\n";
        $data['results']        = $results;
        $data['page_headding']  = $this->page_headding;
        return view("admin.user.list", $data);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->page_headding   = 'Create User';
        $data                  = array();
        $data['page_headding'] = $this->page_headding;
        $data['action']        = "admin.user.create";
        $data['edit']          = "";
        return view("admin.user.edit", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = [
            'role_id' => 'User Role',
        ];
        $validatedData = Validator::make($request->all(), [
            'first_name'            => 'required|string',
            'last_name'             => 'required|string',
            'email'                 => 'required|string|email|unique:admin_users',
            'phone'                 => 'required',
            'password'              => 'required|min:6|string|confirmed',
            'password_confirmation' => 'required',
            'role_id'               => 'required|integer',

        ], [], $attributes);
        if ($validatedData->fails()) {
            return redirect('admin/user/create')
                        ->withErrors($validatedData)
                        ->withInput();
        }
        else{
            $input             = request()->all();
            if(!isset($input['status'])){
                $input['status'] = '0';
            }
            $input['password'] = Hash::make($input['password']);
            $admin_users       = $this->table_obj->create($input);            
            return redirect()->route('admin.user')->with('success', 'User successfully created.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $this->page_headding   = 'Edit User';
        $data                  = array();
        $data['page_headding'] = $this->page_headding;
        $data['action']        = "admin.user.edit";
        $data['page']          = ($request->input('page') !== null)? $request->input('page') : '';
        $data['search']        = ($request->input('search') !== null)? $request->input('search') : '';
        $data['edit']          = $id;
        $condition = array(
            'where' => array(
                0 => array('id', '=', $id)
            ),
            'orwhere' => array(
                // 0 => array('id', '>',  1),
            )
        );
        $existing_data =  $this->commonFunctionModel->fetchExistingDetails("*", $this->table_name, $condition );
        
        if(count($existing_data) == 0){
            return redirect()->route('admin.user')->with('error', 'User details not found.');
        }
        $data['existing_data']  = $existing_data[0];
        return view("admin.user.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attributes = [
            'role_id' => 'User Role',
        ];
        $validatedData = Validator::make($request->all(), [
            'first_name'            => 'required|string',
            'last_name'             => 'required|string',
            'email'                 => ['required','string', 'email',
                                         Rule::unique('admin_users')->ignore($id),
                                        ],
            'phone'                 => 'required',
            'role_id'               => 'required|integer',

        ], [], $attributes);
        if ($validatedData->fails()) {
            return redirect('admin/user/edit/'.$id)
                        ->withErrors($validatedData)
                        ->withInput();
        }
        else{
            $input             = request()->all();
            if(!isset($input['status'])){
                $input['status'] = '0';
            }
            $update_obj        = $this->table_obj->find($id);
            $update_obj->update($input);   
            $pass_value       = array();      
            if(isset($input['page']) && !empty($input['page']) ){
                $pass_value['page'] = $input['page'];
            }
            if(isset($input['search']) && !empty($input['search']) ){
                $pass_value['search'] = $input['search'];
            }
            return redirect()->route('admin.user', $pass_value)->with('success', 'User successfully updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        $pass_value = array();
        if(array_key_exists('page', $request->input()) && !empty($request->input('page')) ){
            $pass_value['page']   = $request->input('page');
        }
        if( array_key_exists('search', $request->input()) && !empty($request->input('search')) ){
            $pass_value['search'] = $request->input('search');
        }
        if($id > 1){
            $condition = [
                    ['id', '=', $id],
                    ['id', '!=', 1]
                    ];
            // $this->table_obj->where($condition)->delete();
            return redirect()->route('admin.user', $pass_value)->with('success', 'User successfully deleted.');
        }
        else{
            return redirect()->route('admin.user', $pass_value)->with('error', 'I cannot remove super admin.');
        }        
        
    }
}
