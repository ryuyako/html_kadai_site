<html>
<head>
<meta charset="utf-8">
<title>POST練習</title>
<script>
function validateForm() {
    var name = document.forms["myForm"]["name"].value;
    var mail = document.forms["myForm"]["mail"].value;
    var favoritelanguage = document.forms["myForm"]["favoritelanguage"].value;
    var unfavoritelanguage = document.forms["myForm"]["unfavoritelanguage"].value;

    if (name === "" || mail === "" || favoritelanguage === "empty" || unfavoritelanguage === "empty") {
        alert("全ての情報を入力してください");
        return false;
    }
}
</script>
</head>
<body>
<form name="myForm" action="write.php" method="post" onsubmit="return validateForm()">
	<p>お名前: <input type="text" name="name"></p>
	<p>EMAIL: <input type="text" name="mail"></p>
	<p>好きなプログラミング言語:
		<select name="favoritelanguage">
			<option value="empty"></option>
			<option value="HTML">HTML</option>
			<option value="CSS">CSS</option>
			<option value="JavaScript">JavaScript</option>
			<option value="PHP">PHP</option>
			<option value="Python">Python</option>
		</select>
	</p>
	<p>苦手なプログラミング言語:
		<select name="unfavoritelanguage">
			<option value="empty"></option>
			<option value="HTML">HTML</option>
			<option value="CSS">CSS</option>
			<option value="JavaScript">JavaScript</option>
			<option value="PHP">PHP</option>
			<option value="Python">Python</option>
		</select>
	</p>
	<input type="submit" value="送信">
</form>
<ul>
<li><a href="index.php">index.php</a></li>
</ul>
</body>
</html>
