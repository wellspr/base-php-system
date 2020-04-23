# Boilerplate

## Simple routing system with Google login implementation.

### 1) Router

Setting up the router:

`$app = new Route();`

Setting a root route:

```
$app -> setRoute("/", function($req, $res){
  $res -> render("views", [
    'title' => 'Home',
    'contentDirectory' => "content",
    'contentFileName' => "home"
  ]);
});
```
Here you can define the directory's name and the name of the file to be rendered without the (.php) extension, as well as the page's title.

This router has support for routing id's:

```
$app -> setRoute("/user/:id", function($req, $res){
  $id = $req -> params('id');
  if($id=='info'){
    $res -> render("views", [
      'title' => 'User Info',
      'contentDirectory' => "user",
      'contentFileName' => "info"
    ]);
  }
}
```

Where info.php is some script for displaying some information about the user.

In the next example we send a `GET` request directly to the route `/user/get_params`, which renders the file `get_params.php` as `/user/get_params?name=Paulo`(note that you don't need to include the .php).

In general is possible to render any page as well with get requests:

`/any_path?title=some+title&file_name=file-name&dir_name=dir-name`

A method called `get_query_params` manages the query variables. Taking as example the route /user/get_params:

```
$app -> setRoute("/user/:id", function($req, $res){

  $id = $req -> params('id');

  if($id=='get_params'){

    $req_uri = $req->get_request_uri();
    $params = Request :: get_query_params($req_uri);

    if(isset($params['title'])){
      $title = $params['title'];
    }else{
      $title = "Get User Params";
    }

    if(isset($params['file_name'])){
      $file_name = $params['file_name'];
    }else{
      $file_name = 'get_params';
    }

    if(isset($params['dir_name'])){
      $dir_name = $params['dir_name'];
    }else{
      $dir_name = 'user';
    }

    $res -> render("views", [
      'title' => "$title",
      'contentDirectory' => "$dir_name",
      'contentFileName' => "$file_name"
    ]);
  }
});
```

