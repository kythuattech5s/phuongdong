<?php
namespace App\Http\Controllers;
use App\Models\{News,Services,Specialist,Doctor,RegisterAdvise,BookApointment,BookApointmentDoctor,TimePick};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use \View;
class StaticController extends Controller
{
    public function contact($request, $route, $link)
    {
    	$currentItem = $route;
    	return View::make('static.contact',compact('currentItem'));
    }
    public function search($request, $route, $link)
    {
    	if ($request->isMethod('post')) {
    		$val = $request->input('val');
			if (!isset($val)) return '';
			$listNews = News::publish()->act()->FullTextSearch('name',$val)->ord()->get()->take(3)->all();
			$listServices = Services::act()->FullTextSearch('name',$val)->ord()->get()->take(3)->all();
			$listSpecialist = Specialist::act()->FullTextSearch('name',$val)->ord()->get()->take(3)->all();
			$listDoctor = Doctor::act()->FullTextSearch('name',$val)->ord()->get()->take(3)->all();
			return view('search.autocomplete_search_result',compact('listNews','listServices','listSpecialist','listDoctor','val'));
    	}

    	if ($request->isMethod('get')) {
    		$val = $request->input('q');
    		return view('search.view',compact('val'));
    	}
    }
    public function searchItem($request, $route, $link){
    	$q = $request->input('q');
    	$type = $request->input('type');
    	if (!isset($q) || !isset($type)) {
    		echo 'Không có kết quả nào phù hợp';
    	}
    	switch ($type) {
    		case 'news':
				$listItems = News::publish()->act()->FullTextSearch('name',$q)->paginate(3);
				return view('search.search_news',compact('listItems'));
    			break;
    		default:
    			return '';
    			break;
    	}
    }
    protected function validatorSendBookApointment(array $data)
    {
        return Validator::make($data, [
            'fullname' => ['required'],
            'phone' => ['required'],
            'day_book' => ['required'],
            'time_pick' => ['required']
        ],[
            'required' => 'Vui lòng nhập/chọn :attribute'
        ],[
            'fullname' => 'Họ và tên',
            'phone' => 'Số điện thoại',
            'day_book' => 'Ngày đặt',
            'time_pick' => 'Lich khám'
        ]);
    }
    public function bookApointment ($request, $route, $link){
        $validator = $this->validatorSendBookApointment($request->all());
        if ($validator->fails()) {
            return \Support::response([
                'code' => 100,
                'message' => $validator->errors()->first(),
                'redirect' => url()->previous()
            ]);
        }
        $itemTimePick = TimePick::find($request->input('time_pick'));
        $timePickText = isset($itemTimePick) ? $itemTimePick->name:'';
        $dataCreate = [
            'fullname'  => $request->input('fullname'),
            'phone'     => $request->input('phone'),
            'day_book'  => $request->input('day_book'),
            'time_pick' => $request->input('time_pick'),
            'time_pick_text' => $timePickText,
            'act' => 0,
            'created_at' => new \DateTime,
            'updated_at' => new \DateTime,
            'note' => $request->input('note')
        ];
        BookApointment::insert($dataCreate);
        $this->sendEmailNoficationContact($dataCreate,'bookApointment');
        return \Support::response([
            'code' => 200,
            'message' => 'Gửi thông tin thành công'
        ]);
    }
    protected function validatorSendResgisterAdvise(array $data)
    {
        return Validator::make($data, [
            'fullname' => ['required'],
            'phone' => ['required'],
            'email' => ['required','email'],
        ],[
            'required' => 'Vui lòng nhập/chọn :attribute',
            'email' => 'Vui lòng nhập Email đúng định dạng'
        ],[
            'fullname' => 'Họ và tên',
            'phone' => 'Số điện thoại',
        ]);
    }
    public function resgisterAdvise($request, $route, $link){
        $validator = $this->validatorSendResgisterAdvise($request->all());
        if ($validator->fails()) {
            return \Support::response([
                'code' => 100,
                'message' => $validator->errors()->first(),
                'redirect' => url()->previous()
            ]);
        }
        $dataCreate = [
            'fullname'  => $request->input('fullname'),
            'phone'     => $request->input('phone'),
            'email'     => $request->input('email'),
            'act' => 0,
            'created_at' => new \DateTime,
            'updated_at' => new \DateTime,
            'note' => $request->input('note')
        ];
        RegisterAdvise::insert($dataCreate);
        $this->sendEmailNoficationContact($dataCreate,'resgisterAdvise');
        return \Support::response([
            'code' => 200,
            'message' => 'Gửi thông tin thành công'
        ]);
    }
    public function bookApointmentDoctor($request, $route, $link){
        $validator = $this->validatorSendResgisterAdvise($request->all());
        if ($validator->fails()) {
            return \Support::response([
                'code' => 100,
                'message' => $validator->errors()->first(),
                'redirect' => url()->previous()
            ]);
        }
        $dataCreate = [
            'doctor_id' => (int)$request->input('doctor'),
            'fullname'  => $request->input('fullname'),
            'phone'     => $request->input('phone'),
            'email'     => $request->input('email'),
            'act' => 0,
            'created_at' => new \DateTime,
            'updated_at' => new \DateTime,
            'note' => $request->input('note')
        ];
        BookApointmentDoctor::insert($dataCreate);
        $this->sendEmailNoficationContact($dataCreate,'bookApointmentDoctor');
        return \Support::response([
            'code' => 200,
            'message' => 'Gửi thông tin thành công'
        ]);
    }
    public function sendEmailNoficationContact($data,$type){
        // Phân quyền email nhận thông tin liên hệ
        return true;
    }
}