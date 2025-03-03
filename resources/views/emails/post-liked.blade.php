<!DOCTYPE html>
<html>
<head>
    <title>Post Liked Notification</title>
</head>
<body>
    <h1>Your Post Was Liked!</h1>
    <p>
        Hello,
    </p>
    <p>
        {{ $liker->name }} liked your post "{{ $post->title }}".
    </p>
    <p>
        <a href="{{ url('/posts/' . $post->id) }}">Click here</a> to view the post.
    </p>
    <p>Thank you for using our platform!</p>
</body>
</html>