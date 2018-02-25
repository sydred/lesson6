<?php
if(isset($_FILES['myfile']['name']) && !empty($_FILES['myfile']['name']))
{
	if($_FILES['myfile']['error'] == UPLOAD_ERR_OK &&
		move_uploaded_file($_FILES['myfile']['tmp_name'], $_FILES['myfile']['name']))
	{
		echo "<p style='color:green'>файл с тестом загружен</p>";
	}
	else 
	{
		echo "<p style='color:red'>файл с тестом не загружен</p>";
	} 
}
?>

<form method="post" action="list.php" enctype="multipart/form-data">
	Ваша фамилия <input type="text" name="surname">
	Файл с тестом <input type="file" name="file">
	<input type="submit" name="отправить">
</form>