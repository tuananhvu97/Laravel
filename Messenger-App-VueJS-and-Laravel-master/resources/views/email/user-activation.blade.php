<!DOCTYPE html>
<html>
<head>
	<title>Mail xác nhận</title>
</head>
<body>
	<p>
		Chào mừng {{ $user->name }} đã đăng ký thành viên tại Messege App. Bạn hãy click vào đường link sau đây để hoàn tất việc đăng ký.
		</br>
		<a href="{{ $user->activation_link }}">{{ $user->activation_link }}</a>
	</p>
</body>
</html>