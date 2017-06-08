<?php
$user = Auth::user();
$loginUserName = empty($user->nick_name) ? $loginUser->name: $user->nick_name;
$tops = \App\Models\Permission::where('pid',0)->orderBy('sort')->get();

function createLi($user, $m){
	$html = '';
	if($m->type == 'm' && $user->can($m->name)){
		$url = $m->url ? url($m->url) : '';
		$display = $m->display_name;
		$icon = $m->icon;
		if(!empty($m->children) && count($m->children) > 0){
			$html = <<<EOD
<li class="nav-item ">
   <a href="$url" class="nav-link">
       <i class="$icon"></i>
       <span class="title">$display</span>
   </a>
   <ul class="sub-menu">
EOD;
			$childrenHtml = [];
			foreach ($m->children  as $child)
			{
				$childrenHtml[] = createLi($user, $child);
			}
			$html = $html . implode('', $childrenHtml) . '</ul>';

		}else{
			$html = '<li class="nav-item "><a href="'.$url.'"  class="nav-link"><i class="'.$icon.'"></i><span class="title">'.$display.'</span></a></li>';
		}
	}
	return $html;
}


?>



<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start active open">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start active open">
                        <a href="index.html" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">Dashboard 1</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="dashboard_2.html" class="nav-link ">
                            <i class="icon-bulb"></i>
                            <span class="title">Dashboard 2</span>
                            <span class="badge badge-success">1</span>
                        </a>
                    </li>
                    <li class="nav-item start ">
                        <a href="dashboard_3.html" class="nav-link ">
                            <i class="icon-graph"></i>
                            <span class="title">Dashboard 3</span>
                            <span class="badge badge-danger">5</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="heading">
                <h3 class="uppercase">Features</h3>
            </li>
            @forelse($tops as $top)
		        <?php echo createLi($user, $top); ?>
            @empty
            @endforelse
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>