<?php
$user = Auth::user();
$loginUserName = empty($user->nick_name) ? $loginUser->name: $user->nick_name;
$tops = \App\Models\Permission::where('pid',0)->orderBy('sort')->get();

function createLi($user, $m){
	$curUrl =  url( Route::getCurrentRoute()->uri() );

	$html = '';
	if($m->type == 'm' && $user->can($m->name)){
		$url = $m->url ? url($m->url) : '';
		$display = $m->display_name;
		$icon = $m->icon;
		$selectedSpan = str_contains($curUrl, $m->url) ? '<span class="selected"></span>':'';
		if(!empty($m->children) && count($m->children) > 0){
			$html = <<<EOD
<li class="nav-item">
   <a href="$url" class="nav-link nav-toggle">
       <i class="$icon"></i>
       <span class="title">$display</span>
       <span class="arrow"></span>
       $selectedSpan
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
			$html = '<li class="nav-item"><a href="'.$url.'"  class="nav-link"><i class="'.$icon.'"></i><span class="title">'.$display.'</span>'.$selectedSpan.'</a></li>';
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

            @forelse($tops as $top)
		        <?php echo createLi($user, $top); ?>
            @empty
            @endforelse
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>

<script>
    /**
     *    根据当前url选中菜单
     *    设置导航栏
     **/

    $(".selected").each(function (i, obj) {
        $(obj).parents("li").each(function (j, li) {
            $(li).addClass('start active open');
            $('.arrow',li).addClass('open');
        });
        $(obj).parents("ul.sub-menu").css('display', "block");

        var t = $(obj).parent().parent().parent().parent().find('.title').get(0);
        var m = $(t).text();
        var n = $(obj).siblings('.title').text();

        var title = '<h1>'+m+'<small>'+n+'</small></h1>'
        $('.page-title').html(title);
        $('#breadcrumb').html(n);
    });

</script>