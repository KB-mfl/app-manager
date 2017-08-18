<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>后台测试</title>
    </head>
    <body>
        <h1>user</h1>
        <form action="/api/register" method="post">
            name:<input type="text" name="username">
            password:<input type="password" placeholder="password" name="password">
            admin<input type="checkbox" name="admin" value="true">
            <input type="submit" value="register">
        </form>
        <form action="/login" method="post">
            name:<input type="text" name="username">
            password:<input type="password" placeholder="password" name="password">
            <input type="submit" value="login">
        </form>
        <form action="/check" method="get">
            <input type="submit" value="check">
        </form>
        <form action="/logout" method="post">
            <input type="submit" value="logout">
        </form>


        <h1>app</h1>
        <form action="/api/addapp" enctype="multipart/form-data" method="post">
            
            name:<input type="text" name="name">
            <input type="submit">
        </form>
        <form action="/api/applist" method="get">
            <input type="hidden" name="username" value="qiankaihua">
            <input type="hidden" name="apiToken" value="8679eeb3-33d2-48b2-9ae6-816b34287f6f">
            has_deleted<input type="checkbox" name="want_deleted" value="true">
            list<input type="submit">
        </form>
        <form action="/api/1/deleteapp" method="post">
            
            <input type="hidden" name="_method" value="DELETE" size="50" />
            delete_id:<input type="text" name="app_id">
            <input type="submit">
        </form>
        <form action="/api/1/readapp" method="post">
            
            <input type="hidden" name="_method" value="PUT" size="50" />
            readdapp_id:<input type="text" name="app_id">
            <input type="submit">
        </form>
        <h1>system</h1>
        <form action="/api/1/system" enctype="multipart/form-data" method="post">
        
            app_id:<input type="text" name="app_id">
            system:<input type="text" name="system">
            logo:<input type="file" id="file" name="file">
            identification:<input type="text" name="identification">
            <input type="submit">
        </form>
        <form action="/api/1/system" method="get">
        
            has_deleted:<input type="checkbox" name="want_deleted" value="true">
            list:<input type="submit">
        </form>
        <form action="/api/1/system" method="post">

            <input type="hidden" name="_method" value="DELETE" size="50" />
            删除：<input type="text" name="system_id">
            <input type="submit">
        </form>
        <form action="/api/1/system" method="post">

            <input type="hidden" name="_method" value="PUT" size="50" />
            恢复：<input type="text" name="system_id">
            <input type="submit">
        </form>
        <h1>version</h1>
        <form action="/api/1/version" enctype="multipart/form-data" method="post">
            
            <input type="hidden" name="username" value="admin">
            <input type="hidden" name="apitoken" value="f846b380-2fbc-442a-8c8b-071db1c1feee">
            version:<input type="text" name="version">
            file:<input id="file" type="file" name="file"/>
　　         <input type="submit" value="upload" />
        </form>
        <form action="/api/1/version" method='get'>
            
            limit:<input type="text" name='limit'>
            has_deleted:<input type="checkbox" name="want_deleted" value="true">
            list<input type="submit">
        </form>
        <form action="/api/1/version" method='post'>
            
            <input type="hidden" name="_method" value="DELETE" size="50" />
            delete_id:<input type="text" name='version_id'>
            delete:<input type="submit">
        </form>
        <form action="/api/1/version" method='post'>
            
            <input type="hidden" name="_method" value="PUT" size="50" />
            recover_id:<input type="text" name='version_id'>
            recover:<input type="submit">
        </form>
        <h1>Download</h1>
        <form action="/api/download" method="get">
            
            version_id:<input type="text" name="version_id">
            get:<input type="submit">
        </form>
        <h1>Image</h1>
        <form action="/api/1/image" enctype="multipart/form-data" method="post">
            
            img:<input id="file" type="file" name="file"/>
            upload:<input type="submit">
        </form>
        <form action="/api/1/image" method="get">

            show:<input type="submit">
        </form>
        <h1>Data</h1>
        <form action="/api/1/data" method="get">
            
            <input type="checkbox" name="want_deleted" value="true">
            <input type="submit">
        </form>
        <form action="/api/1/data" method="post">
            
            key:<input type="text" name="key">
            value:<input type="text" name="value">
            add:<input type="submit">
        </form>
        <form action="api/1/data" method="post">
            
            <input type="hidden" name="_method" value="PUT" size="50" />
            key:<input type="text" name="key">
            value:<input type="text" name="value">
            change:<input type="submit">
        </form>
        <form action="api/1/data" method="post">
            
            <input type="hidden" name="_method" value="DELETE" size="50" />
            key:<input type="text" name="key">
            delete:<input type="submit">
        </form>
        <h1>FirstScreen</h1>
        <form action="api/1/first_screen" enctype="multipart/form-data" method="post">

            <input type="hidden" name="username" value="qiankaihua">
            <input type="hidden" name="apiToken" value="a5860f3d-36b9-48b7-a2dd-48f07accda8a">
            content:<input type="text" name="content">
            img:<input type="file" name="file" id="file">
            <input type="submit">
        </form>
        <form action="api/1/first_screen" method="get">
        
            list:<input type="submit">
        </form>
        <form action="api/1/first_screen" method="post">

            <input type="hidden" name="_method" value="DELETE" size="50" />
            delete<input type="text" name="first_screen_id">
            <input type="submit">
        </form>
        <form action="api/1/first_screen" method="post">

            <input type="hidden" name="_method" value="PUT" size="50" />
            active<input type="text" name="first_screen_id">
            <input type="submit">
        </form>
        <h1>feedback</h1>
        <form action="api/1/feedback" method="post">

            title:<input type="text" name="title">
            content:<input type="text" name="content">
            feedback_id<input type="text" name="feedback_id">
            <input type="submit">
        </form>
        <form action="api/1/feedback" method="get">
            
            list:<input type="submit">
        </form>
        <form action="api/1/feedback" method="post">
        
            <input type="hidden" name="_method" value="DELETE" size="50" />
            delete<input type="text" name="feedback_id">
            <input type="submit">
        </form>
        <!--a href='192.168.1.101:8000/app/apps' download='robots.txt' target='_blank'>xiazai</a-->
    </body>
</html>