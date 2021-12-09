<?php
  if(isset($_POST['submit'])){
    require ('uploadFile.php');
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <div class="p-5 mb-4 bg-light rounded-3"  style="background-image: url(./images/187161.webp); background-repeat: no-repeat, repeat;  background-size: cover;background-position: center;">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">...AUTOMATICALLY SAVE YOUR CONTACTS DIRECTLY INTO YOUR GOOGLE CONTACTS...</h1>
        </div>
      </div>
    <div class="container py-4">
        <div class="shadow-lg p-3 mb-5 bg-body rounded">
            <div class="card text-center">
                <div class="card-header">
                v 1.0
                </div>
                <div class="card-body">
                <h5 class="card-title">Click the browse button to select the excel file that contains the contact details you want to read and save into your Google contacts</h5>
                <form action="<?php $_PHP_SELF ?>" method="post" enctype="multipart/form-data">
                  <div class="mb-3">
                    <input type="file" name="file">
                  </div>
                  <div class="mb-3">
                    <button type="submit" name="submit" class="btn btn-primary">SUBMIT FILE</button>
                  </div>
                </form>
                </div>
                <div class="card-footer text-muted">
                  B. Mlamleli
                </div>
            </div>
            <div class="card text-center">
            <!-- Table -->
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name(s)</th>
                  <th scope="col">Surname</th>
                  <th scope="col">Contact number</th>
                </tr>
              </thead>
              <tbody>
              <?php
                if(isset($_POST['submit'])){
                  $i = 1;
                  foreach($data[1] as $key){
                    echo "<tr><td>".$i++."</td>".
                          "<td>".$key['A']."</td>".
                          "<td>".$key['B']."</td>".
                          "<td>"."0".$key['C']."</td></tr>";
                  }
                }
              ?>
              </tbody>
            </table>
            <div>
            <!-- end of table -->
        </div>
    </div>
  </body>
</html>

<!-- https://www.youtube.com/watch?v=JaRq73y5MJk -->