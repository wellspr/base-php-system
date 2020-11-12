# Base PHP

## Simple routing system with login implementation.

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
