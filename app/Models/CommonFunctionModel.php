<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class CommonFunctionModel extends Model
{
	function __construct(){

    }
    public function fetchAllResult($fields = "*", $table, $condition = null, $order = null, $offset = null, $limit = null){
        $query = DB::table($table);
        $query->select($fields);
        if($condition !== null){
            if(isset($condition['where'])){
                $query->where($condition['where']);
            }
            if(isset($condition['orwhere'])){
                $query->orwhere($condition['where']);
            }
        }
        if($offset !== null && $limit !== null){
            $query->offset($offset)
                 ->limit($limit);
        }

        if($order !== null){
            $query->orderBy($order[0], $order[1]);
        }
        $result = $query->get();    
        return $result;
    }
    public function fetchExistingDetails($fields = "*", $table, $condition = null){
        $query = DB::table($table);
        $query->select($fields);
        if($condition !== null){
            if(isset($condition['where'])){
                $query->where($condition['where']);
            }
            if(isset($condition['orwhere'])){
                $query->orwhere($condition['where']);
            }
        }
        $result = $query->get();    
        return $result;
    }
    public function fetchPaginationResult($fields = "*", $table, $condition = null, $order = null, $limit = 10){
        $where    = array();
        $orwhere  = array();
        if($condition !== null){
            if(isset($condition['where'])){
                $where = $condition['where'];
            }
            if(isset($condition['orwhere'])){
                $orwhere = $condition['orwhere'];
            }
        }
        $query = DB::table($table)->where($where)->orwhere($orwhere)->orderBy($order[0], $order[1])->paginate($limit);   
        return $query;
    }

}
