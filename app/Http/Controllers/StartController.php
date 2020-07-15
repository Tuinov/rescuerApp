<?php


namespace App\Http\Controllers;


use App\Events\NewEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StartController
{

    public function index()
    {
        $users = DB::table('goods')->get();
//        $url_data = [
//            [
//                'title' => 'DKA',
//                'url' => 'http://dka-develop.ru',
//            ],
//            [
//                'title' => 'youtube',
//                'url' => 'http://youtube.com',
//            ]
//        ];
        dd(json_encode($users));
        //dd($users);
        return view('start', [
            'url_data' => $url_data
        ]);


    }

    public function getJson()
    {
        return [
            [
                'title' => 'google',
                'url' => 'http://dka-develop.ru',
            ],
            [
                'title' => 'yandex',
                'url' => 'http://youtube.com',
            ]
        ];
    }

    public function chartData()
    {
        return [
            'labels' => ['март','апрель','май','июнь'],
            'datasets'   => [
                [
                    'label' => 'Продажи',
                    'backgroundColor' => '#F26202',
                    'data' => [15000,5000,10000,30000],
                ],
                [
                    'label' => 'Прошлый год',
                    'backgroundColor' => '#B5CC18',
                    'data' => [rand(5000, 10000),10000,8000,20000],
                ]
            ]
        ];
        
    }

    public function ajaxData()
    {
        $users = DB::table('products')->get();
        $ret =  [
            'label' => 'Прошлый год',
            'backgroundColor' => '#B5CC18',
            'data' => 10000,
        ];

        return json_encode($users);
    }

    public function newEvent(Request $request)
    {
       $result = [
            'labels' => ['март','апрель','май','июнь'],
            'datasets'   => [
                [
                    'label' => 'Продажи',
                    'backgroundColor' => '#F26202',
                    'data' => [15000,5000,10000,30000],
                ]
            ]
         ];

       if($request->has('label')) {
           $result['label'][] = $request->input('label');
           $result['datasets'][0]['data'] = (integer)$request->input('sale');

           if($request->has('realtime')) {
               if(filter_var($request->input('label'), FILTER_VALIDATE_BOOLEAN)) {
                   event(new NewEvent($result));

               }
           }
       }

       return $result;
    }
}