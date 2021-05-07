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
        有用户提交了作业,详情如下:
    </p>
    <p>
        昵称:
        <code>{{$nickname}}</code>
    </p>
    <p>
        时间:
        <code>{{$submit_time}}</code>
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
