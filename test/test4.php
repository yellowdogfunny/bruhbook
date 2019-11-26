<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Upload status with img</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </script>

  <script>
    function doSubmit(){
      // Form Data
      var formData = new FormData();

      var fileSelect = document.getElementById("fileSelect");
      if(fileSelect.files && fileSelect.files.length == 1){
       var file = fileSelect.files[0]
       formData.set("file", file , file.name);
      }

      var input1 = document.getElementById("input1");
      formData.set("input1", input1.value)
      // Http Request
      var request = new XMLHttpRequest();
      request.open('POST', "../php/create-post.php");
      request.send(formData);
    }
  </script>
  </head>
  <body>
    <form>
      <input type="text" id="input1"/>
      <input type="file" id="fileSelect"/>
      <button type="button" onclick="doSubmit()">Submit</button>
    </form>
  </body>
</html>
