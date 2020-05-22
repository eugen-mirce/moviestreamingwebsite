<!DOCTYPE html>
<html>
<head>
 <title>Admin</title>
 <link rel="stylesheet" type="text/css" href="stylesheet.css">
 <script src="https://kit.fontawesome.com/f6cad20e11.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="header">
  <ul class="menu">
    <li class="item"><a href="#">Dashboard</a></li>
    <li class="item"><a href="#">Movies</a>
  <ul>
    <li class="dropdown"><a href="">Movie List</a></li>
    <li class="dropdown"><a href="">New Movie</a></li>
    </ul>
  </li>
  <li class="item"><a href="#">TV Series</a>
    <ul>
    <li class="dropdown"><a href="">TV List</a></li>
    <li class="dropdown"><a href="">New TV</a></li>
    </ul>
  </li>
  <li class="item"><a href="#">Users</a>
  <li class="item"><a href="">Settings</a></li>
  <li class="item"><a href="">Logout</a></li>
  </li>
  </ul>
</div>
<div class="content list">
    <div class="top-bar">
        <a href="#">Add New Movie</a>
        <form>
             <input type="text" placeholder="Search...">
        </form>
        <div class="srcbttn">
        <i class="fas fa-search"></i>
        </div>
    </div>
    <div class="results">
        <table class="results-table"> 
            <tr>
                <th>Title</th>
                <th>Added Date</th>
                <th>Views</th>
                <th>Edit</th>
                <th>Remove</th>
            </tr>
            <tr>
                <td>Avengers</td>
                <td>21/32/2345</td>
                <td>69</td>
                <td><a href="#">Edit</a></td>
                <td><a href="#">Remove</a></td>
            </tr>
            <tr>
                <td>Avensfsfyualitgsyfaitsrgsergers</td>
                <td>21/32/2345</td>
                <td>69</td>
                <td><a href="#">Edit</a></td>
                <td><a href="#">Remove</a></td>
            </tr>
            <tr>
                <td>Avengers</td>
                <td>21/32/2345</td>
                <td>69</td>
                <td><a href="#">Edit</a></td>
                <td><a href="#">Remove</a></td>
            </tr>
            <tr>
                <td>Avengers</td>
                <td>21/32/2345</td>
                <td>69</td>
                <td><a href="#">Edit</a></td>
                <td><a href="#">Remove</a></td>
            </tr>
            <tr>
                <td>Avengers</td>
                <td>21/32/2345</td>
                <td>69</td>
                <td>Edit</td>
                <td>Remove</td>
            </tr>

        </table>
    </div>
    <div class="pagination">
    <ul class="pagination">
		<li class="disabled"><a href="#">1</a></li>
		<li><a href="#">2</a></li>
	</ul>
    </div>
</div>
</body>
</html>