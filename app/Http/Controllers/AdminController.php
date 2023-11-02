<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function home()
    {


      


        return view(
            'dashboard',

        );
    }


public function getOrderRushHourData(Request $request)
{
    $data = Order::select(
        DB::raw("DATE_FORMAT(created_at, '%h:%i:%s') as hour"), 
        DB::raw('COUNT(*) as count')
    )->where('status' , 'done')
    ->whereNotNull('created_at')
    ->groupBy('hour')
    ->orderBy('hour')
    ->get();
    
    // Prepare the data for the chart
    $labels = $data->pluck('hour');
    $counts = $data->pluck('count');
    
    return response()->json([
        'labels' => $labels,
        'data' => $counts,
    ]);
    
}


    public function index($id)
    {
        if (view()->exists($id)) {
            return view($id);
        } else {
            return view('404');
        }

        //   return view($id);
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = auth()->user()->id;
        $admin = User::where('id', $id)->first();
        if ($admin) {
            return view('admin.profile.edit', compact('admin'));
        }
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
        $id = auth()->user()->id;
    
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'sometimes|nullable|confirmed', 
        ]);
        
        
        $input = $request->except('password');
        $admin = User::findOrFail($id);
    
        if ($request->filled('password')) {
            $input['password'] = bcrypt($request->password);
        } else {
            $input = Arr::except($input, ['password']);
        }
    
        $admin->update($input);
        return redirect()->back()
            ->with('edit', 'تم تحديث معلومات المستخدم بنجاح');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  

    public function getAllMonths()
    {
        $month_array = [];
        $months = Order::orderBy('created_at', 'ASC')->pluck('created_at');
        $months = json_decode($months);
        if (!empty($months)) {
            foreach ($months as $unformatted_month) {
                $date = new \DateTime($unformatted_month);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array[$month_no] = $month_name;
            }
        }
        return $month_array;
    }

    public function getMonthlyOrderCount($months)
    {
        $monthly_order_count = Order::whereMonth('created_at', $months)
            ->get()
            ->count();
        return $monthly_order_count;
    }
    public function getMonthlyOrderData()
    {
        $monthly_order_data_array = [];
        $monthly_order_count_array = [];
        $month_name_array = [];
        $month_array = $this->getAllMonths();
        if (!empty($month_array)) {
            foreach ($month_array as $month_no => $month_name) {
                $monthly_order_count = $this->getMonthlyOrderCount($month_no);
                array_push($monthly_order_count_array, $monthly_order_count);
                array_push($month_name_array, $month_name);
            }
        }
        $max_no = max($monthly_order_count_array);
        $max = round(($max_no + 10 / 2) / 10) * 10;

        $monthly_order_data_array = [
            'months' => $month_name_array,
            'order_count_data' => $monthly_order_count_array,
            'max' => $max,
        ];

        return $monthly_order_data_array;
    }}
