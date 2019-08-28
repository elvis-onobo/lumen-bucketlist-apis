<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

use App\Bucketlist;
use App\User;

class BucketlistController extends Controller
{
    /**
     * Display a listing of the bucketlists.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($paginate)
    {
        // validate results, minimum of 20 and maximum of 100
        Validator::make($paginate,['paginate' => 'required|numeric|min:20|max:100']);
        // get all bucketlists
        $bucketlists = Bucketlist::paginate($paginate);

        return response()->json($bucketlists);
        // return [
        //     'id'=>$bucketlists->id,
        // ];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            // validate
            $this->validate($request, ['bucketlist' => 'required|string|min:6']);

        try {

            $bucketlist= new Bucketlist;
            $bucketlist->bucketlist = $request->input('bucketlist');
            $bucketlist->user_id =   $request->input('user_id');

            if ($bucketlist->save()) {
                return [
                    'status' => 'successful',
                    'message' => 'bucketlist created'
                ];
            }
        } catch (Exception $e) {
            return ["error"=>"there's a problem with the code"];
        }
    }

    /**
     * Display a specific bucketlist
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get single group
        $bucketlist = Bucketlist::findOrFail($id);

        // return single article as resource
        return response()->json($bucketlist);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $bucketlist_id)
    {
            // validate
            $this->validate($request, ['bucketlist' => 'required|string|min:6']);

        try {

            $bucketlist= new Bucketlist;
            $bucketlist->bucketlist = $request->input('bucketlist');
            $data= array('bucketlist'=>$bucketlist->bucketlist);

            if (Bucketlist::where('id', $bucketlist_id)->update($data)) {
                return [
                    'status' => 'successful',
                    'message' => 'bucketlist edited'
                ];
            }
        } catch (Exception $e) {
            return response()->json($e->message());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get single bucketlist
        $bucketlist = Bucketlist::findOrFail($id);
        // destroy the bucketlist
        if($bucketlist->delete()){
            return response()->json([
                'status'=>'200',
                'message'=>'successfully deleted'
            ]);
        };
    }

    /*
    *
    * Search for a specific bucketlist using a keyword
    *
    */
    public function search($q)
    {
        $q = htmlentities($q);
        $search = Bucketlist::where('bucketlist', 'LIKE', '%'.$q.'%')
                  ->orderBy('id', 'desc')
                  ->paginate(20);

        return response()->json($search);
    }
}