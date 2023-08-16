<!DOCTYPE html>
<html>
<head>
  <title>Attachment Email</title>
</head>
<body>
  <h1>Attachment Email</h1>
  <p>Please find the attached file.</p>
  <img src="{{ $message->embed($data['file_path']) }}">
</body>
</html>