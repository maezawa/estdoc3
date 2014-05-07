<div class="list {{Source}} pid{{PublicId}}" itemscope itemtype="http://schema.org/MedicalClinic">
	<a name="no{{{func_Count}}}"></a>
	<div class="pin bg{{{func_Pin}}}" style="background-position: -{{{func_Count}}}px 0"></div>

	<section class="hospital">
		<div class="pic">
			<a href="/doctor/{{HospitalId}}/">{{{func_Img}}}</a><br>
			{{{func_Ppc}}}
			{{{func_TimeTable}}}
		</div>

		<div class="profile">
			<div class="title_container">
				<div class="title">
					<h3><a href="/doctor/{{HospitalId}}/" itemprop="significantLink">{{HospitalName}}</a></h3>
					{{{func_Service}}}
				</div>
				{{{func_Access1}}}
			</div>

			<hr>

			{{{func_SellingPoint}}}

			<dl class="feature">
				<dt>所在地</dt>
				<dd>{{Address}}</dd>
				{{{func_Access}}}
				{{{func_Feature}}}
			</dl>

			<table id="consultationHours">
			<thead>
			<tr>
				<th>月</th>
				<th>火</th>
				<th>水</th>
				<th>木</th>
				<th>金</th>
				<th>土</th>
				<th>日</th>
				<th>祝</th>
			</tr>
			</thead>
			<tbody>
			{{{func_ConsultationT}}}
			</tbody>
			</table>
		</div>
	</section>
	<aside class="schedule time a{{PublicId}}" data-iid="{{PublicId}}">
		<ul>
			<li><button class="button prev"></button></li>
			<li class="d"></li>
			<li class="d"></li>
			<li class="d"></li>
			<li class="d"></li>
			<li class="d"></li>
			<li class="d"></li>
			<li class="d"></li>
			<li><button class="button next"></button></li>
		</ul>
		<br>
		<div class="time_btns"></div>
	</aside>
</div>
