<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bucketlist;
use App\ListItem;

class ListItemController extends Controller
{
    /**
     * Display a list items for a bucketlist.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // get all listitems where id = $id
        $listitems = ListItem::where('bucketlist_id', $id)
                    ->select('*')
                    ->orderBy('list_items.id', 'desc')
                    ->first();
        $bucketlist = Bucketlist::findOrFail($id)->first();

//        return response()->json($listitems);

        return [
                'id'=>$bucketlist->id,
                'name'=>$bucketlist->bucketlist,
                'items'=>[
                        $listitems
                    ],
                'created_at'=>$bucketlist->created_at,
                'updated_at'=>$bucketlist->updated_at,
                'created_by'=>$bucketlist->user_id,
            ];
    }


    /**
     * Store a new list under a bucket list.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
            // validate
            $this->validate($request, ['list' => 'required|string|min:6']);

        try {

            $listItem= new ListItem;
            $listItem->list = $request->input('list');
            $listItem->bucketlist_id = $id;

            if ($listItem->save()) {
                return [
                    'status' => 'successful',
                    'message' => 'list item created'
                ];
            }
        } catch (Exception $e) {
            return ["error"=>"there's a problem with the code"];
        }
    }

    /**
     * Display a specific item in a bucketlist
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $item_id)
    {
        $listitem = ListItem::where([
                            ['list_items.id','=', $item_id],
                            ['list_items.bucketlist_id','=', $id],
                        ])
                    ->first();

            return response()->json($listitem);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $item_id)
    {
            // validate
            $this->validate($request, ['list' => 'required|string|min:6']);

        try {

            $listitem= new ListItem;
            $listitem->list = $request->input('list');
            $data= array('list'=>$listitem->list);

            if (ListItem::where([
                            ['list_items.id','=', $item_id],
                            ['list_items.bucketlist_id','=', $id],
                        ])
                ->update($data)) {
                return [
                    'status' => 'successful',
                    'message' => 'list item edited'
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
    public function destroy($id, $item_id)
    {
        // get the list item
        $listitem = ListItem::where([
                            ['list_items.id','=', $item_id],
                            ['list_items.bucketlist_id','=', $id],
                        ])->first();
        // destroy the list item
        if($listitem->delete()){
            return response()->json([
                'status'=>'200',
                'message'=>'successfully deleted'
            ]);
        };
    }
}