<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Validator;
use App\Models\Subscribe;
use App\Models\StartWorkModel;
use App\Models\Category;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectImgDetails;
use App\Models\CaseStudies;
use App\Models\Studiesimages;
use App\Models\HomeBackground;
use App\Models\HomeVideo;
use App\Models\HomeAnimation;
use App\Models\HomeClient;
use App\Models\TestimonialModel;
use App\Models\AboutDesc;
use App\Models\BlogModel;
use App\Models\ServiceModel;
use App\Models\CategoryService;
use App\Models\AgencyDescVideo;
use App\Models\AgencyMembers;
use App\Models\AgencySlider;
use App\Models\ImageAgency;
use App\Models\Careers;
use App\Models\JobList;

class ApiController extends Controller
{

    public function homeScreen()
    {
        $homeback = HomeBackground::first();
        $aboutdesc = AboutDesc::first();
        $homevideo = HomeVideo::first();
        $animationtext = HomeAnimation::first();
        $client = HomeClient::all();
        $testimonial = TestimonialModel::all();
        $blog = BlogModel::orderBy('is_featured', 'desc')
        ->take(3)
        ->get();
        $service = ServiceModel::take(7)->get();
        $casestudies = CaseStudies::with(['StudiesImages'=> function ($query) {
            $query->orderBy('is_featured', 'desc');
        }])->where('status', '0')->take(5)->get();
        $projects = Project::with(['projectimgdetails' => function ($query) {
             $query->orderBy('is_featured', 'desc');
        }])->where('status', '0')->where('featured','1')->take(5)->get();
        $categories = Category::where('status', '0')->get();
        return response()->json([
            'status' => 200, 'homeback' => $homeback, 'aboutdesc' => $aboutdesc,
            'homevideo' => $homevideo, 'animationtext' => $animationtext, 'client' => $client, 'testimonial' => $testimonial,
            'projects' => $projects, 'blog' => $blog, 'service' => $service, 'casestudies' => $casestudies, 'categories' => $categories
        ]);
    }

    public function agencyScreen()
    {
        $agency = AgencyDescVideo::first();
        $team = AgencyMembers::all();
        $agencyslider = AgencySlider::all();
        $animationtext = HomeAnimation::first();
        $agencyimages = ImageAgency::first();
        return response()->json(['status' => 200, 'agency' => $agency, 'team' => $team, 'agencyslider' => $agencyslider, 'animationtext' => $animationtext,'agencyimages' => $agencyimages]);
    }

    public function serviceScreen()
    {
        $service = ServiceModel::with('servicesimages')->get();

        $categoryservice = CategoryService::where('status', '0')->get();
        return response()->json(['status' => 200, 'service' => $service, 'categoryservice' => $categoryservice]);
    }
    public function getservicesDetails($id)
    {
        $service = ServiceModel::all();
        return response()->json(['status' => 200, 'service' => $service, 'id' => $id]);
    }

    public function blogScreen()
    {
        $blog = BlogModel::all();
        return response()->json(['status' => 200, 'blog' => $blog]);
    }

    public function projectScreen()
    {
        $projects = Project::with(['projectimgdetails' => function ($query) {
            $query->orderBy('is_featured', 'desc');
        }])->where('status', '0')->get();
        $categories = Category::where('status', '0')->get();
        return response()->json([
            'status' => 200, 'projects' => $projects, 'categories' => $categories
        ]);
    }


    public function getprojectDetails($id)
    {
        $projects = Project::with('projectimgdetails')->where('status', '0')->find($id);
        return response()->json([
            'status' => 200, 'project' => $projects
        ]);
    }


    public function getcasestudiesScreen($id)
    {
 $casestudies = CaseStudies::with(['StudiesImages'=> function ($query) {
    $query->where('is_featured', false)->orderBy('is_featured', 'desc');
}])->where('status', '0')->find($id);
        return response()->json([
      'status' => 200, 'casestudies' => $casestudies
        ]);
    }



    public function getblogDetails($id)
    {
        $blog = BlogModel::find($id);
        return response()->json(['status' => 200, 'blog' => $blog]);
    }

    public function casestudiesScreen()
    {
        $casestudies = CaseStudies::with(['StudiesImages'=> function ($query) {
            $query->orderBy('is_featured', 'desc');
        }])->where('status', '0')->take(5)->get();
        return response()->json([
            'status' => 200, 'casestudies' => $casestudies
        ]);
    }




















// public function startwork(Request $request)
// {
//     // Define the validation rules
//     $rules = [
//         'fname' => 'required',
//         'lname' => 'required',
//         'msg' => 'required',
//         'phone' => 'required',
//     ];

//     // Check if checkboxone is checked
//     $checkboxone = $request->has('checkboxone') ? 1 : 0;

//     // Check if checkboxtwo is checked
//     $checkboxtwo = $request->has('checkboxtwo') ? 1 : 0;

//     // Add the checkbox values to the validation data array
//     $data = $request->all();
//     $data['checkboxone'] = $checkboxone;
//     $data['checkboxtwo'] = $checkboxtwo;

//     // Validate the request data
//     $validator = Validator::make($data, $rules, [
//         'fname.required' => 'Please enter your first name.',
//         'lname.required' => 'Please enter your last name.'
//     ]);
    
//         if ($validator->fails()) {
//             return response()->json($validator->errors()->first(), 400);
//         } else {
             
//     //         $fileAttachment = trim($request->file);
//     // $pathInfo       = pathinfo($fileAttachment);
//     // $attchmentName  = "attachment_".date("YmdHms").(
//     // (isset($pathInfo['extension']))? ".".$pathInfo['extension'] : ""
//     // );
   
//     // $attachment    = chunk_split(base64_encode(file_get_contents($fileAttachment)));
//     // $boundary      = "PHP-mixed-".md5(time());
//     // $boundWithPre  = "\n--".$boundary;
   
//     // $headers   = "From: info@thegoproject.me";
//     // $headers  .= "\nReply-To:  info@thegoproject.me";
//     // $headers  .= "\nContent-Type: multipart/mixed; boundary=\"".$boundary."\"";
   
//     // $message   = $boundWithPre;
//     // $message  .= "\n Content-Type: text/plain; charset=UTF-8\n";
//     // $message  .= "\nA new user has reached out to the Go project \nName:" .$request->fname. " " .$request->lname. "\nPhone:" .$request->phone.
//     //  "\nEmail:" .$request->email. "\nMessage:" .$request->msg. "\nCheckbox Value:" .$request->checkboxone. "\nCheckbox Second Value:" .$request->checkboxtwo;
   
//     // $message .= $boundWithPre;
//     // $message .= "\nContent-Type: application/octet-stream; name=\"".$attchmentName."\"";
//     // $message .= "\nContent-Transfer-Encoding: base64\n";
//     // $message .= "\nContent-Disposition: attachment\n";
//     // $message .= $attachment;
//     // $message .= $boundWithPre."--";
          
//             mail('mcheikhayla26@gmail.com', 'Contact Form',
//     //         "A new user has reached out to the Go project \nName:" .$request->fname. " " .$request->lname. "\nPhone:" .$request->phone.
//     //  "\nEmail:" .$request->email. "\nMessage:" .$request->msg. "\nCheckbox Value:" .$request->checkboxone. "\nCheckbox Second Value:" .$request->checkboxtwo
//     // $message
//     'hey'
//     //  , $headers
//      );
//             return response()->json(['msg' => 'success']);
//         }
// }

    public function startwork(Request $request)
    {
        // Define the validation rules
        $rules = [
            'fname' => 'required',
            'lname' => 'required',
            'msg' => 'required',
            'phone' => 'required',
            'checkboxone' => 'required',
            'file' => 'required|file'     
        ];
    
        // Check if checkboxone is checked
        $checkboxone = $request->has('checkboxone') ? 1 : 0;
    
        // Check if checkboxtwo is checked
        $checkboxtwo = $request->has('checkboxtwo') ? 1 : 0;
    
        // Add the checkbox values to the validation data array
        $data = $request->all();
        $data['checkboxone'] = $checkboxone;
        $data['checkboxtwo'] = $checkboxtwo;
    
        // Validate the request data
        $validator = Validator::make($data, $rules, [
            'fname.required' => 'Please enter your first name.',
            'lname.required' => 'Please enter your last name.'
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors()->first(), 400);
        } else {
        $file = $request->file('file');
        
        // Create a unique filename
        $filename = time() . '_' . $file->getClientOriginalName();
        
        // Move the file to a temporary location
        $file->move(storage_path('temp'), $filename);
        
        // Build the email message
        $message ="A new user has reached out to the Go project \nName:" .$request->fname. " " .$request->lname. "\nPhone:" .$request->phone.
        "\nEmail:" .$request->email. "\nMessage:" .$request->msg. "\nCheckbox Value:" .$request->checkboxone. "\nCheckbox Second Value:" .$request->checkboxtwo;
        
        // Set up the email data
        $to = 'mcheikhayla26@gmail.com';
        $subject = 'Start Work Form';
        $headers = "From: sender@example.com\r\n";
        $headers .= "Reply-To: sender@example.com\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";
        
        // Build the email body
        $body = "--boundary\r\n";
        $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n";
        $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $body .= $message . "\r\n\r\n";
        $body .= "--boundary\r\n";
        $body .= "Content-Type: application/octet-stream; name=\"" . basename($filename) . "\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n";
        $body .= "Content-Disposition: attachment; filename=\"" . basename($filename) . "\"\r\n\r\n";
        $body .= chunk_split(base64_encode(file_get_contents(storage_path('temp/' . $filename)))) . "\r\n";
        $body .= "--boundary--";
        
        // Send the email using the PHP mail() function
        $result = mail($to, $subject, $body, $headers);
        
        // Delete the temporary file
        if (file_exists(storage_path('temp/' . $filename))) {
            unlink(storage_path('temp/' . $filename));
        }
        if ($result) {
            response()->json(['msg' => 'success']);
        } else {
            return response()->json(['error' => 'Error sending mail'], 500);
        }
        // Move the file to a temporary location
        // $file->move(storage_path('temp'), $filename);
            // mail('mcheikhayla26@gmail.com', 'Contact Form',$message);
            // return 
        }
    }
 

public function contact(Request $request)
{
    // Define the validation rules
    $rules = [
        'fname' => 'required',
        'lname' => 'required',
        'msg' => 'required',
        'phone' => 'required',
        'checkboxone' => 'required', // Make checkboxone field required
    ];

    // Validate the request data
    $validator = Validator::make($request->all(), $rules, [
        'fname.required' => 'Please enter your first name.',
        'lname.required' => 'Please enter your last name.',
        'checkboxone.required' => 'Please check the checkbox.',
    ]);

  
        if ($validator->fails()) {
            return response()->json($validator->errors()->first(), 400);
        } else {
        $file = $request->file('file');
        
        // Create a unique filename
        $filename = time() . '_' . $file->getClientOriginalName();
        
        // Move the file to a temporary location
        $file->move(storage_path('temp'), $filename);
        
        // Build the email message
        $message ="A new user has reached out to the Go project \nName:" .$request->fname. " " .$request->lname. "\nPhone:" .$request->phone.
        "\nEmail:" .$request->email. "\nMessage:" .$request->msg. "\nCheckbox Value:" .$request->checkboxone. "\nCheckbox Second Value:" .$request->checkboxtwo;
        
        // Set up the email data
        $to = 'mcheikhayla26@gmail.com';
        $subject = 'Start Work Form';
        $headers = "From: sender@example.com\r\n";
        $headers .= "Reply-To: sender@example.com\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";
        
        // Build the email body
        $body = "--boundary\r\n";
        $body .= "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n";
        $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $body .= $message . "\r\n\r\n";
        $body .= "--boundary\r\n";
        $body .= "Content-Type: application/octet-stream; name=\"" . basename($filename) . "\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n";
        $body .= "Content-Disposition: attachment; filename=\"" . basename($filename) . "\"\r\n\r\n";
        $body .= chunk_split(base64_encode(file_get_contents(storage_path('temp/' . $filename)))) . "\r\n";
        $body .= "--boundary--";
        
        // Send the email using the PHP mail() function
        $result = mail($to, $subject, $body, $headers);
        
        // Delete the temporary file
        if (file_exists(storage_path('temp/' . $filename))) {
            unlink(storage_path('temp/' . $filename));
        }
        if ($result) {
            response()->json(['msg' => 'success']);
        } else {
            return response()->json(['error' => 'Error sending mail'], 500);
        }
        // Move the file to a temporary location
        // $file->move(storage_path('temp'), $filename);
            // mail('mcheikhayla26@gmail.com', 'Contact Form',$message);
            // return 
        }
    }
    
    
    public function careers(Request $request , $careers_id)
{
    // Define the validation rules
    $rules = [
        'fname' => 'required',
        'lname' => 'required',
        'city' => 'required',
       'linkone' => 'required',
        'file' => 'required|file'
    ];

    // Validate the request data
    $validator = Validator::make($request->all(), $rules, [
        'fname.required' => 'Please enter your first name.',
        'lname.required' => 'Please enter your last name.',
        'linkone.required' => 'Please enter at least the first link.',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors()->first(), 400);
    } else {
            $careers = new Careers();
          $careers->careers_id = $careers_id;
            $careers->fname = $request->fname;
            $careers->lname = $request->lname;
            $careers->city = $request->city;
            $careers->linkone = $request->linkone;
            $careers->linktwo = $request->linktwo;
            $careers->linkthree = $request->linkthree;
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $fileName = time().rand(1000,50000) . '.' . $file->getClientOriginalExtension();
            $file->move('resume/', $fileName);
            $uploadFile = 'resume/' . $fileName;
            $file=$uploadFile;
            $careers->file=$file;
        }  
            $careers->save();
            return response()->json(['msg' => 'success']);
    }
}
    
    

    public function getpositionScreen()
    {
       $joblist = JobList::all();
       return response()->json(['joblist' => $joblist],200); 
    }
    
    public function getpositiondetailsScreen($id)
    {
          $joblist = JobList::find($id);
       return response()->json(['joblist' => $joblist],200); 
    }
    public function AllCategories()
    {
        $projects = Project::with('projectimgdetails')->get();
        return response()->json(['projects' => $projects], 200);
    }
    public function Categories($id)
    {
        $categories = Category::with('projects')->find($id);
        return response()->json(['category' => $categories], 200);
    }
}
