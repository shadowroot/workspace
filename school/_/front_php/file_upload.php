<form method="post" action="" enctype="multipart/form-data" onsubmit="up.submit()">
	<div id="content">
		<span><input type="file" name="pictures0[]" multiple="multiple" onchange="if(this.value != ''){up.getValue(this.value);}" /></span>
		<span><textarea name="pictures_subscribe0" cols="50" rows="4" ></textarea></span><br />
	</div>
	<span><a href="javascript:up.pic_add();">Pøidat obrázek</a></span>
	<span><input type="submit" value="Uložit" id="submit" /></span>
</form>