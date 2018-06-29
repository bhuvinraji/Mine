<form method="post" action="{{ url('admin/excel_download') }}" class="user_download">
    {!! csrf_field() !!}
    <h5> Download User Detail </h5>
    From :
    <input type="date" id="from_date" name="from_date">
    To :
    <input type="date" id="to_date" name="to_date">
    <input type="submit" value="Submit">
</form>


public function excel_download(Request $request)
   {
       $requestData = $request->all();
       $excel_document = array();
       
       $from = $requestData['from_date'];
       $to = $requestData['to_date'];

       $candidate = DB::table('users')->whereBetween('created_at', [$from, $to])->select('name','email','mobile')->get();
      Session::flash('success', 'Event delete successfully!');
       if(count($candidate) > 0){
       //echo '<pre>'; print_r($candidate);
       
           foreach($candidate as $key => $profile){

           $excel_document[$key]['name']=$profile->name;
           $excel_document[$key]['email']=$profile->email;
           $excel_document[$key]['mobile']= $profile->mobile;

           }
     
             Excel::create('user details', function($excel) use($excel_document) {

              $excel->sheet('Sheetname', function($sheet) use($excel_document) {

              $sheet->fromArray($excel_document);

              });

             })->download('xls');  
       }else{
           
              return back()->with('error','There is no users betweeen this date');
       }
   }
$(document).ready(function(){
   $(".user_download").submit(function(){
       var from_date = document.getElementById('from_date').value;
       var to_date = document.getElementById('to_date').value;
       if(from_date =="" || to_date ==""){
           alert("please give from date and to date");
           return false;
       }
   })
})