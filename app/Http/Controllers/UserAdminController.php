<?php

namespace App\Http\Controllers;

use App\Exports\OrderDetailsExport;
use App\Imports\OrdersImport;
use App\Models\Address;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Products;
use App\Models\Sub_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UserAdminController extends Controller
{
    /**
     * get this year all analytics Data
     */
    public function showData()
    {
        $userId = Auth::id();
        // Fetch month-wise data from DB
        $rawData = Order::selectRaw("
                MONTH(created_at) as month,
                MONTHNAME(created_at) as monthname,
                COUNT(*) as total_orders
            ")
            ->whereYear('created_at', date('Y'))
            ->where('user_id', $userId)
            ->groupBy(DB::raw('MONTH(created_at), MONTHNAME(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Define all 12 months
        $allMonths = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];

        //Map DB data for quick lookup
        $rawDataMap = $rawData->keyBy('month');

        //Fill all months (even with 0 orders)
        $finalData = [];

        foreach ($allMonths as $monthNumber => $monthName) {
            $finalData[] = [
                'month' => $monthName,
                'total_orders' => $rawDataMap[$monthNumber]->total_orders ?? 0,
            ];
        }
        $Products = Products::all()->count();
        $Orders = Order::where('user_id', $userId)->get()->count();
        $letestOrder = OrderDetails::orderBy('id', 'DESC')->with('order')->first();
        // dd($letestOrder);
        $Address = Address::where('user_id', $userId)->get()->count();
        $Categpories = Category::all()->count();
        $subCategories = Sub_Category::all()->count();


        return view('website.user-accounts.dashboard', compact('Products', 'Orders', 'Address', 'Categpories', 'subCategories', 'finalData', 'letestOrder'));
    }

    /**
     * get last 30 days data analytics
     */

    public function getLastMonthOrder()
    {
        $userId = Auth::id();
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();
        // dd($startOfLastMonth,$endOfLastMonth);
        // Fetch orders for last full month for a specific user, grouped by day name
        $orders = Order::select(
            DB::raw('DAYNAME(created_at) as day_name'), //laravel get days name using DAYNAME function and store data day_name
            DB::raw('COUNT(*) as total_orders') //count total order and store total_orders
        )
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->where('user_id', $userId)
            ->groupBy('day_name') //get day_name and store data by grouping
            ->get();

        $lastMonthOrders = Order::where('user_id', $userId)
            ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
            ->get()
            ->count();
        $Products = Products::all()->count();
        $letestOrder = OrderDetails::orderBy('id', 'DESC')->with('order')->first();
        $Address = Address::where('user_id', $userId)->get()->count();
        $Categpories = Category::all()->count();
        $subCategories = Sub_Category::all()->count();

        // Map day names to orders
        $rawDataMapDays = $orders->keyBy('day_name'); //create new key on day_name

        // Define all full day names (in order)
        $allDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        // Final array with all 7 days
        $finalDayData = [];

        foreach ($allDays as $dayName) {
            $finalDayData[] = [
                'Day' => $dayName,
                'total_orders' => $rawDataMapDays[$dayName]->total_orders ?? 0,
            ];
        }

        return view('website.user-accounts.last-month', compact('lastMonthOrders', 'Products', 'Address', 'orders', 'Categpories', 'subCategories', 'finalDayData', 'letestOrder'));
    }

    /**
     * get last 7 days data get
     */
    public function getLastWeekOrders()
    {
        $userId = Auth::id();

        // Last week's Monday
        $startOfLastWeek = Carbon::now()->startOfWeek()->subWeek();
        // Last week's Sunday
        $endOfLastWeek = Carbon::now()->endOfWeek()->subWeek();

        // Fetch orders for last week grouped by day name
        $orders = Order::select(
            DB::raw('DAYNAME(created_at) as day_name'),
            DB::raw('COUNT(*) as total_orders')
        )
            ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->where('user_id', $userId)
            ->groupBy('day_name')
            ->get();

        // Total order count (if you want it separately)
        $lastWeekOrders = Order::where('user_id', $userId)
            ->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->get()->count();
        $Products = Products::all()->count();
        $letestOrder = OrderDetails::orderBy('id', 'DESC')->with('order')->first();
        $Address = Address::where('user_id', $userId)->get()->count();
        $Categpories = Category::all()->count();
        $subCategories = Sub_Category::all()->count();

        // Map day names to orders
        $rawDataMapDays = $orders->keyBy('day_name');
        // Define all full day names
        $allDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        // Final array with all 7 days
        $finalDayData = [];

        foreach ($allDays as $dayName) {
            $finalDayData[] = [
                'Day' => $dayName,
                'total_orders' => $rawDataMapDays[$dayName]->total_orders ?? 0,
            ];
        }

        return view('website.user-accounts.last-week', compact('lastWeekOrders', 'Products', 'Address', 'orders', 'Categpories', 'subCategories', 'finalDayData', 'letestOrder'));
    }

    /**
     * get last last year data get
     */
    public function getLastYearOrder()
    {
        $userId = Auth::id();

        // Get the start and end date for the previous year
        $startOfLastYear = Carbon::now()->subYear()->startOfYear(); // January 1st of last year
        $endOfLastYear = Carbon::now()->subYear()->endOfYear();     // December 31st of last year

        // Fetch month-wise data from DB for last year
        $rawData = Order::selectRaw("
            MONTH(created_at) as month,
            MONTHNAME(created_at) as monthname,
            COUNT(*) as total_orders
        ")
            ->whereBetween('created_at', [$startOfLastYear, $endOfLastYear])  // Fetch data for last year
            ->where('user_id', $userId)
            ->groupBy(DB::raw('MONTH(created_at), MONTHNAME(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Define all 12 months
        $allMonths = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];

        // Map DB data for quick lookup
        $rawDataMap = $rawData->keyBy('month');

        // Fill all months (even with 0 orders)
        $finalData = [];

        foreach ($allMonths as $monthNumber => $monthName) {
            $finalData[] = [
                'month' => $monthName,
                'total_orders' => $rawDataMap[$monthNumber]->total_orders ?? 0,
            ];
        }

        // Count other required data
        $Products = Products::all()->count();
        $Orders = Order::where('user_id', $userId)
            ->whereBetween('created_at', [$startOfLastYear, $endOfLastYear])
            ->get()
            ->count();
        $letestOrder = OrderDetails::orderBy('id', 'DESC')->with('order')->first();
        $Address = Address::where('user_id', $userId)->get()->count();
        $Categpories = Category::all()->count();
        $subCategories = Sub_Category::all()->count();

        return view('website.user-accounts.last-year', compact('Products', 'Orders', 'Address', 'Categpories', 'subCategories', 'finalData', 'letestOrder'));
    }

    /**
     * Download Data With Excel Formate
     */

    //Selected Data Download For Excel Formate
    public function dawloadDataExalFormate(Request $request)
    {
        $ids = $request->input('order_ids');

        if (!$ids || count($ids) == 0) {
            return back()->withErrors(['error' => 'Please select at least one order.']);
        }
        $fileName = 'selected-orders_' . now()->format('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new OrderDetailsExport($ids), $fileName);
    }

    //Multiple Data Download In Excel Formate
    public function multipleData()
    {
        $fileName = 'selected-orders_' . now()->format('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new OrderDetailsExport(), $fileName);
    }

    /**
     * import data with excel sheet
     */

     public function importDataWithExcel(Request $request){
        $request->validate([
            'import_file' => ['required','file']
        ]);

        Excel::import(new OrdersImport , $request->file('import_file'));

        return redirect()->back()->with('success','Data Is Imported Successfully!');
     }

     public function ContectUs(){
        return view('website.contect');
     }
}
