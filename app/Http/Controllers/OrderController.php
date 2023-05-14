<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use App\Models\Task;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    //-----------user dashboard-------------

    //-----------Management
    public function NewOrderForm(){
        $orderList = OrderList::where('user_id', '=', Auth::user()->id)
            ->where('order_id', '=', null)->get();
        
        return view('user.dashboard.order.new', compact('orderList'));
    }

    public function NewOrder(Request $request){
        $orderList = OrderList::where('user_id', '=', Auth::user()->id)
            ->where('order_id', '=', null)->get();

        $user = Auth::user();

        $validated = $request->validate(
            [
                'title' => 'required|string|max:255',
                'description' => 'required',
            ]
            );

        $newOrder = new Order;
        $newOrder->title = $validated['title'];
        $newOrder->description = $validated['description'];
        $newOrder->client_id = $user->id;
        $newOrder->status = 0.0;
        $newOrder->order_status = 'pending';
        $newOrder->is_archived = false;
        $newOrder->is_canceled = false;
        $newOrder->save();
        
        foreach ($orderList as $item) {
            $item->order_id = $newOrder->id;
            $item->save();
        }

        return redirect(route('displayOrder', $newOrder));
    }

    public function DisplayAllOrders(){
        $orders = Auth::user()->Orders()->where('is_archived', '=', false)
                                        ->where('is_canceled', '=', false)
                                        ->get();
        return view('user.dashboard.order.index', compact('orders'));
    }

    public function DisplayOrder(Order $order){

        $tasks = $order->Tasks()->get();
        $orderList = $order->OrderList()->get();
        $taskGroups = array();

        foreach($tasks as $item){
            if(!in_array($item->group, $taskGroups))
            {
                $taskGroups[] = $item->group;
            }
        }
        return view('user.dashboard.order.show', compact('order', 'tasks', 'taskGroups', 'orderList'));
    }

    public function CancelOrder(Order $order){
        $order->is_canceled = true;
        $order->is_archived = true;
        $order->save();
        return redirect(route('displayAllOrders'));
    }

    public function DisplayInvoice(Order $order){
        $user = Auth::user();
        $invoice = $order->Invoice()->get();
        $tasks = $order->Tasks()->get();
        return view('user.dashboard.invoice', compact('user , order, tasks, invoice'));
    }


    public function AddProductToList(Request $request, $category, $id){

        $orderList = new OrderList;
        $orderList->order_id = null;
        $orderList->user_id = Auth::user()->id;
        $orderList->prod_id = $id;
        $orderList->prod_category = $category;
        $orderList->volume = $request->volume;
        $orderList->save();
        return redirect('products/'.$category.'s/'.$id);
    }

    public function RemoveProductFromList(OrderList $listItem){
        $listItem->delete();
        return redirect(route('main'));
    }

    //-----------control panel-------------
    //-----------Management
    public function IndexPendingOrders(Request $request){

        if($request->search)
        {
            $request->flash();
            $searching = true;
            $orders = Order::where(function ($query){
                                $query  ->where('is_archived', '=', false)
                                        ->where('order_status', '=', 'pending');
                            })
                            ->where(function ($query) use ($request){
                                $query  ->where('title', 'LIKE', '%' . $request->search . '%')
                                        ->orWhere('client_id', 'LIKE', '%' . $request->search . '%');
                            })
                            ->paginate(15);
            if($orders->isNotEmpty()){
                $isFound = true;
                return view('admin.order.index-pending', compact('searching', 'isFound', 'orders'));
            }else{
                $isFound = false;
                return view('admin.order.index-pending', compact('searching','isFound'));
            }
        }else{
            $searching = false;
            $orders = Order::where('is_archived', '=', false)
                            ->where('order_status', '=', 'pending')
                            ->paginate(15);
            return view('admin.order.index-pending', compact('searching', 'orders'));
        }
        
    }

    public function IndexDeliveringOrders(Request $request){

        if($request->search)
        {
            $request->flash();
            $searching = true;
            $orders = Order::where(function ($query){
                                $query  ->where('is_archived', '=', false)
                                        ->where('order_status', '=', 'delivering');
                            })
                            ->where(function ($query) use ($request){
                                $query  ->where('title', 'LIKE', '%' . $request->search . '%')
                                        ->orWhere('client_id', 'LIKE', '%' . $request->search . '%');
                            })
                            ->paginate(15);
            if($orders->isNotEmpty()){
                $isFound = true;
                return view('admin.order.index-delivering', compact('searching', 'isFound', 'orders'));
            }else{
                $isFound = false;
                return view('admin.order.index-delivering', compact('searching','isFound'));
            }
        }else{
            $searching = false;
            $orders = Order::where('is_archived', '=', false)
                            ->where('order_status', '=', 'delivering')
                            ->paginate(15);
            return view('admin.order.index-delivering', compact('searching', 'orders'));    
        }
        
    }

    public function IndexCompletedOrders(Request $request){

        if($request->search)
        {
            $request->flash();
            $searching = true;
            $orders = Order::where(function ($query){
                                $query  ->where('is_archived', '=', false)
                                        ->where('order_status', '=', 'completed');
                            })
                            ->where(function ($query) use ($request){
                                $query  ->where('title', 'LIKE', '%' . $request->search . '%')
                                        ->orWhere('client_id', 'LIKE', '%' . $request->search . '%');
                            })
                            ->paginate(15);
            if($orders->isNotEmpty()){
                $isFound = true;
                return view('admin.order.index-completed', compact('searching', 'isFound', 'orders'));
            }else{
                $isFound = false;
                return view('admin.order.index-completed', compact('searching','isFound'));
            }
        }else{
            $searching = false;
            $orders = Order::where('is_archived', '=', false)
                            ->where('order_status', '=', 'completed')
                            ->paginate(15);
            return view('admin.order.index-completed', compact('searching', 'orders'));    
        }
        
    }

    public function IndexArchivedOrders(Request $request){
        if($request->search)
        {
            $request->flash();
            $searching = true;
            $orders = Order::where(function ($query){
                                $query  ->where('is_archived', '=', true);
                            })
                            ->where(function ($query) use ($request){
                                $query  ->where('title', 'LIKE', '%' . $request->search . '%')
                                        ->orWhere('client_id', 'LIKE', '%' . $request->search . '%');
                            })
                            ->paginate(15);
            if($orders->isNotEmpty()){
                $isFound = true;
                return view('admin.order.index-archived', compact('searching', 'isFound', 'orders'));
            }else{
                $isFound = false;
                return view('admin.order.index-archived', compact('searching','isFound'));
            }
        }else{
            $searching = false;
            $orders = Order::where('is_archived', '=', true)
                            ->paginate(15);
            return view('admin.order.index-archived', compact('searching', 'orders'));    
        }
    }

    public function ChangeOrderStatus(Order $order, $status)
    {
        
        $order->order_status = $status;
        $order->save();

        return redirect(route('indexPendingOrders'));
    }

    public function ShowOrder(Order $order){
        $client = $order->Client()->get()[0];
        $orderList = $order->OrderList()->get();
        $tasks = $order->Tasks()->get();
        $taskGroups = array();
        foreach($tasks as $item){
            if(!in_array($item->group, $taskGroups))
            {
                $taskGroups[] = $item->group;
            }
        }

        return view('admin.order.show', compact('order', 'tasks', 'client', 'taskGroups', 'orderList'));
    }

    public function ArchiveOrder(Order $order){

        $order->is_archived = true;
        $order->save();

        return redirect(route('indexPendingOrders'));
    }

    public function UnarchiveOrder(Order $order){

        $order->is_archived = false;
        $order->save();

        return redirect(route('indexPendingOrders'));
    }

    
    //-----------Tasks
    public function AddTask(Request $request, Order $order){
        //add task
        $valid = $request->validate([
            'title' => 'required',
            'group' => 'required',
            'cost' => 'required',
        ]);

        $task = new Task;
        $task->order_id = $order->id;
        $task->title = $valid['title'];
        $task->group = $valid['group'];
        $task->cost = $valid['cost'];
        $task->is_done = false;
        $task->save();

        //update order status
        $tasks = $order->Tasks()->get();
        $doneTasks = $order->Tasks()->where('is_done', '=', true)->get();
        $order->status = ($doneTasks->count() / $tasks->count()) * 100;
        $order->save();

        return redirect(route('showOrder', $order));
    }

    public function EditTask(Request $request, Order $order , Task $task){

        if($request->isChecked)
        {
            if($request->isChecked == 'true')
            {
                $task->is_done = 1;
            }else{
                $task->is_done = 0;
            }

            $task->save();

            //update order status
            $tasks = $order->Tasks()->get();
            $doneTasks = $order->Tasks()->where('is_done', '=', true)->get();
            $order->status = ($doneTasks->count() / $tasks->count()) * 100;
            $order->save();
        }
        return redirect(route('showOrder', $order));
    }

    public function DeleteTask(Task $task){
        //delete task

        //update order status
        $order = $task->Order()->get();
        $tasks = $order->Tasks()->get();
        $doneTasks = $order->Tasks()->where('is_done', '=', 'true')->get();
        $order->status = ($doneTasks->count() / $tasks->count()) * 100;
        $order->save();
        
    }


    //-----------Invoice
    public function BuildInvoice(Order $order){
        
    }

}
