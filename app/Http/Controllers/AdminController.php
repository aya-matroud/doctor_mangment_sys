<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Storage;
use notification;
use App\Notifications\MyFirstNotification;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function addview(){

        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
                return view('admin.add_doctor');
            }

            else{

                 return redirect()->back();
            }

        }

        else{

            return redirect('login');
        }


    }

    public function upload(Request $request)
    {
        $doctor=new Doctor();
        if($request->has('file'))
        {
        $image=$request->file;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->file->move('doctorimage',$imagename);
        $doctor->image=$imagename;
        }
        $doctor->name=$request->name;
        $doctor->phone=$request->number;
        $doctor->speciality=$request->speciality;
        $doctor->save();
        return redirect()->back()->with('message','Doctor Added Successfully');

    }

    public function showappointment(){

        if(Auth::id())
        {
            if(Auth::user()->usertype==1)
            {
        $data=Appointment::all();
        return view('admin.showappointment',compact('data'));
            }
            else{

                return redirect()->back();
           }

       }

       else{

           return redirect('login');
       }

    }

    public function approved($id){

        $data=appointment::find($id);
        $data->status='approved';
        $data->save();
         return redirect()->back();

    }

    public function canceled($id){

        $data=appointment::find($id);
        $data->status='canceled';
        $data->save();
         return redirect()->back();


    }
    public function showdoctors(){

        $data=Doctor::all();
        return view('admin.showdoctors',compact('data'));
    }

    public function deletedoctor($id){
        $data=doctor::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function editdoctor($id){

        $data=doctor::find($id);
        return view('admin.updatedoctor',compact('data'));
    }

    public function updatedoctor(Request $request,$id){

        $doctor=doctor::find($id);
        $doctor->name=$request->name;
        $doctor->phone=$request->number;
        $doctor->speciality=$request->speciality;

        $image=$request->file;
        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->file->move('doctorimage',$imagename);
            $doctor->image=$imagename;
        }
        $doctor->save();
        return redirect()->back()->with('message','Doctor Details Updated Successfully');
    }

    public function viewmail($id){

        $data=appointment::find($id);
        return view('admin.view_mail',compact('data'));

    }


}
