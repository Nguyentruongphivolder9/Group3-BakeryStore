<?php
function Pagination($number, $page, $addition, $cate_id){
	
	if ($number > 1){
		echo '<ul class="prod-page-box">';			
		if($page>1){
			echo '<li class="prod-page-item"><a class="page-link" href="?page='.($page-1).$addition.'&cate_id='.($cate_id != null ? $cate_id : '').'">Previous</a></li>';
		}

		$avaiablePage = [1,$page-1,$page,$page+1,$number]; //mảng gồm trang đầu, trang cuối, trang hiện tại và 2 trang kế trang hiện tại 
		$isFirst = $isLast = false; // 2 biến này để kiếm tra có dấu ... trước và sau trang hiện tại chưa
		for($i=0; $i<$number; $i++){
			if(!in_array($i+1,$avaiablePage)){ //nếu không có trong mảng thì ra khỏi vòng for
				if(!$isFirst && $page >3){//nếu chưa có dấu ... và số trang phải lớn hơn 3
					echo'<li class="prod-page-item"><a class="page-link" href="?page='.($page-2).$addition.'&cate_id='.($cate_id != null ? $cate_id : '').'">...</a></li>';
					$isFirst = true; //xác nhận đã có dấu ...
				}
				if(!$isLast && $i >$page){
					echo'<li class="page-item"><a class="page-link" href="?page='.($page+2).$addition.'&cate_id='.($cate_id != null ? $cate_id : '').'">...</a></li>';
					$isLast = true; //xác nhận đã có dấu ...
				}
				continue;
			}
			if($page==$i+1){
				echo'<li class="prod-page-item active">
                <a class="page-link" href="#">'.($i+1).'</a>
                </li>';
			}else{
				echo'<li class="prod-page-item">
                <a class="page-link" href="?page='.($i+1).$addition.'&cate_id='.($cate_id != null ? $cate_id : '').'">'.($i+1).'</a>
                </li>';
			}		
		}
		if($page<$number){
			echo '<li class="prod-page-item">
            <a class="page-link" href="?page='.($page+1).$addition.'&cate_id='.($cate_id != null ? $cate_id : '').'">Next</a></li>';
		}	
	
	}
}

?>