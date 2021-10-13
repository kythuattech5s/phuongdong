<div style="max-width: 600px;margin: auto;font-family: arial">
	<h2 style="text-align: center">Khách hàng gửi thông tin đặt lịch khám</h2>
	<table style="width: 100%;border-spacing:0;text-align: left;margin-bottom: 30px;border-collapse: collapse;">
		<thead>
			<tr>
				<th colspan="2" style="border:solid 1px #999999;padding: 5px;background: #343a40;color: #f8f9fa;text-align: center">Thông tin khách hàng</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="border:solid 1px #999999;padding: 5px;width:180px;"><strong>Họ và tên</strong></td>
				<td style="border:solid 1px #999999;padding: 5px">{{$data['fullname']}}</td>
			</tr>
			<tr style="background: #f2f2f2">
				<td style="border:solid 1px #999999;padding: 5px;width:180px;"><strong>Tuổi</strong></td>
				<td style="border:solid 1px #999999;padding: 5px">{{$data['age']}}</td>
			</tr>
			<tr>
				<td style="border:solid 1px #999999;padding: 5px;width:180px;"><strong>Dịch vụ khám</strong></td>
				<td style="border:solid 1px #999999;padding: 5px">{{\App\Models\ServiceCategory::getNameById($data['service_id'])}}</td>
			</tr>
			<tr>
				<td style="border:solid 1px #999999;padding: 5px;width:180px;"><strong>Chuyên khoa</strong></td>
				<td style="border:solid 1px #999999;padding: 5px">{{\App\Models\Specialist::getNameById($data['service_id'])}}</td>
			</tr>
			<tr style="background: #f2f2f2">
				<td style="border:solid 1px #999999;padding: 5px;width:180px;"><strong>Số điện thoại</strong></td>
				<td style="border:solid 1px #999999;padding: 5px">{{$data['phone']}}</td>
			</tr>
			<tr>
				<td style="border:solid 1px #999999;padding: 5px;width:180px;"><strong>Email</strong></td>
				<td style="border:solid 1px #999999;padding: 5px">{{$data['email']}}</td>
			</tr>
			<tr style="background: #f2f2f2">
				<td style="border:solid 1px #999999;padding: 5px;width:180px;"><strong>Ngày hẹn</strong></td>
				<td style="border:solid 1px #999999;padding: 5px">{{$data['day_book']}}</td>
			</tr>
			<tr>
				<td style="border:solid 1px #999999;padding: 5px;width:180px;"><strong>Giờ hẹn</strong></td>
				<td style="border:solid 1px #999999;padding: 5px">{{$data['time_pick_text']}}</td>
			</tr>
			<tr style="background: #f2f2f2">
				<td style="border:solid 1px #999999;padding: 5px;width:180px;"><strong>Ghi chú</strong></td>
				<td style="border:solid 1px #999999;padding: 5px">{{$data['note']}}</td>
			</tr>
			<tr>
				<td style="border:solid 1px #999999;padding: 5px;width:180px;"><strong>Bác sĩ</strong></td>
				<td style="border:solid 1px #999999;padding: 5px">{{\App\Models\Doctor::getNameById($data['doctor_id'])}}</td>
			</tr>
			<tr style="background: #f2f2f2">
				<td style="border:solid 1px #999999;padding: 5px;width:180px;"><strong>Thời gian gửi</strong></td>
				<td style="border:solid 1px #999999;padding: 5px">{{$data['created_at']->format('d/m/Y H:i:s')}}</td>
			</tr>
		</tbody>
	</table>
	<table style="width: 100%;border-spacing:0;text-align: left;margin-bottom: 30px;border-collapse: collapse;">
		<thead>
			<tr>
				<th colspan="2" style="border:solid 1px #999999;padding: 5px;background: #343a40;color: #f8f9fa;text-align: center">Thông tin nguồn</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="border:solid 1px #999999;padding: 5px;width:180px;"><strong>utm_source</strong></td>
				<td style="border:solid 1px #999999;padding: 5px">{{$data['utm_source']}}</td>
			</tr>
			<tr style="background: #f2f2f2">
				<td style="border:solid 1px #999999;padding: 5px;width:180px;"><strong>utm_campaign</strong></td>
				<td style="border:solid 1px #999999;padding: 5px">{{$data['utm_campaign']}}</td>
			</tr>
			<tr>
				<td style="border:solid 1px #999999;padding: 5px;width:180px;"><strong>utm_medium</strong></td>
				<td style="border:solid 1px #999999;padding: 5px">{{$data['utm_medium']}}</td>
			</tr>
			<tr style="background: #f2f2f2">
				<td style="border:solid 1px #999999;padding: 5px;width:180px;"><strong>utm_term</strong></td>
				<td style="border:solid 1px #999999;padding: 5px">{{$data['utm_term']}}</td>
			</tr>
			<tr>
				<td style="border:solid 1px #999999;padding: 5px;width:180px;"><strong>utm_content</strong></td>
				<td style="border:solid 1px #999999;padding: 5px">{{$data['utm_content']}}</td>
			</tr>
		</tbody>
	</table>
</div>