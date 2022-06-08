<!DOCTYPE html>
<html lang="en">

<head>
	<META HTTP-EQUIV="Expires" CONTENT="0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<LINK rel="stylesheet" type="text/css" href="/static/css/feedback.css">
	<link rel="SHORTCUT ICON" href="/static/favicon.ico">
	<title>lain game :: feedback</title>
</head>

<body>
	<center>
		<a href="/">index</a>&nbsp;&nbsp;&nbsp;
		<a href="/about">about</a>&nbsp;&nbsp;&nbsp;
		<a href="javascript:history.go(-1)">back</a>
	</center>

	<center>
		<div class="greenbox">
			<div class="content">
				Any comments / suggestions?<br><br>
				<table>
					<form action='/feedback' method='post'>
						<tr>
							<td colspan="2">Email:</td>
							<td colspan="2"><input class="in" type=text name=email></td>
						</tr>
						<tr>
							<td colspan="2">Body:</td>
							<td colspan="2"><textarea class="taa" name=body rows=10></textarea></td>
						</tr>
						<input type=submit value="Send Email">
					</form>
				</table>
			</div>
		</div>

		<br>
	</center>
</body>

</html>