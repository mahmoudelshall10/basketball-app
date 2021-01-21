<?php

if(!function_exists('fcm_send'))
{
    function fcm_send($token,  $title = '' ,$body = '', $data = '')
    {
        $api_key = 'AAAAtOczi3I:APA91bGv5RJvgkAUdaluHtlgYoQbgWVMLNUGxHEDp9McyJ34kfHMlLYZ5149uEuzEPRQkkCr3FPnvOmSnrUDDv7tV9hYdzUeFLW3JzRTU6oOXN631-3Hc4PcQCI34Q9hRXTM08XZW7hH';
        $push_url = 'https://fcm.googleapis.com/fcm/send';
        if (!is_array($token)) {
            $token = [$token];
        }
        // $array_token =array();
        $msg =
            [
                'body' => $body,
                'title' => $title,
                // 'click_action' => 'home'
                //'custom_url'   => $url
            ];
        $fields =
            [
                'registration_ids' => $token,
                'notification' => $msg,
            ];
        if (!empty($data)) {

            $fields['data'] = $data;
            // dd($data);
        }
        $headers =
            [
                'Authorization' => 'key=' . $api_key,
                'Content-Type' => 'application/json'
            ];
        
        // dd($fields);
        
        $client = new \GuzzleHttp\Client();
        
        $response = $client->post($push_url, [
            'headers' => $headers,
            'body' => json_encode($fields)
        ]);

        $result = $response->getBody();
        // dd($response);
        return $result;
    } //end of // push notification function
}

if(!function_exists('mutlpileEle'))
{
    function mutlpileEle($m,$n)
    {
        $result = [];
        if(is_array($m) && is_array($n))
        {
            for($i=0;$i<count($m);$i++)
            {
                for($x=0;$x<count($n);$x++)
                {
                    if($i == $x)
                    {
                        $result[] = $m[$i] * $n[$x]; 
                    }
                }
            }
            return $result;
        }
    }
}

// if(!function_exists('trans_a'))
// {
//     function trans_a($arr,$para)
//     {
//         $t = [];
//         $c = 0;
//         $k = [];
//         // dd(array_merge((array)$arr));
//         foreach((array)$arr as $key => $trans)
//         {
//             // return array_sum((array)$trans);
//             // $k[] = $key;
//             // $k[] = (array)$trans;
//             // dd($k);
//             foreach($trans as $key1 => $singleTrans)
//             {
//             // $t[] = arrSumSameKey((array)$singleTrans[$para]);
//                 // for($i=0;$i<count((array)$singleTrans);$i++){
//                     // $k[] = (array)$singleTrans;
//                     $k[] = (array)$singleTrans->$para;
//                 // }
//             // $t[] = arrSumSameKey((array)$singleTrans->$para);
//             // array_push($t,$c);
//             }
//         }
//         dd($k);
//     }   
// }

if(!function_exists('multiply'))
{
    function multiply($arr)
    {
        $r = [];
        $c = count($arr);
        foreach($arr as $item)
        {
            $r[] = $item * $c;
        }
        return $r;
    }
}
if(!function_exists('doubleFor'))
{
    function doubleFor($arr,$arr1)
    {
        $r = [];
        for ($i = 0; $i < count($arr); $i++){
            for ($x = 0; $x < count($arr1); $x++){
                if($i == $x)
                {
                    array_push($r,$arr[$i],$arr1[$x]);
                }
            }
          }
        return $r;
    }
}

// if(!function_exists('arrayUnShift'))
// {
//     function arrayUnShift($arr,$arr1,$length)
//     {
//         $exArr = [];

//         // if()
//         // {

//         // } 
//     }
// }
// if(!function_exists('FunctionName'))
// {
//     function FunctionName()
//     {
//         if(request()->hasFile('file') ) {
//             $file = request()->file('file');
//             $imagemimes = ['jpg','jpeg','png','gif']; //Add more mimes that you want to support
//             $videomimes = ['flv','mp4','wmv']; //Add more mimes that you want to support
//             $audiomimes = ['mp3','mpeg']; //Add more mimes that you want to support
//             if(in_array($file->getMimeType() ,$imagemimes)) {
//                 $filevalidate = "required|image|mimes:.$imagemimes|max:2048";
//             }
//             //Validate video
//             if (in_array($file->getMimeType() ,$videomimes)) {
//                 $filevalidate = "required|video|mimes:.$videomimes";
//             }
//             //validate audio
//             if (in_array($file->getMimeType() ,$audiomimes)) {
//                 $filevalidate = "required|audio|mimes:.$audiomimes";
//             }		
//         }
//         $this->validate(request(), [
//             'file' => $filevalidate,
//             'body' => 'required'
//         ]);
//     }
// }

