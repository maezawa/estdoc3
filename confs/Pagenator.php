<?php
namespace{
	class Paginator{
		var $items_per_page;
		var $items_total;
		var $current_page;
		var $num_pages;
		var $mid_range;
		var $low;
		var $high;
		var $return;
		var $default_ipp = 30;

		public function Paginator(){
			$this->current_page = 1;
			$this->mid_range = 10;
			$this->items_per_page = $this->default_ipp;
		}

		public function paginate(){
			$uri = preg_replace('/(&|\?)page=[0-9]+/', '', $_SERVER['REQUEST_URI']);
			$uri = (preg_match('/\?/', $uri)) ? $uri.'&' : $uri.'?';

			$this->num_pages = ceil($this->items_total / $this->items_per_page);
			if(isset($_GET['page'])) $this->current_page = (int)$_GET['page'];
			if($this->current_page < 1 || !is_numeric($this->current_page)) $this->current_page = 1;
			if($this->current_page > $this->num_pages) $this->current_page = $this->num_pages;
			$prev_page = $this->current_page - 1;
			$next_page = $this->current_page + 1;

			if ($this->items_total <= $this->items_per_page){
				$this->high = $this->items_total - 1;
				return null;
			}

			$this->return .= ($this->current_page != 1 && $this->items_total >= 10) ?
				"<a href=\"{$uri}page=1\"><li>❮❮</li></a><a href=\"{$uri}page=$prev_page\"><li>❮</li></a>" :
				"<span><li class=\"off\">❮❮</li></span><span><li class=\"off\">❮</li></span>";

			$this->start_range = $this->current_page - floor($this->mid_range / 2);
			$this->end_range = $this->current_page + floor($this->mid_range / 2);

			if($this->start_range <= 0){
				$this->end_range += abs($this->start_range) + 1;
				$this->start_range = 1;
			}

			if($this->end_range > $this->num_pages){
				$this->start_range -= $this->end_range-$this->num_pages;
				$this->end_range = $this->num_pages;
			}

			$this->range = range($this->start_range, $this->end_range);

			for($i = 1; $i <= $this->mid_range; $i++){
				if($i == 1 || $i == $this->num_pages || in_array($i, $this->range)){
					$this->return .= ($i == $this->current_page) ? "<li class=\"now\"><span>$i</span></li>" : "<a href=\"{$uri}page=$i\"><li>$i</li></a>";
				}
			}

			$this->return .= "<a href=\"{$uri}page=$next_page\"><li>❯</li></a>\n";
			$this->return .= "<a href=\"{$uri}page={$this->num_pages}\"><li>❯❯</li></a>\n";
			$this->low = ($this->current_page-1) * $this->items_per_page;
			$this->high = ($this->current_page * $this->items_per_page) - 1;
		}

		public function display_pages(){
			return $this->return;
		}

		public function getCurrent(){
			$end = ($this->high + 1) > $this->items_total ? $this->items_total : $this->high + 1;
			return number_format($this->low + 1). "〜". number_format($end);
		}
	}
}


/* Paginator for SmartPhone */
namespace sp{
	class Paginator extends \Paginator{

		public function paginate(){
			$uri = preg_replace('/&page=[0-9]+/', '', $_SERVER['REQUEST_URI']);
			$uri.= ($_SERVER['QUERY_STRING']) ? '&' : '?';

			$this->num_pages = ceil($this->items_total / $this->items_per_page);
			if(isset($_GET['page'])) $this->current_page = (int)$_GET['page'];
			if($this->current_page < 1 || !is_numeric($this->current_page)) $this->current_page = 1;
			if($this->current_page > $this->num_pages) $this->current_page = $this->num_pages;
			$prev_page = $this->current_page - 1;
			$next_page = $this->current_page + 1;

			if ($this->items_total <= $this->items_per_page){
				$this->high = $this->items_total - 1;
				return null;
			}

			$this->return .= ($this->current_page != 1 && $this->items_total >= 10) ?
				"<a href=\"{$uri}page=1\" class=\"button\">❮❮</a>　<a href=\"{$uri}page=$prev_page\" class=\"button\">❮</a>　" :
				"<span>❮❮</span>　<span>❮</span>　　";

			$this->return .= "<select id=\"pagination\">";

			$this->start_range = $this->current_page - floor($this->mid_range / 2);
			$this->end_range = $this->current_page + floor($this->mid_range / 2);

			if($this->start_range <= 0){
				$this->end_range += abs($this->start_range) + 1;
				$this->start_range = 1;
			}

			if($this->end_range > $this->num_pages){
				$this->start_range -= $this->end_range-$this->num_pages;
				$this->end_range = $this->num_pages;
			}

			$this->range = range($this->start_range, $this->end_range);

			for($i = 1; $i <= $this->mid_range; $i++){
				if($i == 1 || $i == $this->num_pages || in_array($i, $this->range)){
					$this->return .= ($i == $this->current_page) ? "<option selected>{$i}ページ</option>" : "<option value=\"{$uri}page=$i\">{$i}ページ</option>";
				}
			}

			$this->return .= "</select>";
			$this->return .= "　<a href=\"{$uri}page=$next_page\" class=\"button\">❯</a>\n";
			$this->return .= "　<a href=\"{$uri}page={$this->num_pages}\" class=\"button\">❯❯</a>\n";
			$this->low = ($this->current_page-1) * $this->items_per_page;
			$this->high = ($this->current_page * $this->items_per_page) - 1;
		}

	}
}