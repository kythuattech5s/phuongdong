<?php
namespace App\Http\Controllers;
use App\Models\{News,Services,Specialist,Doctor,RegisterAdvise,BookApointment,BookApointmentDoctor,TimePick,Question,QueueEmail};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use \View;
use App\Helpers\Utm;
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
            $listQuestion = Question::act()->FullTextSearch('name',$val)->ord()->get()->take(3)->all();
			return view('search.autocomplete_search_result',compact('listNews','listQuestion','listServices','listSpecialist','listDoctor','val'));
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
				$listItems = News::publish()->act()->FullTextSearch('name',$q)->paginate(4);
				return view('search.search_news',compact('listItems'));
    			break;
            case 'service':
                $listItems = Services::act()->FullTextSearch('name',$q)->paginate(3);
                return view('search.search_services',compact('listItems'));
                break;
            case 'specialist':
                $listItems = Specialist::act()->FullTextSearch('name',$q)->paginate(4);
                return view('search.search_specialist',compact('listItems'));
                break;
            case 'doctor':
                $listItems = Doctor::act()->FullTextSearch('name',$q)->paginate(4);
                return view('search.search_doctor',compact('listItems'));
                break;
            case 'question':
                $listItems = Question::act()->FullTextSearch('name',$q)->paginate(4);
                return view('search.search_question',compact('listItems'));
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
        ],[
            'required' => 'Vui lòng nhập/chọn :attribute'
        ],[
            'fullname' => 'Họ và tên',
            'phone' => 'Số điện thoại',
        ]);
    }
    public function bookApointment ($request, $route, $link)
    {
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
        $data = [
            'fullname'  => $request->input('fullname'),
            'service_id'=> (int)$request->input('service'),
            'age'       => $request->input('age'),
            'phone'     => $request->input('phone'),
            'email'     => $request->input('email'),
            'day_book'  => $request->input('day_book'),
            'time_pick' => $request->input('time_pick'),
            'time_pick_text' => $timePickText,
            'status' => 1,
            'created_at' => new \DateTime,
            'updated_at' => new \DateTime,
            'note' => $request->input('note'),
            'doctor_id' => (int)$request->input('doctor')
        ];
        $utmInfo = Utm::get();
        $dataCreate = array_merge($data,$utmInfo);
        // BookApointment::insert($dataCreate);
        $this->sendEmailNoficationContact($dataCreate,'bookApointment');
        return \Support::response([
            'code' => 200,
            'message' => 'Đặt lịch khám thành công'
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
        $data = [
            'fullname'  => $request->input('fullname'),
            'phone'     => $request->input('phone'),
            'email'     => $request->input('email'),
            'act' => 0,
            'created_at' => new \DateTime,
            'updated_at' => new \DateTime,
            'note' => $request->input('note')
        ];
        $utmInfo = Utm::get();
        $dataCreate = array_merge($data,$utmInfo);
        // RegisterAdvise::insert($dataCreate);
        $this->sendEmailNoficationContact($dataCreate,'resgisterAdvise');
        return \Support::response([
            'code' => 200,
            'message' => 'Đăng ký thành công'
        ]);
    }
    public function sendEmailNoficationContact($data,$type){
        switch ($type) {
            case 'bookApointment':
                $title = $_SERVER['SERVER_NAME'].' Khách hàng gửi thông tin đặt lịch khám.';
                $content = view('queue_emails.book_apointment',compact('data'))->render();
                $listEmail = \DB::table('email_receive_informations')->whereRaw("FIND_IN_SET(1,group_email)")->get()->all();
                break;
            case 'resgisterAdvise':
                $title = $_SERVER['SERVER_NAME'].' Khách hàng gửi thông tin đăng ký tư vấn.';
                $content = view('queue_emails.resgister_advise',compact('data'))->render();
                $listEmail = \DB::table('email_receive_informations')->whereRaw("FIND_IN_SET(2,group_email)")->get()->all();
                break;
            default:
                return true;
                break;
        }
        if (count($listEmail) > 0) {
            $mainEmail = $listEmail[0]->email;
            $arrEmailCc = [];
            if (count($listEmail) > 1) {
                foreach ($listEmail as $key => $emailInfo) {
                    if ($key > 0) {
                        array_push($arrEmailCc, $emailInfo->email);
                    }
                }
            }
            $listEmailCc = count($arrEmailCc) > 0 ? json_encode($arrEmailCc):'';
            $dataCreate = [
                "title"         => $title,
                "content"       => $content,
                "to"            => $mainEmail,
                "created_at"    => new \DateTime,
                "updated_at"    => new \DateTime,
                "status"        => 0,
                "count_error"   => 0,
                "is_sms"        => 0,
                "cc"            => $listEmailCc
            ];
            QueueEmail::insert($dataCreate);
        }
        return true;
    }
    public function ratingUsefulNews($request, $route, $link){
        $newId = $request->input('new');
        $type = $request->input('type');
        $itemNews = News::find($newId);
        if (!isset($newId) || !isset($type) || !isset($itemNews)) {
            return \Support::response([
                'code' => 100,
                'message' => 'Đã có lỗi xảy ra vui lòng thử lại qua!'
            ]);
        }
        switch ($type) {
            case 'like':
                $itemNews->like = $itemNews->like +1;
                break;
            case 'unlike':
                $itemNews->unlike = $itemNews->unlike +1;
                break;
            default:
                break;
        }
        $itemNews->save();
        return \Support::response([
            'code' => 200,
            'message' => 'Cảm ơn bạn đã đánh giá bài viết.'
        ]);
    }
    public function makeQuestion($request, $route, $link){
        $currentItem = $route;
        return View::make('static.make_question',compact('currentItem'));
    }
    public function orderExaminationSchedule($request, $route, $link){
        $currentItem = $route;
        return View::make('static.order_examination_schedule',compact('currentItem'));
    }
    public function introduce($request, $route, $link){
        $currentItem = $route;
        $listEquipment = \App\Models\Equipment::act()->get();
        $historyBegin = \App\Models\HistoryBegin::act()->get();
        return View::make('static.introduce',compact('currentItem','listEquipment','historyBegin'));
    }
}