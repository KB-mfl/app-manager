<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>test</title>
    </head>
    <body>
        <h1>app</h1>
        <form action="/api/appmanager/addapp" enctype="multipart/form-data" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            name:<input type="text" name="name">
            hash_name:<input type="text" name="hash_name">
            logo:<input id="img" type="file" name="logo"/>
            image:<input id="img" type="file" name="image"/>
            <input type="submit">
        </form>
        <form action="/api/appmanager/applist" method="get">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            has_deleted<input type="checkbox" name="want_deleted" value="true/false">
            list<input type="submit">
        </form>
        <form action="/api/appmanager/2/deleteapp" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="DELETE" size="50" />
            delete_id:<input type="text" name="app_id">
            <input type="submit">
        </form>
        <form action="/api/appmanager/2/readdapp" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="PUT" size="50" />
            readdapp_id:<input type="text" name="app_id">
            <input type="submit">
        </form>
        <h1>history</h1>
        <form action="/api/appmanager/1/history" enctype="multipart/form-data" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            varsion:<input type="text" name="varsion">
            system:<input type="text" name="system">
            <input id="file" type="file" name="new_app"/>
　　         <input type="submit" value="upload" />
        </form>
        <form action="/api/appmanager/1/history" method='get'>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            limit:<input type="text" name='limit'>
            has_deleted:<input type="checkbox" name="want_deleted" value="true/false">
            list<input type="submit">
        </form>
        <form action="/api/appmanager/1/history" method='post'>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="DELETE" size="50" />
            delete_id:<input type="text" name='history_id'>
            delete:<input type="submit">
        </form>
        <form action="/api/appmanager/1/history" method='post'>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="PUT" size="50" />
            recover_id:<input type="text" name='history_id'>
            recover:<input type="submit">
        </form>
        <h1>Download</h1>
        <form action="/api/appmanager/1/download" method="get">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            history_id:<input type="text" name="history_id">
            get:<input type="submit">
        </form>
        <h1>Image</h1>
        <form action="/api/appmanager/1/image" enctype="multipart/form-data" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            img:<input id="img" type="file" name="img"/>
            is_logo:<input type="checkbox" name="is_logo" value="true/false">
            upload:<input type="submit">
        </form>
        <h1>Data</h1>
        <form action="/api/appmanager/1/data" method="get">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="checkbox" name="want_deleted" value="true/false">
            <input type="submit">
        </form>
        <form action="/api/appmanager/1/data" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            key:<input type="text" name="key">
            value:<input type="text" name="value">
            add:<input type="submit">
        </form>
        <form action="api/appmanager/1/data" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="PUT" size="50" />
            key:<input type="text" name="key">
            value:<input type="text" name="value">
            change:<input type="submit">
        </form>
        <form action="api/appmanager/1/data" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="DELETE" size="50" />
            key:<input type="text" name="key">
            delete:<input type="submit">
        </form>
    </body>
</html>