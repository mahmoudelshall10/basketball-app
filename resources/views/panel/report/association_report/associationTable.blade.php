<table  class="display table table-bordered table-striped" id="dynamic-table" style="direction: rtl;width:100%">
<thead>
<tr>
  <th>م</th>
  <th>الاسم</th>
  {{-- <th>اسم الدوري</th>
  <th>توقيت المباراة</th> --}}
  {{-- <th>الكود البنكي</th> --}}
  <th>اسم الفرع</th>
  <th>الدرجة</th>
  <th>عدد المباريات	| ملعب</th>
  <th>عدد المباريات	| طاولة</th>
  <th>فئة بدل الانتقال | ملعب</th>
  <th>فئة بدل الانتقال | طاولة</th>
  <th>اجمالى المستحق</th>
  <th>10% ضرائب</th>
  <th>صافي المستحق</th>
</tr>
</thead>
<tbody>
  @foreach($referees as $referee)
  <tr>
      <td>{{$loop->iteration}}</td>
      <td>{{$referee['referee_fullname_ar']}}</td>
      <td>{{$gov[$loop->iteration-1]}}</td>
      <td>{{$referee['referee_type']}}</td>
      <td>{{$playground[$loop->iteration-1]}}</td>
      <td>{{$table[$loop->iteration-1]}}</td>
  </tr>
  @endforeach

 <tfoot style="text-align:center">
  <tr>
    {{-- <th>المجموع الكلي : {{$total}}</th>
    <th>اجمالى بدل الإقامة  : {{$total_subsistance_allowance}}</th>
    <th>اجمالى بدل البطولة : {{$total_tournament_allowance}}</th>
    <th>اجمالى بدل التحكيم : {{$total_refereeing_allowance}}</th>
    <th>اجمالى بدل الانتقال : {{$total_transition_allowance}}</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th style="text-align:right">الإجمالي لكل صفحة :</th> --}}
  </tr>
</tfoot>
</table>