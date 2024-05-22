<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use view;

class DemoController extends Controller
{

    public function homePage()
    {
        return view('home');
    }
    //======================Prerecorded video======================//
    //======================Request======================//
    public function simpleRequest(): string
    {
        return "simple request me";
    }

    // Request With Parameters
    public function requiredPeramiter($name, $age, $city): string
    {
        return "My name is {$name}. Age is {$age}. My city name is $city";
    }
    // second type
    // public function requiredPeramiter(Request $request):string{
    //     $name = $request->name;
    //     $age = $request->age;
    //     $city = $request->city;
    //     return "My name is {$name}. My age is {$age}, My City name is $city";
    // }

    public function optionalPeramiter($name = "Korim", $age = 30, $city = "Tongi"): string
    {
        return "My name is {$name}. Age is {$age}. My city name is $city";
    }
    // // second type
    // public function optionalPeramiter(Request $request):string{
    //     $name = $request->name;
    //     $age = $request->age;
    //     $city = $request->city;
    //     return "My name is {$name}. My age is {$age}, My City name is $city";
    // }



    //Request Body
    //single data
    public function requestBody(Request $request): string
    {
        $name = $request->input("name");
        $age = $request->input("age");
        $city = $request->input("city");
        return "My name is {$name}. My age is {$age}, My City name is $city";
    }
    // all data
    public function requestBodyData(Request $request): array
    {
        return $request->input();
    }
    //Request Header
    //single data
    public function headerSingleData(Request $request): string
    {
        $name = $request->header("name");
        $age = $request->header("age");
        $city = $request->header("city");
        return "My name is {$name}. My age is {$age}, My City name is $city";
    }
    // all data
    public function headerMultipleData(Request $request): array
    {
        return $request->header();
    }
    //Request all data
    //single data
    public function allSingleData(Request $request): string
    {
        // parameter data
        $name = $request->header("name");
        $age = $request->age;
        $city = $request->input("city");
        return "My name is {$name}. My age is {$age}, My City name is $city";
    }
    // all data
    public function allMultipleData(Request $request): array
    {
        $header = $request->header();
        $body = $request->input();
        $url = $request->age;
        return [
            "header" => $header,
            "body" => $body,
            "url" => $url
        ];
    }
    //from Data
    //single data
    public function fromDataSingle(Request $request)
    {
        $name = $request->input("name");
        $age = $request->input("age");
        $city = $request->input("city");
        return "My name is {$name}. My age is {$age}, My City name is $city";
    }
    // all data
    public function fromDataMultiple(Request $request): array
    {
        return $request->input();
    }
    public function singleImage(Request $request): string
    {
        $photo = $request->file('singlePhoto');
        $fileSize = filesize($photo);
        $fileType = filetype($photo);
        $fileOrginalName = $photo->getClientOriginalName();
        $fileTempName = $photo->getFilename();
        $fileExtention = $photo->extension();
        return response()->json([
            'fileSize' => $fileSize,
            'fileType' => $fileType,
            'fileOrginalName' => $fileOrginalName,
            'fileTempName' => $fileTempName,
            'fileExtention' => $fileExtention
        ]);
    }
    public function MultipleImage(Request $request)
    {
        $multipleImage = $request->file('multiplePhoto');
        foreach ($multipleImage as $data) {
            $fileSize = filesize($data);
            $fileType = filetype($data);
            $fileOrginalName = $data->getClientOriginalName();
            $fileTempName = $data->getFilename();
            $fileExtention = $data->extension();
            return response()->json([
                'fileSize' => $fileSize,
                'fileType' => $fileType,
                'fileOrginalName' => $fileOrginalName,
                'fileTempName' => $fileTempName,
                'fileExtention' => $fileExtention
            ]);
        }
    }
    public function singleFile(Request $request)
    {
        // upload move method
        $photo = $request->file('singlePhoto');
        $rename = date('Ymdhis') . $photo->getClientOriginalName();
        $photo->move(public_path('/image'), $rename);

        // upload storeAs  method
        $photo = $request->file('singlePhoto');
        $rename = date('Ymdhis') . $photo->getClientOriginalName();
        $photo->storeAs(('/image'), $rename);
    }
    public function MultipleFile(Request $request): bool
    {
        $multipleImage = $request->file('multiplePhoto');
        foreach ($multipleImage as $data) {
            $rename = date('Ymdhis') . $data->getClientOriginalName();
            $data->move(public_path('/image'), $rename);
            $data->save();
        }
        return true;
    }
    // ip address
    public function ipAddress(Request $request): string
    {
        $personalIp = $request->ip();
        return $personalIp;
    }

    // acceptable conentent type
    public function acceptableContentType(Request $request): array
    {
        try {
            $contentNagotiation = $request->getAcceptableContentTypes();
            return $contentNagotiation;
        } catch (Exception $exception) {
            return redirect()->back();
        }
    }
    public function acceptableContentTypeCondition(Request $request): string|array
    {
        try {
            if ($request->accepts('text/html')) {
                return "This Content type is text/html";
            } else {
                $contentNagotiation = $request->getAcceptableContentTypes();
                return $contentNagotiation;
            }
        } catch (Exception $exception) {
            return redirect()->back();
        }
    }
    public function cookie(Request $request): string|array
    {
        // all cookie
        return $request->cookie();
        //single cookie
        // $cookie1 = $request->cookie("Cookie_1");
        // $cookie2 = $request->cookie("Cookie_2");
        // return "First cookie value is  {$cookie1}. second cookie value is {$cookie2}";
    }
    //======================/Request======================//
    //======================Response======================//
    // simple GET request
    public function simpleResponse(): JsonResponse
    {
        $data = [
            "key" => "value",
            "key2" => "value2"
        ];
        $statusCode = 200;

        return response()->json($data, $statusCode);
    }
    // simple POST request (assuming you handle POST differently)
    public function simpleResponsePost(): JsonResponse
    {
        return $this->simpleResponse();
    }
    // Ridirect route
    // Redirect from redirect1 to redirect2
    public function redirect1(): RedirectResponse
    {
        return redirect()->route('route2');
    }
    public function redirect2(): string
    {
        return "route2";
    }

    // file bainary
    public function fileBinary(): BinaryFileResponse
    {
        $pathFile = public_path('img/1.jpg');
        return response()->file($pathFile);
    }

    public function fileDownload()
    {
        $pathFile = public_path('img/1.jpg');
        return response()->download($pathFile);
    }
    //cookie set
    public function cookies()
    {
        $Name = "token";
        $Value = "arif billah shobuz";
        $eExpirationTime = 120;
        $Path = "/";
        $Domain = $_SERVER['SERVER_NAME'];
        $Secure = false;
        $HttpOnly = true;
        return response("cookie set successfully")->cookie(
            $Name,
            $Value,
            $eExpirationTime,
            $Path,
            $Domain,
            $Secure,
            $HttpOnly
        );
    }
    // Header set
    public function header()
    {
        return Response::make("Header Create Successfully")->withHeaders([
            "name" => "Arif Billah Shobuz",
            "age" => "30",
            "village" => "Pragpur",
            "Town" => "Dhaka"
        ]);
        // or more method
        // return response("hi")->header("name", "Arif Billah Shobuz")->header("age","30 ")->header("village", "Pragpur")->header("Town", "Dhaka");
    }
    //======================/Response======================//
    //======================/Prerecorded video======================//

    //=======================hasin vai Live class=====================//
    public function peramiterNameAccept(Request $request, $name = null)
    {
        if ($name == null) {
            return response(" Please Provide Your Name", 400);
        } else {
            return response("my name is {$name}", 200);
        }
    }
    public function peramiterNumberAccept(Request $request, $id = null)
    {
        if ($id == null) {
            return response(" Please Provide Your Id", 400);
        } else {
            return response("My Id is {$id}", 200);
        }
    }
    public function peramiterQureyStringSpacificPeramiter(Request $request, $name = null)
    {
        if ($name == null) {
            return response(" Please Provide Your Name", 400);
        } else {
            $qureyStringAge = $request->input("age", "23");
            $qureyStringVillage = $request->input("village", "Pragpur");
            return response("my name is {$name} and age {$qureyStringAge} and village {$qureyStringVillage}", 200);
        }
    }
    public function peramiterQureyStringAllPeramiter(Request $request, $name = null,)
    {
        if ($name == null) {
            return response(" Please Provide Your Name", 400);
        } else {
            $qureyStringAllPeramiter = $request->input();
            // more option
            // $qureyStringAllPeramiter = $request->all();
            return response(["Main peramiter is {$name}", $qureyStringAllPeramiter], 200);
        }
    }
    //person page
    public function personPage(Request $request)
    {
        return view('personPage');
    }
    public function personStore(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $photo = $request->file('image');
        $rename = date('Ymdhis') . $photo->getClientOriginalName();
        $photo->move(public_path('/image'), $rename);
        // $images = $request->file('image');
        // $name = time()."-".$images->getClientOriginalName();
        // $images->move(public_path('images/'), $name);
        return view('person', [
            'name' => $name,
            'email' => $email,
            'image' => $photo
        ]);
    }

    //=======================/hasin vai Live class=====================//
    //=======================Rabbil vai Live class=====================//
    public function strngIntNullBoolenResponse(): string|int|null|bool
    {
        return "string";
        // return 10;
        // return null;
        // return true;
        // return false;
    }
    public function arrayAssociativeArrayResponse()
    {
        $array = ["arif", "billah", 30, "Dhaka"];
        $associativeArray = ["name" => "Arif Billah", "age" => 30, "city" => "Dhaka"];
        // return $array;
        return $associativeArray;
    }
    public function jsonRespons():JsonResponse
    {
        $associativeArray = ["name" => "Arif Billah", "age" => 30, "city" => "Dhaka"];
        // return $array;
        return response()->json($associativeArray);
    }
    public function responseWithDataMsgCode()
    {
        $associativeArray = ["name" => "Arif Billah", "age" => 30, "city" => "Dhaka"];
        // return $array;
        return response()->json(["status" => "success", "data" => $associativeArray, "message" => "Data retrieved successfully"], 200);
        // status code auto manege by laravel
        //200=> success, 201=> created, 202=> accepted, 203=> non-authoritative information,
        //305=> use proxy, 307=> temporary redirect, 308=> permanent redirect
        //400=>bad request,  403=> Forbidden, 404=>not found, 419=> session expired
        // 500=>server error

        // Default manage by your code
        //401 => Unauthorized
    }
    public function responseRedirect():RedirectResponse
    {
        return redirect('/string-int-null-boolen-response');
    }
    public function binaryFileResponse():BinaryFileResponse
    {
        // image path
        $image = 'image/T-shart.png';
        //binary response
        return response()->file($image);
    }
    public function fileDownloadManage():BinaryFileResponse
    {
            // image path
            $image = 'image/T-shart.png';
            //binary response to download
            return response()->download($image);
    }
    public function respnseCookies()
    {
        $Name = "user details";
        $Value = "arif billah shobuz";
        $ExpirationTime = 120;// 120 means 120 minits
        $Path = "/respnse-cookies";
        $Domain = $_SERVER['SERVER_NAME'];
        $Secure = true;
        $HttpOnly = true;
        return response('cookie set success')->cookie($Name,  $Value, $ExpirationTime,$Path, $Domain,$Secure,$HttpOnly);
    }
    public function responseWithHeaderProperties()
    {
        return response('header create successfully')->header('ostad1', "valu1")->header('ostad 2','valu 2');
    }
    public function responseBladeView()
    {
        return view('home');
    }
}
