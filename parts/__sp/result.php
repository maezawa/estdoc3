<div class="list {{Source}}" itemscope itemtype="http://schema.org/MedicalClinic">
	<section class="hospital">
		<div class="pic">
			<a href="/doctor/{{HospitalId}}/">{{{func_Img}}}</a><br>
			<button class="button to_doctor">詳細を見る</button>
			<button class="button green map each" data-lat="{{Latitude}}" data-lng="{{Longitude}}">地図を表示</button>
		</div>

		<div class="profile">
			<div class="title_container">
				<div class="title">
					<h3><a href="/doctor/{{HospitalId}}/" itemprop="significantLink">{{HospitalName}}</a></h3>
				</div>
			</div>

			<dl class="feature">
				{{{func_Service}}}
				<dt>住所</dt>
				<dd>{{Address}}</dd>
				{{{func_Access}}}
				{{{func_Feature}}}
			</dl>

			<div class="hos_comment">
				<strong>{{SellingPoint}}</strong><br>
				{{Introduction}}
			</div>

			<div class="consultationHours">
				<dl>
					<dt>月</dt>
					<dd>{{HourMon}}</dd>
				</dl>
				<dl>
					<dt>火</dt>
					<dd>{{HourTues}}</dd>
				</dl>
				<dl>
					<dt>水</dt>
					<dd>{{HourWed}}</dd>
				</dl>
				<dl>
					<dt>木</dt>
					<dd>{{HourThurs}}</dd>
				</dl>
			</div>
			<div class="consultationHours">
				<dl>
					<dt>金</dt>
					<dd>{{HourFri}}</dd>
				</dl>
				<dl>
					<dt class="sat">土</dt>
					<dd class="sat">{{HourSat}}</dd>
				</dl>
				<dl>
					<dt class="hol">日</dt>
					<dd class="hol">{{HourSun}}</dd>
				</dl>
				<dl>
					<dt class="hol">祝</dt>
					<dd class="hol">{{HourHoliday}}</dd>
				</dl>
			</div>
		</div>
	</section>
	{{{func_Ppc}}}
	{{{func_TimeTable}}}

	<aside class="schedule time a{{PublicId}}" data-iid="{{PublicId}}">
		<ul>
			<li><button class="button prev icon">&#xf053;</button></li>
			<li class="d"></li>
			<li class="d"></li>
			<li class="d"></li>
			<li class="d"></li>
			<li class="d"></li>
			<li class="d"></li>
			<li class="d"></li>
			<li><button class="button next icon">&#xf054;</button></li>
		</ul>
		<br>
		<div class="time_btns"></div>
	</aside>
</div>
