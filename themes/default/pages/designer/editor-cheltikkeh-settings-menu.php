
<menu id="cheltikkeh-editor-settings-tabs">
	<button class="h1 h2 h3 h4 h5">عنوان</button>
	<button class="p">پاراگراف</button>
	<button class="button">دکمه</button>
	<button class="a">پیوند</button>
	<button class="input">جای خالی</button>
	<button class="textarea">جای خالی</button>
	<button class="img">تصویر</button>
	<button class="nav">پس زمینه</button>
	<button class="menu">لیست</button>
	<button class="form">فرم</button>
</menu>

<div class="h1 h2 h3 h4 h5">
	<nav id="text-align" class="right">
		<h5 class="subtitle">چینش قلم</h5>
		<select class="select">
			<option value="rtlright">فارسی- راست چین</option>
			<option value="rtlcenter">فارسی- وسط چین</option>
			<option value="rtlleft">فارسی- چپ چین</option>
			<option value="rtljustify">فارسی- تمام خط</option>
			<option value="ltrright">انگلیسی- راست چین</option>
			<option value="ltrcenter">انگلیسی- وسط چین</option>
			<option value="ltrleft">انگلیسی- چپ چین</option>
			<option value="ltrjustify">انگلیسی- تمام خط</option>
		</select>
	</nav>
	<nav id="font" class="right">
		<h5 class="subtitle">قلم</h5>
		<input type="text" class="text ltr" id="size" />
		<select class="select ltr" id="family">
			<option id="default" value="default">Default</option>
			<option id="soroosh" value="soroosh">B soroosh</option>
			<option id="roya" value="roya">B Roya</option>
			<option id="mitra" value="mitra">B Mitra</option>
			<option id="nazanin" value="nazanin">B Nazanin</option>
		</select>
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
	</nav>
	<nav id="background" class="right">
		<h5 class="subtitle">پس زمینه</h5>
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker" colspan="2">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="alpha" value="100" />
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
	</nav>
	<nav id="content" class="right">
		<h5 class="subtitle">محتوا</h5>
		<select class="select" id="type">
			<option id="static" value="static">ایستا</option>
			<option id="first" value="نام شما">پویا- نام</option>
			<option id="last" value="نام خانوادگی شما">پویا- نام خانوادگی</option>
			<option id="firstlast" value="نام و نام خانوادگی شما">پویا- نام و نام خانوادگی</option>
			<option id="phone" value="شماره تماس شما">پویا- شماره تماس</option>
			<option id="email" value="پست الکترونیک شما">پویا- پست الکترونیک</option>
			<option id="title" value="عنوان سایت شما">پویا- عنوان سایت</option>
			<option id="description" value="توضیحات سایت شما">پویا- توضیحات سایت</option>
			<option value="دسته بندی ها">پویا- دسته بندی ها</option>
			<option value="نام دسته">پویا- نام دسته</option>
			<option value="عنوان پست">پویا- عنوان پست</option>
		</select>
		<input type="text" class="text" id="text" />
	</nav>
	<nav class="remove right">
		<h5 class="subtitle">حذف المان از ماژول</h5>
		<button class="texture red" id="remove">این المان از ماژول حذف شود</button>
	</nav>
</div>

<div class="p">
	<nav id="text-align" class="right">
		<h5 class="subtitle">چینش قلم</h5>
		<select class="select">
			<option value="rtlright">فارسی- راست چین</option>
			<option value="rtlcenter">فارسی- وسط چین</option>
			<option value="rtlleft">فارسی- چپ چین</option>
			<option value="rtljustify">فارسی- تمام خط</option>
			<option value="ltrright">انگلیسی- راست چین</option>
			<option value="ltrcenter">انگلیسی- وسط چین</option>
			<option value="ltrleft">انگلیسی- چپ چین</option>
			<option value="ltrjustify">انگلیسی- تمام خط</option>
		</select>
	</nav>
	<nav id="font" class="right">
		<h5 class="subtitle">قلم</h5>
		<input type="text" class="text ltr" id="size" />
		<select class="select ltr" id="family">
			<option id="default" value="default">Default</option>
			<option id="soroosh" value="soroosh">B soroosh</option>
			<option id="roya" value="roya">B Roya</option>
			<option id="mitra" value="mitra">B Mitra</option>
			<option id="nazanin" value="nazanin">B Nazanin</option>
		</select>
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
	</nav>
	<nav id="background" class="right">
		<h5 class="subtitle">پس زمینه</h5>
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker" colspan="2">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="alpha" value="100" />
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
	</nav>
	<nav id="content" class="right">
		<h5 class="subtitle">محتوا</h5>
		<select class="select" id="type">
			<option id="static" value="static">ایستا</option>
			<option id="first" value="نام شما">پویا- نام</option>
			<option id="last" value="نام خانوادگی شما">پویا- نام خانوادگی</option>
			<option id="firstlast" value="نام و نام خانوادگی شما">پویا- نام و نام خانوادگی</option>
			<option id="phone" value="شماره تماس شما">پویا- شماره تماس</option>
			<option id="email" value="پست الکترونیک شما">پویا- پست الکترونیک</option>
			<option id="title" value="عنوان سایت شما">پویا- عنوان سایت</option>
			<option id="description" value="توضیحات سایت شما">پویا- توضیحات سایت</option>
			<option value="دسته بندی ها">پویا- دسته بندی ها</option>
			<option value="نام دسته">پویا- نام دسته</option>
			<option value="عنوان پست">پویا- عنوان پست</option>
			<option value="محتوای پست">پویا- محتوای پست</option>
		</select>
		<select class="select" id="category">
			<option value="محتوای پست ها">محتوای پست ها</option>
			<?php
				start_session();
				
				$user = session( 'user_info' );
				$prefix = $user['site_id']. '_';
				
				$categories = database( 'read', DB_NAME, array(
					'table_name'			=> $prefix. 'categories',
					'single'				=> false,
				) );
				
				for( $c = 2; $c <= $categories['nums']; $c++ ){
					echo '<option value="محتوای پست های '. $categories[$c]['name']. '">محتوای پست های '. $categories[$c]['name']. '</option>';
				}
			?>
		</select>
		<textarea rows="5" id="text"></textarea>
	</nav>
	<nav class="remove right">
		<h5 class="subtitle">حذف المان از ماژول</h5>
		<button class="texture red" id="remove">این المان از ماژول حذف شود</button>
	</nav>
</div>

<div class="button">
	<nav id="text-align" class="right">
		<h5 class="subtitle">چینش قلم</h5>
		<select class="select">
			<option value="rtlright">فارسی- راست چین</option>
			<option value="rtlcenter">فارسی- وسط چین</option>
			<option value="rtlleft">فارسی- چپ چین</option>
			<option value="rtljustify">فارسی- تمام خط</option>
			<option value="ltrright">انگلیسی- راست چین</option>
			<option value="ltrcenter">انگلیسی- وسط چین</option>
			<option value="ltrleft">انگلیسی- چپ چین</option>
			<option value="ltrjustify">انگلیسی- تمام خط</option>
		</select>
	</nav>
	<nav id="font" class="right">
		<h5 class="subtitle">قلم</h5>
		<input type="text" class="text ltr" id="size" />
		<select class="select ltr" id="family">
			<option id="default" value="default">Default</option>
			<option id="soroosh" value="soroosh">B soroosh</option>
			<option id="roya" value="roya">B Roya</option>
			<option id="mitra" value="mitra">B Mitra</option>
			<option id="nazanin" value="nazanin">B Nazanin</option>
		</select>
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
	</nav>
	<nav id="border" class="right">
		<h5 class="subtitle">حاشیه</h5>
		<select class="select" id="style">
			<option id="none" value="none">بدون حاشیه</option>
			<option id="solid" value="solid">خط کامل</option>
			<option id="dashed" value="dashed">خط چین</option>
			<option id="dotted" value="dotted">نقطه چین</option>
		</select>
		<input type="text" class="text ltr" id="width" />
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
	</nav>
	<nav id="background" class="right">
		<h5 class="subtitle">پس زمینه</h5>
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker" colspan="2">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="alpha" value="100" />
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
		<nav id="image" class="right">
			<img class="src" id="src" src="" />
			<button class="red" id="remove">حذف تصویر</button>
			<button class="blue" id="change">تغییر تصویر</button>
		</nav>
	</nav>
	<nav id="content" class="right">
		<h5 class="subtitle">محتوا</h5>
		<select class="select" id="type">
			<option id="static" value="static">ایستا</option>
			<option id="first" value="نام شما">پویا- نام</option>
			<option id="last" value="نام خانوادگی شما">پویا- نام خانوادگی</option>
			<option id="firstlast" value="نام و نام خانوادگی شما">پویا- نام و نام خانوادگی</option>
			<option id="phone" value="شماره تماس شما">پویا- شماره تماس</option>
			<option id="email" value="پست الکترونیک شما">پویا- پست الکترونیک</option>
			<option id="title" value="عنوان سایت شما">پویا- عنوان سایت</option>
			<option id="description" value="توضیحات سایت شما">پویا- توضیحات سایت</option>
		</select>
		<input type="text" class="text" id="text" />
	</nav>
	<nav class="remove right">
		<h5 class="subtitle">حذف المان از ماژول</h5>
		<button class="texture red" id="remove">این المان از ماژول حذف شود</button>
	</nav>
</div>

<div class="a">
	<nav id="content" class="right">
		<h5 class="subtitle">لینک</h5>
		<input type="text" class="text ltr" id="href" />
	</nav>
	<nav class="remove right">
		<h5 class="subtitle">حذف المان از ماژول</h5>
		<button class="texture red" id="remove">این المان از ماژول حذف شود</button>
	</nav>
</div>

<div class="input">
	<nav id="text-align" class="right">
		<h5 class="subtitle">چینش قلم</h5>
		<select class="select">
			<option value="rtlright">فارسی- راست چین</option>
			<option value="rtlcenter">فارسی- وسط چین</option>
			<option value="rtlleft">فارسی- چپ چین</option>
			<option value="rtljustify">فارسی- تمام خط</option>
			<option value="ltrright">انگلیسی- راست چین</option>
			<option value="ltrcenter">انگلیسی- وسط چین</option>
			<option value="ltrleft">انگلیسی- چپ چین</option>
			<option value="ltrjustify">انگلیسی- تمام خط</option>
		</select>
	</nav>
	<nav id="font" class="right">
		<h5 class="subtitle">قلم</h5>
		<input type="text" class="text ltr" id="size" />
		<select class="select ltr" id="family">
			<option id="default" value="default">Default</option>
			<option id="soroosh" value="soroosh">B soroosh</option>
			<option id="roya" value="roya">B Roya</option>
			<option id="mitra" value="mitra">B Mitra</option>
			<option id="nazanin" value="nazanin">B Nazanin</option>
		</select>
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
	</nav>
	<nav id="border" class="right">
		<h5 class="subtitle">حاشیه</h5>
		<select class="select" id="style">
			<option id="none" value="none">بدون حاشیه</option>
			<option id="solid" value="solid">خط کامل</option>
			<option id="dashed" value="dashed">خط چین</option>
			<option id="dotted" value="dotted">نقطه چین</option>
		</select>
		<input type="text" class="text ltr" id="width" />
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
	</nav>
	<nav id="background" class="right">
		<h5 class="subtitle">پس زمینه</h5>
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker" colspan="2">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="alpha" value="100" />
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
	</nav>
	<nav id="content" class="right">
		<h5 class="subtitle">متن</h5>
		<input type="text" class="text" id="placeholder" />
	</nav>
	<nav class="remove right">
		<h5 class="subtitle">حذف المان از ماژول</h5>
		<button class="texture red" id="remove">این المان از ماژول حذف شود</button>
	</nav>
</div>

<div class="textarea">
	<nav id="text-align" class="right">
		<h5 class="subtitle">چینش قلم</h5>
		<select class="select">
			<option value="rtlright">فارسی- راست چین</option>
			<option value="rtlcenter">فارسی- وسط چین</option>
			<option value="rtlleft">فارسی- چپ چین</option>
			<option value="rtljustify">فارسی- تمام خط</option>
			<option value="ltrright">انگلیسی- راست چین</option>
			<option value="ltrcenter">انگلیسی- وسط چین</option>
			<option value="ltrleft">انگلیسی- چپ چین</option>
			<option value="ltrjustify">انگلیسی- تمام خط</option>
		</select>
	</nav>
	<nav id="font" class="right">
		<h5 class="subtitle">قلم</h5>
		<input type="text" class="text ltr" id="size" />
		<select class="select ltr" id="family">
			<option id="default" value="default">Default</option>
			<option id="soroosh" value="soroosh">B soroosh</option>
			<option id="roya" value="roya">B Roya</option>
			<option id="mitra" value="mitra">B Mitra</option>
			<option id="nazanin" value="nazanin">B Nazanin</option>
		</select>
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
	</nav>
	<nav id="border" class="right">
		<h5 class="subtitle">حاشیه</h5>
		<select class="select" id="style">
			<option id="none" value="none">بدون حاشیه</option>
			<option id="solid" value="solid">خط کامل</option>
			<option id="dashed" value="dashed">خط چین</option>
			<option id="dotted" value="dotted">نقطه چین</option>
		</select>
		<input type="text" class="text ltr" id="width" />
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
	</nav>
	<nav id="background" class="right">
		<h5 class="subtitle">پس زمینه</h5>
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker" colspan="2">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="alpha" value="100" />
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
	</nav>
	<nav id="content" class="right">
		<h5 class="subtitle">متن</h5>
		<input type="text" class="text" id="placeholder" />
	</nav>
	<nav class="remove right">
		<h5 class="subtitle">حذف المان از ماژول</h5>
		<button class="texture red" id="remove">این المان از ماژول حذف شود</button>
	</nav>
</div>

<div class="img">
	<nav id="image" class="right">
		<h5 class="subtitle">تصویر</h5>
		<img class="src" id="src" src="" />
		<button class="red" id="remove">حذف تصویر</button>
		<button class="blue" id="change">تغییر تصویر</button>
	</nav>
	<nav class="remove right">
		<h5 class="subtitle">حذف المان از ماژول</h5>
		<button class="texture red" id="remove">این المان از ماژول حذف شود</button>
	</nav>
</div>

<div class="nav">
	<nav id="text-align" class="right">
		<h5 class="subtitle">چینش</h5>
		<select class="select">
			<option value="rtlright">راست به چپ- راست چین</option>
			<option value="rtlcenter">راست به چپ- وسط چین</option>
			<option value="rtlleft">راست به چپ- چپ چین</option>
			<option value="ltrright">چپ به راست- راست چین</option>
			<option value="ltrcenter">چپ به راست- وسط چین</option>
			<option value="ltrleft">چپ به راست- چپ چین</option>
		</select>
	</nav>
	<nav id="background" class="right">
		<h5 class="subtitle">پس زمینه</h5>
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker" colspan="2">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="alpha" value="100" />
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
	</nav>
	<nav class="remove right">
		<h5 class="subtitle">حذف المان از ماژول</h5>
		<button class="texture red" id="remove">این المان از ماژول حذف شود</button>
	</nav>
</div>

<div class="menu">
	<nav id="text-align" class="right">
		<h5 class="subtitle">چینش</h5>
		<select class="select">
			<option value="rtlright">راست به چپ- راست چین</option>
			<option value="rtlcenter">راست به چپ- وسط چین</option>
			<option value="rtlleft">راست به چپ- چپ چین</option>
			<option value="ltrright">چپ به راست- راست چین</option>
			<option value="ltrcenter">چپ به راست- وسط چین</option>
			<option value="ltrleft">چپ به راست- چپ چین</option>
		</select>
	</nav>
	<nav id="background" class="right">
		<h5 class="subtitle">پس زمینه</h5>
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker" colspan="2">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="alpha" value="100" />
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
	</nav>
	<nav class="remove right">
		<h5 class="subtitle">حذف المان از ماژول</h5>
		<button class="texture red" id="remove">این المان از ماژول حذف شود</button>
	</nav>
</div>

<div class="form">
	<nav id="text-align" class="right">
		<h5 class="subtitle">چینش</h5>
		<select class="select">
			<option value="rtlright">راست چین</option>
			<option value="rtlcenter">وسط چین</option>
			<option value="rtlleft">چپ چین</option>
		</select>
	</nav>
	<nav id="border" class="right">
		<h5 class="subtitle">حاشیه</h5>
		<select class="select" id="style">
			<option id="none" value="none">بدون حاشیه</option>
			<option id="solid" value="solid">خط کامل</option>
			<option id="dashed" value="dashed">خط چین</option>
			<option id="dotted" value="dotted">نقطه چین</option>
		</select>
		<input type="text" class="text ltr" id="width" />
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
	</nav>
	<nav id="background" class="right">
		<h5 class="subtitle">پس زمینه</h5>
		<table id="color">
			<tr>
				<td id="reference" style="width: 35px;">
					<button id="pointer"></button>
				</td>
				<td id="color-picker" colspan="2">
					<button id="pointer"></button>
				</td>
			</tr>
			<tr style="height: 35px;">
				<td id="preview-back">
					<nav id="preview"></nav>
				</td>
				<td>
					<input class="ltr" id="alpha" value="100" />
				</td>
				<td>
					<input class="ltr" id="value" value="#ff0000" />
				</td>
			</tr>
		</table>
	</nav>
	<nav class="remove right">
		<h5 class="subtitle">حذف المان از ماژول</h5>
		<button class="texture red" id="remove">این المان از ماژول حذف شود</button>
	</nav>
</div>

<nav class="operations">
	<button class="green" id="apply">اعمال تغییرات</button>
	<button class="gray" id="dismiss">بستن این پنجره</button>
</nav>
