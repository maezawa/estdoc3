/**
 * jQuery Plugin
 * jquery.ajaxComboBox.7.1
 * Yuusaku Miyazaki (toumin.m7@gmail.com)
 * MIT License
 * http://www.usamimi.info/~sutara/ajaxComboBox/
 */
(function(f){function h(a){a=f(a);return!(!a.width()&&!a.height())&&"none"!==a.css("display")}function n(a,e){a=a.replace(/=#\]/g,'="#"]');var b,c,d=q.exec(a);d&&d[2]in p&&(b=p[d[2]],c=d[3],a=d[1],c&&(d=Number(c),c=isNaN(d)?c.replace(/^["']|["']$/g,""):d));return e(a,b,c)}var g=f.zepto,r=g.qsa,s=g.matches,p=f.expr[":"]={visible:function(){if(h(this))return this},hidden:function(){if(!h(this))return this},selected:function(){if(this.selected)return this},checked:function(){if(this.checked)return this},parent:function(){return this.parentNode},first:function(a){if(0===a)return this},last:function(a,e){if(a===e.length-1)return this},eq:function(a,e,b){if(a===b)return this},contains:function(a,e,b){if(-1<f(this).text().indexOf(b))return this},has:function(a,e,b){if(g.qsa(this,b).length)return this}},q=/(.*):(\w+)(?:\(([^)]+)\))?$\s*/,t=/^\s*>/,k="Zepto"+ +new Date;g.qsa=function(a,e){return n(e,function(b,c,d){try{var l;!b&&c?b="*":t.test(b)&&(l=f(a).addClass(k),b="."+k+" "+b);var m=r(a,b)}catch(h){throw console.error("error performing selector: %o",e),h;}finally{l&&l.removeClass(k)}return c?g.uniq(f.map(m,function(a,b){return c.call(a,b,m,d)})):m})};g.matches=function(a,e){return n(e,function(b,c,d){return(!b||s(a,b))&&(!c||c.call(a,null,d)===a)})}})(Zepto);

;(function(){
	//Start point
	$.fn.ajaxComboBox = function(_source, _options){
		//return jQuery object to continue method chain.
		return this.each(function(){
			individual(this, _source, _options);
		});
	};

	//About each ComboBox 
	function individual(_jqobj, _source, _options){
		//#1. Global vars
		var Opt  = initOptions(_source, _options);
		var Cls  = initCssClassName();
		var Vars = initLocalVars();
		var Elem = initElements(_jqobj);

		//#3. Event handler
		eHandlerForInput();
		eHandlerForWhole();
		eHandlerForTextArea();

		//That's all.
		return true;

		//==============================================
		//#1. Global vars
		//==============================================
		//**********************************************
		//Initialize options of plugin
		//**********************************************
		//@called individual
		//@params obj,str _source  (the name of file for DB connect, or JSON object)
		//@params obj     _options (options sent by user)
		//@return obj
		function initOptions(_source, _options){
			//----------------------------------------
			// 1st
			//----------------------------------------
			_options = $.extend({
				//基本設定
				source      : _source,
				field       : 'name',     //column for display as suggest
				and_or      : 'AND',      //AND? OR? for search words
				per_page    : 10,         //候補一覧1ページに表示する件数
				navi_num    : 5,          //ページナビで表示するページ番号の数
				primary_key : 'id',       //候補選択後、selected_pkeyの値となるDBのカラム
				bind_to     : false,      //候補選択後に実行されるイベントの名前
				navi_simple : false      //先頭、末尾のページへのリンクを表示するか？
			}, _options);
			//----------------------------------------
			// 2nd
			//----------------------------------------
			//検索するフィールド(カンマ区切りで複数指定可能)
			_options.search_field = (_options.search_field == undefined)
				? _options.field
				: _options.search_field;
			//----------------------------------------
			// 3rd
			//----------------------------------------
			//大文字で統一
			_options.and_or = _options.and_or.toUpperCase();

			//カンマ区切りのオプションを配列に変換する。
			var arr = ['search_field'];
			for (var i = 0, l = arr.length; i < l; i++){
				_options[arr[i]] = _strToArray(_options[arr[i]]);
			}
			//----------------------------------------
			// 4th
			//----------------------------------------
			//CASE WHEN後のORDER BY指定
			_options.order_by = (_options.order_by == undefined)
				? _options.search_field
				: _options.order_by;
			//order_by を多層配列に
			//【例】 [ ['id', 'ASC'], ['name', 'DESC'] ]
			_options['order_by'] = _setOrderbyOption(_options['order_by'], _options['field']);
			//----------------------------------------
			// Return
			//----------------------------------------
			return _options;

			//++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			//----------------------------------------------
			//カンマ区切りの文字列を配列にする。
			//----------------------------------------------
			function _strToArray(str) {
				return str.replace(/[\s　]+/g, '').split(',');
			}
			//----------------------------------------
			//"order_by"オプションを配列にする
			//----------------------------------------
			//コンボボックスとタグ、両方のorder_byの配列化に使用する。
			function _setOrderbyOption(arg_order, arg_field) {
				var arr = [];
				if (typeof arg_order == 'object') {
					for (var i = 0, l = arg_order.length; i < l; i++){
						var orders = arg_order[i].replace(/(^\s+)|(\s+$)/g,'').split(' ');
						arr[i] =  (orders.length == 2) ? orders : [orders[0], 'ASC'];
					}
				}else{
					var orders = arg_order.replace(/(^\s+)|(\s+$)/g,'').split(' ');
					arr[0] = (orders.length == 2) ?
						orders :
						(orders[0].match(/^(ASC|DESC)$/i)) ?
							[arg_field, orders[0]] :
							[orders[0], 'ASC'];
				}
				return arr;
			}	
		}
		//**********************************************
		//"title attr" for each languages
		//**********************************************
		//@called individual
		//@global obj Opt (use not only "Opt.lang", but "per_page" and others)
		//@return obj
		function initMessages(){
			return {
				add_btn     : '追加ボタン',
				add_title   : '入力ボックスを追加します',
				del_btn     : '削除ボタン',
				del_title   : '入力ボックスを削除します',
				next        : '次へ',
				next_title  : '次の' + Opt.per_page + '件 (右キー)',
				prev        : '前へ',
				prev_title  : '前の' + Opt.per_page + '件 (左キー)',
				first_title : '最初のページへ (Shift + 左キー)',
				last_title  : '最後のページへ (Shift + 右キー)',
				get_all_btn : '全件取得 (下キー)',
				get_all_alt : '画像:ボタン',
				close_btn   : '閉じる (Tabキー)',
				close_alt   : '画像:ボタン',
				loading     : '読み込み中...',
				loading_alt : '画像:読み込み中...',
				not_found   : '(0 件)'
			};
		}
		//**********************************************
		//Set name of CSS class.
		//**********************************************
		//@called individual
		//@global obj Opt オプション
		//@return obj         クラス名の詰め合わせ
		function initCssClassName(){
			//各モード共通
			var class_name = {
				container:      'ac_container', //ComboBoxを包むdivタグ
				container_open: 'ac_container_open',
				selected:       'ac_selected',
				re_area:        'ac_result_area', //結果リストの<div>
				results:        'ac_results', //候補一覧を囲む<ul>
				re_off:         'ac_results_off', //候補一覧(非選択状態)
				select:         'ac_over', //選択中の<li>
				input_off:      'ac_input_off' //非選択状態
			};

			class_name = $.extend(class_name, { input: 'ac_s_input' }); //テキストボックス
			return class_name;
		}
		//**********************************************
		//Initialize vars
		//**********************************************
		//@called individual
		//@global obj Opt 
		//@return obj
		function initLocalVars(){
			var localvars = {
				timer_valchange : false, //タイマー変数(一定時間ごとに入力値の変化を監視)
				is_suggest      : false, //リストのタイプ。false=>全件 / true=>予測
				page_all        : 1,     //全件表示の際の、現在のページ番号
				page_suggest    : 1,     //候補表示の際の、現在のページ番号
				max_all         : 1,     //全件表示の際の、全ページ数
				max_suggest     : 1,     //候補表示の際の、全ページ数
				is_paging       : false, //ページ移動か?
				is_loading      : false, //Ajaxで問い合わせ中かどうか？
				xhr             : false, //XMLHttpオブジェクトを格納
				prev_value      : ''    //初期値
			};
			return localvars;
		}
		//**********************************************
		//Initialize HTML-elements 
		//**********************************************
		//@called individual
		//@params elem _jqobj
		//@global obj Cls
		//@global obj Opt
		//@return obj elems
		function initElements(_jqobj){
			//----------------------------------------------
			//部品を作成
			//----------------------------------------------
			//本体
			var elems = {};

			elems.combo_input = $(_jqobj)
				.attr('autocomplete', 'off')
				.addClass(Cls.input);

			elems.container = $(elems.combo_input); //(elems.combo_input).parent().addClass(Cls.container);
			//サジェストリスト
			elems.result_area = $('<div>').addClass(Cls.re_area);
			elems.results     = $('<ul id="' + Cls.results + '_">' ).addClass(Cls.results);
			Cls.Id = Cls.results + '_';

			//primary_keyカラムの値を送信するためのinput:hiddenを作成
			var hidden_name = $(elems.combo_input).attr('id');
			elems.hidden = $('<input type="hidden" />')
				.attr({
					'name': hidden_name,
					'id'  : hidden_name + '_'
				})
				.val('');

			//----------------------------------------------
			//部品をページに配置
			//----------------------------------------------
			$(elems.result_area).insertAfter($(elems.container));
			!$(elems.hidden) && $(elems.hidden).insertAfter($(elems.result_area));
			$(elems.result_area)
				.append(elems.results);

			//----------------------------------------------
			//サイズ調整
			//----------------------------------------------
			return elems;
		}
		//==============================================
		//#3. Event handler
		//==============================================
		//**********************************************
		//text-box
		//**********************************************
		//@called individual
		function eHandlerForInput() {
			$(Elem.combo_input)
				.focus(setTimerCheckValue)
				.on('click', function() {
					cssFocusInput();
					$(Elem.results).children('li').removeClass(Cls.select);
				});
		}
		//**********************************************
		//plugin whole
		//**********************************************
		//@called individual
		function eHandlerForWhole() {
			var stop_hide = false; //このプラグイン内でのマウスクリックなら、htmlでの候補消去を中止。
			$(Elem.container).on('mousedown', function(e){ stop_hide = true });
			$('html').on('mousedown', function(){
				var arrLi = $(Elem.results).children('li');
				var li = arrLi[0];
				typeof li != 'undefined' && $(Elem.hidden).val($(li).attr('pkey'));
				(stop_hide) ? stop_hide = false : hideResults();
			});
		}
		//**********************************************
		//list of suggests
		//**********************************************
		//@called displayResults
		function eHandlerForResults() {
			$(Elem.results)
				.children('li')
				.on('mouseover', function() {
					$(Elem.results).children('li').removeClass(Cls.select);
					$(this).addClass(Cls.select);
					cssFocusResults();
				})
				.on('mousedown', function(e) {
					e.preventDefault();
					e.stopPropagation();
					selectCurrentLine(false);
				});
		}
		function eHandlerForTextArea() {
			if (!Opt.shorten_url) return;
		}
		//==============================================
		//#4. Appearance
		//==============================================
		//**********************************************
		//image for loading
		//**********************************************
		//@called suggest
		function setLoading() {
			if ($(Elem.results).html() == '') {
				calcWidthResults();
				$(Elem.container).addClass(Cls.container_open);
			}
		}
		//**********************************************
		//選択候補を追いかけて画面をスクロール
		//**********************************************
		//キー操作による候補移動、ページ移動のみに適用
		//@param boolean enforce 移動先をテキストボックスに強制するか？
		function scrollWindow(enforce) {
			//------------------------------------------
			//使用する変数を定義
			//------------------------------------------
			var current_result = getCurrentLine();

			var target_top = (current_result && !enforce)
				? current_result.offset().top
				: $(Elem.container).offset().top;

			var target_size;

			Vars.size_li = $(Elem.results).children('li:first').height;
			target_size = Vars.size_li;

			var client_height = document.documentElement.clientHeight;

			var scroll_top = (document.documentElement.scrollTop > 0)
				? document.documentElement.scrollTop
				: document.body.scrollTop;

			var scroll_bottom = scroll_top + client_height - target_size;
			//------------------------------------------
			//スクロール処理
			//------------------------------------------
			var gap;
			if ($(current_result).length) {
				if (target_top < scroll_top || target_size > client_height) {
					//上へスクロール
					//※ブラウザの高さがターゲットよりも低い場合もこちらへ分岐する。
					gap = target_top - scroll_top;
				} else if (target_top > scroll_bottom) {
					//下へスクロール
					gap = target_top - scroll_bottom;
				} else {
					//スクロールは行われない
					return;
				}
			} else if (target_top < scroll_top) {
				gap = target_top - scroll_top;
			}
			window.scrollBy(0, gap);
		}
		//**********************************************
		//候補リストを暗く、入力欄を明瞭に
		//**********************************************
		//@called hideResults, eHandlerForInput, notFoundDataBase, prepareResults, selectCurrentLine, nextLine, prevLine
		function cssFocusInput() {
			$(Elem.results).addClass(Cls.re_off);
			$(Elem.combo_input).removeClass(Cls.input_off);
		}
		//**********************************************
		//候補リストを明瞭に、入力欄を暗く
		//**********************************************
		//@called eHandlerForResults, prepareResults, nextLine, prevLine
		function cssFocusResults() {
			$(Elem.results).removeClass(Cls.re_off);
			$(Elem.combo_input).addClass(Cls.input_off);
		}
		//==============================================
		//#5. Input by user
		//==============================================
		//**********************************************
		//入力値変化監視をタイマーで予約
		//**********************************************
		//@called EH_input, checkValue
		function setTimerCheckValue() {
			Vars.timer_valchange = setTimeout(checkValue, 500);
		}
		//**********************************************
		//入力値変化監視を実行
		//**********************************************
		//@called setTimerCheckValue
		function checkValue() {
			var now_value = $(Elem.combo_input).val();
			if (now_value != Vars.prev_value) {
				Vars.prev_value = now_value;

				//hiddenの値を削除
				$(Elem.hidden).val('');

				//ページ数をリセット
				Vars.page_suggest = 1;
				Vars.is_suggest = true;

				$.ajax({
					url: 'http://api.estdoc.jp/geo?callback=?&name=' + now_value,
					success: function(data, dataType){
						Opt.source = data.body;
						suggest();
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						console.log(textStatus);
					}
				});
			}
			$(Elem.result_area).css('border', '1px solid #79b');

			//一定時間ごとの監視を再開
			setTimerCheckValue();
		}
		//==============================================
		//#6. Search
		//==============================================
		//**********************************************
		//abort Ajax
		//**********************************************
		//@called suggest, hideResults
		function abortAjax() {
			if (Vars.xhr){
				Vars.xhr.abort();
				Vars.xhr = false;
			}
		}
		//**********************************************
		//send request to PHP(server side)
		//**********************************************
		//@called firstPage, nextPage, prevPage, lastPage, eHandlerForButton, checkValue
		function suggest() {
			var q_word = (Vars.is_suggest) ? ($(Elem.combo_input).val()).replace(/(^\s+)|(\s+$)/g, '') : '';
			if (q_word.length < 1 && Vars.is_suggest) {
				hideResults();
				return;
			}
			q_word = q_word.split(/[\s　]+/);

			abortAjax(); //Ajax通信をキャンセル
			setLoading(); //ローディング表示

			//ここで、本来は真偽値が格納される変数に数値を格納している。
			if (Vars.is_paging) {
				var obj = getCurrentLine();
				Vars.is_paging = (obj) ? $(Elem.results).children('li').index(obj) : -1;
			} else if (!Vars.is_suggest) {
				Vars.is_paging = 0;
			}
			var which_page_num = (Vars.is_suggest) ? Vars.page_suggest : Vars.page_all;

			//データ取得
			(typeof Opt.source == 'object') && searchForJSON(q_word, which_page_num);
		}
		//**********************************************
		//データベースではなく、JSONを検索
		//**********************************************
		//@called suggest
		function searchForJSON(q_word, which_page_num) {
			var matched = [];
			var esc_q = [];
			var sorted = [];
			var json = {};
			var i = 0;
			var arr_reg = [];
			do { //全件表示のため、do-while文を使う。
				//正規表現のメタ文字をエスケープ
				esc_q[i] = q_word[i].replace(/\W/g,'\\$&').toString();
				arr_reg[i] = new RegExp(esc_q[i], 'gi');
				i++;
			} while (i < q_word.length);

			//SELECT * FROM source WHERE field LIKE q_word;
			for (var i = 0; i < Opt.source.length; i++) {
				var flag = false;
				for (var j = 0, l = arr_reg.length; j < l; j++) {
					if (Opt.source[i][Opt.field].match(arr_reg[j])) {
						flag = true;
						if (Opt.and_or == 'OR') break;
					} else {
						flag = false;
						if (Opt.and_or == 'AND') break;
					}
				}
				if (flag) matched.push(Opt.source[i]);
			}
			//見つからなければすぐに終了
			if (matched.length == undefined) {
				notFoundDataBase();
				return;
			}
			json.cnt_whole = matched.length;

			//(CASE WHEN ...)の後に続く order 指定
			var reg1 = new RegExp('^' + esc_q[0] + '$', 'gi');
			var reg2 = new RegExp('^' + esc_q[0], 'gi');
			var matched1 = [];
			var matched2 = [];
			var matched3 = [];
			for (var i = 0, l = matched.length; i < l; i++) {
				if (matched[i][Opt.order_by[0][0]].match(reg1)) {
					matched1.push(matched[i]);
				} else if (matched[i][Opt.order_by[0][0]].match(reg2)) {
					matched2.push(matched[i]);
				} else {
					matched3.push(matched[i]);
				}
			}
			if (Opt.order_by[0][1].match(/^asc$/i)) {
				matched1.sort(compareASC);
				matched2.sort(compareASC);
				matched3.sort(compareASC);
			} else {
				matched1.sort(compareDESC);
				matched2.sort(compareDESC);
				matched3.sort(compareDESC);
			}
			sorted = sorted.concat(matched1).concat(matched2).concat(matched3);
			//----------------------------------------------
			//searchInsteadOfDB内のsort用の比較関数
			//----------------------------------------------
			function compareASC(a, b) {
				return a[Opt.order_by[0][0]].localeCompare(b[Opt.order_by[0][0]]);
			}
			function compareDESC(a, b) {
				return b[Opt.order_by[0][0]].localeCompare(a[Opt.order_by[0][0]]);
			}
			//LIMIT xx OFFSET xx
			var start = (which_page_num - 1) * Opt.per_page;
			var end   = start + Opt.per_page;
			//----------------------------------------------
			//最終的に返るオブジェクトを作成
			//----------------------------------------------
			for (var i = start, sub = 0; i < end; i++, sub++) {
				if (sorted[i] == undefined) break;
				for (var key in sorted[i]) {
					//セレクト専用
					if (key == Opt.primary_key) {
						if (json.primary_key == undefined) json.primary_key = [];
						json.primary_key.push(sorted[i][key]);
					}
					if (key == Opt.field) {
						//変換候補を取得
						if (json.candidate == undefined) json.candidate = [];
						json.candidate.push(sorted[i][key]);
					}
				}
			}

			json.cnt_page = (typeof json.candidate === 'undefined') ? 0 : json.candidate.length;
			prepareResults(json, q_word, which_page_num);
		}
		//**********************************************
		//問い合わせ該当件数ゼロだった場合
		//**********************************************
		//@called searchForDB, searchForJSON
		function notFoundDataBase() {
			$(Elem.results).empty();
			//$(Elem.result_area).show();
			calcWidthResults();
			$(Elem.container).addClass(Cls.container_open);
			cssFocusInput();
		}
		//==============================================
		//#7. Show or hide results
		//==============================================
		//**********************************************
		//候補表示の準備
		//**********************************************
		//@called searchForDB, searchForJSON
		//DB, JSONで分岐していた処理が、ここで合流する。
		function prepareResults(json, q_word, which_page_num) {
			if (!json.primary_key) json.primary_key = false;

			//候補リストを表示する
			displayResults(json.candidate, json.subinfo, json.primary_key);
			if (Vars.is_paging === false) {
				cssFocusInput();
			} else {
				//全件表示とページ移動時、直前の行番号と同じ候補を選択状態にする
				var idx = Vars.is_paging; //真偽値を収めるべき変数に、例外的に数値が入っている。
				var limit = $(Elem.results).children('li').length - 1;
				if (idx > limit) idx = limit;
				var obj = $(Elem.results).children('li').eq(idx);
				$(obj).addClass(Cls.select);
				//setSubInfo(obj);
				Vars.is_paging = false; //次回に備えて初期化する

				cssFocusResults();
			}
		}
		//**********************************************
		//候補一覧の<ul>成形、表示
		//**********************************************
		//@params array arr_candidate   DBから検索・取得した値の配列
		//@params array arr_subinfo    サブ情報の配列
		//@params array arr_primary_key 主キーの配列
		//@called prepareResults
		function displayResults(arr_candidate, arr_subinfo, arr_primary_key) {
			//候補リストを、一旦リセット
			$(Elem.results).empty();
			var l = (typeof arr_candidate === 'undefined') ? 0 : arr_candidate.length;
			for (var i = 0; i < l; i++) {

				//候補リスト
				var list = $('<li>')
					.text(arr_candidate[i]) //!!! against XSS !!!
					.attr({
						pkey  : arr_primary_key[i],
						title : arr_candidate[i]
					});

				$(Elem.results).append(list);
			}
			//サジェスト結果表示
			//表示のたびに、結果リストの位置を調整しなおしている。
			//このプラグイン以外でページ内の要素の位置をずらす処理がある場合に対処するため。
			calcWidthResults();

			$(Elem.container).addClass(Cls.container_open);
			eHandlerForResults(); //イベントハンドラ設定
		}
		function calcWidthResults() {
			//containerのpositionの値に合わせてtop,leftを設定する。
			var parentOffset = $(Elem.combo_input).parent().offset();
			var offset = $(Elem.combo_input).offset();
			$(Elem.result_area).css({
				top  : offset.top + $(Elem.combo_input).height + 'px',
				left : (offset.left - parentOffset.left) + 'px'
			});

			//幅を設定した後、表示する。
			$(Elem.result_area).show();
		}
		//**********************************************
		//候補エリアを消去
		//**********************************************
		//@called eHandlerForButton, eHandlerForWhole, suggest, selectCurrentLine
		function hideResults() {
			cssFocusInput();

			$(Elem.results).empty();
			$(Elem.result_area).hide();
			$(Elem.container).removeClass(Cls.container_open);

			abortAjax();      //Ajax通信をキャンセル
		}
		//==============================================
		//#9. Select line
		//==============================================
		//**********************************************
		//現在選択中の候補に決定する
		//**********************************************
		//@called eHandlerForResults
		function selectCurrentLine(is_enter_key) {

			//選択候補を追いかけてスクロール
			scrollWindow(true);

			var current = getCurrentLine();

			if (current) {
				$(Elem.combo_input).val($(current).text());
				Elem.id = $(Elem.hidden).attr('id');
				$('#' + Elem.id).val($(current).attr('pkey'));

				Vars.prev_value = $(Elem.combo_input).val();
				hideResults();
			}

			(Opt.bind_to) && $(Elem.combo_input).trigger(Opt.bind_to, is_enter_key);  //候補選択を引き金に、イベントを発火する
			$(Elem.combo_input).focus();  //テキストボックスにフォーカスを移す
			$(Elem.combo_input).change(); //テキストボックスの値が変わったことを通知
			cssFocusInput();
		}
		//**********************************************
		//現在選択中の候補の情報を取得
		//**********************************************
		//@return object current_result 現在選択中の候補のオブジェクト(<li>要素)
		//@called scrollWindow, selectCurrentLine, suggest, nextLine, prevLine
		function getCurrentLine() {
			if ($(Elem.result_area).is(':hidden')) return false;
			var obj = $(Elem.results).children('li.' + Cls.select);
			return $(obj).length ? obj : false;
		}
	} //the end of "individual"
})($);