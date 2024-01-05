<!DOCTYPE html>
<html lang="zh">
<body>
<style>
    .qmbox img {
        max-width: 100%;
        height: auto;
    }

    .qmbox p.details {
        font-style: italic;
        color: #777;
    }

    .qmbox .footer p {
        font-size: small;
        color: #777;
    }

    .qmbox pre.commit-message {
        white-space: pre-wrap;
    }

    .qmbox .file-stats a {
        text-decoration: none;
    }

    .qmbox .file-stats .new-file {
        color: #090;
    }

    .qmbox .file-stats .deleted-file {
        color: #B00;
    }
</style>

<meta>

<div class="content">
    <p>
        你好 18580880040!
    </p>
    <p>
        你的平台增加了一个新的会员:
    </p>
    <p>
        昵称:
        <code>{{$userInfo['nickname']}}</code>
    </p>
    <p>
        头像:
        <img src="{{$userInfo['avatar']}}" width="80px" height="80px">
    </p>


</div>
<div class="footer" style="margin-top: 10px;">
    <p>
       请勿回复此邮件
    </p>
</div>


<style type="text/css">.qmbox style, .qmbox script, .qmbox head, .qmbox link, .qmbox meta {
        display: none !important;
    }</style>
</body>
</html>
