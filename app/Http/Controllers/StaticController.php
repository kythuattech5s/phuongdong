<?php
namespace App\Http\Controllers;
use App\Models\{News,Services,Specialist,Doctor,RegisterAdvise,BookApointment,BookApointmentDoctor,TimePick,Question};
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
    public function sendEmailNoficationContact($data,$type){
        // Phân quyền email nhận thông tin liên hệ
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